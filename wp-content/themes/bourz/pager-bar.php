<?php
$defaults_wplp = array(
	'before'           => '<div class="home-cat-tag-page pager-only brnhmbx-font-4 fs12 fw700">' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_Page', 'PAGE' ) ) . ' &nbsp;&nbsp; ',
	'after'            => '</div>',
	'separator'        => ' &nbsp;&nbsp;/&nbsp;&nbsp; '
);
wp_link_pages( $defaults_wplp );
?>
