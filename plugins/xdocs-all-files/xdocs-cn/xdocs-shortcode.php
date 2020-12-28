<?php


//按类别显示置顶的post，按照名称排序，参数：类别和数量
function xdocs_posts_sticky($atts) {

extract(shortcode_atts(array(
      'xdocs_category' => "common",
	  'displaynum' => 5,
   ), $atts));

$sticky = get_option( 'sticky_posts' );
$args = array( 'post_type' => 'xdocs', 'posts_per_page' =>$displaynum,'category_name'=>$xdocs_category,'order' => 'ASC','orderby' => 'title','ignore_sticky_posts' => false,'post__in'  => $sticky);

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) :
$return_string;
while ( $loop->have_posts() ) : $loop->the_post();

$return_string=$return_string .'<a style="color:#007eb9;" href="'.get_permalink().'" target="_blank">'.get_the_title().'</a></br>';

endwhile;
endif;
wp_reset_query();
return $return_string;
}

//以上为什么不能使用echo？echo会导致输出位置不可控

//按类别显示post，按照名称排序，参数：类别和数量
function xdocs_posts_function($atts) {

extract(shortcode_atts(array(
      'xdocs_category' => "common",
	  'displaynum' => 5,
   ), $atts));
   
$args = array( 'post_type' => 'xdocs', 'posts_per_page' =>$displaynum,'category_name'=>$xdocs_category,'order' => 'ASC','orderby' => 'title','ignore_sticky_posts' => false );

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) :
$return_string;
while ( $loop->have_posts() ) : $loop->the_post();

$return_string=$return_string .'<a style="color:#007eb9;" href="'.get_permalink().'" target="_blank">'.get_the_title().'</a></br>';

endwhile;
endif;
wp_reset_query();
return $return_string;
}

//挂载短代码
add_shortcode('xdocs-posts', 'xdocs_posts_function');
add_shortcode('xdocs-posts-sticky', 'xdocs_posts_sticky');

//add_action( 'init', 'register_shortcodes');

?>