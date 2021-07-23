<?php

/* Checkbox Default Values */
$brnhmbx_bourz_sh_CategoryBar = get_theme_mod( 'brnhmbx_bourz_sh_CategoryBar', 1 );
$brnhmbx_bourz_sh_TagBar = get_theme_mod( 'brnhmbx_bourz_sh_TagBar', 1 );
/* */

?>

<?php
get_template_part( 'pager-bar' );
if ( get_the_category() && $brnhmbx_bourz_sh_CategoryBar ) { get_template_part( 'category-bar' ); }
if ( $brnhmbx_bourz_sh_TagBar ) { the_tags( '<div class="home-cat-tag-page brnhmbx-font-1 fs12">', ', ', '</div>' ); }
?>

</div>
