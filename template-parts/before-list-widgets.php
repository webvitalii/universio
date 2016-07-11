	<?php
	$settings = universio_get_settings();
	$before_list_widgets_columns = $settings['before_list_widgets_columns'];
	?>
	<?php if ( is_active_sidebar( 'before_list_widgets' ) ) : ?>
	<div class="site-before-list-widgets">
		<div class="widget-area widget-area-before-list">
			<div class="fx-columns fx-columns-<?php echo $before_list_widgets_columns; ?>">
			<?php if ( ! dynamic_sidebar( 'before_list_widgets' ) ) : ?>
				<?php
					// show nothing if there is no widgets
				?>
			<?php endif; ?>
			</div><!-- .fx-columns -->
		</div><!-- .widget-area .widget-area-before-list -->
	</div><!-- .site-before-list-widgets -->
	<?php endif; ?>