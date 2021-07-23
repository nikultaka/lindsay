<?php

/* Translation */
$brnhmbx_bourz_tra_By = get_theme_mod( 'brnhmbx_bourz_tra_By', 'By' );
$brnhmbx_bourz_tra_Views = get_theme_mod( 'brnhmbx_bourz_tra_Views', 'Views' );
/* */

/* Checkbox Default Values */
$brnhmbx_bourz_sh_Author = get_theme_mod( 'brnhmbx_bourz_sh_Author', 1 );
$brnhmbx_bourz_sh_Date = get_theme_mod( 'brnhmbx_bourz_sh_Date', 1 );
$brnhmbx_bourz_sh_btnComments = get_theme_mod( 'brnhmbx_bourz_sh_btnComments', 1 );
$brnhmbx_bourz_sh_Hits = get_theme_mod( 'brnhmbx_bourz_sh_Hits', 1 );
$brnhmbx_bourz_sh_Excerpt = get_theme_mod( 'brnhmbx_bourz_sh_Excerpt', 1 );
$brnhmbx_bourz_sh_SocialBar_Facebook = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Facebook', 1 );
$brnhmbx_bourz_sh_SocialBar_Twitter = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Twitter', 1 );
$brnhmbx_bourz_sh_SocialBar_Google = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Google', 1 );
$brnhmbx_bourz_sh_SocialBar = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar', 1 );
if ( !$brnhmbx_bourz_sh_SocialBar_Facebook && !$brnhmbx_bourz_sh_SocialBar_Twitter && !$brnhmbx_bourz_sh_SocialBar_Google ) {
	$brnhmbx_bourz_sh_SocialBar = 0;
}
/* */

$header_area = false;
if ( get_the_title() || $brnhmbx_bourz_sh_Excerpt || $brnhmbx_bourz_sh_Author || $brnhmbx_bourz_sh_Date || $brnhmbx_bourz_sh_Hits || $brnhmbx_bourz_sh_SocialBar || ( $brnhmbx_bourz_sh_btnComments && comments_open() ) ) { $header_area = true; }

?>

<?php

if ( $header_area ) { ?>
    <div class="header-area<?php echo bourz_applyLayout(); ?>">
        <?php if ( get_the_title() && get_post_format() != 'aside' ) { ?><h1 class="header-area-title <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_HAT', 'brnhmbx-font-1' ); ?> fw700"><?php the_title(); ?></h1><?php } ?>

        <?php if ( $brnhmbx_bourz_sh_Author || $brnhmbx_bourz_sh_Date || $brnhmbx_bourz_sh_Hits ) { ?>
            <div class="author-bar brnhmbx-font-4 fs12 fw700">
                <?php if ( $brnhmbx_bourz_sh_Author ) { if ( get_avatar( get_the_author_meta( 'ID' ) ) ) { ?><div class="author-bar-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?></div><?php } ?>
                <div class="author-bar-date-views"><?php echo esc_attr( $brnhmbx_bourz_tra_By ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div><?php } ?>
                <?php if ( $brnhmbx_bourz_sh_Date ) { ?><div class="author-bar-date-views header-area-date"><?php echo get_the_date(); ?></div><?php } ?>
                <?php if ( $brnhmbx_bourz_sh_Hits && function_exists( 'bourz_getPostViews' ) ) { ?><div class="author-bar-date-views"><?php echo bourz_getPostViews( get_the_ID() ) . ' ' . esc_html( $brnhmbx_bourz_tra_Views ); ?></div><?php } ?>
            </div>
        <?php } ?>

        <?php if ( $brnhmbx_bourz_sh_Excerpt ) { ?><div class="header-area-excerpt <?php echo get_theme_mod( 'brnhmbx_bourz_swiFont_HAE', 'brnhmbx-font-2' ); ?> fst-italic"><?php if ( get_post_format() == 'aside' || get_post_format() == 'link' ) { the_content(); } else { echo get_the_excerpt(); } ?></div><?php } ?>
        <?php get_template_part( 'social-bar' ); ?>
    </div>
<?php } ?>

<div class="article-content-outer<?php echo bourz_applyLayout(); ?>" style=" <?php if ( $header_area ) { ?>border-top: 2px solid;<?php } ?>">
