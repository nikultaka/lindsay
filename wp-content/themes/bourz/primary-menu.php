<div class="site-menu-outer">
    <div class="site-menu-container <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_Menu', 'brnhmbx-font-1' ); ?> fw700 clearfix">
	<?php
            
    $args = array(
        'theme_location' => 'primary',
        'container'       => 'div',
        'container_class' => 'site-nav2',
        'menu_id'         => 'site-menu',
		'fallback_cb' => 'bourz_assign_PrimaryMenu'
    );
    
    wp_nav_menu( $args );
    
    ?>
	</div>
</div>