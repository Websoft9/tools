<?php

/**
 * Plugin Name: xdocs
 * Plugin URI: http://themeforest.com/xvelopers
 * Description: Create awesome documentation for your product using xdocs and export them to html or pdf formats.
 * Version: 1.0.2
 * Author: Nauman Ahmad - Xvelopers
 * Author URI: http://xvelopers.com
 * License: A "Slug" license name e.g. GPL12
 */
class xv_xdocs
{

    private static $instance;

    /**
     *  Initiator
     */

    public static function init()
    {
        return self::$instance;
    }

    /**
     *  Constructor
     */

    public function __construct()
    {

        global $post;
        global $theme_name;

        // settings
        $this->settings = array(
            'path' => plugin_dir_url(__FILE__),
            'dir' => plugin_dir_url(__FILE__) . 'assets/',
            'version' => '1.0.0'
        );


        require_once 'inc/acf-init.php';


        add_action('init', array(&$this, 'xdocs_init'));


        add_filter('single_template', array(&$this, 'get_custom_post_type_template'));


        add_action('post_submitbox_misc_actions', array(&$this, 'add_my_media_button'));


        add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'), 50);


        require_once 'functions.php';

        //Shortcode Plugins

        if (!class_exists('BootstrapShortcodes')) {
            require_once 'inc/shortcodes/bootstrap-shortcodes/bootstrap-shortcodes.php';
        }
        if (!class_exists('WP_Prism_Syntax_Highlighter')) {
            require_once 'inc/shortcodes/wp-prism-syntax-highlighter/wp-prism-syntax-highlighter.php';
        }

    }

    public function xdocs_init()
    {
        $this->custom_post_type();
        $this->xdocs_post_id();
        $this->xdocs_theme_name();
    }

    public function add_my_media_button()
    {

        global $post;
        global $theme_name;

        global $new_id;
        $new_id = $post->ID;


        $nonce = wp_create_nonce('xdocs_make_zip');
        $download_url = plugin_dir_url(__FILE__) . "documentation.zip";
        $download_pdf = plugin_dir_url(__FILE__) . "inc/pdf/pdf_server.php";
        $post_type = get_post_type();
        if ($post_type == 'xdocs') {
            echo '<div class="xdocs_zip"><a class="button button-primary button-large xdocs-zip " data-theme="' . $this->xdocs_theme_name() . '" data-url="' . $download_url . '"   data-nonce="' . $nonce . '" data-id="' . $post->ID . '"  href="#">Download Zip</a></div>';

            echo '<div class="xdocs_zip"><a class="button button-primary button-large xdocs-pdf " data-theme="' . $this->xdocs_theme_name() . '" data-url="' . $download_pdf . '"   data-nonce="' . $nonce . '" data-id="' . $post->ID . '"  href="#">Download PDF</a></div><div class="loader" id="loader" style="display:none"></div> ';


        }
    }

    public function admin_enqueue_scripts()
    {

        // Register the script
        wp_enqueue_style('xdocs_main', $this->settings['dir'] . '/css/main.css');

        // Register the script
        wp_register_script('xdocs_main', $this->settings['dir'] . '/js/main.js');

        // Localize the script with new data
        $translation_array = array(
            'ajaxurl' => admin_url('admin-ajax.php')
        );
        wp_localize_script('xdocs_main', 'myAjax', $translation_array);

        // Enqueued script with localized data.
        wp_enqueue_script('xdocs_main');

    }

    // Register Custom Post Type
    public function custom_post_type()
    {

        $labels = array(
            'name' => _x('xdocs', 'Post Type General Name', 'xdocs'),
            'singular_name' => _x('xdoc', 'Post Type Singular Name', 'xdocs'),
            'menu_name' => __('XDocs', 'xdocs'),
            'name_admin_bar' => __('XDocs', 'xdocs'),
            'parent_item_colon' => __('Parent Item:', 'xdocs'),
            'all_items' => __('All Items', 'xdocs'),
            'add_new_item' => __('Add New Item', 'xdocs'),
            'add_new' => __('Add New', 'xdocs'),
            'new_item' => __('New Item', 'xdocs'),
            'edit_item' => __('Edit Item', 'xdocs'),
            'update_item' => __('Update Item', 'xdocs'),
            'view_item' => __('View Item', 'xdocs'),
            'search_items' => __('Search Item', 'xdocs'),
            'not_found' => __('Not found', 'xdocs'),
            'not_found_in_trash' => __('Not found in Trash', 'xdocs'),
        );
        $args = array(
            'label' => __('xdoc', 'xdocs'),
            'description' => __('Create Documentation', 'xdocs'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'tags'),
            'taxonomies' => array('category'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('xdocs', $args);

    }

    public function get_custom_post_type_template($single_template)
    {
        global $post;
        $theme_name = '';

        echo $post->id;

        if ($post->post_type == 'xdocs') {

            $theme_name = get_field('select_theme');

            if (isset($theme_name)) {
                ///include(WP_PLUGIN_DIR .'/xdocs/themes/functions.php');


                $theme_name = get_field('select_theme');
                $single_template = dirname(__FILE__) . '/themes/' . $theme_name . '/index.php';
                include('themes/theme-functions.php');
            }
        }
        return $single_template;
    }

    public function xdocs_post_id()
    {
        global $post;
        global $post_id;

        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $post_id = $_REQUEST['id'];
        } else {
            $post_id = get_the_ID();
        }

        return $post_id;

    }

    public function xdocs_theme_name()
    {
        global $post;

        global $theme_name;

        if (isset($_REQUEST['theme']) && !empty($_REQUEST['theme'])) {

            $theme_name = $_REQUEST['theme'];

        } elseif (get_field('select_theme')) {

            $theme_name = get_field('select_theme');
        } else {
            $theme_name = 'theme1';
        }
        return $theme_name;
    }

}  //Class end


add_action('wp_ajax_xdocs_zip_operation', 'xdocs_zip_operation');
function xdocs_zip_operation()
{

    $xv_xdocs = new xv_xdocs();
    $post_id = $xv_xdocs->xdocs_post_id();
    $theme_name = $xv_xdocs->xdocs_theme_name();

    echo $post_id;
    echo $theme_name;

    ob_start();
    include('themes/theme-functions.php');
    require_once 'themes/' . $theme_name . '/index.php';
    $html = ob_get_clean();

    xdocs_create_files($post_id, $html, $theme_name);
    echo 'zip created';
}

add_action('wp_ajax_xdocs_pdf_operation', 'xdocs_pdf_operation');
function xdocs_pdf_operation()
{

    ob_start();
    include('themes/theme-functions.php');
    require_once 'inc/pdf/index.php';
    $html = ob_get_clean();

    $url = 'http://freehtmltopdf.com';
    $data = array('convert' => '',
        'html' => $html,
        'baseurl' => site_url()
    );

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    $file = WP_PLUGIN_DIR . '/xdocs/inc/pdf/documentation.pdf';
    xdocs_mkdir($file);

    file_put_contents($file, $result, LOCK_EX);
    //echo($result);
    echo 'PDF Created';

    echo $html;


}

// /**
// *  Kicking this off
// */

function xv_xdocs_init()
{
    global $xv_xdocs;
    $xv_xdocs = new xv_xdocs();
    $xv_xdocs->init();
}

add_action('plugins_loaded', 'xv_xdocs_init');
