<?php get_header(); ?>

<?php get_sidebar( 'before-content' ); ?>

<?php get_template_part( 'template-parts/wrap', 'before' ); ?>

<?php
$settings = universio_get_settings();
$list_columns = $settings['list_columns'];
?>

				<?php if (have_posts()) : ?>
					
					<?php get_template_part( 'template-parts/before-list', 'widgets' ); ?>
					
					<div class="fx-columns fx-columns-<?php echo $list_columns; ?>">
					
					<?php while ( have_posts() ) : the_post(); // the loop ?>

						<?php get_template_part( 'content' ); ?>

						<?php comments_template( '', true ); ?>

					<?php endwhile; // end of the loop ?>

					</div><!-- .fx-columns -->
					
					<?php echo universio_nav(); ?>
					
					<?php get_template_part( 'template-parts/after-list', 'widgets' ); ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/nothing', 'found' ); ?>

				<?php endif; ?>

<?php get_template_part( 'template-parts/wrap', 'after' ); ?>

<?php get_sidebar( 'after-content' ); ?>

<?php get_footer(); ?>