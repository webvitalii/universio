<?php
$settings = universio_get_settings();
$footer_columns = $settings['footer_columns'];
?>
			<?php if ( is_active_sidebar( 'sidebar_footer' ) ) : ?>
				<div class="fx-padding-all fx-bg-gray-lightest">
					<div class="widget-area widget-area-footer">
						<div class="fx-columns fx-columns-<?php echo $footer_columns; ?>">
						<?php if ( ! dynamic_sidebar( 'sidebar_footer' ) ) : // footer widgetized area ?>
							<?php
								// show nothing if there is no widgets in footer sidebar
							?>
						<?php endif; // end of the sidebar widgetized area ?>
						</div><!-- .fx-columns -->
					</div><!-- .widget-area .widget-area-footer -->
				</div><!-- .fx-padding-all -->
			<?php endif; ?>
