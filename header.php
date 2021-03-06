<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class('fx-wrap'); ?>>

<div id="page" class="hfeed site site-main">

<div class="fx-fixed-top fx-bg-gray-darkest">

	<div class="fx-container fx-container-lg">

		<nav class="fx-menu fx-menu-dark"
		<?php //wp_list_pages('title_li='); // list of all pages ?>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary-nav',
			//'container' => 'nav',
			//'container_class' => 'nav-menu0 fx-menu0 fx-menu-dark-transparent0', // clearfix 
			//'menu_class' => '', // nav
			'fallback_cb' => 'universio_list_pages'
		) );
		?>
		</nav><!-- .site-navigation .main-navigation -->

	</div><!-- .fx-container fx-container-lg -->

</div><!-- .fx-fixed-top -->

<div class="site-content-pusher"><!-- push content because of fixed menu --></div>


<div class="fx-container fx-container-lg site-container">
<div class="site-wrapper">




<?php
$title_desc = esc_attr( get_bloginfo( 'name', 'display' ) );
if ( get_bloginfo( 'description' ) ) { // add desc to title attr
	$title_desc .= ' | '.esc_attr( get_bloginfo( 'description', 'display' ) );
}
 
if ( universio_is_homepage() ) {
	$link_before = '';
	$link_after = '';
} else {
	$link_before = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . $title_desc . '">';
	$link_after = '</a>';
}
?>

	<header class="site-header fx-clearfix">
		<div class="fx-padding-all fx-clearfix">
		<div class="site-header-logo">
			<?php universio_custom_logo(); ?>
		</div><!-- .site-header-logo -->
	
		<h3 class="site-title"><?php echo $link_before; ?><?php bloginfo( 'name' ); ?><?php echo $link_after; ?></h3>

		<?php if ( get_bloginfo( 'description' ) ) : ?>
		<h5 class="site-description"><?php bloginfo( 'description' ); ?></h5>
		<?php endif; ?>
		</div><!-- .fx-padding-all -->
	</header><!-- .site-header -->



	<?php if ( get_header_image() ) : ?>
	<header class="site-header-image">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
	</header><!-- .site-header -->
	<?php endif; ?>
	
	
	<?php
	$settings = universio_get_settings();
	$header_widgets_columns = $settings['header_widgets_columns'];
	?>
	<?php if ( is_active_sidebar( 'header_widgets' ) ) : ?>
	<div class="fx-padding-all site-header-widgets">
		<div class="widget-area widget-area-header">
			<div class="fx-columns fx-columns-<?php echo $header_widgets_columns; ?>">
			<?php if ( ! dynamic_sidebar( 'header_widgets' ) ) : ?>
				<?php
					// show nothing if there is no widgets
				?>
			<?php endif; ?>
			</div><!-- .fx-columns -->
		</div><!-- .widget-area .widget-area-header -->
	</div><!-- .fx-padding-all .site-header-widgets -->
	<?php endif; ?>
	
	
<div id="main" class="site-main">

	<div class="fx-grid">
