
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" class="fx-form-control" name="s" />
	<button type="submit" class="fx-btn">
		<i class="ionicon ion-ios-search-strong fx-icon fx-icon-20"></i> 
		<?php echo esc_attr( __( 'Search', 'flexflux' ) ); ?>
	</button>
</form>
