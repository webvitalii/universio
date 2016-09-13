<?php

// Usage: [universio_btn text="Buy" title="buy now" href="https://www.google.ca/" class="fx-btn-primary"]
function universio_shortcode_btn( $atts ) {
	extract( shortcode_atts( array(
		'href' => '#',
		'class' => '',
		'text' => 'Button',
		'title' => ''
	), $atts ) );
	return '<a href="'.$href.'" class="fx-btn '.$class.'" title="'.$title.'">'.$text.'</a>';
}
add_shortcode( 'universio_btn', 'universio_shortcode_btn' );
