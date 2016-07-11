<?php get_header(); ?>

<?php get_sidebar( 'before-content' ); ?>

<?php get_template_part( 'template-parts/wrap', 'before' ); ?>

	<?php get_template_part( 'template-parts/before-list', 'widgets' ); ?>

	<?php woocommerce_content(); ?>
	
	<?php get_template_part( 'template-parts/after-list', 'widgets' ); ?>

<?php get_template_part( 'template-parts/wrap', 'after' ); ?>

<?php get_sidebar( 'after-content' ); ?>

<?php get_footer(); ?>