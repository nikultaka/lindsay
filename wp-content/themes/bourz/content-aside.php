<?php

$brnhmbx_bourz_minHeight_styleA = get_theme_mod( 'brnhmbx_bourz_minHeight_styleA', 0 );
$brnhmbx_bourz_minHeight_styleB = get_theme_mod( 'brnhmbx_bourz_minHeight_styleB', 0 );

?>

<div<?php if ( !is_single() ) { echo ' class="clearfix ' . bourz_applyColumns() . '"'; } ?>>

    <div <?php post_class(); ?>>

        <article class="post post-aside zig-zag clearfix">

            <div class="article-outer<?php echo bourz_applyLayout(); ?>">
				<div class="article-inner" <?php if ( !is_single() ) { if ( bourz_checkStyle_B() ) { if ( $brnhmbx_bourz_minHeight_styleB ) { echo 'style="min-height: ' . esc_attr( $brnhmbx_bourz_minHeight_styleB ) . 'px;"'; } } else if ( bourz_checkStyle_Z() ) { echo 'style="height: 80px;"'; } else { if ( $brnhmbx_bourz_minHeight_styleA ) { echo 'style="min-height: ' . esc_attr( $brnhmbx_bourz_minHeight_styleA ) . 'px;"'; } } } ?>>
                    <div class="article-container clearfix">

                        <?php if ( is_single() ) { ?>

                        	<?php get_template_part( 'single-start' ); ?>
                            <div class="p40">
                            <?php get_template_part( 'single-end' ); ?>
                        	</div>

                        <?php } else {

							get_template_part( 'excerpt-start' );

								if ( !bourz_checkStyle_B() ) {

                                    echo '<div class="home-excerpt brnhmbx-font-3 fs14">';
                                    the_content();
                                    echo '</div>';

                                    get_template_part( 'excerpt-end' );

                                } ?>

                            </div><!-- /home-excerpt-outer -->

                        <?php } ?>

                    </div>
                </div>
            </div>

        </article>

	</div>

</div>
