<?php

/* Translation */
$brnhmbx_bourz_tra_TypeKeyword = get_theme_mod( 'brnhmbx_bourz_tra_TypeKeyword', 'Type keyword to search' );
/* */

?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
	<div>
		<input class="search-box" type="text" value="<?php echo esc_attr( $brnhmbx_bourz_tra_TypeKeyword ); ?>" name="s" id="s" />
	</div>
</form>