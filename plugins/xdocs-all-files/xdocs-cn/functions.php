<?php


function xdocs_create_files($post_id = '', $html = '', $theme_name = 'theme1')
{

    //Secify the file name with location
    $file = WP_PLUGIN_DIR . '/xdocs/documents/index.html';

    // The new person to add to the file
    // Write the contents to the file,
    // using the FILE_APPEND flag to append the content to the end of the file
    // and the LOCK_EX flag to prevent anyone else writing to the file at the same time

    $file = WP_PLUGIN_DIR . '/xdocs/documents/index.html';
    xdocs_mkdir($file);

    //Get all images used in a post before chagnging path
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $img) {
        $src = $img->getAttribute('src');
        download_images($src);
    }


    // $html = preg_replace('~<img\s[^>]*?src="(.*?\/)([^/"]*)"~', '<img src="assets/img/\2"', $html);

    $html = preg_replace_callback('~<img src="([^"]*)"(?: class="([^"]*)")?>~i',
        function ($m) {
            return '<img src="' . (isset($m[2]) ? '"assets/img/' : $m[1]) . '" class="' . ($m[2] ?: '') . '">';
        }, $html);

    $html = preg_replace('~<script\s[^>]*?src="(.*?\/)([^/"]*)"~', '<script src="assets/js/\2"', $html);
    $html = preg_replace('~<link\s[^>]*?href="(.*?\/)([^/"]*)"~', '<link rel="stylesheet" href="assets/css/\2"', $html);
    file_put_contents($file, $html, LOCK_EX);


    global $files_to_zip;

    $files_to_zip = array($file);


    //Get all attachments used in a post
    $attachments = get_children(
        array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => 'inherit',
            'orderby' => 'title',
            'order' => 'ASC',
            'post_mime_type' => 'image',

        )
    );

    $images_to_zip = array();
    foreach ($attachments as $attachment) {

        $images_to_zip [] = wp_get_attachment_url($attachment->ID);
        download_images(wp_get_attachment_url($attachment->ID));
    }


    $all_files = array();
    $all_files = array_merge($files_to_zip, $images_to_zip);


    $xdocs_url = WP_PLUGIN_DIR . '/xdocs/';


    /**
     * copy slected theme css files
     */
    xdocs_xcopy($xdocs_url . 'themes/' . $theme_name . '/assets', $xdocs_url . 'documents/assets');


    /**
     * Remove Zip if there is any
     */
    if (file_exists($xdocs_url . 'documentation.zip')) {
        unlink($xdocs_url . 'documentation.zip');
    }

    /**
     * Now create zip
     */
    xdocs_zip($xdocs_url . 'documents', $xdocs_url . 'documentation.zip');


    /**
     * Our Work is done lets remove image folder and everything in it
     */
    xdocs_Deletedirectory($xdocs_url . 'documents');



}


/* creates a compressed zip file */
function create_zip($files = array(), $destination = '', $overwrite = false)
{
    //if the zip file already exists and overwrite is false, return false
    if (file_exists($destination) && !$overwrite) {
        return false;
    }
    //vars
    $valid_files = array();
    //if files were passed in...
    if (is_array($files)) {
        //cycle through each file
        foreach ($files as $file) {
            //make sure the file exists
            if (file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if (count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach ($valid_files as $file) {


            $zip->addFile($file, WP_PLUGIN_DIR . '/xdocs/documents/' . basename($file));
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return file_exists($destination);
    } else {
        return false;
    }
}


function download_images($my_url)
{


    /**
     * Initialize the cURL session
     */
    $ch = curl_init();

    /**
     * Set the URL of the page or file to download.
     */
    curl_setopt($ch, CURLOPT_URL, $my_url);

    /**
     * Create a new file
     */
    $filename = WP_PLUGIN_DIR . '/xdocs/documents/assets/img/' . basename($my_url);

    xdocs_mkdir($filename);

    $fp = fopen($filename, 'w');

    /**
     * Ask cURL to write the contents to a file
     */
    curl_setopt($ch, CURLOPT_FILE, $fp);

    /**
     * Execute the cURL session
     */
    curl_exec($ch);

    /**
     * Close cURL session and file
     */
    curl_close($ch);
    fclose($fp);
}


// function xdocs_url_filter($text){

//   // base url needs trailing /
//   // // Replace links
//   // $pattern = "/<a([^>]*) " .
//   //            "href=\"[^http|ftp|https|mailto]([^\"]*)\"/";
//   // $replace = "<a\${1} href=\"" . $base . "\${2}\"";
//   // $text = preg_replace($pattern, $replace, $text);
//   // Replace images
//   $pattern = "/<img([^>]*) " . 
//              "src=\"[^http|ftp|https]([^\"]*)\"/";
// $base = 'xxxx';
//   $replace = "<img\${1} src=\"" . basename(${2}) . "\${2}\"";
//   $text = preg_replace($pattern, $replace, $text);
//   // Done
//   return $text;
// }


function xdocs_zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                continue;

            $file = realpath($file);

            if (is_dir($file) === true) {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            } else if (is_file($file) === true) {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    } else if (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}


/**
 * Copy a file, or recursively copy a folder and its contents
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.1
 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
 * @param       string $source Source path
 * @param       string $dest Destination path
 * @param       string $permissions New folder creation permissions
 * @return      bool     Returns true on success, false on failure
 */
function xdocs_xcopy($source, $dest, $permissions = 0755)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, $permissions);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        xdocs_xcopy("$source/$entry", "$dest/$entry", $permissions);
    }

    // Clean up
    $dir->close();
    return true;
}


function xdocs_Deletedirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!xdocs_Deletedirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}


function xdocs_mkdir($filename)
{

    $dirname = dirname($filename);
    if (!is_dir($dirname)) {
        mkdir($dirname, 0755, true);
    }
}


function xdocs_url()
{
    $theme_name = get_field('select_theme');
    if (isset($theme_name)) {
        return plugin_dir_url(__FILE__) . 'themes/' . $theme_name;
    }
}


function xdocs_field($field_name = '')
{
    global $post_id;
    $queried_post = get_post($post_id);

    if ($field_name == 'title') {
        $value = $queried_post->post_title;
    } elseif ($field_name == 'content') {
        $value = $queried_post->post_content;
    } elseif (get_field($field_name, $post_id)) {
        $value = get_field($field_name, $post_id);
    } elseif (get_sub_field($field_name, $post_id)) {
        $value = get_sub_field($field_name, $post_id);

    } else {
        $value = 'BAD VALUE';
    }
    return $value;
}

//websoft9开发的短代码
include 'xdocs-shortcode.php';

?>