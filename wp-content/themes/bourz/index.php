<?php get_header();

/* Radio Default Values */
$brnhmbx_bourz_opt_Layout = get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' );
/* */

?>

		<div class="clearfix main-container<?php echo bourz_applyLayout(); ?>">
        	<div class="clearfix site-content<?php echo bourz_applyLayout(); ?>">

				<?php

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'above-among-slider' ); } /* */

				/* Slider - Among */
                if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderPosition', 'cover' ) == 'among' ) {

                    if ( get_theme_mod( 'brnhmbx_bourz_bpts', '0' ) ) {

                        bourz_blogPostsToSlider();

                    } else {

                        bourz_placeSlider();

                    }

                } /* /Slider - Among */

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-among-slider' ); } /* */

				?>

                <!-- wrapper -->
                <div class="wrapper clearfix">

                <?php

                $brnhmbx_bourz_counter = 0;
				$brnhmbx_bourz_text_HomepageCats = get_theme_mod( 'brnhmbx_bourz_text_HomePosts', '' );

                /* Hide the posts in the feed if "Show Blog Posts in Slider" option is chosen. - Optional */
                if ( get_theme_mod( 'brnhmbx_bourz_bptsExclude', '0' ) ) {

					$indexLoop_args = array(
						'post__not_in' =>  bourz_excludePostsUsedInSlider(),
						'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
					);

					if ( $brnhmbx_bourz_text_HomepageCats && get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) != 'all' ) {

						$homepageCatIDs = explode( ',', esc_attr( $brnhmbx_bourz_text_HomepageCats ) );

						if ( get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) == 'hidecats' ) {

							$indexLoop_shCats = array( 'category__not_in' => $homepageCatIDs );

						} else if ( get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) == 'showcats' ) {

							$indexLoop_shCats = array( 'cat' => $homepageCatIDs );

						}

						$indexLoop_final = array_merge( $indexLoop_args, $indexLoop_shCats );

					} else {

						$indexLoop_final = $indexLoop_args;

					}

                    $indexPosts = new WP_Query( $indexLoop_final );

                    // Pagination fix
                    $temp_query = $wp_query;
                    $wp_query   = NULL;
                    $wp_query   = $indexPosts;

                } else {

                    $indexLoop_args = array(
												'post_type' => 'post',
                        'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
                    );

					if ( $brnhmbx_bourz_text_HomepageCats && get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) != 'all' ) {

						$homepageCatIDs = explode( ',', esc_attr( $brnhmbx_bourz_text_HomepageCats ) );

						if ( get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) == 'hidecats' ) {

							$indexLoop_shCats = array( 'category__not_in' => $homepageCatIDs );

						} else if ( get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) == 'showcats' ) {

							$indexLoop_shCats = array( 'cat' => $homepageCatIDs );

						}

						$indexLoop_final = array_merge( $indexLoop_args, $indexLoop_shCats );

					} else {

						$indexLoop_final = $indexLoop_args;

					}

                    $indexPosts = new WP_Query( $indexLoop_final );

					if ( $brnhmbx_bourz_text_HomepageCats && get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) != 'all' ) {

						// Pagination fix
						$temp_query = $wp_query;
						$wp_query   = NULL;
						$wp_query   = $indexPosts;

					}

                }

                $brnhmbx_bourz_counter = 0;
				$brnhmbx_bourz_banner_AFP = 0;

                if ( $indexPosts->have_posts() ) :
                    while ( $indexPosts->have_posts() ) : $indexPosts->the_post();

                    if ( $brnhmbx_bourz_opt_Layout == '2col' || $brnhmbx_bourz_opt_Layout == '2col_sidebar' ) {

                        // Open & close row in every 2 entries for 2 columns layout

                        if ( $brnhmbx_bourz_counter % 2 == 0 ) { ?>

                            <!-- row -->
                            <div class="row-1-2 clearfix">

                    <?php }

                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;

                        if ( $brnhmbx_bourz_counter % 2 == 0 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>

                            </div><!-- /row -->
                            <?php /* Leaderboard Banner */ if ( !$brnhmbx_bourz_banner_AFP ) { if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'after-first-post' ); } $brnhmbx_bourz_banner_AFP = 1; } /* */ ?>

                    <?php }

                    } else if ( $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) {

                        // Open & close row for the first entry and then in every 2 entries for 1 + 2 columns layout

						if ( $brnhmbx_bourz_counter == 0 ) { ?>

                        	<!-- row -->
                            <div class="row-1-1-2 clearfix">

                     	<?php } else {

							if ( $brnhmbx_bourz_counter % 2 == 1 ) { ?>

								<!-- row -->
								<div class="row-1-2 clearfix">

						<?php }

						}

                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;

                        if ( $brnhmbx_bourz_counter == 1 || $brnhmbx_bourz_counter % 2 == 1 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>

                            </div><!-- /row -->
                            <?php /* Leaderboard Banner */ if ( !$brnhmbx_bourz_banner_AFP ) { if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'after-first-post' ); } $brnhmbx_bourz_banner_AFP = 1; } /* */ ?>

                    <?php }

                    } else if ( $brnhmbx_bourz_opt_Layout == '3col' ) {

                        // Open & close row in every 3 entries for 3 columns layout

                        if ( $brnhmbx_bourz_counter % 3 == 0 ) { ?>

                            <!-- row -->
                            <div class="row-1-3 clearfix">

                    <?php }

                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;

                        if ( $brnhmbx_bourz_counter % 3 == 0 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>

                            </div><!-- /row -->
                            <?php /* Leaderboard Banner */ if ( !$brnhmbx_bourz_banner_AFP ) { if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'after-first-post' ); } $brnhmbx_bourz_banner_AFP = 1; } /* */ ?>

                    <?php }

                    } else if ( $brnhmbx_bourz_opt_Layout == '2_3col' ) {

                        // Open & close row for the first 2 entries and then in every 3 entries for 3 columns layout

						if ( $brnhmbx_bourz_counter == 0 ) { ?>

                        	<!-- row -->
                            <div class="row-2-3 clearfix">

                     	<?php } else {

                        if ( $brnhmbx_bourz_counter % 3 == 2 ) { ?>

                            <!-- row -->
                            <div class="row-1-3 clearfix">

                    <?php }

						}

                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;

                        if ( $brnhmbx_bourz_counter == 2 || $brnhmbx_bourz_counter % 3 == 2 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>

                            </div><!-- /row -->
                            <?php /* Leaderboard Banner */ if ( !$brnhmbx_bourz_banner_AFP ) { if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'after-first-post' ); } $brnhmbx_bourz_banner_AFP = 1; } /* */ ?>

                    <?php }

                    } else {

                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;
						/* Leaderboard Banner */ if ( !$brnhmbx_bourz_banner_AFP ) { if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'after-first-post' ); } $brnhmbx_bourz_banner_AFP = 1; } /* */

                    }

                    endwhile;

                else :

                get_template_part( 'nothing-found' );

                endif;

                wp_reset_postdata();

                ?>

                </div><!-- /wrapper -->

                <?php

                bourz_Pagination();

                if ( get_theme_mod( 'brnhmbx_bourz_bptsExclude', '0' ) || ( $brnhmbx_bourz_text_HomepageCats && get_theme_mod( 'brnhmbx_bourz_opt_HomePosts', 'all' ) != 'all' ) ) {

                    // Reset main query object
                    $wp_query = NULL;
                    $wp_query = $temp_query;

                }

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-blog-posts' ); } /* */

                ?>

                <?php /* Home Widgets */
                ob_start( 'bourz_compress' );

                if ( is_active_sidebar( 'brnhmbx_bourz_home_widgets' ) && get_theme_mod( 'brnhmbx_bourz_sh_HomeWidgets', 1 ) ) {

                     if ( get_theme_mod( 'brnhmbx_bourz_sh_HomeWidgetsFront', 1 ) ) {

                         if ( get_query_var( 'paged' ) <= 1 ) { ?>

                            <div class="home-widget-area">
                                <div class="home-widget-area-inner<?php if ( $brnhmbx_bourz_opt_Layout == '1col_sidebar' || $brnhmbx_bourz_opt_Layout == '2col_sidebar' || $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) { echo '-col2-sidebar'; } else if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { echo '-col2'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_home_widgets' ); ?></div>
                            </div>

                        <?php }

                    } else { ?>

                        <div class="home-widget-area">
							<div class="home-widget-area-inner<?php if ( $brnhmbx_bourz_opt_Layout == '1col_sidebar' || $brnhmbx_bourz_opt_Layout == '2col_sidebar' || $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) { echo '-col2-sidebar'; } else if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { echo '-col2'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_home_widgets' ); ?></div>
                        </div>

                    <?php }

                } ob_end_flush();
                /* /Home Widgets */

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-home-widgets' ); } /* */

				?>

            </div><!-- /site-content -->
		</div><!-- /main-container -->

    </div><!-- /article-wrapper-outer -->

    <?php /* Sidebar - Home */
    if ( $brnhmbx_bourz_opt_Layout == '1col_sidebar' || $brnhmbx_bourz_opt_Layout == '2col_sidebar' || $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) { get_sidebar(); } /* /Sidebar - Home */?>

</div><!-- /site-mid -->

<?php get_footer(); ?>
