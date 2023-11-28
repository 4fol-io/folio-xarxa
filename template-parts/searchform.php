<form role="search" method="get" class="search-form mb-5" action="<?= esc_url(home_url('/')); ?>" novalidate="novalidate">
	<label class="sr-only"><?php _e( 'Search for:', 'folio-xarxa' ); ?></label>
	<div class="input-group">
		<input type="search" name="s" value="<?= get_search_query(); ?>" class="search-field form-control" placeholder="<?php esc_attr_e( 'Search', 'folio-xarxa' ); ?>..." required>
		<div class="input-group-append">
			<button type="submit" class="search-submit btn btn-primary"><?php esc_attr_e( 'Search', 'folio-xarxa' ); ?></button>
		</div>
	</div>
</form>
