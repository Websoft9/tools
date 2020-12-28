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
	
	
	// If anyone reads the code, sorry for the uglyness, it's WordPress coding standards, not mines.
	
	
	if ( ! defined( 'ABSPATH' ) ) {
		die( 'Forbidden' );
	}
	
	
	add_action( 'admin_menu', 'prism_add_options_page' );
	add_action( 'admin_init', 'prism_register_settings' );
	
	function prism_add_options_page() {
		add_options_page('WP Prism Syntax Highlighter', 'Prism', 'manage_options', 'prism', 'prism_options_page' );
	}
	
	function prism_register_settings() {
		register_setting( 'prism-settings-group', 'default_language' );
		register_setting( 'prism-settings-group', 'default_inline' );
		register_setting( 'prism-settings-group', 'default_line_numbers' );
		register_setting( 'prism-settings-group', 'custom_prism_css' );
		register_setting( 'prism-settings-group', 'custom_prism_js' );
		register_setting( 'prism-settings-group', 'notice_warn_theme_css' );
	}
	
	function prism_add_settings_link( $settings_links ) {
		array_push( $settings_links, '<a href="options-general.php?page=prism">Settings</a>' );
		return $settings_links;
	}
	
	
	function prism_options_page() {
?>
		<div id="wrap">
			<h2>WP Prism Syntax Highlighter</h2>
			
			<form method="post" action="options.php">
				<?php settings_fields( 'prism-settings-group' ); ?>
				<?php do_settings_sections( 'prism-settings-group' ); ?>
				
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="default_language">Default language :</label>
							</th>
							
							<td>
								<select id="default_language" name="default_language">
									<?php
										$languages = null;
										$prism_js_file_contents = file_get_contents( plugins_url( 'wp-prism-syntax-highlighter/js/prism.js' ) );
										preg_match_all( '/Prism\.languages\.(\w+) *= *(\{|Prism\.languages\.extend)/', $prism_js_file_contents, $languages);
										
										foreach ( $languages[1] as $language ) {
											echo '<option value="' . $language . '"' . ( get_option( 'default_language' ) == $language ? ' selected' : '' ) . '>' .$language . ' </option>';
										}
									?>
								</select>
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="default_inline">Make code inline by default</label>
							</th>
							
							<td>
								<input type="checkbox" id="default_inline" name="default_inline" <?php echo get_option( 'default_inline' ) != '' ? 'checked' : ''; ?> />
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="default_line_numbers">Show line numbers by default</label>
							</th>
							
							<td>
								<input type="checkbox" id="default_line_numbers" name="default_line_numbers" <?php echo get_option( 'default_line_numbers' ) != '' ? 'checked' : ''; ?> />
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="custom_prism_css">Custom Prism CSS (file must be in <em><?php echo ABSPATH . 'wp-content/plugins/wp-prism-syntax-highlighter/css/' ; ?></em>) :</label>
							</th>
							
							<td>
								<input type="text" id="custom_prism_css" name="custom_prism_css" value="<?php echo get_option( 'custom_prism_css' ) != '' ? esc_attr( get_option( 'custom_prism_css' ) ) : 'prism.css'; ?>" />
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="custom_prism_js">Custom Prism JavaScript (file must be in <em><?php echo ABSPATH . 'wp-content/plugins/wp-prism-syntax-highlighter/js/' ; ?></em>) :</label>
							</th>
							
							<td>
								<input type="text" id="custom_prism_js" name="custom_prism_js" value="<?php echo get_option( 'custom_prism_js' ) != '' ? esc_attr( get_option( 'custom_prism_js' ) ) : 'prism.js'; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
				
				<?php submit_button(); ?>
			</form>
		</div>
<?php
	}
