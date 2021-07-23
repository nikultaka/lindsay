<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="clearfix search-widget zig-zag brnhmbx-wc-product-search-widget">
    <div class="clearfix search-widget-inner">
        <div class="search-widget-input-box">
            <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                <input class="brnhmbx-font-1 search-widget-input" type="text" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'bourz' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'bourz' ); ?>" />
                <input type="hidden" name="post_type" value="product" />
            </form>
        </div>
        <div class="fs16 search-widget-s-pro-icon">
            <div class="table-cell-middle pr15"><i class="fa fa-search"></i></div>
        </div>
    </div>
</div>
