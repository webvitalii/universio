<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title">
			<?php
			printf( _n( '1 comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'flexflux' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			global $post;
			echo '<a href="'.get_post_comments_feed_link( $post->ID ).'" class="rss-feed-link" title="'.esc_attr( __( 'Post comments RSS feed', 'flexflux' ) ).'"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>';
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php wp_list_comments( array(
				//'callback' => 'flexflux_comments',
				'style' => 'ol',
				'short_ping'  => true,
				'avatar_size' => 50
			) );?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; ?>


	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'flexflux' ); ?></p>
	<?php endif; ?>


	<?php
		comment_form();
	?>

</div><!-- #comments .comments-area -->
