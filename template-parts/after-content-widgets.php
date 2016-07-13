	<?php
	$settings = universio_get_settings();
	$after_content_widgets_columns = $settings['after_content_widgets_columns'];
	?>
	<?php if ( is_active_sidebar( 'after_content_widgets' ) ) : ?>
	<div class="site-after-content-widgets">
		<div class="widget-area widget-area-after-content">
			<div class="fx-columns fx-columns-<?php echo $after_content_widgets_columns; ?>">
			<?php if ( ! dynamic_sidebar( 'after_content_widgets' ) ) : ?>
				<?php
					// show nothing if there is no widgets
				?>
			<?php endif; ?>
			</div><!-- .fx-columns -->
		</div><!-- .widget-area .widget-area-after-content -->
	</div><!-- .site-after-content-widgets -->
	<?php endif; ?>