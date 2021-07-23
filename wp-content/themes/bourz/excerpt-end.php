<?php

/* Checkbox Default Values */
$brnhmbx_bourz_sh_TagBar_Home = get_theme_mod( 'brnhmbx_bourz_sh_TagBar_Home', 1 );
$brnhmbx_bourz_sh_CategoryBar_Home = get_theme_mod( 'brnhmbx_bourz_sh_CategoryBar_Home', 1 );
/* */

?>

<?php

		get_template_part( 'pager-bar' );
		if ( get_the_category() && $brnhmbx_bourz_sh_CategoryBar_Home ) { get_template_part( 'category-bar' ); }	
		if ( $brnhmbx_bourz_sh_TagBar_Home ) { the_tags( '<div class="home-cat-tag-page brnhmbx-font-1 fs12">', ', ', '</div>' ); }