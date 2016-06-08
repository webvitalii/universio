<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function universio_default_settings() {
	$settings = array(
		'max_width' => 1200,
		'layout' => 'content-sidebar',
		'excerpt_or_content_in_list' => 'excerpt',
		'code_head' => '',
		'code_footer' => '',
		'use_cdn' => 0,
		'ga_code' => '',
		'ga_code_hide_if_loggedin' => 1
	);
	return $settings;
}


function universio_get_settings() {
	$universio_settings = (array) get_option('universio_settings');
	$default_settings = universio_default_settings();
	$universio_settings = array_merge($default_settings, $universio_settings); // use default settings if custom settings are empty
	return $universio_settings;
}
