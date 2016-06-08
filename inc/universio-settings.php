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
	
	add_settings_field('max_width', __( 'Maximum width of the website', 'universio' ), 'universio_field_max_width_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('layout', __( 'Layout', 'universio' ), 'universio_field_layout_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('logo_url', __( 'Logo', 'universio' ), 'universio_field_logo_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('excerpt_or_content_in_list', __( 'Show excerpt or content in the list', 'universio' ), 'universio_field_excerpt_or_content_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('code_head', __( 'Head code', 'universio' ), 'universio_field_code_head_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('code_footer', __( 'Footer code', 'universio' ), 'universio_field_code_footer_callback', 'universio_general_page', 'universio_settings_general_section');
	add_settings_field('use_cdn', __( 'Use CDN', 'universio' ), 'universio_field_use_cdn_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('ga_code', __( 'Google analytics code', 'universio' ), 'universio_field_ga_code_callback', 'universio_general_page', 'universio_settings_general_section');
	
	add_settings_field('ga_code_hide_if_loggedin', __( 'Hide Google analytics code if use is logged in', 'universio' ), 'universio_field_ga_code_hide_if_loggedin_callback', 'universio_general_page', 'universio_settings_general_section');
	
	
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
	$output['logo_url'] = trim($input['logo_url']);
	$output['excerpt_or_content_in_list'] = trim($input['excerpt_or_content_in_list']);
	$output['code_head'] = trim($input['code_head']);
	$output['code_footer'] = trim($input['code_footer']);
	
	$output['ga_code'] = trim($input['ga_code']);
	
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
	
	$options = array(
		'content-sidebar' => __( 'content / sidebar-right', 'universio' ),
		'sidebar-content' => __( 'sidebar-left / content', 'universio' ),
		'content' => __( 'content (full width, no sidebars)', 'universio' ),
		'content-sidebar-sidebar' => __( 'content / sidebar-left / sidebar-right', 'universio' ),
		'sidebar-content-sidebar' => __( 'sidebar-left / content / sidebar-right', 'universio' ),
		'sidebar-sidebar-content' => __( 'sidebar-left / sidebar-right / content', 'universio' )
	);
	
	foreach ( $options as $key => $value ):
		$checked = '';
		if ( $settings['layout'] == $key ) {
			$checked = ' checked="checked"';
		}
		echo '<p><label><input type="radio" name="universio_settings[layout]" value="'.$key.'"  '.$checked.'> '.$value.'<label></p>'."\n";
	endforeach;
	echo '<p class="description">'.__( 'General layout settings', 'universio' ).'</p>';
}


function universio_field_logo_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	echo '<input type="text" name="universio_settings[logo_url]" class="regular-text js-media-input" value="'.$settings['logo_url'].'" />';
	echo '<a href="#" class="button button-small js-media-choose">'.__( 'Choose image', 'universio' ).'</a>';
	
	if( !empty( $settings['logo_url'] ) ) {
		echo '<div><img src="'.$settings['logo_url'].'" /></div>';
	}
	
	?>
	
	<script>
	jQuery(function($){ // document.ready and noConflict mode
		var custom_media_uploader;
		$( '.js-media-choose' ).click( function( event ) {
			event.preventDefault();
			custom_media_uploader = wp.media.frames.file_frame = wp.media( {
				title: '<?php _e( 'Choose image', 'universio' ); ?>',
				button: {
					text: '<?php _e( 'Choose image', 'universio' ); ?>'
				},
				multiple: false
			});
			custom_media_uploader.on( 'select', function() {
				var attachment = custom_media_uploader.state().get( 'selection' ).first().toJSON();
				$( '.js-media-input' ).val( attachment.url );
			});
			custom_media_uploader.open();
		});
	});
	</script>

	<?php
	
	echo '<p class="description"></p>';
}


function universio_field_excerpt_or_content_callback() {
	$settings = universio_get_settings();
	$default_settings = universio_default_settings();
	
	$options = array(
		'excerpt' => __( 'Excerpt', 'universio' ),
		'content' => __( 'Full content', 'universio' )
	);
	
	foreach ( $options as $key => $value ):
		$checked = '';
		if ( $settings['excerpt_or_content_in_list'] == $key ) {
			$checked = ' checked="checked"';
		}
		echo '<p><label><input type="radio" name="universio_settings[excerpt_or_content_in_list]" value="'.$key.'"  '.$checked.'> '.$value.'<label></p>'."\n";
	endforeach;
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
		
		<form method="post" action="options.php">
			<?php settings_fields('universio_settings_group'); ?>
			<div class="universio-group-general">
				<?php do_settings_sections('universio_general_page'); ?>
			</div>
			<?php submit_button(); ?>
		</form>
	
	</div><!-- .wrap -->
	<?php
}