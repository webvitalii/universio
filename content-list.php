
<article id="post-<?php the_ID(); ?>" <?php post_class('fx-clearfix'); ?>>

	<header class="entry-header page-header">
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php if ( 'post' == get_post_type() ) : // hide meta text for pages ?>
			<?php echo universio_post_meta(); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php get_template_part( 'template-parts/image', 'thumbnail' ); ?>

	<section class="entry-content entry-summary">

		<?php
		$settings = universio_get_settings();
		$list_excerpt_or_content = $settings['list_excerpt_or_content'];
		if( $list_excerpt_or_content == 'excerpt' ) {
			the_excerpt( '' );
		} else {
			the_content( '' );
		}
		?>

	</section><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
