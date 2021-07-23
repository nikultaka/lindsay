<?php get_header();

	/* Checkbox Default Values */
	$brnhmbx_bourz_sh_SidebarInnerPage = get_theme_mod( 'brnhmbx_bourz_sh_SidebarInnerPage', 1 );
	$brnhmbx_bourz_sh_PageComments = get_theme_mod( 'brnhmbx_bourz_sh_PageComments', 1 );
	$brnhmbx_bourz_sh_SocialBar_Facebook = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Facebook', 1 );
	$brnhmbx_bourz_sh_SocialBar_Twitter = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Twitter', 1 );
	$brnhmbx_bourz_sh_SocialBar_Google = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Google', 1 );
	$brnhmbx_bourz_sh_SocialBar = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar', 1 );
	$brnhmbx_bourz_sh_SocialBar_Page = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Page', 1 );
	if ( ( !$brnhmbx_bourz_sh_SocialBar_Facebook && !$brnhmbx_bourz_sh_SocialBar_Twitter && !$brnhmbx_bourz_sh_SocialBar_Google ) || !$brnhmbx_bourz_sh_SocialBar_Page ) {
		$brnhmbx_bourz_sh_SocialBar = 0;
	}
	/* */

	$header_area = false;
	if ( get_the_title() || $brnhmbx_bourz_sh_SocialBar || ( $brnhmbx_bourz_sh_PageComments && comments_open() ) ) { $header_area = true; }

	?>
	<div class="clearfix main-container<?php echo bourz_applyLayout(); ?>">
        <div class="clearfix site-content<?php echo bourz_applyLayout(); ?>">

			<?php

			/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'above-page' ); } /* */

            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>

                <article class="post post-page zig-zag clearfix">
                    <div class="article-outer<?php echo bourz_applyLayout(); ?>">
                        <div class="article-inner">
                            <div class="article-container clearfix">

                                <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_Map', 0 ) && get_theme_mod( 'brnhmbx_bourz_mapPage' ) == get_the_ID() ) { ?>
                                    <div id="googleMap"></div>
                                <?php } else {
									?><div class="fea-img-container"><?php the_post_thumbnail(); ?></div><?php
                                } ?>

                                <?php if ( $header_area ) { ?>
                                    <div class="header-area<?php echo bourz_applyLayout(); ?>">
                                        <?php if ( get_the_title() ) { ?><h1 class="header-area-title <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_HAT', 'brnhmbx-font-1' ); ?> fw700"><?php the_title(); ?></h1><?php }
										if ( function_exists( 'WC' ) ) { if ( !is_cart() && !is_checkout() && !is_account_page() ) { if ( $brnhmbx_bourz_sh_SocialBar_Page ) { get_template_part( 'social-bar' ); } } } else { if ( $brnhmbx_bourz_sh_SocialBar_Page ) { get_template_part( 'social-bar' ); } } ?>
                                    </div>
                                <?php } ?>

                                <div class="article-content-outer<?php echo bourz_applyLayout(); ?>" style=" <?php if ( $header_area ) { ?>border-top: 2px solid;<?php } ?>">
                                    <div class="brnhmbx-font-3 fs16 clearfix"><?php the_content(); ?></div>
																		<?php get_template_part( 'pager-bar' ); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>

                <?php

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-page' ); } /* */

				if ( $brnhmbx_bourz_sh_PageComments ) { comments_template(); }

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-page-comments' ); } /* */

                endwhile;

                else :

                get_template_part( 'nothing-found' );

                endif; ?>

            </div><!-- /site-content -->
		</div><!-- /main-container -->

    </div><!-- /article-wrapper-outer -->

    <!-- sidebar -->

    <?php

	if ( function_exists( 'WC' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {

		// WooCommerce Pages

		echo '<div class="sidebar clearfix brnhmbx-font-3 fs14">';
			dynamic_sidebar( 'brnhmbx_bourz_woo_widgets' );
		echo '</div>';

	} else {

		if ( $brnhmbx_bourz_sh_SidebarInnerPage ) {

			if ( get_theme_mod( 'brnhmbx_bourz_ExtraSidebar_Page' ) ) {

				echo '<div class="sidebar clearfix">';
					dynamic_sidebar( 'brnhmbx_bourz_sidebar_page' );
				echo '</div>';

			} else {

				get_sidebar();

			}

		}

	}

    ?>

    <!-- /sidebar -->

</div><!-- /site-mid -->

<?php get_footer(); ?>
