<?php

/* Translation */
$brnhmbx_bourz_tra_Sticky = get_theme_mod( 'brnhmbx_bourz_tra_Sticky', 'STICKY' );
/* */

/* Checkbox Default Values */
$brnhmbx_bourz_sh_Date_Home = get_theme_mod( 'brnhmbx_bourz_sh_Date_Home', 1 );
$brnhmbx_bourz_sh_btnComments_Home = get_theme_mod( 'brnhmbx_bourz_sh_btnComments_Home', 1 );
/* */

?>

<!-- home-excerpt-outer -->
<div class="home-excerpt-outer">

    <?php if ( $brnhmbx_bourz_sh_Date_Home || ( $brnhmbx_bourz_sh_btnComments_Home && comments_open() ) ) { ?>
    <?php if ( $brnhmbx_bourz_sh_Date_Home ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_date(); ?></a></div><?php } ?>
    <?php if ( $brnhmbx_bourz_sh_btnComments_Home && comments_open() ) { ?><div class="brnhmbx-font-4 fw700 listing-comment<?php if ( !$brnhmbx_bourz_sh_Date_Home ) { echo '-w-o-date'; } ?> clearfix"><a href="<?php esc_url( the_permalink() ); ?>#comments"><div class="listing-comment-icon"><i class="fa fa-comment"></i></div><div class="listing-comment-number"><?php comments_number( '0 ', '1 ', '% ' ); ?></div></a></div><?php } ?>
    <?php } ?>
    <?php if ( is_sticky() && is_home() && !is_paged() ) { echo '<span class="sticky-icon fs11 brnhmbx-font-1">' . esc_attr( $brnhmbx_bourz_tra_Sticky ) . '</span>'; } ?>
    <?php if ( get_post_format() != 'aside' ) { ?><div class="listing-title <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_HLT', 'brnhmbx-font-2' ); ?> fw700 fst-italic"><h1 class="home-listing-title-inner"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1></div><?php } ?>
