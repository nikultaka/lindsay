<?php

$instagramShortcode = get_theme_mod( 'brnhmbx_bourz_InstagramShortcode', '' );

?>

    <div class="footer-box-outer" id="footer-box-outer">
        <footer class="clearfix">

			<?php if ( is_active_sidebar( 'brnhmbx_bourz_footer_widgets' ) ) {

                ob_start( 'bourz_compress' ); ?>

                <div class="footer-box-inner clearfix">
                    <div class="footer-widget-area">
                        <div class="footer-widget-area-inner<?php if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { echo '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { echo '-col4'; } ?> clearfix"><?php dynamic_sidebar( 'brnhmbx_bourz_footer_widgets' ); ?></div>
                    </div>
                </div>

            <?php ob_end_flush(); } ?>

            <?php /* Instagram Slider Widget */
			if ( $instagramShortcode ) {

				echo '<div class="instagram-label brnhmbx-font-1 fw700 fs14">' . esc_attr( get_theme_mod( 'brnhmbx_bourz_InstagramText', 'FOLLOW @ INSTAGRAM' ) ) . '</div>';
				echo do_shortcode( $instagramShortcode );

			}
			/* */ ?>

            <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_bottomLine', 1 ) ) { ?>
            <div class="footer-bottom-outer">
                <div class="footer-bottom clearfix">
                    <div class="footer-text brnhmbx-font-2 fst-italic fs12"><?php echo esc_attr( get_theme_mod( 'brnhmbx_bourz_text_Footer', '2019 Bourz. All rights reserved.' ) ); ?></div><?php echo bourz_placeSocialIcons( 'footer-social' ); ?><div class="footer-menu-outer fs12 clearfix">

                        <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_FooterMenu', 1 ) ) {

                            $args_footer = array(
                                'theme_location' => 'footer_menu',
                                'container_class' => 'footer-nav',
                                'menu_id'         => 'footer-menu',
                                'depth'		   => '-1',
								'echo' => false,
                                'fallback_cb' => 'bourz_assign_FooterMenu'
                            );

							$nav = wp_nav_menu( $args_footer );
							echo str_replace( '</a></li>', '</a></li><li class="nav-sep">/</li>', $nav );

                        } else {

                            echo '<a href="javascript:void(0);" class="brnhmbx-font-1 btn-to-top"><i class="fa fa-chevron-up"></i>' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_BackToTop', 'BACK TO TOP' ) ) . '</a>';

                        } ?>

                    </div>
                </div>
            </div>
            <?php } ?>
        </footer>
    </div>

</div><!-- /body-outer -->

<?php wp_footer(); ?>

<script>
    /*jQuery(document).ready(function () {  
        setTimeout(function() { 
            jQuery("#load_flatpickr").flatpickr({
                maxDate: '2017-05-04' //new Date().getFullYear() - 18
            });    
        }, 3000);    
    });*/ 
</script>

</body>
</html>
