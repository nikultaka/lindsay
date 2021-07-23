<div id="sticky-menu">
	<div class="sticky-menu-inner clearfix">
    	<div class="sticky-logo-outer">
			<div class="sticky-logo-container">
    			<?php if ( get_theme_mod( 'brnhmbx_bourz_sh_StickyLogo', 1 ) ) {

					$stickyLogoPath = '';
                    if ( get_theme_mod( 'brnhmbx_bourz_upload_Logo' ) ) { $stickyLogoPath = get_theme_mod( 'brnhmbx_bourz_upload_Logo' ); }
                    if ( get_theme_mod( 'brnhmbx_bourz_upload_StickyLogo' ) ) { $stickyLogoPath = get_theme_mod( 'brnhmbx_bourz_upload_StickyLogo' ); }
                    if ( $stickyLogoPath ) { ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="theme-sticky-logo-alt" src="<?php echo esc_url( $stickyLogoPath ); ?>" /></a><?php } else { ?>    
                    <h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( get_theme_mod( 'brnhmbx_bourz_text_Logo' ) != '' ) { echo esc_attr( get_theme_mod( 'brnhmbx_bourz_text_Logo' ) ); } else { bloginfo( 'name' ); } ?></a></h1><?php }

				} ?>
        	</div>
		</div>
        <div class="site-menu-outer">
            <div class="site-menu-container brnhmbx-font-1 fw700 clearfix">
            <?php

            $args = array(
                'theme_location' => 'primary',
                'container'       => 'div',
                'container_class' => 'site-nav2',
                'menu_id'         => 'site-menu-sticky',
                'fallback_cb' => 'bourz_assign_PrimaryMenu'
            );

            wp_nav_menu( $args );

            ?>
            </div>
        </div>
        <?php ob_start( 'bourz_compress' ); ?>
        <div class="top-extra-outer">
            <div class="top-extra">
                <div class="top-extra-inner clearfix">
                    <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_HeaderSocial', 1 ) && get_theme_mod( 'brnhmbx_bourz_sh_SocialAccounts', 1 ) ) { echo bourz_placeSocialIcons( 'header-social' ); } ?>
                    <a class="btn-to-top" href="javascript:void(0);"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
        </div>
        <?php ob_end_flush(); ?>
    </div>
</div>
