	<?php
	$settings = universio_get_settings();
	$before_content_widgets_columns = $settings['before_content_widgets_columns'];
	?>
	<?php if ( is_active_sidebar( 'before_content_widgets' ) ) : ?>
	<div class="site-before-content-widgets">
		<div class="widget-area widget-area-before-content">
			<div class="fx-columns fx-columns-<?php echo $before_content_widgets_columns; ?>">
			<?php if ( ! dynamic_sidebar( 'before_content_widgets' ) ) : ?>
				<?php
					// show nothing if there is no widgets
				?>
			<?php endif; ?>
			</div><!-- .fx-columns -->
		</div><!-- .widget-area .widget-area-before-content -->
	</div><!-- .site-before-content-widgets -->
	<?php endif; ?>