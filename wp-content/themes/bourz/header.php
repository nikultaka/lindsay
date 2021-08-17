<!DOCTYPE html>
<html <?php if ( get_theme_mod( 'brnhmbx_bourz_tra_Lang' ) ) { echo 'lang="' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_Lang' ) ) . '"'; } else { language_attributes(); } ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( get_theme_mod( 'brnhmbx_bourz_upload_Favicon' ) && !function_exists( 'wp_site_icon' ) ) { ?><link rel="icon" href="<?php echo esc_url( get_theme_mod( 'brnhmbx_bourz_upload_Favicon' ) ); ?>"><?php } ?>
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="hiddenInfo">
		<span id="mapInfo_Zoom"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_MapZoom', 15 ) ); ?></span>
		<span id="mapInfo_coorN"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_coorN', '49.0138' ) ); ?></span>
		<span id="mapInfo_coorE"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_coorE', '8.38624' ) ); ?></span>
		<span id="bxInfo_Controls"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_opt_bxControls', 'arrow' ) ); ?></span>
		<span id="bxInfo_Auto"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_bxAuto', 0 ) ); ?></span>
		<span id="bxInfo_Controls_Main"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_opt_bxControls_Main', 'bullet' ) ); ?></span>
		<span id="bxInfo_Auto_Main"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_bxAuto_Main', 0 ) ); ?></span>
		<span id="bxInfo_Pause"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_sliderPause', 4000 ) ); ?></span>
		<span id="bxInfo_Infinite"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_sliderInfinite', 1 ) ); ?></span>
		<span id="bxInfo_Random"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_sliderRandom', 0 ) ); ?></span>
		<span id="bxInfo_Mode"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_sliderMode', 'horizontal' ) ); ?></span>
		<span id="siteUrl"><?php echo esc_attr( get_home_url() ); ?></span>
		<span id="trigger-sticky-value"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_triggerSticky', '300' ) ); ?></span>
		<span id="menu-logo-l-r"><?php if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-left' && get_theme_mod( 'brnhmbx_bourz_opt_MenuPos', 'menu-left' ) == 'menu-right' ) { echo'true'; } ?></span>
		<span id="spot-duration"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_spotDuration', '4000' ) ); ?></span>
		<span id="woo-border"><?php if ( function_exists( 'WC' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) { ?><div class="brnhmbx-woo-border"></div><?php } ?></span>
		<span id="slicknav_apl"><?php echo esc_attr( get_theme_mod( 'bourz_slicknav_apl', 1 ) ); ?></span>
	</div>

	<div class="body-outer">

		<!-- Sticky Header -->
		<?php if ( get_theme_mod( 'brnhmbx_bourz_stickyHeader', 0 ) ) { get_template_part( 'sticky-menu' ); } ?>
		<!-- /Sticky Header -->

		<!-- Mobile Header -->
		<div class="mobile-header clearfix">
			<div class="mobile-logo-outer">
				<div class="mobile-logo-container">
					<?php $stickyLogoPath = '';
					if ( get_theme_mod( 'brnhmbx_bourz_upload_Logo' ) ) { $stickyLogoPath = get_theme_mod( 'brnhmbx_bourz_upload_Logo' ); }
					if ( get_theme_mod( 'brnhmbx_bourz_upload_StickyLogo' ) ) { $stickyLogoPath = get_theme_mod( 'brnhmbx_bourz_upload_StickyLogo' ); }
					if ( get_theme_mod( 'brnhmbx_bourz_upload_MobileLogo' ) ) { $stickyLogoPath = get_theme_mod( 'brnhmbx_bourz_upload_MobileLogo' ); }
					if ( $stickyLogoPath ) { ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="theme-sticky-logo-alt" src="<?php echo esc_url( $stickyLogoPath ); ?>" /></a><?php } else { ?>
						<h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( get_theme_mod( 'brnhmbx_bourz_text_Logo' ) != '' ) { echo esc_attr( get_theme_mod( 'brnhmbx_bourz_text_Logo' ) ); } else { bloginfo( 'name' ); } ?></a></h1>
					<?php } ?>
				</div>
			</div>
			<div class="brnhmbx-menu-button"><i class="fa fa-navicon"></i></div>
			<div id="touch-menu" class="<?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_Menu', 'brnhmbx-font-1' ); ?> fw700"></div>
		</div>
		<!-- /Mobile Header -->

		<?php if ( get_theme_mod( 'brnhmbx_bourz_opt_SpotMessages', 'tagline' ) != 'none' || get_theme_mod( 'brnhmbx_bourz_sh_HeaderMenu', 1 ) ) { ?>
			<div class="top-line-outer">
				<div class="top-line-container">
					<div class="top-line-inner clearfix">
						<?php if ( get_theme_mod( 'brnhmbx_bourz_opt_SpotMessages', 'tagline' ) != 'none' ) { ?>
							<div class="spot-messages brnhmbx-font-1 fs12">
								<?php if ( get_theme_mod( 'brnhmbx_bourz_opt_SpotMessages', 'tagline' ) == 'spot' ) { ?>
									<span><?php echo wp_kses_post( get_theme_mod( 'brnhmbx_bourz_spotMessages_1', 'Spot Message 1' ) ); ?></span>
									<span><?php echo wp_kses_post( get_theme_mod( 'brnhmbx_bourz_spotMessages_2', 'Spot Message 2' ) ); ?></span>
									<span><?php echo wp_kses_post( get_theme_mod( 'brnhmbx_bourz_spotMessages_3', 'Spot Message 3' ) ); ?></span>
								<?php } else if ( get_theme_mod( 'brnhmbx_bourz_opt_SpotMessages', 'tagline' ) == 'tagline' ) { ?><span class="spot-tagline"><?php bloginfo( 'description' ); ?></span><?php } ?>
							</div>
						<?php } ?>
						<?php if ( get_theme_mod( 'brnhmbx_bourz_sh_HeaderMenu', 1 ) ) { ?>
							<div class="header-menu-outer fs12 clearfix">

								<?php
								$args_header = array(
									'theme_location' => 'header_menu',
									'container_class' => 'footer-nav',
									'menu_id'         => 'header-menu',
									'depth'		   => '-1',
									'echo' => false,
									'fallback_cb' => 'bourz_assign_HeaderMenu'
								);

								$nav = wp_nav_menu( $args_header );
								echo str_replace( '</a></li>', '</a></li><li class="nav-sep">/</li>', $nav );
								?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="site-top clearfix">
			<div class="site-top-container-outer clearfix">
				<?php if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-top' ) { get_template_part( 'logo' ); } ?>
				<div class="site-top-container clearfix">
					<?php if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-left' ) { get_template_part( 'logo' ); if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuPos', 'menu-left' ) == 'menu-right' ) { ?><div class="site-logo-outer-handler"></div><?php } } else { ?><div class="site-logo-left-handler"></div><?php } ?><?php get_template_part( 'primary-menu' ); ob_start( 'bourz_compress' ); get_template_part( 'social-search' ); ob_end_flush(); ?>
				</div>
				<?php if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-bottom' ) { get_template_part( 'logo' ); } ?>
			</div>
			<?php /* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'above-full-slider' ); } /* */ ?>
		</div>    

		<?php

		/* Header Widgets */
		ob_start( 'bourz_compress' );

		if ( is_active_sidebar( 'brnhmbx_bourz_header_widgets' ) && ( is_home() || ( is_single() && get_theme_mod( 'brnhmbx_bourz_sh_HeaderWidgetsPost', 0 ) ) || ( is_archive() && get_theme_mod( 'brnhmbx_bourz_sh_HeaderWidgetsArchive', 0 ) ) || ( is_page() && get_theme_mod( 'brnhmbx_bourz_sh_HeaderWidgetsPage', 0 ) ) ) && get_theme_mod( 'brnhmbx_bourz_sh_HeaderWidgets', 1 ) ) {

			if ( get_theme_mod( 'brnhmbx_bourz_sh_HeaderWidgetsFront', 1 ) ) {

				if ( get_query_var( 'paged' ) <= 1 ) { ?>

					<div class="header-widgets-container clearfix">
						<div class="header-widget-area">
							<div class="header-widget-area-inner<?php if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { echo '-col2'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_header_widgets' ); ?></div>
						</div>
					</div>

				<?php }

			} else { ?>

				<div class="header-widgets-container clearfix">
					<div class="header-widget-area">
						<div class="header-widget-area-inner<?php if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { echo '-col2'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_header_widgets' ); ?></div>
					</div>
				</div>

			<?php }

		} ob_end_flush();
		/* /Header Widgets */ ?>

		<?php

		/* Slider - Fullwidth */
		if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderPosition', 'cover' ) == 'full' ) {

			if ( get_theme_mod( 'brnhmbx_bourz_bpts', '0' ) ) {

				bourz_blogPostsToSlider();

			} else {

				bourz_placeSlider();

			}

		} /* /Slider - Fullwidth */ ?>

		<div class="site-mid clearfix">

			<?php /* Slider - Cover */
			if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderPosition', 'cover' ) == 'cover' ) {

				if ( get_theme_mod( 'brnhmbx_bourz_bpts', '0' ) ) {

					bourz_blogPostsToSlider();

				} else {

					bourz_placeSlider();

				}

			} /* /Slider - Cover */

			/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-cover-slider' ); } /* */

			/* Upper Widgets */
			ob_start( 'bourz_compress' );

			if ( is_active_sidebar( 'brnhmbx_bourz_upper_widgets' ) && ( is_home() || ( is_single() && get_theme_mod( 'brnhmbx_bourz_sh_UpperWidgetsPost', 0 ) ) || ( is_archive() && get_theme_mod( 'brnhmbx_bourz_sh_UpperWidgetsArchive', 0 ) ) || ( is_page() && get_theme_mod( 'brnhmbx_bourz_sh_UpperWidgetsPage', 0 ) ) ) && get_theme_mod( 'brnhmbx_bourz_sh_UpperWidgets', 1 ) ) {

				if ( get_theme_mod( 'brnhmbx_bourz_sh_UpperWidgetsFront', 1 ) ) {

					if ( get_query_var( 'paged' ) <= 1 ) { ?>

						<div class="upper-widget-area">
							<div class="upper-widget-area-inner<?php if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { echo '-col2'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_upper_widgets' ); ?></div>
						</div>

					<?php }

				} else { ?>

					<div class="upper-widget-area">
						<div class="upper-widget-area-inner<?php if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { echo '-col2'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_upper_widgets' ); ?></div>
					</div>

				<?php }

			} ob_end_flush();
			/* /Upper Widgets */

			/* Leaderboard Banner */ if ( is_home() ) { if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-upper-widgets' ); } } /* */

			?>

			<div class="article-wrapper-outer">
