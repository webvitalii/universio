

	</div><!-- .fx-grid -->

</div><!-- #main .site-main -->


<footer class="site-footer clearfix">

	<div class="fx-grid">

		<div class="fx-box-2 fx-padding-all">
			<div class="site-footer-left">

				<?php if ( ! dynamic_sidebar( 'footer' ) ) : // the footer widgetized area ?>
					<!-- no widgets in footer -->
				<?php endif; // end of the footer widgetized area ?>

			</div><!-- .site-footer-left -->
		</div><!-- .fx-box -->

		<div class="fx-box-1 fx-padding-all">
			<div class="site-footer-right fx-text-right">

				<?php
				// it is completely optional, but if you like the theme I would appreciate it if you keep the credit link at the bottom ?>
				<?php _e( 'Powered by', 'flexflux' ); ?>
				<!--<a href="http://wordpress.org/" title="<?php _e( 'WordPress CMS', 'flexflux' ); ?>" target="_blank"><i class="ionicon ion-social-wordpress-outline fx-icon fx-icon-20"></i><?php _e( 'WordPress', 'flexflux' ); ?></a>
				<?php _e( '&', 'flexflux' ); ?>-->
				<a href="http://codecanyon.net/user/webvitalii/portfolio?ref=webvitalii" title="<?php _e( 'Responsive WordPress theme', 'flexflux' ); ?>" target="_blank"><!--<i class="ionicon ion-ios-star-outline fx-icon fx-icon-20"></i>--><?php _e( 'Flexflux', 'flexflux' ); ?></a>

				<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" class="rss-feed-link" title="<?php echo esc_attr( __( 'Posts RSS feed', 'flexflux' ) ); ?>"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>
				<a href="<?php echo esc_url( get_bloginfo( 'comments_rss2_url' ) ); ?>" class="rss-feed-link" title="<?php echo esc_attr( __( 'Comments RSS feed', 'flexflux' ) ); ?>"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>

			</div><!-- .site-footer-right -->
		</div><!-- .fx-box -->

	</div><!-- .fx-grid -->


</footer><!-- .site-footer -->

</div><!-- .site-wrapper -->
</div><!-- .container -->

</div><!-- #page .hfeed -->

<?php wp_footer(); // wp_footer() should be just before the closing </body> tag, or many plugins will be broken  ?>

</body>

</html>