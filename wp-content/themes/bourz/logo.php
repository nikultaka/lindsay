<?php
$brnhmbx_bourz_headerBanner = get_theme_mod( 'brnhmbx_bourz_text_Banner_Header', '' );
$brnhmbx_bourz_sh_Banner_Header = get_theme_mod( 'brnhmbx_bourz_sh_Banner_Header', 1 );
$brnhmbx_bourz_opt_LogoPos = get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' );
$brnhmbx_bourz_HBT = 0;
if ( $brnhmbx_bourz_headerBanner && $brnhmbx_bourz_sh_Banner_Header && ( $brnhmbx_bourz_opt_LogoPos == 'logo-top' || $brnhmbx_bourz_opt_LogoPos == 'logo-bottom' ) ) { $brnhmbx_bourz_HBT = 1; }
?>
<div class="site-logo-outer<?php if ( $brnhmbx_bourz_HBT ) { echo ' clearfix'; } ?>">
    <header class="site-logo-container">
		<?php if ( $brnhmbx_bourz_HBT ) { ?><div class="leaderboard-header-logo"><div class="table-cell-middle"><?php } ?>
            <?php
            // If a logo image is uploaded
            if ( get_theme_mod( 'brnhmbx_bourz_upload_Logo' ) ) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="theme-logo-alt" src="<?php echo esc_url( get_theme_mod( 'brnhmbx_bourz_upload_Logo' ) ); ?>" /></a>
            <?php } else { // Use logo text ?>
                <h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( get_theme_mod( 'brnhmbx_bourz_text_Logo' ) != '' ) { echo esc_attr( get_theme_mod( 'brnhmbx_bourz_text_Logo' ) ); } else { bloginfo( 'name' ); } ?></a></h1>
            <?php } ?>
        <?php if ( $brnhmbx_bourz_HBT ) { ?></div></div><?php } ?>
	</header>
    <?php if ( $brnhmbx_bourz_HBT ) {
	$ad_code = apply_filters( 'widget_text', $brnhmbx_bourz_headerBanner ); ?><div class="leaderboard-header"><?php echo wp_kses_post( $ad_code ); ?></div><?php } ?>
</div>
