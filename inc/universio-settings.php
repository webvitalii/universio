<?php
/*
Universio settings code
Powered by WordPress Settings API - http://codex.wordpress.org/Settings_API
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function universio_menu() { // add menu item
	add_theme_page(__( 'Universio Settings', 'universio' ), __( 'Universio Settings', 'universio' ), 'manage_options', 'universio', 'universio_settings');
	//add_menu_page( __( 'Universio Settings', 'universio' ), __( 'Universio Settings', 'universio' ),
	//	'manage_options', 'universio', 'universio_settings', 'dashicons-layout', 45 );
}
add_action('admin_menu', 'universio_menu');


function universio_admin_init() {
	register_setting('universio_settings_group', 'universio_settings', 'universio_settings_validate');

	add_settings_section('universio_settings_general_section', '', 'universio_section_callback', 'universio_general_page');
	add_settings_section('universio_settings_list_section', '', 'universio_section_callback', 'universio_list_page');
	
	add_settings_field('max_width', __( 'Maximum width of the website', 'universio' ), 'universio_field_max_width_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('layout', __( 'Layout', 'universio' ), 'universio_field_layout_callback', 'universio_general_page', 'universio_settings_general_section');

	add_settings_field('code_head', __( 'Head code', 'universio' ), 'universio_field_code_head_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('code_footer', __( 'Footer code', 'universio' ), 'universio_field_code_footer_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('use_cdn', __( 'Use CDN', 'universio' ), 'universio_field_use_cdn_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('ga_code', __( 'Google analytics code', 'universio' ), 'universio_field_ga_code_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('ga_code_hide_if_loggedin', __( 'Hide Google analytics code if use is logged in', 'universio' ), 'universio_field_ga_code_hide_if_loggedin_callback', 'universio_general_page', 'universio_settings_general_section');

	add_settings_field('header_widgets_columns', __( 'Number of columns in the header', 'universio' ), 'universio_field_header_widgets_columns_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('footer_widgets_columns', __( 'Number of columns in the footer', 'universio' ), 'universio_field_footer_widgets_columns_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('before_content_widgets_columns', __( 'Number of columns in the before content area', 'universio' ), 'universio_field_before_content_widgets_columns_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('after_content_widgets_columns', __( 'Number of columns in the after content area', 'universio' ), 'universio_field_after_content_widgets_columns_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('before_list_widgets_columns', __( 'Number of columns in the before list area', 'universio' ), 'universio_field_before_list_widgets_columns_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('after_list_widgets_columns', __( 'Number of columns in the after list area', 'universio' ), 'universio_field_after_list_widgets_columns_callback', 'universio_general_page', 'universio_settings_general_section');

	add_settings_field('list_columns', __( 'Number of columns in the list', 'universio' ), 'universio_field_list_columns_callback', 'universio_list_page', 'universio_settings_list_section');
	add_settings_field('list_excerpt_or_content', __( 'Show excerpt or content in the list', 'universio' ), 'universio_field_excerpt_or_content_callback', 'universio_list_page', 'universio_settings_list_section');
	
}
add_action('admin_init', 'universio_admin_init');


function universio_settings_init() { // set default settings
	global $universio_settings;
	$universio_settings = universio_get_settings();
	update_option('universio_settings', $universio_settings);
}
add_action('admin_init', 'universio_settings_init');


function universio_settings_validate($input) {
	$default_settings = universio_get_settings();
	$output['use_cdn'] = $input['use_cdn'];
	$output['ga_code_hide_if_loggedin'] = $input['ga_code_hide_if_loggedin'];
	
	$output['max_width'] = trim($input['max_width']);
	$output['layout'] = trim($input['layout']);

	$output['code_head'] = trim($input['code_head']);
	$output['code_footer'] = trim($input['code_footer']);
	
	$output['ga_code'] = trim($input['ga_code']);

	$output['header_widgets_columns'] = trim($input['header_widgets_columns']);
	$output['footer_widgets_columns'] = trim($input['footer_widgets_columns']);
	
	$output['before_content_widgets_columns'] = trim($input['before_content_widgets_columns']);
	$output['after_content_widgets_columns'] = trim($input['after_content_widgets_columns']);
	
	$output['before_list_widgets_columns'] = trim($input['before_list_widgets_columns']);
	$output['after_list_widgets_columns'] = trim($input['after_list_widgets_columns']);
	
	$output['list_columns'] = trim($input['list_columns']);
	$output['list_excerpt_or_content'] = trim($input['list_excerpt_or_content']);
	
	return $output;
}


function universio_section_callback() { // Universio settings description
	echo '';
}


function universio_field_max_width_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	echo '<input type="number" name="universio_settings[max_width]" class="regular-text" value="'.$settings['max_width'].'" required="required" />';
	echo '<p class="description">';
	printf( __( 'Default: %s', 'universio' ), $default_settings['max_width'] );
	echo '</p>';
}


function universio_field_layout_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$layout_options = array(
		'content-sidebar' => __( 'content / sidebar-right', 'universio' ),
		'sidebar-content' => __( 'sidebar-left / content', 'universio' ),
		'content' => __( 'content (full width, no sidebars)', 'universio' ),
		'content-sidebar-sidebar' => __( 'content / sidebar-left / sidebar-right', 'universio' ),
		'sidebar-content-sidebar' => __( 'sidebar-left / content / sidebar-right', 'universio' ),
		'sidebar-sidebar-content' => __( 'sidebar-left / sidebar-right / content', 'universio' )
	);
	
	echo '<p>'.universio_settings_dropdown('layout', $layout_options, $settings['layout']).'</p>';
	echo '<p class="description">'.__( 'General layout settings', 'universio' ).'</p>';
}


function universio_field_header_widgets_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$widget_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('header_widgets_columns', $widget_columns_options, $settings['header_widgets_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for header widgets.', 'universio' ).'</p>';
}


function universio_field_footer_widgets_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$widget_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('footer_widgets_columns', $widget_columns_options, $settings['footer_widgets_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for footer widgets.', 'universio' ).'</p>';
}


function universio_field_before_content_widgets_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$widget_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('before_content_widgets_columns', $widget_columns_options, $settings['before_content_widgets_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for before content area.', 'universio' ).'</p>';
}


function universio_field_after_content_widgets_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$widget_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('after_content_widgets_columns', $widget_columns_options, $settings['after_content_widgets_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for after content area.', 'universio' ).'</p>';
}


function universio_field_before_list_widgets_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$widget_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('before_list_widgets_columns', $widget_columns_options, $settings['before_list_widgets_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for before list area.', 'universio' ).'</p>';
}


function universio_field_after_list_widgets_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$widget_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('after_list_widgets_columns', $widget_columns_options, $settings['after_list_widgets_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for after list area.', 'universio' ).'</p>';
}


function universio_field_list_columns_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$list_columns_options = universio_get_columns_options();
	
	echo '<p>'.universio_settings_dropdown('list_columns', $list_columns_options, $settings['list_columns']).'</p>';
	echo '<p class="description">'.__( 'Number of columns for blog, category, archive, search results etc.', 'universio' ).'</p>';
}


function universio_field_excerpt_or_content_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$list_options = array(
		'excerpt' => __( 'Excerpt', 'universio' ),
		'content' => __( 'Full content', 'universio' )
	);
	
	echo '<p>'.universio_settings_dropdown('list_excerpt_or_content', $list_options, $settings['list_excerpt_or_content']).'</p>';
	echo '<p class="description">'.__( 'Show excerpt or full content in the list of posts', 'universio' ).'</p>';
}


function universio_field_code_head_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	echo '<textarea name="universio_settings[code_head]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_head'].'</textarea>';
	echo '<p class="description">'.__( 'Code will be added to head section just before closing [head] tag', 'universio' ).'</p>';
}


function universio_field_code_footer_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	echo '<textarea name="universio_settings[code_footer]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_footer'].'</textarea>';
	echo '<p class="description">'.__( 'Code will be added to body section just before closing [body] tag', 'universio' ).'</p>';
}


function universio_field_use_cdn_callback() {
	$settings = universio_get_settings();
	echo '<label><input type="checkbox" name="universio_settings[use_cdn]" '.checked(1, $settings['use_cdn'], false).' value="1" />';
	echo ' Use CDN (Ionicons assets)</label>';
	echo '<p class="description"></p>';
}


function universio_field_ga_code_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	echo '<input type="text" name="universio_settings[ga_code]" class="regular-text" value="'.$settings['ga_code'].'" />';
	echo '<p class="description">Example: UA-12345678-9</p>';
}


function universio_field_ga_code_hide_if_loggedin_callback() {
	$settings = universio_get_settings();
	echo '<label><input type="checkbox" name="universio_settings[ga_code_hide_if_loggedin]" '.checked(1, $settings['ga_code_hide_if_loggedin'], false).' value="1" />';
	echo ' Hide Google analytics code if use is logged in</label>';
	echo '<p class="description"></p>';
}


function universio_settings() {
	
	?>
	<div class="wrap">
		
		<h2><span class="dashicons dashicons-admin-generic" style="position: relative; top: 4px;"></span> 
			<?php echo __( 'Universio Settings', 'universio' ); ?></h2>
		
		
		<h2 class="nav-tab-wrapper">
			<a href="#" class="nav-tab universio-tab-general">General</a>
			<a href="#" class="nav-tab universio-tab-list">List</a>
		</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields('universio_settings_group'); ?>
			<div class="universio-group-general">
				<?php do_settings_sections('universio_general_page'); ?>
			</div>
			<div class="universio-group-list">
				<?php do_settings_sections('universio_list_page'); ?>
			</div>
			<?php submit_button(); ?>
		</form>


		<script>
			jQuery(function($){
				$('.universio-tab-general').click(function(event) {
					event.preventDefault();
					$(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
					$('.universio-group-general').slideDown();
					$('.universio-group-list').slideUp();
				});

				$('.universio-tab-list').click(function(event) {
					event.preventDefault();
					$(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
					$('.universio-group-list').slideDown();
					$('.universio-group-general').slideUp();
				});

				$('.universio-tab-general').click();
			});
		</script>
	
	
	</div><!-- .wrap -->
	<?php
}