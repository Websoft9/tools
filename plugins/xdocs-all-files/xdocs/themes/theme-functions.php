<?php


  global $post, $post_id; 
  
  if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){

    $post_id = $_REQUEST['id'];

  }else{

    $post_id = get_the_ID();
  }

    function xdocs_head(){
        do_action('xdocs_head');
    }
    function xdocs_foot(){
        //anything in theme foot
        do_action('xdocs_foot');
    }

    function xdocs_path(){
        $xdocs = new xv_xdocs();
        echo plugin_dir_url(__FILE__ ) . $xdocs->xdocs_theme_name() . '/assets';
    }

    function xdocs_the_title(){
        global  $post_id;
        $queried_post = get_post($post_id);
        echo $queried_post->post_title;
    }

    function xdocs_the_content(){
        global  $post_id;
        echo apply_filters('the_content', get_post_field('post_content', $post_id));
    }


    function xdocs_preloader(){
    	global  $post_id; 
    	$preloader  = get_field('enable_preloader',$post_id);
    	if($preloader){
          echo '<div class="xdocs-pre-loader"></div>';

    	}
    }

	function xdocs_logo(){
		global  $post_id; 
        $logo = get_field('logo',$post_id);
        if( !empty($logo) ): ?>
              <div class="logo">
                  <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
              </div>
        <?php endif; 
	}

	function xdocs_the_version(){
		global  $post_id; 
		 $version = get_field('version',$post_id);
        if( !empty($version) ): ?>
              <div class="version"> Version <?php echo esc_attr($version); ?></div>
         <?php endif; 
	}


	function xdocs_the_fetured_image(){
		global  $post_id; 
		$attachment_id = get_post_thumbnail_id( $post_id ); // attachment ID
	    $image_attributes = wp_get_attachment_image_src( $attachment_id,'full' ); // returns an array
	    if( $image_attributes ) { ?> 
	        <img src="<?php echo $image_attributes[0]; ?>" alt="">
	    <?php }
	}


	function xdocs_the_copyrights(){
		global  $post_id; 
		$copyrights = get_field('copyrights',$post_id);
        if( !empty($copyrights) ): 
           echo '<div class="copyrights">'. esc_attr($copyrights). '</div>';
         endif; 
	}


	function xdocs_the_quick_links(){
		global  $post_id; 
	      $website  = get_field('website',$post_id);
          $facebook  = get_field('facebook',$post_id);
          $twitter  = get_field('twitter',$post_id);
          $github  = get_field('github',$post_id);
          $contact  = get_field('contatct_url',$post_id);
          $support  = get_field('support_forum',$post_id);

          $social_output ='';


           
            if( !empty($website) )
            $social_output .= "<li><a target='_blank' href='{$website}' ><i class='fa fa-home'></i></a></li>";
            if( !empty($facebook) )
              $social_output .= "<li><a target='_blank' href='{$facebook}' ><i class='fa fa-facebook'></i></a></li>";
            if( !empty($twitter) )
              $social_output .= "<li><a target='_blank' href='{$twitter}' ><i class='fa fa-twitter'></i></a></li>";
            if( !empty($github) )
              $social_output .= "<li><a target='_blank' href='{$github}' ><i class='fa fa-github'></i></a></li>";
            if( !empty($contact) )
              $social_output .= "<li><a target='_blank' href='{$contact}' ><i class='fa fa-envelope'></i></a></li>";
            if( !empty($support) )
              $social_output .= "<li><a target='_blank' href='{$support}' ><i class='fa fa-support'></i></a></li>";
          


          if( !empty($website) || !empty($facebook) || !empty($twitter) || !empty($github) || !empty($contact) || !empty($support)):
              echo "<ul class='social'>{$social_output}</ul>";
          endif; 

	}

    function xdocs_preloader_icon(){
        global  $post_id;
        $preloader  = get_field('enable_preloader',$post_id);
        $icon  = get_field('preloader_icons',$post_id);
        $xdocs = new xv_xdocs();
        if($preloader && $icon){?>
        <style>
            .xdocs-pre-loader{
                background: url(<?php echo plugins_url().'/xdocs/assets/img/'.$icon.'.gif'; ?>) center no-repeat #fff;
            }
        </style>

        <?php  }
    }
    add_action('xdocs_head','xdocs_preloader_icon');


    function xdocs_fav_icon(){
        global  $post_id;
        $fav_icon = get_field('fav_icon',$post_id);
        if( !empty($fav_icon) ): ?>
            <link rel="icon" href="<?php echo $fav_icon['url']; ?>">
        <?php endif;
    }
    add_action('xdocs_head','xdocs_fav_icon');



?>