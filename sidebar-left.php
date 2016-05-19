
				<div class="fx-box-3 fx-padding-all fx-bg-gray-lightest">
					<div class="widget-area widget-area-left">

						<?php if ( ! dynamic_sidebar( 'sidebar_left' ) ) : // sidebar widgetized area ?>
							<?php
								// show something if there is no widgets in main sidebar
							?>

							<aside class="widget widget_pages">
								<h4 class="widget-title"><?php _e( 'Pages', 'flexflux' ); ?></h4>
								<ul>
								<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
								</ul>
							</aside>
							
							<aside class="widget widget_tags">
								<h4 class="widget-title"><?php _e( 'Tags', 'flexflux' ); ?></h4>
								<?php wp_tag_cloud(); ?>
							</aside>

						<?php endif; // end of the sidebar widgetized area ?>

					</div><!-- .widget-area .widget-area-left -->
				</div><!-- .fx-box -->
