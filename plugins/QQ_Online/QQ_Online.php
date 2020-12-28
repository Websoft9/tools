<?php
/**
 * Plugin Name: OHSOP-QQ在线客服
 * Plugin URI: 
 * Description: QQ在线咨询客服
 * Version: 1.0.0
 * Author: OSHOP
 * GitHub: 
 * Author URI: http://www.oshopsoft.com
 */

$qqzixunPluginsName = 'QQ_Online';
$adminMenuName = "QQ在线客服";

global $qqzixunOptions;

$qqzixunOptions = array (
    'qq1' => '',
    'qqnick1'      => '',
    'qq2' => '',
    'qqnick2'      => '',
	'qq3' => '',
    'qqnick3'      => '',
	'qqfooter' => '',
    'qqfooterlink'      => '',
);


function qqzixun_active(){
   global $qqzixunOptions;
   foreach ($qqzixunOptions as $key => $value) {
      if(get_option($key) === false)
        update_option($key, $value);
    }
}

function qqzixun_add_admin() {
    global $qqzixunPluginsName, $qqzixunOptions, $adminMenuName;
    if(!empty($_POST)){
        if ( isset($_POST['qqzixunsave']) and $_POST['qqzixunsave'] == true ) {
            foreach ($qqzixunOptions as $key => $value) {
                if(isset($_POST[$key]))
                    update_option($key, $_POST[$key]);
                else
                    update_option($key, "0");
            }
            header('Location:options-general.php?page=qq-zixun&saved=true');
        } elseif( isset($_POST['qqzixunreset']) and $_POST['qqzixunreset'] == true ) {
             foreach ($qqzixunOptions as $key => $value) {
                    delete_option($key);
                    update_option($key, $value);
            }
            header('Location:options-general.php?page=qq-zixun&reset=true');
        }
    }
    add_options_page($adminMenuName, $adminMenuName, 'manage_options', basename(__FILE__), 'qq_zixun_plugin_admin');
}

function addPluginLinks($links, $file)
{
    if ($file == plugin_basename(__FILE__)) {
        array_unshift($links, '<a href="options-general.php?page=' . basename(__FILE__).'">'.__('设置').'</a>');
    }

    return $links;
}
//setting menu
add_filter('plugin_action_links', 'addPluginLinks', 10, 2);

function qq_zixun_plugin_admin() {
    global $qqzixunPluginsName, $qqzixunOptions, $adminMenuName;

    $autoSavedOptions = array();

   

    foreach ($qqzixunOptions as $key => $value) {
        $val = get_option($key);
        if( $val !== false){
            $autoSavedOptions[$key] = $val;
        }else{
            $autoSavedOptions[$key] = $value;
        }
    }

    extract($autoSavedOptions);

    if ( $_GET['saved'] ) echo '<div class="updated"><p><strong>设置已保存</strong></p></div>';
    if ( $_GET['reset'] ) echo '<div class="updated"><p><strong>设置已重置</strong></p></div>';
?>
    <div class="wrap qqzixun-plugins">
        <?php screen_icon(); ?>
        <h2><?php echo $adminMenuName.' 设置';?></h2>
        <form method="post">
            <table class="form-table" >
                <tr>
                    <td>QQ客服1号码</td><td><input type="text" name="qq1" value="<?php echo $qq1 ?>" /></td>					
                </tr>
				<tr>                    
					<td>QQ客服1昵称</td><td><input type="text" name="qqnick1" value="<?php echo $qqnick1 ?>" /></td>
                </tr>
				<tr>
                    <td>QQ客服2号码</td><td><input type="text" name="qq2" value="<?php echo $qq2 ?>" /></td>					
                </tr>
				<tr>                    
					<td>QQ客服2昵称</td><td><input type="text" name="qqnick2" value="<?php echo $qqnick2 ?>" /></td>
                </tr>
                <tr>
                    <td>QQ客服3号码</td><td><input type="text" name="qq3" value="<?php echo $qq3 ?>" /></td>					
                </tr>
				<tr>                    
					<td>QQ客服3昵称</td><td><input type="text" name="qqnick3" value="<?php echo $qqnick3 ?>" /></td>
                </tr>

				 <tr>
                    <td>QQ客服底部文本</td><td><input type="text" name="qqfooter" value="<?php echo $qqfooter ?>" /></td>					
                </tr>
				<tr>                    
					<td>QQ客服底部文本链接</td><td><input type="text" name="qqfooterlink" value="<?php echo $qqfooterlink ?>" /></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input class="button-primary" name="qqzixunsave" type="submit" value="保存设置" />
                        <input class="button-secondary" name="qqzixunreset" type="submit" value="重置设置" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <style type="text/css">
    .qqzixun-plugins *{font-family: 'Microsoft YaHei';}
     .qqzixun-plugins table tr td label img{margin-top:-28px;vertical-align: middle;padding: 5px; margin-right: 5px;}
     .qqzixun-plugins table tr td label{margin-right: 8px;}
     .qqzixun-plugins table tr td label .autoimgbox{height: 35px;overflow: hidden; display: inline-block;}
    </style>
    <?php
}

function add_qq_zixun_foot_code() {
    wp_reset_query();
	$qq1=get_option('qq1');
	$qqnick1=get_option('qqnick1');
	$qq2=get_option('qq2');
	$qqnick2=get_option('qqnick2');
	$qq3=get_option('qq3');
	$qqnick3=get_option('qqnick3');
	$qqfooter=get_option('qqfooter');
	$qqfooterlink=get_option('qqfooterlink');
    echo '<div class="qqserver">
  <div class="qqserver_fold">
    <div></div>
  </div>
  <div class="qqserver-body" style="display: block;">
    <div class="qqserver-header">
      <div></div>
      <span class="qqserver_arrow"></span> </div>
    <ul>
        <li>
        <a title="所有问题，都可以问我" href="http://wpa.qq.com/msgrd?v=3&amp;uin='.$qq1.'&amp;site=qq&amp;menu=yes" target="_blank">
        <div>客服咨询</div>
        <span>'.$qqnick1.'</span> </a> </li>

      <li> <a title="所有问题，都可以问我" href="http://wpa.qq.com/msgrd?v=3&amp;uin='.$qq2.'&amp;site=qq&amp;menu=yes" target="_blank">
        <div>客服咨询</div>
        <span>'.$qqnick2.'</span> </a> </li>
      <li> <a title="Partner合作，问我" href="http://wpa.qq.com/msgrd?v=3&amp;uin='.$qq3.'&amp;site=qq&amp;menu=yes" target="_blank">
        <div>推广合作</div>
        <span>'.$qqnick3.'</span> </a> </li>
    </ul>
    <div class="qqserver-footer"><span class="qqserver_icon-alert"></span><a class="text-primary" href="'.$qqfooterlink.'" target="_blank">'.$qqfooter.'</a> </div>
  </div>
</div>';
wp_enqueue_script('qq-zixun',plugins_url('js/qq-zixun.js',__FILE__));
wp_enqueue_style('qq-zixun-css',plugins_url('css/qq-zixun.css',__FILE__));   
}

register_activation_hook(__FILE__,'qqzixun_active');
add_action('admin_menu', 'qqzixun_add_admin');
add_action('wp_footer','add_qq_zixun_foot_code',1);