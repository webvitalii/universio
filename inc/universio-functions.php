<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function universio_default_settings() {
	$settings = array(
		'max_width' => 1200,
		'layout' => 'content-sidebar',
		'code_head' => '',
		'code_footer' => '',
		'use_cdn' => 0,
		'ga_code' => '',
		'ga_code_hide_if_loggedin' => 1,
		'footer_columns' => '1',
		'list_columns' => '1',
		'list_excerpt_or_content' => 'excerpt'
	);
	return $settings;
}


function universio_get_settings() {
	$universio_settings = (array) get_option('universio_settings');
	$default_settings = universio_default_settings();
	$universio_settings = array_merge($default_settings, $universio_settings); // use default settings if custom settings are empty
	return $universio_settings;
}


function universio_settings_dropdown($name, $options, $selected) {
	$dropdown_html = '';
	foreach ( $options as $key => $value ):
		$selected_html = '';
		if ( $selected == $key ) {
			$selected_html = ' selected';
		}
		$dropdown_html .= '<option value="'.$key.'"'.$selected_html.'>'.$value.'</option>';
	endforeach;
	$dropdown_html = '<select name="universio_settings['.$name.']">'.$dropdown_html.'</select>';
	return $dropdown_html;
}
