<?php 


require_once('acf/acf.php');
//  Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

if(!function_exists('xdocs_themes_array')){
	function xdocs_themes_array(){

	  $xdocs_url = WP_PLUGIN_DIR .'/xdocs/themes/*';
	  
	  $themes_list = array();
	  foreach(glob($xdocs_url, GLOB_ONLYDIR) as $key =>  $dir) {
	   
	   $name     = basename($dir);
	   
	   $theme_screenshot = WP_PLUGIN_DIR .'/xdocs/themes/'.$name.'/screenshot.png';

	    if(file_exists($theme_screenshot)){
	        $img_path =   plugins_url( '../themes/'.$name.'/screenshot.png', __FILE__ );
	       
	       // $themes_list[$name] =  basename($dir) ;
	        $themes_list[$name] =  xdocs_radio_img( $img_path );
	     }else{
	           $themes_list[$name] =  basename($dir) ;
	     }
	  }
	  return $themes_list;
	}
}




if(!function_exists('xdocs_radio_img')){
function xdocs_radio_img($img_path=''){

	return '<img src="'.$img_path.'"/>';
}
}
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_55fdccf2d9d75',
	'title' => 'Themes',
	'fields' => array (
		array (
			'key' => 'field_55fc126d7b4fb',
			'label' => 'Themes',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_55f86f282e532',
			'label' => 'Select Theme',
			'name' => 'select_theme',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => xdocs_themes_array(),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'theme1',
			'layout' => 'horizontal',
			'allow_null' => 0,
		),
		array (
			'key' => 'field_55fc156c079a1',
			'label' => 'General Options',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_55fc13077b4fd',
			'label' => 'Logo',
			'name' => 'logo',
			'type' => 'image',
			'instructions' => 'Upload Your Logo',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'return_format' => 'array',
			'min_width' => 0,
			'min_height' => 0,
			'min_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'max_size' => 0,
			'mime_types' => '',
		),
		array (
			'key' => 'field_55fc133e7b4fe',
			'label' => 'Fav Icon',
			'name' => 'fav_icon',
			'type' => 'image',
			'instructions' => 'Upload You fav Icon',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'return_format' => 'array',
			'min_width' => 0,
			'min_height' => 0,
			'min_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'max_size' => 0,
			'mime_types' => '',
		),
		array (
			'key' => 'field_57738616f1ab1',
			'label' => 'Version',
			'name' => 'version',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '1.0.0',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
//		array (
//			'key' => 'field_577388ebfd8cb',
//			'label' => 'Email',
//			'name' => 'email',
//			'type' => 'email',
//			'instructions' => 'Enter Your email Address',
//			'required' => 0,
//			'conditional_logic' => 0,
//			'wrapper' => array (
//				'width' => '',
//				'class' => '',
//				'id' => '',
//			),
//			'default_value' => '',
//			'placeholder' => 'info@example.com',
//			'prepend' => '',
//			'append' => '',
//		),
		array (
			'key' => 'field_57738647f1ab2',
			'label' => 'Copyrights',
			'name' => 'copyrights',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Copyright © 2016 XDOCS.	All rights reserved.',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_55fc12a07b4fc',
			'label' => 'Quick Links',
			'name' => 'quick_links',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_57738403491ea',
			'label' => 'Website',
			'name' => 'website',
			'type' => 'url',
			'instructions' => 'Enter your website URL',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'http://example.com',
		),
		array (
			'key' => 'field_57738449491eb',
			'label' => 'Facebook',
			'name' => 'facebook',
			'type' => 'url',
			'instructions' => 'Enter your Facebook fan page URL',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'http://facebook.com',
		),
		array (
			'key' => 'field_57738489491ec',
			'label' => 'Twitter',
			'name' => 'twitter',
			'type' => 'url',
			'instructions' => 'Enter your twitter URL',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'http://twitter.com',
		),
		array (
			'key' => 'field_5773849c491ed',
			'label' => 'Github',
			'name' => 'github',
			'type' => 'text',
			'instructions' => 'Enter your GitHub repository URL',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'http://github.com/',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5773851b491ee',
			'label' => 'Contatct URL',
			'name' => 'contatct_url',
			'type' => 'url',
			'instructions' => 'Enter your contact page url',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_5773854c491ef',
			'label' => 'Support Forum',
			'name' => 'support_forum',
			'type' => 'url',
			'instructions' => 'Enter item support forum URL',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_577455adffb69',
			'label' => 'Styling',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55f86f282e532',
						'operator' => '!=',
						'value' => 'theme2',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_577455d3ffb6a',
			'label' => 'Primary Color',
			'name' => 'primary_color',
			'type' => 'color_picker',
			'instructions' => 'Select theme primary color',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_5774562effb6b',
			'label' => 'Secondary Color',
			'name' => 'secondary_color',
			'type' => 'color_picker',
			'instructions' => 'Select theme secondary Color',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_5774ebe3086e0',
			'label' => 'Preloader',
			'name' => 'preloader',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_5774ebff086e1',
			'label' => 'Enable Preloader',
			'name' => 'enable_preloader',
			'type' => 'true_false',
			'instructions' => 'uncheck if you want to disable preloader',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
		),
		array (
			'key' => 'field_5774ec48086e2',
			'label' => 'Preloader Icons',
			'name' => 'preloader_icons',
			'type' => 'radio',
			'instructions' => 'Select a preloader icon.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'loader1' => xdocs_radio_img(plugins_url().'/xdocs/assets/img/loader1.gif'),
				'loader2' => xdocs_radio_img(plugins_url().'/xdocs/assets/img/loader2.gif'),
				'loader3' =>   xdocs_radio_img(plugins_url() .'/xdocs/assets/img/loader3.gif'),
				'loader4' =>   xdocs_radio_img(plugins_url().'/xdocs/assets/img/loader4.gif'),
		),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'xdocs',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;



if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_55fdccf2caefc',
	'title' => 'Sections',
	'fields' => array (
		array (
			'key' => 'field_55fed10b025df',
			'label' => 'Add Sections',
			'name' => 'add_sections',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_55fed10c025e1',
			'min' => '',
			'max' => '',
			'layout' => 'block',
			'button_label' => 'Add New Section',
			'sub_fields' => array (
				array (
					'key' => 'field_55fed10c025e1',
					'label' => 'Section Title',
					'name' => 'section_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 100,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_55fed10c025e2',
					'label' => 'Section Details',
					'name' => 'section_details',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
				),
				array (
					'key' => 'field_5779673f1c0a4',
					'label' => 'Steps Nav',
					'name' => 'steps_nav',
					'type' => 'true_false',
					'instructions' => 'Default theme supports steps nav. You can enable or disable for any section.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Enable Steps floting Nav',
					'default_value' => 0,
				),
				array (
					'key' => 'field_577163557bdb9',
					'label' => 'Steps',
					'name' => 'steps',
					'type' => 'repeater',
					'instructions' => 'If you want to add subsection or step please add it here. Note not all themes supports steps.',
					'required' => 0,

					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => 'field_577163b57bdba',
					'min' => '',
					'max' => '',
					'layout' => 'block',
					'button_label' => 'Add Step',
					'sub_fields' => array (
						array (
							'key' => 'field_577163b57bdba',
							'label' => 'Step Title',
							'name' => 'step_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_577163c87bdbb',
							'label' => 'Step Details',
							'name' => 'step_details',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
						),
					),
				),

			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'xdocs',
			),
		),
	),
	'menu_order' => 5,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;





?>