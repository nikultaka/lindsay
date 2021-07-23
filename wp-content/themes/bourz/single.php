<?php get_header();

		/* Checkbox Default Values */
		$brnhmbx_bourz_sh_RelatedPosts = get_theme_mod( 'brnhmbx_bourz_sh_RelatedPosts', 1 );
		$brnhmbx_bourz_sh_PostComments = get_theme_mod( 'brnhmbx_bourz_sh_PostComments', 1 );
		$brnhmbx_bourz_sh_SidebarPost_Standard = get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Standard', 1 );
		$brnhmbx_bourz_sh_SidebarPost_Gallery = get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Gallery', 1 );
		$brnhmbx_bourz_sh_SidebarPost_Video = get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Video', 1 );
		$brnhmbx_bourz_sh_RPDate = get_theme_mod( 'brnhmbx_bourz_sh_RPDate', 1 );
		/* */

		/* Radio Default Values */
		$brnhmbx_bourz_opt_RPStyle = get_theme_mod( 'brnhmbx_bourz_opt_RPStyle', 'b' );
		$brnhmbx_bourz_opt_PageNaviBullet = get_theme_mod( 'brnhmbx_bourz_opt_PageNaviBullet', 'arrow' );
		$brnhmbx_bourz_opt_RPBase = get_theme_mod( 'brnhmbx_bourz_opt_RPBase', 'tag' );
		/* */

		?>

    	<div class="clearfix main-container<?php echo bourz_applyLayout(); ?>">
        	<div class="clearfix site-content<?php echo bourz_applyLayout(); ?>">

				<?php

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'above-post' ); } /* */

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                    if ( function_exists( 'bourz_setPostViews' ) ) { bourz_setPostViews( get_the_ID() ); }

                    get_template_part( 'content', get_post_format() );

                    endwhile;

                    else :

                    get_template_part( 'nothing-found' );

                    endif;

                    ?>

                    <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_AuthorBox', 0 ) ) { echo bourz_author_box(); } ?>

                    <div class="page-navi clearfix">

                        <?php

                        $next_post = get_adjacent_post( false, '', false );
                        $prev_post = get_adjacent_post( false, '', true );

                        if( !empty( $prev_post ) ) { ?>

                            <div class="page-navi-prev zig-zag clearfix">
                                <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                    <div class="page-navi-btn">
                                        <div class="page-navi-border clearfix">
                                            <?php if ( has_post_thumbnail( $prev_post->ID ) && $brnhmbx_bourz_opt_PageNaviBullet == 'image' ) { ?><div class="page-navi-prev-img"><?php echo get_the_post_thumbnail( $prev_post->ID, 'brnhmbx-bourz-small-thumbnail-image' ); ?></div><?php } ?>
                                            <div class="page-navi-prev-info">
                                                <?php if ( $brnhmbx_bourz_opt_PageNaviBullet == 'arrow' ) { ?><div class="table-cell-middle page-navi-prev-arrow"><i class="fa fa-angle-left"></i></div><?php } ?>
                                                <div class="table-cell-middle <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_PostNav', 'brnhmbx-font-1' ); ?> fs16 fw700"><?php echo get_the_title( $prev_post->ID ); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php }

                        if( !empty( $next_post ) ) { ?>

                            <div class="page-navi-next zig-zag clearfix">
                                <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                    <div class="page-navi-btn">
                                    	<div class="page-navi-border clearfix">
											<?php if ( has_post_thumbnail( $next_post->ID ) && $brnhmbx_bourz_opt_PageNaviBullet == 'image' ) { ?><div class="page-navi-next-img"><?php echo get_the_post_thumbnail( $next_post->ID, 'brnhmbx-bourz-small-thumbnail-image' ); ?></div><?php } ?>
                                            <div class="page-navi-next-info">
                                                <div class="table-cell-middle <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_PostNav', 'brnhmbx-font-1' ); ?> fs16 fw700"><?php echo get_the_title( $next_post->ID ); ?></div>
                                                <?php if ( $brnhmbx_bourz_opt_PageNaviBullet == 'arrow' ) { ?><div class="table-cell-middle page-navi-next-arrow"><i class="fa fa-angle-right"></i></div><?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                         <?php } ?>

                    </div>

                    <?php

					/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-post' ); } /* */

					$brnhmbx_bourz_orig_post = $post;
					global $post;
					$brnhmbx_bourz_tags = wp_get_post_tags( $post->ID );
					$brnhmbx_bourz_cats = wp_get_post_categories( $post->ID );

					if ( $brnhmbx_bourz_opt_RPBase == 'tag' ) { $brnhmbx_bourz_RPBaseTermIDs = $brnhmbx_bourz_tags; } else if ( $brnhmbx_bourz_opt_RPBase == 'category' ) { $brnhmbx_bourz_RPBaseTermIDs = $brnhmbx_bourz_cats; }

					if ( $brnhmbx_bourz_RPBaseTermIDs ) {

						if ( $brnhmbx_bourz_opt_RPBase == 'tag' ) {

							$brnhmbx_bourz_tag_ids = array();
							foreach ( $brnhmbx_bourz_tags as $brnhmbx_bourz_individual_tag ) { $brnhmbx_bourz_tag_ids[] = $brnhmbx_bourz_individual_tag->term_id; }

							$args = array(
								'tag__in' => $brnhmbx_bourz_tag_ids,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => 3, // Number of related posts to display.
								'ignore_sticky_posts' => 1

							);

						} else if ( $brnhmbx_bourz_opt_RPBase == 'category' ) {

							$brnhmbx_bourz_cat_ids = array();
							foreach ( $brnhmbx_bourz_cats as $brnhmbx_bourz_individual_cat ) { $cat = get_category( $brnhmbx_bourz_individual_cat ); $brnhmbx_bourz_cat_ids[] = $cat->term_id; }

							$args = array(
								'category__in' => $brnhmbx_bourz_cat_ids,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => 3, // Number of related posts to display.
								'ignore_sticky_posts' => 1

							);

						}

						$brnhmbx_bourz_my_query = new wp_query( $args );

						if ( $brnhmbx_bourz_sh_RelatedPosts && $brnhmbx_bourz_my_query->have_posts() ) { ?>

							<!-- related-posts-container -->
							<div class="related-posts-container clearfix">
								<!-- related-posts-outer -->
								<div class="clearfix related-posts-outer<?php echo bourz_applyLayout(); ?>">
									<!-- related-posts -->
									<div class="related-posts clearfix">

										<!-- related-posts-row -->
										<div class="related-posts-row<?php echo bourz_applyLayout(); ?>">
											<?php

											while( $brnhmbx_bourz_my_query->have_posts() ) {
												$brnhmbx_bourz_my_query->the_post();

											?>

											<div class="clearfix zig-zag related-post-item<?php echo bourz_applyLayout(); ?>">
                                                <a class="brnhmbx-posts-widget" href="<?php esc_url( the_permalink() ); ?>">

													<?php if ( $brnhmbx_bourz_opt_RPStyle == 'a' ) {

                                                        if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?></div><?php }

                                                    } else if ( $brnhmbx_bourz_opt_RPStyle == 'b' ) {

                                                        if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

                                                    } else if ( $brnhmbx_bourz_opt_RPStyle == 'c' ) {

                                                        if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-3-outer"><?php }

                                                    } else if ( $brnhmbx_bourz_opt_RPStyle == 'd' ) {

														if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

													}

                                                    if ( has_post_thumbnail() && $brnhmbx_bourz_opt_RPStyle == 'c' ) { ?>

                                                    <div class="listing-box-3 clearfix">

                                                    <?php } else if ( has_post_thumbnail() && $brnhmbx_bourz_opt_RPStyle == 'd' ) { ?>

                    								<div class="listing-box-d clearfix">

                                                    <?php } else { ?>

                                                    <div class="listing-box clearfix<?php if ( $brnhmbx_bourz_opt_RPStyle == 'b' ) { echo ' listing-box-b'; } ?>">

                                                    <?php }

                                                    if ( $brnhmbx_bourz_sh_RPDate ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><?php echo get_the_date(); ?></div><?php } ?>
                                                    <div class="listing-title <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_RP', 'brnhmbx-font-2' ); ?> fw700 fst-italic"><?php the_title(); ?></div>

                                                    </div>

                                                    <?php

                                                    if ( $brnhmbx_bourz_opt_RPStyle == 'b' || $brnhmbx_bourz_opt_RPStyle == 'c' || $brnhmbx_bourz_opt_RPStyle == 'd' ) {

                                                        if ( has_post_thumbnail() ) { ?></div></div></div><?php }

                                                    } ?>

                                                </a>
											</div>

											<?php }

											$post = $brnhmbx_bourz_orig_post;
											wp_reset_postdata();

											?>
										</div><!-- /related-posts-row -->

									</div><!-- /related-posts -->
								</div><!-- /related-posts-outer -->
							</div><!-- /related-posts-container -->

						<?php }

					}

				if ( $brnhmbx_bourz_sh_PostComments ) { comments_template(); }

				/* Leaderboard Banner */ if ( function_exists( 'bourz_detectLeaderboard' ) ) { bourz_detectLeaderboard ( 'below-post-comments' ); } /* */

				?>

            </div><!-- /site-content -->
		</div><!-- /main-container -->

    </div><!-- /article-wrapper-outer -->

    <!-- sidebar -->
    <?php

        if ( ( get_post_format() == '' || get_post_format() == 'aside' || get_post_format() == 'link' ) && $brnhmbx_bourz_sh_SidebarPost_Standard ) {

            if ( get_theme_mod( 'brnhmbx_bourz_ExtraSidebar_Post' ) ) {

                echo '<div class="sidebar clearfix">';
                    dynamic_sidebar( 'brnhmbx_bourz_sidebar_post' );
                echo '</div>';

            } else {

                get_sidebar();

            }

        } else if ( get_post_format() == 'gallery' && $brnhmbx_bourz_sh_SidebarPost_Gallery ) {

            if ( get_theme_mod( 'brnhmbx_bourz_ExtraSidebar_Post' ) ) {

                echo '<div class="sidebar clearfix">';
                    dynamic_sidebar( 'brnhmbx_bourz_sidebar_post' );
                echo '</div>';

            } else {

                get_sidebar();

            }

        } else if ( get_post_format() == 'video' && $brnhmbx_bourz_sh_SidebarPost_Video ) {

            if ( get_theme_mod( 'brnhmbx_bourz_ExtraSidebar_Post' ) ) {

                echo '<div class="sidebar clearfix">';
                    dynamic_sidebar( 'brnhmbx_bourz_sidebar_post' );
                echo '</div>';

            } else {

                get_sidebar();

            }

        }

    ?>
    <!-- /sidebar -->

</div><!-- /site-mid -->

<?php get_footer(); ?>
