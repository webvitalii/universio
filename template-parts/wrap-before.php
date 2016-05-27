<?php
// global $wp_query;
// $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

$col_class = 'fx-box-sm-6';

$settings = flexflux_get_settings();

if( $settings['layout'] == 'sidebar-content' || $settings['layout'] == 'content-sidebar' ) {
	$col_class = 'fx-box-sm-9';
}

if( $settings['layout'] == 'content' ) {
	$col_class = 'fx-box-sm-12';
}

if( is_page_template ( 'template-full-width-no-sidebar.php' ) ){ // show wide column if sidebar is removed
	$col_class = 'fx-box-sm-12 full-width-wrap';
}

?>
			<div class="<?php echo $col_class; ?> fx-padding-all">

				<div id="primary" class="content-area">
				
					<div id="content" class="site-content">
