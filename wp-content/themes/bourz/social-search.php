<div class="top-extra-outer">
    <div class="top-extra">    
        <div class="top-extra-inner clearfix">
            <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_HeaderSocial', 1 ) && get_theme_mod( 'brnhmbx_bourz_sh_SocialAccounts', 1 ) ) { echo bourz_placeSocialIcons( 'header-social' ); } ?>
            <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_HeaderSearch', 1 ) ) { ?>
                <div class="brnhmbx-top-search-button"><i class="fa fa-search"></i></div>
                <div class="top-search"><input class="top-search-input brnhmbx-font-1" type="text" value="<?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_TypeKeyword', 'Type keyword to search' ) ); ?>" name="s" id="s_top" /></div>
			<?php } ?>
        </div>    
    </div>
</div>