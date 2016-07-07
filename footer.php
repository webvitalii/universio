

	</div><!-- .fx-grid -->

</div><!-- #main .site-main -->


<?php
$settings = universio_get_settings();
$footer_widgets_columns = $settings['footer_widgets_columns'];
?>
<?php if ( is_active_sidebar( 'footer_widgets' ) ) : ?>
	<div class="fx-padding-all site-sidebar-footer">
		<div class="widget-area widget-area-footer">
			<div class="fx-columns fx-columns-<?php echo $footer_widgets_columns; ?>">
			<?php if ( ! dynamic_sidebar( 'footer_widgets' ) ) : // footer widgetized area ?>
				<?php
					// show nothing if there is no widgets in footer sidebar
				?>
			<?php endif; // end of the sidebar widgetized area ?>
			</div><!-- .fx-columns -->
		</div><!-- .widget-area .widget-area-footer -->
	</div><!-- .fx-padding-all -->
<?php endif; ?>


<footer class="site-footer fx-clearfix">

	<div class="fx-grid">

		<div class="fx-box-sm-8 fx-padding-all">
			&copy; <?php echo date('Y'); ?>
			<a href="<?php esc_url( home_url( '/' ) ); ?>" 
			title="<?php echo esc_attr( get_bloginfo( 'description', 'display' )); ?>"><?php bloginfo( 'name' ); ?></a>
		</div><!-- .fx-box -->

		<div class="fx-box-sm-4 fx-padding-all fx-text-right">
			<?php
			// it is completely optional, but if you like the theme I would appreciate it if you keep the credit link at the bottom ?>
			<?php _e( 'Powered by', 'universio' ); ?>
			<a href="http://wordpress.org/" title="<?php _e( 'WordPress CMS', 'universio' ); ?>" target="_blank"><i class="ionicon ion-social-wordpress-outline fx-icon fx-icon-20"></i><?php _e( 'WordPress', 'universio' ); ?></a>
			<?php //_e( '&', 'universio' ); ?>
			<!--<a href="http://codecanyon.net/user/webvitalii/portfolio?ref=webvitalii" title="<?php _e( 'Responsive WordPress theme', 'universio' ); ?>" target="_blank"><?php _e( 'Universio', 'universio' ); ?></a>-->

			<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" class="rss-feed-link" title="<?php echo esc_attr( __( 'Posts RSS feed', 'universio' ) ); ?>"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>
			<a href="<?php echo esc_url( get_bloginfo( 'comments_rss2_url' ) ); ?>" class="rss-feed-link" title="<?php echo esc_attr( __( 'Comments RSS feed', 'universio' ) ); ?>"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>
		</div><!-- .fx-box -->

	</div><!-- .fx-grid -->


</footer><!-- .site-footer -->

</div><!-- .site-wrapper -->
</div><!-- .fx-container -->

</div><!-- #page .hfeed -->

<?php wp_footer();  ?>

</body>

</html>