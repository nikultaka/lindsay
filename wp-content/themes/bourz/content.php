<?php

/* Checkbox Default Values */
$brnhmbx_bourz_sh_FeaImg_Single_Standard = get_theme_mod( 'brnhmbx_bourz_sh_FeaImg_Single_Standard', 1 );
$brnhmbx_bourz_ignoreExcerpt_Standard = get_theme_mod( 'brnhmbx_bourz_ignoreExcerpt_Standard', 0 );
$brnhmbx_bourz_ignoreExcerpt_Standard_Archive = get_theme_mod( 'brnhmbx_bourz_ignoreExcerpt_Standard_Archive', 0 );
/* */

/* Radio Default Values */
$brnhmbx_bourz_opt_FeaImg_Standard = get_theme_mod( 'brnhmbx_bourz_opt_FeaImg_Standard', 'fea' );
$brnhmbx_bourz_opt_HomeImg_Standard = get_theme_mod( 'brnhmbx_bourz_opt_HomeImg_Standard', 'home' );
/* */

$brnhmbx_bourz_minHeight_styleA = get_theme_mod( 'brnhmbx_bourz_minHeight_styleA', 0 );
$brnhmbx_bourz_minHeight_styleB = get_theme_mod( 'brnhmbx_bourz_minHeight_styleB', 0 );

?>

<div<?php if ( !is_single() ) { echo ' class="clearfix ' . bourz_applyColumns() . '"'; } ?>>

    <div <?php post_class(); ?>>

        <article class="post zig-zag clearfix">

            <div class="article-outer<?php echo bourz_applyLayout(); ?>">
				<div class="article-inner" <?php if ( !is_single() ) { if ( bourz_checkStyle_B() ) { if ( $brnhmbx_bourz_minHeight_styleB ) { echo 'style="min-height: ' . esc_attr( $brnhmbx_bourz_minHeight_styleB ) . 'px;"'; } } else if ( bourz_checkStyle_Z() ) { echo 'style="height: 80px;"'; } else { if ( $brnhmbx_bourz_minHeight_styleA ) { echo 'style="min-height: ' . esc_attr( $brnhmbx_bourz_minHeight_styleA ) . 'px;"'; } } } ?>>
                    <div class="article-container clearfix">

                    	<?php if ( bourz_checkStyle_Z() ) { ?>

                            <div class="post-styleZ">
                                <a href="<?php esc_url( the_permalink() ); ?>">
                                    <div class="post-styleZ-inner clearfix">
                                        <?php if ( has_post_thumbnail() && $brnhmbx_bourz_opt_FeaImg_Standard == 'fea' ) { ?><div class="post-styleZ-img"><?php echo the_post_thumbnail( 'brnhmbx-bourz-small-thumbnail-image' ); ?></div><?php } ?>
                                        <div class="post-styleZ-info <?php if ( has_post_thumbnail() && $brnhmbx_bourz_opt_FeaImg_Standard == 'fea' ) { echo 'post-styleZ-info-with-t'; } ?>">
                                            <div class="table-cell-middle"><div class="listing-title <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_HLT', 'brnhmbx-font-2' ); ?> fw700 fst-italic"><div class="home-listing-title-z-inner"><?php the_title(); ?></div></div></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php } else { ?>

							<?php if ( has_post_thumbnail() && $brnhmbx_bourz_opt_FeaImg_Standard == 'fea' ) { if ( !is_single() ) { ?><div class="fea-img-container"><a href="<?php esc_url( the_permalink() ); ?>"><?php } if ( !is_single() && $brnhmbx_bourz_opt_HomeImg_Standard == 'home' ) { the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); } else { if ( is_single() ) { if ( $brnhmbx_bourz_sh_FeaImg_Single_Standard ) { echo '<div class="fea-img-container">'; the_post_thumbnail(); echo '</div>'; } } else { the_post_thumbnail(); } } if ( !is_single() ) { ?></a></div><?php } } ?>

                            <?php if ( is_single() ) { ?>

                            	<?php get_template_part( 'single-start' ); ?>
								<div class="brnhmbx-font-3 fs16"><?php the_content(); ?></div>
                                <?php get_template_part( 'single-end' ); ?>

                            <?php } else {

                                get_template_part( 'excerpt-start' );

                                    if ( !bourz_checkStyle_B() ) {

										if ( ( is_home() && $brnhmbx_bourz_ignoreExcerpt_Standard ) || ( !is_home() && $brnhmbx_bourz_ignoreExcerpt_Standard_Archive ) ) {

											echo '<div class="home-excerpt brnhmbx-font-3 fs14">';
											the_content();
											echo '</div>';

										} else {

                                        	echo bourz_appendMoreButton();

										}

                                        get_template_part( 'excerpt-end' );

                                    } ?>

                                </div><!-- /home-excerpt-outer -->

                            <?php } ?>

                        <?php } ?>

                    </div>
                </div>
            </div>

        </article>

	</div>

</div>
