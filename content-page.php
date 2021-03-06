
<article <?php post_class('fx-clearfix'); ?>>

	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<?php get_template_part( 'template-parts/image', 'full' ); ?>

	<section class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="wp_link_pages fx-clearfix"><span class="wp_link_pages-item-empty">' . __( 'Pages:', 'universio' ).'</span>', 'after' => '</div>', 'link_before' => '<span class="wp_link_pages-item">', 'link_after' => '</span>', 'pagelink' => '%' ) ); ?>
	</section><!-- .entry-content -->

</article>
