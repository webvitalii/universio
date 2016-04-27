<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function flexflux_default_settings() {
	$settings = array(
		'max_width' => 1200,
		'layout' => 'content-sidebar',
		'excerpt_or_content_in_list' => 'excerpt',
		'code_head' => '',
		'code_footer' => ''
	);
	return $settings;
}


function flexflux_get_settings() {
	$flexflux_settings = (array) get_option('flexflux_settings');
	$default_settings = flexflux_default_settings();
	$flexflux_settings = array_merge($default_settings, $flexflux_settings); // use default settings if custom settings are empty
	return $flexflux_settings;
}
