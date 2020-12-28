<?php
	/**
	 * The MIT License (MIT)
	 * 
	 * Copyright (c) 2014 TRUCHOT Guillaume
	 * 
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 * 
	 * The above copyright notice and this permission notice shall be included in all
	 * copies or substantial portions of the Software.
	 * 
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	 * SOFTWARE.
	 */
	
	
	/**
	 * Plugin Name: WP Prism Syntax Highlighter
	 * Plugin URI: https://github.com/GuiTeK/wp-prism-syntax-highlighter
	 * Description: A lightweight and convenient plugin to integrate Prism Syntax Highlighter into WordPress.
	 * Version: 1.0.5
	 * Author: Lea Verou (Prism), Truchot Guillaume (WordPress Plugin)
	 * Author URI: https://github.com/GuiTeK
	 * License: MIT
	 */
	
	
	// If anyone reads the code, sorry for the uglyness, it's WordPress coding standards, not mines.
	
	
	require_once( 'prism-options.php' );
	
	add_action( 'wp_enqueue_scripts', array( WP_Prism_Syntax_Highlighter::get_instance(), 'add_style' ) );
	add_action( 'wp_footer', array( WP_Prism_Syntax_Highlighter::get_instance(), 'add_script' ) );
	add_action( 'admin_footer', array( WP_Prism_Syntax_Highlighter::get_instance(), 'add_admin_script' ) );
	//add_action( 'admin_notices', array( WP_Prism_Syntax_Highlighter::get_instance(), 'admin_notices' ) );
	
	 add_filter( 'mce_buttons', array( WP_Prism_Syntax_Highlighter::get_instance(), 'add_mce_button' ) );
	add_filter( 'mce_external_plugins', array( WP_Prism_Syntax_Highlighter::get_instance(), 'add_mce_plugin' ) );
	// add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'prism_add_settings_link' );
	//register_activation_hook( __FILE__, array( WP_Prism_Syntax_Highlighter::get_instance(), 'activation_hook' ) );
	
	
	class WP_Prism_Syntax_Highlighter {
		private static $instance = null;
		
		public static function get_instance() {
			if ( null == self::$instance )
				self::$instance = new self;
			
			return self::$instance;
		}
		
		
		private $load_pjsh;
		
		private function __construct() {
			$this->load_pjsh = false;
		}
		
		private function decide_load_prism() {
			if ( strstr( get_post()->post_content, '<code class="language-' ) !== false ) {
				$this->load_pjsh = true;
			}
		}
		
		
		public function activation_hook() {
			$theme_css_file_contents = file_get_contents( get_stylesheet_directory() . '/style.css' );
			
			if ( preg_match( '/(pre|code) ?(,|\{)/', $theme_css_file_contents ) ) {
				update_option( 'notice_warn_theme_css', '1' );
			}
		}

		
		
		public function add_style() {
			$this->decide_load_prism();
			
			if ( true == $this->load_pjsh ) {
				wp_register_style( 'wp-prism-syntax-highlighter', plugins_url( 'xdocs/inc/shortcodes/wp-prism-syntax-highlighter/css/' . ( get_option( 'custom_prism_css' ) != '' ? esc_attr( get_option( 'custom_prism_css' ) ) : 'prism.css' ) ) );
				wp_enqueue_style( 'wp-prism-syntax-highlighter' );
			}
		}
		
		public function add_script() {
			if ( true == $this->load_pjsh ) {
				echo '<script src="' . plugins_url( 'xdocs/inc/shortcodes/wp-prism-syntax-highlighter/js/' . ( get_option( 'custom_prism_js' ) != '' ? esc_attr( get_option( 'custom_prism_js' ) ) : 'prism.js' ) ) . '"></script>';
			}
		}
		
		public function add_admin_script() {
			echo
			'<script type="text/javascript">
				var currentLanguage = "' . get_option( 'default_language' ) . '";
				var currentInlineCode = ' . ( get_option( 'default_inline' ) == 'on' ? 'true' : 'false' ) . ';
				var currentLineNumbers = ' . ( get_option( 'default_line_numbers' ) == 'on' ? 'true' : 'false' ) . ';
			</script>';
			
			echo '<script src="' . plugins_url( 'xdocs/inc/shortcodes/wp-prism-syntax-highlighter/js/' . ( get_option( 'custom_prism_js' ) != '' ? esc_attr( get_option( 'custom_prism_js' ) ) : 'prism.js' ) ) . '"></script>';
		}
		
		
		public function add_mce_button( $mce_buttons ) {
			array_push($mce_buttons, 'prism');
			return $mce_buttons;
		}
		
		public function add_mce_plugin( $mce_plugins ) {
			$mce_plugins['prism'] = plugins_url( 'xdocs/inc/shortcodes/wp-prism-syntax-highlighter/js/editor-plugin.js' );
			return $mce_plugins;
		}
	}
