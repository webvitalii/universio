	<?php
	$settings = universio_get_settings();
	$after_list_widgets_columns = $settings['after_list_widgets_columns'];
	?>
	<?php if ( is_active_sidebar( 'after_list_widgets' ) ) : ?>
	<div class="site-after-list-widgets">
		<div class="widget-area widget-area-after-list">
			<div class="fx-columns fx-columns-<?php echo $after_list_widgets_columns; ?>">
			<?php if ( ! dynamic_sidebar( 'after_list_widgets' ) ) : ?>
				<?php
					// show nothing if there is no widgets
				?>
			<?php endif; ?>
			</div><!-- .fx-columns -->
		</div><!-- .widget-area .widget-area-after-list -->
	</div><!-- .site-after-list-widgets -->
	<?php endif; ?>