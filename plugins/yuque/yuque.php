<?php
/**
 * Plugin Name: Yuque
 * Plugin URI: 
 * Description: 语雀API连接
 * Version: 1.0
 * Author: Websoft9     
 * GitHub: 
 * Author URI: http://www.websoft9.com
 */

include 'inc/class.php';

//在 head 标签添加bootstrap样式
function BS_add_head_tag(){

  //获取css的URL地址
  $cssURL=plugin_dir_url(__FILE__ )."/css/bootstrap.min.css";
	echo "<link rel='stylesheet' id='bootstrap'  href=$cssURL type='text/css' media='all' />";
}


//在post中插入语雀项目目录
function Insert_yuque_toposts_function($atts, $content=null, $code="") {

  $dispaly_yuque=new Yuque($content,"Websoft9","uJ3BbfwQK7n4lqk5F4UI5zFGvbpxL6HhUlmDj018","https://www.yuque.com/webs/");

  //在一个容器布局下显示Yuque接口获取的内容
  echo "<div class=\"container\">";

  echo "<div class=\"row\">";
  $dispaly_yuque->overview_display();
  echo "</div>";

  //增加row之间的行距
  echo "<div class=\"clearfix\" style=\"margin-bottom: 16px;\"></div>";

  echo "<div class=\"row\">";
  $dispaly_yuque->main_display();
  echo "</div>";

  echo "</div>";

}

//注册短代码
function register_shortcodes(){
	add_shortcode('yuque-toc', 'Insert_yuque_toposts_function');
}

//挂载钩子
add_action( 'wp_head', 'BS_add_head_tag' );
add_action( 'init', 'register_shortcodes');


?>