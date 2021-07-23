<?php

/*
Plugin Name: Bourz Components
Plugin URI: http://www.burnhambox.com/bourz
Description: Components for Bourz theme.
Version: 1.0.2
Author: Burnhambox
Author URI: http://www.burnhambox.com
License: GNU
*/

/* Share Icons */
if ( !function_exists( 'bourz_shortcode_share' ) ) {
  function bourz_shortcode_share( $atts ) {

    $output = '';

    $a = shortcode_atts( array(
        'ID' => '0',
    ), $atts );

    if ( $a['ID'] == '' ) { $a['ID'] = 0; }

    //

    $brnhmbx_bourz_sh_SocialBar_Facebook = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Facebook', 1 );
    $brnhmbx_bourz_sh_SocialBar_Twitter = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Twitter', 1 );
    $brnhmbx_bourz_sh_SocialBar_Google = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar_Google', 1 );
    $brnhmbx_bourz_sh_SocialBar = get_theme_mod( 'brnhmbx_bourz_sh_SocialBar', 1 );
    if ( !$brnhmbx_bourz_sh_SocialBar_Facebook && !$brnhmbx_bourz_sh_SocialBar_Twitter && !$brnhmbx_bourz_sh_SocialBar_Google ) {
    	$brnhmbx_bourz_sh_SocialBar = 0;
    }
    $brnhmbx_bourz_sh_btnComments = get_theme_mod( 'brnhmbx_bourz_sh_btnComments', 1 );

    if ( $brnhmbx_bourz_sh_SocialBar || ( $brnhmbx_bourz_sh_btnComments && comments_open() ) ) { $output .= '<div class="clearfix">'; }

    if ( $brnhmbx_bourz_sh_SocialBar ) {

        $output .= '<div class="share-bar brnhmbx-font-1 fw700 fs14">';
        $output .= '<span>' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_Share', 'SHARE') ) . '</span>';
        if ( $brnhmbx_bourz_sh_SocialBar_Facebook ) { $output .= '<div class="share-icon-outer si-facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url( get_permalink( $a['ID'] ) ) . '" target="_blank"><div class="si-long">Facebook</div><div class="si-short">F</div></a></div>'; }
        if ( $brnhmbx_bourz_sh_SocialBar_Twitter ) { $output .= '<div class="share-icon-outer si-twitter"><a href="https://twitter.com/share?url=' . esc_url( get_permalink( $a['ID'] ) ) . '" target="_blank"><div class="si-long">Twitter</div><div class="si-short">T</div></a></div>'; }
        if ( $brnhmbx_bourz_sh_SocialBar_Google ) { $output .= '<div class="share-icon-outer si-google"><a href="https://plus.google.com/share?url=' . esc_url( get_permalink( $a['ID'] ) ) . '" target="_blank"><div class="si-long">Google</div><div class="si-short">G</div></a></div>'; }
        $output .= '</div>';

    }

    if ( $brnhmbx_bourz_sh_btnComments && comments_open() ) {
      $output .= '<div class="brnhmbx-font-1 fw700 listing-comment';
      if ( !$brnhmbx_bourz_sh_SocialBar ) { $output .= '-w-o-date'; }
      $output .= ' clearfix"><a href="' . esc_url( get_permalink( $a['ID'] ) ) . '#comments"><div class="listing-comment-icon"><i class="fa fa-comment"></i></div><div class="listing-comment-number fs14">' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_Comments', 'COMMENTS') ) . '</div></a></div>';
    }

    if ( $brnhmbx_bourz_sh_SocialBar || ( $brnhmbx_bourz_sh_btnComments && comments_open() ) ) { $output .= '</div>'; }

    return $output;

  }
}
add_shortcode( 'bourz_share', 'bourz_shortcode_share' );
/* */

/* brnhmbx_bourz_customAdWidget Class */
class brnhmbx_bourz_customAdWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customAdWidget',
			'Bourz Widget: Ads',
			array( 'description' => "A widget for your Ads. Just place your code and you're done." )

		);
	}

	public function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, array( 'text' => '' ) );
		$text = esc_textarea( $instance['text'] );

		?>

		<p><textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>"><?php echo wp_kses_post( $text ); ?></textarea></p>

		<?php

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( current_user_can( 'unfiltered_html' ) ) {

			$instance['text'] =  $new_instance['text'];

		} else {

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) ); // wp_filter_post_kses() expects slashed

		}

		$instance['filter'] = ! empty( $new_instance['filter'] );

		return $instance;

	}

	public function widget( $args, $instance ) {

		extract( $args );

		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

		if ( $id == 'brnhmbx_bourz_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { $fw_col_number = '-col4'; }
			echo '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_home_widgets' ) {

			$hw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { $hw_col_number = '-col2'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) { $hw_col_number = '-col2-sidebar'; }
			echo '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_upper_widgets' ) {

			$uw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { $uw_col_number = '-col2'; }
			echo '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_header_widgets' ) {

			$hew_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { $hew_col_number = '-col2'; }
			echo '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '">';

		} else {

			echo '<div id="' . esc_attr( $this->id ) . '">';

		}

		?>

        <div class="textwidget adwidget zig-zag clearfix"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>

		<?php

		echo '</div>';

	}

}

/* brnhmbx_bourz_customCatPostsWidget Class */
class brnhmbx_bourz_customCatPostsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customCatPostsWidget',
			'Bourz Widget: Category/Tag Posts',
			array( 'description' => "Display the posts belong to a specific category or tag." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'CATEGORY/TAG POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'category' => 'uncategorized', 'tag' => '', 'show_cats' => 'on', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.cpw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e9e9e9',
					change: _.throttle( function() { $('.cpw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.cpw-t-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.cpw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.cpw-d-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.cpw-d-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.cpw-bo-color-picker').wpColorPicker( {

		            defaultColor: '#FFF',
					change: _.throttle( function() { $('.cpw-bo-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

        <p>Write a Category Slug:<br />
        <p><input id="get-dropdown-val-cat" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['category'] ); ?>" /></p>
        <p><strong>OR</strong></p><p>Write a Tag Slug:<br />
        <p><input id="get-dropdown-val-tag" name="<?php echo esc_attr( $this->get_field_name( 'tag' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tag'] ); ?>" /></p>
        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['show_cats'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cats' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_cats' ) ); ?>">Show Categories</label>
		</p>
		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p>Number of posts to show: <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is bigger than the number of posts to show, your settings will be ignored and all the posts will be shown in Style A.</em>

        <p>Post count for "Style A": <input name="<?php echo esc_attr( $this->get_field_name( 'styleA_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleA_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style B": <input name="<?php echo esc_attr( $this->get_field_name( 'styleB_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleB_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style C": <input name="<?php echo esc_attr( $this->get_field_name( 'styleC_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleC_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style D": <input name="<?php echo esc_attr( $this->get_field_name( 'styleD_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleD_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style Z": <input name="<?php echo esc_attr( $this->get_field_name( 'styleZ_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleZ_count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is smaller than the number of posts to show, Style A will take effect to complete the count.</em>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['date'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>">Display post date?</label>
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Header Color:</label>
		<br />
		<input class="cpw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>">Date Color:</label>
		<br />
		<input class="cpw-d-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_color' ) ); ?>" value="<?php echo esc_attr( $instance['date_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Box Color:</label>
		<br />
		<input class="cpw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>Box Opacity:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>">Border/Header/Date Color for Style C and D:</label>
		<br />
		<input class="cpw-bo-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" value="<?php echo esc_attr( $instance['border_color'] ); ?>" />
        </p>

        <p>Lens Opacity for Style C and D:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range_C_D' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range_C_D'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'CATEGORY/TAG POSTS';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '5';
		$instance['styleA_count'] = $new_instance['styleA_count'];
		$instance['styleB_count'] = $new_instance['styleB_count'];
		$instance['styleC_count'] = $new_instance['styleC_count'];
		$instance['styleD_count'] = $new_instance['styleD_count'];
		$instance['styleZ_count'] = $new_instance['styleZ_count'];
		$instance['date'] = $new_instance['date'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['background_color'] = $new_instance['background_color'];
		$instance['date_color'] = $new_instance['date_color'];
		$instance['border_color'] = $new_instance['border_color'];
		$instance['range'] = $new_instance['range'];
		$instance['range_C_D'] = $new_instance['range_C_D'];
		$instance['category'] = $new_instance['category'];
		$instance['tag'] = $new_instance['tag'];
		$instance['show_cats'] = $new_instance['show_cats'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'CATEGORY/TAG POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'category' => 'uncategorized', 'tag' => '', 'show_cats' => 'on', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$count = $instance['count'];
		$styleA_count = $instance['styleA_count'];
		$styleB_count = $instance['styleB_count'];
		$styleC_count = $instance['styleC_count'];
		$styleD_count = $instance['styleD_count'];
		$styleZ_count = $instance['styleZ_count'];
		$date = $instance['date'] ? 'true' : 'false';
		$text_color = $instance['text_color'];
		$background_color = $instance['background_color'];
		$date_color = $instance['date_color'];
		$border_color = $instance['border_color'];
		$range = $instance['range'];
		$range_C_D = $instance['range_C_D'];
		$category = $instance['category'];
		$tag = $instance['tag'];
		$show_cats = $instance['show_cats'] ? 'true' : 'false';

		/* Combine Widget Listing Settings */

		$w_listing_style = 'a';
		$w_listingOrder = 0;

		if ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count > $count ) {

			$styleA_count = $count;
			$styleB_count = 0;
			$styleC_count = 0;
			$styleD_count = 0;
			$styleZ_count = 0;

		}

		/* */

		$cpw_rand = rand( 1, 9999999 ); ?>

        <style type="text/css" scoped>

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .listing-box,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .widget-listing-z,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':visited' ); ?> .listing-box,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':visited' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $background_color ) ) . ',' . esc_attr( $range ) / 100; ?>); color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .listing-box-d,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':visited' ); ?> .listing-box-d { background: transparent; border: 2px solid; border-color: <?php echo esc_attr( $border_color ); ?>; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .listing-date-z,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':visited' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':visited' ); ?> .listing-date-z { color: <?php echo esc_attr( $date_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .listing-box-3,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':visited' ); ?> .listing-box-3 { background: transparent; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand ); ?> .listing-img-3-outer img { opacity: <?php echo esc_attr( $range_C_D ) / 100; ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':hover' ); ?> .listing-box,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':hover' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $text_color ) ) . ', 1'; ?>); color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':hover' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':hover' ); ?> .listing-date-z { color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.cpw-' . $cpw_rand . ':hover' ); ?> .listing-img-3-outer img { opacity: 0.3; }

		</style>

        <?php

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			} else {

				echo '<div class="pb11"></div>';

			}

			/* function */

			if ( $show_cats == 'true' ) {

				$loop_args = array(

					'showposts' => esc_attr( $count ),
					'category_name' => $category,
					'ignore_sticky_posts' => 1

				);

			} else {

				$loop_args = array(

					'showposts' => esc_attr( $count ),
					'tag' => $tag,
					'ignore_sticky_posts' => 1

				);

			}

			$rPosts = new WP_Query( $loop_args );

			while ( $rPosts->have_posts() ) : $rPosts->the_post();

			//Combine Widget Listing Settings Styles

			$w_listingOrder ++;

			if ( $styleA_count > 0 && ( $w_listingOrder > $count - ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'a';

			}

			if ( $styleB_count > 0 && ( $w_listingOrder > $count - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'b';

			}

			if ( $styleC_count > 0 && ( $w_listingOrder > $count - ( $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'c';

			}

			if ( $styleD_count > 0 && ( $w_listingOrder > $count - ( $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - $styleZ_count ) ) {

				$w_listing_style = 'd';

			}

			if ( $styleZ_count > 0 && ( $w_listingOrder > $count - $styleZ_count && $w_listingOrder <= $count ) ) {

				$w_listing_style = 'z';

			} ?>

            <a class="brnhmbx-posts-widget <?php echo esc_attr( 'cpw-' . $cpw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
                <div class="mb20">

                    <?php if ( $w_listing_style == 'a' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?></div><?php }

					} else if ( $w_listing_style == 'b' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					} else if ( $w_listing_style == 'c' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-3-outer"><?php }

					} else if ( $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					}

					if ( has_post_thumbnail() && $w_listing_style == 'c' ) { ?>

                    <div class="listing-box-3 clearfix">

                    <?php } else if ( has_post_thumbnail() && $w_listing_style == 'd' ) { ?>

                    <div class="listing-box-d clearfix">

                    <?php } else if ( $w_listing_style == 'z' ) { ?>

					<div class="widget-listing-z clearfix">
						<?php if ( has_post_thumbnail() ) { ?><?php echo the_post_thumbnail( 'brnhmbx-bourz-small-thumbnail-image' ); ?><?php } ?>
                        <div class="widget-listing-z-info <?php if ( has_post_thumbnail() ) { echo 'widget-listing-z-info-with-t'; } ?>">
                        	<div class="table-cell-middle"><?php if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date-z"><?php echo get_the_date(); ?></div><?php } ?><span class="brnhmbx-font-2 fw700 fst-italic widget-listing-z-title"><?php the_title(); ?></span></div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="listing-box clearfix<?php if ( $w_listing_style == 'b' ) { echo ' listing-box-b'; } ?>">

                    <?php } ?>

					<?php if ( $w_listing_style != 'z' ) {

						if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><?php echo get_the_date(); ?></div><?php } ?>
                        <div class="listing-title brnhmbx-font-2 fw700 fst-italic"><?php the_title(); ?></div>

                    </div>

                    <?php }

					if ( $w_listing_style == 'b' || $w_listing_style == 'c' || $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?></div></div></div><?php }

					} ?>

                </div>
            </a>

			<?php endwhile;

			wp_reset_postdata();

			/* */

		}

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

/* brnhmbx_bourz_customCatsWidget Class */
class brnhmbx_bourz_customCatsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customCatsWidget',
			'Bourz Widget: Tags/Categories',
			array( 'description' => "A well styled list of your tags or categories." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'TAGS', 'opt_hdr' => '', 'tag_count' => '0', 'cat_count' => '0', 'show_tags' => 'on' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <p><em>Uncheck "Show Tags" below to show categories.</em></p>
        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['show_tags'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_tags' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_tags' ) ); ?>">Show Tags</label>
		</p>
		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p>Number of Tags to show: <input name="<?php echo esc_attr( $this->get_field_name( 'tag_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tag_count'] ); ?>" style="width: 50px;" /></p>
        <p><em>Write "0" to display all tags/categories.</em></p>
        <p>Number of Categories to show: <input name="<?php echo esc_attr( $this->get_field_name( 'cat_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['cat_count'] ); ?>" style="width: 50px;" /></p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'TAGS';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['tag_count'] = $new_instance['tag_count'];
		$instance['cat_count'] = $new_instance['cat_count'];
		$instance['show_tags'] = $new_instance['show_tags'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'TAGS', 'opt_hdr' => '', 'tag_count' => '0', 'cat_count' => '0', 'show_tags' => 'on' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$tag_count = $instance['tag_count'];
		$cat_count = $instance['cat_count'];
		$show_tags = $instance['show_tags'] ? 'true' : 'false';

		$taxonomy = '';
		$count = 0;

		if ( $show_tags == 'true' ) {

			$taxonomy = 'post_tag';
			$count = esc_attr( $tag_count );

		} else {

			$taxonomy = 'category';
			$count = esc_attr( $cat_count );

		}

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			}

			/* function */

			$tag_args = array(

				'smallest'                  => 14,
				'largest'                   => 14,
				'unit'                      => 'px',
				'number'                    => $count,
				'format'                    => 'list',
				'taxonomy'                  => $taxonomy,

			);

			echo '<div class="brnhmbx-font-1 fw700 clearfix">';
			wp_tag_cloud( $tag_args );
			echo '</div>';

			/* */

		}

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

/* brnhmbx_bourz_customEmptySpaceWidget Class */
class brnhmbx_bourz_customEmptySpaceWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customEmptySpaceWidget',
			'Bourz Widget: Empty Space',
			array( 'description' => "Just place an empty space between your widgets if you wish. It's very handy!" )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'count' => 20 );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <p>Height: <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '20';

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		if ( $id == 'brnhmbx_bourz_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { $fw_col_number = '-col4'; }
			echo '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_home_widgets' ) {

			$hw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { $hw_col_number = '-col2'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) { $hw_col_number = '-col2-sidebar'; }
			echo '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_upper_widgets' ) {

			$uw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { $uw_col_number = '-col2'; }
			echo '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_header_widgets' ) {

			$hew_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { $hew_col_number = '-col2'; }
			echo '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '">';

		} else {

			echo '<div id="' . esc_attr( $this->id ) . '">';

		}

		$defaults = array( 'count' => 20 );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$count = apply_filters( 'widget_title', $instance['count'] );

		if ( !empty( $count ) ) {

			/* function */

			?>

			<div style="height: <?php echo esc_attr( $count ); ?>px;"></div>

            <?php

			/* */

		}

		echo '</div>';

	}

}

/* brnhmbx_bourz_customFacebookFindUsWidget Class */
class brnhmbx_bourz_customFacebookFindUsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customFacebookFindUsWidget',
			'Bourz Widget: Find us on Facebook',
			array( 'description' => "Show your Facebook page's lovers." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'page' => 'burnhambox', 'height' => '400', 'faces' => 'on', 'posts' => 'on' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

		<p>Facebook page username: <input name="<?php echo esc_attr( $this->get_field_name( 'page' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['page'] ); ?>" style="width: 100%;" /></p>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">Height <em>(min. 70)</em> :</label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" size="3" value="<?php echo esc_attr( $instance['height'] ); ?>" style="width: 50px;" />
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['faces'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'faces' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'faces' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'faces' ) ); ?>">Show Friend's Faces <em>("Height" value must be at least 215.)</em></label>
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['posts'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>">Show Page Posts <em>("Height" value must be at least 300.)</em></label>
		</p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['page'] = ( !empty( $new_instance['page'] ) ) ? strip_tags( $new_instance['page'] ) : 'burnhambox';
		$instance['height'] = ( !empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '400';
		$instance['faces'] = $new_instance['faces'];
		$instance['posts'] = $new_instance['posts'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		global $id;

		extract( $args );

		if ( $id == 'brnhmbx_bourz_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { $fw_col_number = '-col4'; }
			echo '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_home_widgets' ) {

			$hw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { $hw_col_number = '-col2'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) { $hw_col_number = '-col2-sidebar'; }
			echo '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_upper_widgets' ) {

			$uw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { $uw_col_number = '-col2'; }
			echo '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_header_widgets' ) {

			$hew_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { $hew_col_number = '-col2'; }
			echo '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '">';

		} else {

			echo '<div id="' . esc_attr( $this->id ) . '">';

		}

		$defaults = array( 'page' => 'burnhambox', 'height' => '400', 'faces' => 'on', 'posts' => 'on' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$page = apply_filters( 'widget_title', $instance['page'] );
		$height = $instance['height'];
		$faces = $instance['faces'] ? 'true' : 'false';
		$posts = $instance['posts'] ? 'true' : 'false';

		if ( !empty( $page ) ) {

			/* function */

			?>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
			  <?php
			  $facebook_sdk_language = '';
			  if ( get_theme_mod( 'brnhmbx_bourz_tra_Lang' ) ) { $facebook_sdk_language = esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_Lang' ) ); } else { $facebook_sdk_language = get_bloginfo( 'language' ); }
			  ?>
			  js.src = "//connect.facebook.net/" + "<?php echo str_replace( '-', '_', $facebook_sdk_language ); ?>" + "/sdk.js#xfbml=1&version=v2.4";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-page" data-href="https://www.facebook.com/<?php echo esc_attr( $page ); ?>" data-width="300" data-height="<?php echo esc_attr( $height ); ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="<?php if ( $faces == 'true' ) { echo 'true'; } else { echo 'false'; } ?>" data-show-posts="<?php if ( $posts == 'true' ) { echo 'true'; } else { echo 'false'; } ?>"><div class="fb-xfbml-parse-ignore"></div></div>

            <?php

			/* */

		}

		echo '</div>';

	}

}

/* brnhmbx_bourz_customImageWidget Class */
class brnhmbx_bourz_customImageWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customImageWidget',
			'Bourz Widget: Image',
			array( 'description' => "Go ahead and place a nice image with a title and text. You can link it to anywhere too." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'SIT AMET VULTATUP', 'text' => 'Discover Now!', 'path' => '', 'link' => '', 'target' => 'off', 'text_color' => '#FFF', 'box_color' => '#4f4047', 'iwioi_color' => '#000', 'height' => '110', 'range' => '100' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

				$('.iwt-color-picker').wpColorPicker( {

		            defaultColor: '#FFF',
					change: _.throttle( function() { $('.iwt-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.iwbox-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.iwbox-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.iwioi-color-picker').wpColorPicker( {

		            defaultColor: '#000',
					change: _.throttle( function() { $('.iwioi-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

        <p>Image Path: <input name="<?php echo esc_attr( $this->get_field_name( 'path' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['path'] ); ?>" style="width: 100%;" /></p>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'iwioi_color' ) ); ?>">Use Color Instead of Image:<br /><em>Only used if "Image Path" is blank.</em></label><br />
		<input class="iwioi-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'iwioi_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'iwioi_color' ) ); ?>" value="<?php echo esc_attr( $instance['iwioi_color'] ); ?>" />
        </p>
        <p>Height (<em>Only used if "Image Path" is blank</em>) :
		<input id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" size="3" value="<?php echo esc_attr( $instance['height'] ); ?>" style="width: 50px;" />
		</p>
        <p>Link: <input name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['link'] ); ?>" style="width: 100%;" /></p>
        <p>
		<input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['target'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">Open in new window</label>
		</p>
		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Text: <textarea name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" rows="3" style="width: 100%; resize: none;"><?php echo esc_attr( $instance['text'] ); ?></textarea></p>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Title/Text Color:</label><br />
		<input class="iwt-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'box_color' ) ); ?>">Box Color:</label><br />
		<input class="iwbox-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'box_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'box_color' ) ); ?>" value="<?php echo esc_attr( $instance['box_color'] ); ?>" />
        </p>
        <p>Box Opacity:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

	    $instance['name'] = $new_instance['name'];
		$instance['text'] = $new_instance['text'];
		$instance['path'] = $new_instance['path'];
		$instance['link'] = $new_instance['link'];
		$instance['target'] = $new_instance['target'];
		$instance['box_color'] = $new_instance['box_color'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['iwioi_color'] = $new_instance['iwioi_color'];
		$instance['height'] = $new_instance['height'];
		$instance['range'] = $new_instance['range'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		if ( $id == 'brnhmbx_bourz_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { $fw_col_number = '-col4'; }
			echo '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_home_widgets' ) {

			$hw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { $hw_col_number = '-col2'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) { $hw_col_number = '-col2-sidebar'; }
			echo '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_upper_widgets' ) {

			$uw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { $uw_col_number = '-col2'; }
			echo '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_header_widgets' ) {

			$hew_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { $hew_col_number = '-col2'; }
			echo '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '">';

		} else {

			echo '<div id="' . esc_attr( $this->id ) . '">';

		}

		$defaults = array( 'name' => 'SIT AMET VULTATUP', 'text' => 'Discover Now!', 'path' => '', 'link' => '', 'target' => 'off', 'text_color' => '#FFF', 'box_color' => '#4f4047', 'iwioi_color' => '#000', 'height' => '110', 'range' => '100' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$text = $instance['text'];
		$path = $instance['path'];
		$link = $instance['link'];
		$target = $instance['target'] ? 'true' : 'false';
		$box_color = $instance['box_color'];
		$text_color = $instance['text_color'];
		$iwioi_color = $instance['iwioi_color'];
		$height = $instance['height'];
		$range = $instance['range'];

		/* */

		$iw_rand = rand( 1, 9999999 ); ?>

        <style type="text/css" scoped>

			.image-widget-wrapper div.image-widget-content .image-widget-inner .table-cell-middle <?php echo esc_attr( '.iw-' . $iw_rand ); ?>.image-widget-title,
			.image-widget-wrapper a > div.image-widget-content .image-widget-inner .table-cell-middle <?php echo esc_attr( '.iw-' . $iw_rand ); ?>.image-widget-title,
			.image-widget-wrapper a:visited > div.image-widget-content .image-widget-inner .table-cell-middle <?php echo esc_attr( '.iw-' . $iw_rand ); ?>.image-widget-title { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $box_color ) ) . ',' . esc_attr( $range ) / 100; ?>); color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			.image-widget-wrapper a:hover > div.image-widget-content .image-widget-inner .table-cell-middle <?php echo esc_attr( '.iw-' . $iw_rand ); ?>.image-widget-title { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $text_color ) ) . ', 1'; ?>); color: <?php echo esc_attr( $box_color ); ?>; }

		</style>

        <?php

		/* function */

		?>

        <div class="image-widget-wrapper zig-zag clearfix"><?php if ( $link ) { echo '<a href="' . esc_attr( $link ) . '" target="'; if ( $target == 'true' ) { echo '_blank'; } else { echo '_self'; } echo '">'; } ?>

        <?php if ( $path ) { ?><img alt="img-alt" src="<?php echo esc_attr( $path ); ?>" /><?php } ?>

        <?php if ( $name ) { ?>
            <div class="image-widget-content" <?php if ( !$path ) { echo 'style="background-color: ' . esc_attr( $iwioi_color ) . '; width: 100%;"'; } ?>>
                <div class="image-widget-inner" <?php if ( !$path ) { echo 'style="height: ' . esc_attr( $height ) . 'px;"'; } ?>>
                    <div class="table-cell-middle" <?php echo 'style="color: ' . esc_attr( $text_color ) . ';"' ?>>
                    	<div class="image-widget-title-outer" style="border-color: <?php echo esc_attr( $text_color ) ?>;">
                        	<div class="fs19 brnhmbx-font-1 fw700 image-widget-title<?php echo esc_attr( ' iw-' . $iw_rand ); ?>"><?php echo esc_attr( $name ); ?><?php if ( $text ) { ?><div class="fs14 brnhmbx-font-2 fw400 fst-italic image-widget-text"><?php echo esc_attr( $text ); ?></div><?php } ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ( $link ) { echo '</a>'; } ?></div>

		<?php

		/* */

		echo '</div>';

	}

}

/* brnhmbx_bourz_customPopularPostsWidget */
class brnhmbx_bourz_customPopularPostsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customPopularPostsWidget',
			'Bourz Widget: Popular Posts',
			array( 'description' => "Some posts are crowded ha? This widget will find and display them." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'POPULAR POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'comment_based' => 'on', 'day_limit' => 'on', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.ppw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e9e9e9',
					change: _.throttle( function() { $('.ppw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.ppw-t-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.ppw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.ppw-d-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.ppw-d-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.ppw-bo-color-picker').wpColorPicker( {

		            defaultColor: '#FFF',
					change: _.throttle( function() { $('.ppw-bo-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p>Number of posts to show: <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is bigger than the number of posts to show, your settings will be ignored and all the posts will be shown in Style A.</em>

        <p>Post count for "Style A": <input name="<?php echo esc_attr( $this->get_field_name( 'styleA_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleA_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style B": <input name="<?php echo esc_attr( $this->get_field_name( 'styleB_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleB_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style C": <input name="<?php echo esc_attr( $this->get_field_name( 'styleC_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleC_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style D": <input name="<?php echo esc_attr( $this->get_field_name( 'styleD_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleD_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style Z": <input name="<?php echo esc_attr( $this->get_field_name( 'styleZ_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleZ_count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is smaller than the number of posts to show, Style A will take effect to complete the count.</em>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['date'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>">Display post date?</label>
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['comment_based'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'comment_based' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_based' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'comment_based' ) ); ?>">Comment Based Popularity</label>
        <br><em>Uncheck for "View Based Popularity".</em>
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['day_limit'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'day_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'day_limit' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'day_limit' ) ); ?>">Include last 60 days only</label>
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Header Color:</label>
		<br />
		<input class="ppw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>">Date Color:</label>
		<br />
		<input class="ppw-d-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_color' ) ); ?>" value="<?php echo esc_attr( $instance['date_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Box Color:</label>
		<br />
		<input class="ppw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>Box Opacity:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>">Border/Header/Date Color for Style C and D:</label>
		<br />
		<input class="ppw-bo-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" value="<?php echo esc_attr( $instance['border_color'] ); ?>" />
        </p>

        <p>Lens Opacity for Style C and D:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range_C_D' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range_C_D'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'POPULAR POSTS';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '5';
		$instance['styleA_count'] = $new_instance['styleA_count'];
		$instance['styleB_count'] = $new_instance['styleB_count'];
		$instance['styleC_count'] = $new_instance['styleC_count'];
		$instance['styleD_count'] = $new_instance['styleD_count'];
		$instance['styleZ_count'] = $new_instance['styleZ_count'];
		$instance['date'] = $new_instance['date'];
		$instance['comment_based'] = $new_instance['comment_based'];
		$instance['day_limit'] = $new_instance['day_limit'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['background_color'] = $new_instance['background_color'];
		$instance['date_color'] = $new_instance['date_color'];
		$instance['border_color'] = $new_instance['border_color'];
		$instance['range'] = $new_instance['range'];
		$instance['range_C_D'] = $new_instance['range_C_D'];

		return $instance;

	}

	// Limit to last 60 days
	function filter_where( $where = '' ) {

		$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-' . 60 .' days' ) ) . "'";
		return $where;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'POPULAR POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'comment_based' => 'on', 'day_limit' => 'on', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$count = $instance['count'];
		$styleA_count = $instance['styleA_count'];
		$styleB_count = $instance['styleB_count'];
		$styleC_count = $instance['styleC_count'];
		$styleD_count = $instance['styleD_count'];
		$styleZ_count = $instance['styleZ_count'];
		$date = $instance['date'] ? 'true' : 'false';
		$comment_based = $instance['comment_based'] ? 'true' : 'false';
		$day_limit = $instance['day_limit'] ? 'true' : 'false';
		$text_color = $instance['text_color'];
		$background_color = $instance['background_color'];
		$date_color = $instance['date_color'];
		$border_color = $instance['border_color'];
		$range = $instance['range'];
		$range_C_D = $instance['range_C_D'];

		/* Combine Widget Listing Settings */

		$w_listing_style = 'a';
		$w_listingOrder = 0;

		if ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count > $count ) {

			$styleA_count = $count;
			$styleB_count = 0;
			$styleC_count = 0;
			$styleD_count = 0;
			$styleZ_count = 0;

		}

		/* */

		$ppw_rand = rand( 1, 9999999 ); ?>

        <style type="text/css" scoped>

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .listing-box,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .widget-listing-z,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':visited' ); ?> .listing-box,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':visited' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $background_color ) ) . ',' . esc_attr( $range ) / 100; ?>); color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .listing-box-d,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':visited' ); ?> .listing-box-d { background: transparent; border: 2px solid; border-color: <?php echo esc_attr( $border_color ); ?>; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .listing-date-z,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':visited' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':visited' ); ?> .listing-date-z { color: <?php echo esc_attr( $date_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .listing-box-3,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':visited' ); ?> .listing-box-3 { background: transparent; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand ); ?> .listing-img-3-outer img { opacity: <?php echo esc_attr( $range_C_D ) / 100; ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':hover' ); ?> .listing-box,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':hover' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $text_color ) ) . ', 1'; ?>); color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':hover' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':hover' ); ?> .listing-date-z { color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.ppw-' . $ppw_rand . ':hover' ); ?> .listing-img-3-outer img { opacity: 0.3; }

		</style>

        <?php

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			} else {

				echo '<div class="pb11"></div>';

			}

			/* function */

			if ( $comment_based == 'true' ) {

				$loop_args = array(

					'posts_per_page' => esc_attr( $count ),
					'orderby' => 'comment_count',
					'ignore_sticky_posts' => 1

				);

			} else {

				$loop_args = array(

					'posts_per_page' => esc_attr( $count ),
					'orderby'   => 'meta_value_num',
					'meta_key'  => 'post_views_count',
					'ignore_sticky_posts' => 1

				);

			}

			if ( $day_limit == 'true' ) { add_filter( 'posts_where', array( $this, 'filter_where' ) ); }
			$loop = new WP_Query( $loop_args );
			if ( $day_limit == 'true' ) { remove_filter( 'posts_where', array( $this, 'filter_where' ) ); }

			while( $loop->have_posts() ) : $loop->the_post();

			//Combine Widget Listing Settings Styles

			$w_listingOrder ++;

			if ( $styleA_count > 0 && ( $w_listingOrder > $count - ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'a';

			}

			if ( $styleB_count > 0 && ( $w_listingOrder > $count - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'b';

			}

			if ( $styleC_count > 0 && ( $w_listingOrder > $count - ( $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'c';

			}

			if ( $styleD_count > 0 && ( $w_listingOrder > $count - ( $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - $styleZ_count ) ) {

				$w_listing_style = 'd';

			}

			if ( $styleZ_count > 0 && ( $w_listingOrder > $count - $styleZ_count && $w_listingOrder <= $count ) ) {

				$w_listing_style = 'z';

			} ?>

            <a class="brnhmbx-posts-widget <?php echo esc_attr( 'ppw-' . $ppw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
                <div class="mb20">

                    <?php if ( $w_listing_style == 'a' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?></div><?php }

					} else if ( $w_listing_style == 'b' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					} else if ( $w_listing_style == 'c' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-3-outer"><?php }

					} else if ( $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					}

					if ( has_post_thumbnail() && $w_listing_style == 'c' ) { ?>

                    <div class="listing-box-3 clearfix">

                    <?php } else if ( has_post_thumbnail() && $w_listing_style == 'd' ) { ?>

                    <div class="listing-box-d clearfix">

                    <?php } else if ( $w_listing_style == 'z' ) { ?>

					<div class="widget-listing-z clearfix">
						<?php if ( has_post_thumbnail() ) { ?><?php echo the_post_thumbnail( 'brnhmbx-bourz-small-thumbnail-image' ); ?><?php } ?>
                        <div class="widget-listing-z-info <?php if ( has_post_thumbnail() ) { echo 'widget-listing-z-info-with-t'; } ?>">
                        	<div class="table-cell-middle"><?php if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date-z"><?php echo get_the_date(); ?></div><?php } ?><span class="brnhmbx-font-2 fw700 fst-italic widget-listing-z-title"><?php the_title(); ?></span></div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="listing-box clearfix<?php if ( $w_listing_style == 'b' ) { echo ' listing-box-b'; } ?>">

                    <?php }

					if ( $w_listing_style != 'z' ) {

						if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><?php echo get_the_date(); ?></div><?php } ?>
                        <div class="listing-title brnhmbx-font-2 fw700 fst-italic"><?php the_title(); ?></div>

                    </div>

                    <?php }

					if ( $w_listing_style == 'b' || $w_listing_style == 'c' || $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?></div></div></div><?php }

					} ?>

                </div>
            </a>

			<?php endwhile;

			wp_reset_postdata();

			/* */

		}

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

/* brnhmbx_bourz_customPostWidget Class */
class brnhmbx_bourz_customPostWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customPostWidget',
			'Bourz Widget: Post',
			array( 'description' => "Maybe you want some special attention for one of your posts. Use this!" )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'date' => 'on', 'comments' => 'on', 'text_color' => '#4f4047', 'background_color' => '#e9c490', 'comment_color' => '#a06161', 'range' => '50', 'post_1' => '0', 'radio_buttons' => 'radio_option_1', 'featured_image' => 'on', 'target' => 'off' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.pw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e9c490',
					change: _.throttle( function() { $('.pw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.pw-t-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.pw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.pw-c-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.pw-c-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

        <p>Post ID: <input id="get-dropdown-val-1-p" name="<?php echo esc_attr( $this->get_field_name( 'post_1' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['post_1'] ); ?>" style="width: 50px;" /></p>
        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['date'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>">Display post date?</label>
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['comments'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comments' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'comments' ) ); ?>">Display comments icon?</label>
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['featured_image'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'featured_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featured_image' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'featured_image' ) ); ?>">Use Thumbnail Image <em>(Uncheck to use Featured Image)</em></label>
		</p>

        <p>
		<input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['target'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">Open in new window</label>
		</p>

        <p>Choose Listing Style:</p>
        <p>
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'radio_option_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'radio_buttons' ) ); ?>" type="radio" value="radio_option_1" <?php esc_attr( checked( $instance['radio_buttons'], 'radio_option_1' ) ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'radio_option_1' ) ); ?>">Style A</label><p />
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'radio_option_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'radio_buttons' ) ); ?>" type="radio" value="radio_option_2" <?php esc_attr( checked( $instance['radio_buttons'], 'radio_option_2' ) ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'radio_option_2' ) ); ?>">Style B</label><p />
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'radio_option_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'radio_buttons' ) ); ?>" type="radio" value="radio_option_3" <?php esc_attr( checked( $instance['radio_buttons'], 'radio_option_3' ) ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'radio_option_3' ) ); ?>">Style C</label>
    	</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Background Color:</label>
		<br />
		<input class="pw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Date & Title Color:</label>
		<br />
		<input class="pw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'comment_color' ) ); ?>">Comment Icon Color:</label>
		<br />
		<input class="pw-c-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'comment_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_color' ) ); ?>" value="<?php echo esc_attr( $instance['comment_color'] ); ?>" />
        </p>

        <p>Lens Opacity:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['date'] = $new_instance['date'];
		$instance['comments'] = $new_instance['comments'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['background_color'] = $new_instance['background_color'];
		$instance['comment_color'] = $new_instance['comment_color'];
		$instance['range'] = $new_instance['range'];
		$instance['post_1'] = $new_instance['post_1'];
		$instance['radio_buttons'] = strip_tags( $new_instance['radio_buttons'] );
		$instance['featured_image'] = $new_instance['featured_image'];
		$instance['target'] = $new_instance['target'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		if ( $id == 'brnhmbx_bourz_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { $fw_col_number = '-col4'; }
			echo '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_home_widgets' ) {

			$hw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { $hw_col_number = '-col2'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) { $hw_col_number = '-col2-sidebar'; }
			echo '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_upper_widgets' ) {

			$uw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { $uw_col_number = '-col2'; }
			echo '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_header_widgets' ) {

			$hew_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { $hew_col_number = '-col2'; }
			echo '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '">';

		} else {

			echo '<div id="' . esc_attr( $this->id ) . '">';

		}

		$defaults = array( 'date' => 'on', 'comments' => 'on', 'text_color' => '#4f4047', 'background_color' => '#e9c490', 'comment_color' => '#a06161', 'range' => '50', 'post_1' => '0', 'radio_buttons' => 'radio_option_1', 'featured_image' => 'on', 'target' => 'off' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$date = $instance['date'] ? 'true' : 'false';
		$comments = $instance['comments'] ? 'true' : 'false';
		$text_color = $instance['text_color'];
		$background_color = $instance['background_color'];
		$comment_color = $instance['comment_color'];
		$range = $instance['range'];
		$post_1 = $instance['post_1'];
		$radio_buttons = $instance['radio_buttons'];
		$featured_image = $instance['featured_image'] ? 'true' : 'false';
		$target = $instance['target'] ? 'true' : 'false';

		if ( $radio_buttons == 'radio_option_1' ) {

			$style = 'a';

		} else if ( $radio_buttons == 'radio_option_2' ) {

			$style = 'b';

		} else if ( $radio_buttons == 'radio_option_3' ) {

			$style = 'c';

		}

		$w_selectedCount = 0;

		if ( $post_1 != 0 && $post_1 != 999999 ) { $w_selectedCount++; }

		/* */

		$pw_rand = rand( 1, 9999999 ); ?>

        <style type="text/css" scoped>

			<?php echo esc_attr( 'a.pw-' . $pw_rand ); ?> .listing-box,
			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':visited' ); ?> .listing-box { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $background_color ) ) . ',' . esc_attr( $range ) / 100; ?>); color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			<?php echo esc_attr( 'a.pw-' . $pw_rand ); ?> .listing-comment,
			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':visited' ); ?> .listing-comment,
			<?php echo esc_attr( 'a.pw-' . $pw_rand ); ?> .listing-comment-w-o-date,
			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':visited' ); ?> .listing-comment-w-o-date { color: <?php echo esc_attr( $comment_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.pw-' . $pw_rand ); ?> .listing-box-3,
			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':visited' ); ?> .listing-box-3 { background: transparent; color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.pw-' . $pw_rand ); ?> .listing-img-3-outer img { -webkit-backface-visibility: hidden; -webkit-transform: translateZ(0) scale(1.0, 1.0); opacity: <?php echo esc_attr( $range ) / 100; ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':hover' ); ?> .listing-box { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $text_color ) ) . ', 1'; ?>); color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':hover' ); ?> .listing-box .listing-comment,
			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':hover' ); ?> .listing-box .listing-comment-w-o-date { color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.pw-' . $pw_rand . ':hover' ); ?> .listing-img-3-outer img { opacity: 0.3; }

		</style>

        <?php

		if ( $w_selectedCount ) {

			/* function */

			$loop_args = array(

				'showposts' => 1,
				'post_type' => 'post',
				'post__in' => array( esc_attr( $post_1 ) ),
				'ignore_sticky_posts' => 1,
				'orderby' => 'post__in'

			);

			$rPosts = new WP_Query( $loop_args );

			while ( $rPosts->have_posts() ) : $rPosts->the_post(); ?>

				<a class="brnhmbx-post-widget <?php echo esc_attr( 'pw-' . $pw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>" target="<?php if ( $target == 'true' ) { echo '_blank'; } else { echo '_self'; } ?>">
                    <div class="zig-zag clearfix">

                    	<?php if ( $style == 'a' ) {

							if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php if ( $featured_image == 'false' ) { the_post_thumbnail(); } else { the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); } ?></div><?php }

						} else if ( $style == 'b' ) {

							if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php if ( $featured_image == 'false' ) { the_post_thumbnail(); } else { the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); } ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

						} else if ( $style == 'c' ) {

							if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php if ( $featured_image == 'false' ) { the_post_thumbnail(); } else { the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); } ?><div class="listing-box-container"><div class="listing-box-3-outer"><?php }

						}

						if ( has_post_thumbnail() && $style == 'c' ) { ?>

                        <div class="listing-box-3 clearfix">

                        <?php } else { ?>

                        <div class="listing-box clearfix">

                        <?php } ?>

                        	<?php if ( $date == 'true' || ( $comments == 'true' && comments_open() ) ) { ?>
                            <?php if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><?php echo get_the_date(); ?></div><?php } ?>
                            <?php if ( $comments == 'true' && comments_open() ) { ?><div class="brnhmbx-font-4 fw700 listing-comment<?php if ( $date != 'true' ) { echo '-w-o-date'; } ?> clearfix"><div class="listing-comment-icon"><i class="fa fa-comment"></i></div><div class="listing-comment-number"><?php comments_number( '0 ', '1 ', '% ' ); ?></div></div><?php } ?>
                            <?php } ?>
                            <div class="listing-title brnhmbx-font-2 fw700 fst-italic"><?php the_title(); ?></div>

                        </div>

                        <?php if ( $style == 'b' || $style == 'c' ) {

							if ( has_post_thumbnail() ) { ?></div></div></div><?php }

						} ?>

                    </div>
                </a>

			<?php endwhile;

			wp_reset_postdata();

			/* */

		}

		echo '</div>';

	}

}

/* brnhmbx_bourz_customRecentCommentsWidget Class */
class brnhmbx_bourz_customRecentCommentsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customRecentCommentsWidget',
			'Bourz Widget: Recent Comments',
			array( 'description' => "Display the latest comments your visitors have dropped." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'RECENT COMMENTS', 'opt_hdr' => '', 'count' => 5, 'avatar' => 'on', 'background_color' => '#e9e9e9', 'hdr_color' => '#4f4047', 'author_color' => '#a06161' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.sw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e9e9e9',
					change: _.throttle( function() { $('.sw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.sw-t-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.sw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.sw-a-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.sw-a-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p>Number of comments to show: <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['avatar'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>">Display avatar</label>
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Background Color:</label>
		<br />
		<input class="sw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Author Color:</label>
		<br />
		<input class="sw-a-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'author_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'author_color' ) ); ?>" value="<?php echo esc_attr( $instance['author_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'hdr_color' ) ); ?>">Title Color:</label>
		<br />
		<input class="sw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'hdr_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hdr_color' ) ); ?>" value="<?php echo esc_attr( $instance['hdr_color'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'RECENT COMMENTS';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '5';
		$instance['avatar'] = $new_instance['avatar'];
		$instance['background_color'] = $new_instance['background_color'];
		$instance['author_color'] = $new_instance['author_color'];
		$instance['hdr_color'] = $new_instance['hdr_color'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'RECENT COMMENTS', 'opt_hdr' => '', 'count' => 5, 'avatar' => 'on', 'background_color' => '#e9e9e9', 'hdr_color' => '#4f4047', 'author_color' => '#a06161' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		echo '<div class="recent-comments">';

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$count = $instance['count'];
		$avatar = $instance['avatar'] ? 'true' : 'false';
		$background_color = $instance['background_color'];
		$author_color = $instance['author_color'];
		$hdr_color = $instance['hdr_color'];

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			} else {

				echo '<div class="pb11"></div>';

			}

			/* function */

			$avatar_size = 40;

			$approvedCounter = 0;

			$comments_query = new WP_Comment_Query();
			$comments = $comments_query->query( array( 'number' => 50 ) );

			if ( $comments ) {

				foreach( $comments as $comment ) {

					if ( $comment->comment_approved == '1' && $approvedCounter < $count && !post_password_required( $comment->comment_post_ID ) ) {

						$approvedCounter ++;

						$link = get_permalink( $comment->comment_post_ID ) . '#comment-' . esc_attr( $comment->comment_ID );
                        $title = get_the_title( $comment->comment_post_ID );
						$dots = '';
						if ( strlen( $title ) > 25 ) { $dots = '...'; } ?>

                        <div class="recent-comment-item clearfix" style="background-color: <?php echo esc_attr( $background_color ); ?>;">

                            <?php if ( $avatar == 'true' && get_option( 'show_avatars' ) ) { ?><div class="recent-comment-img"><a href="<?php echo esc_url ( $link ); ?>"><?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?></a></div><?php } ?>

                            <div class="left">

                                <div class="recent-comment-hdr brnhmbx-font-1"><a style="color: <?php echo esc_attr( $hdr_color ); ?>;" href="<?php echo esc_url ( $link ); ?>"><?php echo esc_attr ( substr( $title, 0, 25 ) ) . esc_html( $dots ); ?></a></div>
                                <div class="recent-comment-author brnhmbx-font-2 fw700 fst-italic" style="color: <?php echo esc_attr( $author_color ); ?>;"><?php echo get_comment_author( $comment->comment_ID ); ?></div>

                            </div>

                        </div>

					<?php }

				}

			}

			/* */

		}

		echo '</div>';

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

/* brnhmbx_bourz_customRecentPostsWidget Class */
class brnhmbx_bourz_customRecentPostsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customRecentPostsWidget',
			'Bourz Widget: Recent Posts',
			array( 'description' => "Display a couple or two of your latest posts." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'RECENT POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'recent' => 'on', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.rpw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e9e9e9',
					change: _.throttle( function() { $('.rpw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.rpw-t-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.rpw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.rpw-d-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.rpw-d-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.rpw-bo-color-picker').wpColorPicker( {

		            defaultColor: '#FFF',
					change: _.throttle( function() { $('.rpw-bo-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p>Number of posts to show: <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is bigger than the number of posts to show, your settings will be ignored and all the posts will be shown in Style A.</em>

        <p>Post count for "Style A": <input name="<?php echo esc_attr( $this->get_field_name( 'styleA_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleA_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style B": <input name="<?php echo esc_attr( $this->get_field_name( 'styleB_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleB_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style C": <input name="<?php echo esc_attr( $this->get_field_name( 'styleC_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleC_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style D": <input name="<?php echo esc_attr( $this->get_field_name( 'styleD_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleD_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style Z": <input name="<?php echo esc_attr( $this->get_field_name( 'styleZ_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleZ_count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is smaller than the number of posts to show, Style A will take effect to complete the count.</em>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['date'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>">Display post date?</label>
		</p>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['recent'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'recent' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'recent' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'recent' ) ); ?>">Recent Posts</label>
        <br><em>Uncheck for "Random Posts".</em>
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Header Color:</label>
		<br />
		<input class="rpw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>">Date Color:</label>
		<br />
		<input class="rpw-d-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_color' ) ); ?>" value="<?php echo esc_attr( $instance['date_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Box Color:</label>
		<br />
		<input class="rpw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>Box Opacity:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>">Border/Header/Date Color for Style C and D:</label>
		<br />
		<input class="rpw-bo-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" value="<?php echo esc_attr( $instance['border_color'] ); ?>" />
        </p>

        <p>Lens Opacity for Style C and D:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range_C_D' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range_C_D'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'RECENT POSTS';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '5';
		$instance['styleA_count'] = $new_instance['styleA_count'];
		$instance['styleB_count'] = $new_instance['styleB_count'];
		$instance['styleC_count'] = $new_instance['styleC_count'];
		$instance['styleD_count'] = $new_instance['styleD_count'];
		$instance['styleZ_count'] = $new_instance['styleZ_count'];
		$instance['date'] = $new_instance['date'];
		$instance['recent'] = $new_instance['recent'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['background_color'] = $new_instance['background_color'];
		$instance['date_color'] = $new_instance['date_color'];
		$instance['border_color'] = $new_instance['border_color'];
		$instance['range'] = $new_instance['range'];
		$instance['range_C_D'] = $new_instance['range_C_D'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'RECENT POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'recent' => 'on', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$count = $instance['count'];
		$styleA_count = $instance['styleA_count'];
		$styleB_count = $instance['styleB_count'];
		$styleC_count = $instance['styleC_count'];
		$styleD_count = $instance['styleD_count'];
		$styleZ_count = $instance['styleZ_count'];
		$date = $instance['date'] ? 'true' : 'false';
		$recent = $instance['recent'] ? 'true' : 'false';
		$text_color = $instance['text_color'];
		$background_color = $instance['background_color'];
		$date_color = $instance['date_color'];
		$border_color = $instance['border_color'];
		$range = $instance['range'];
		$range_C_D = $instance['range_C_D'];

		/* Combine Widget Listing Settings */

		$w_listing_style = 'a';
		$w_listingOrder = 0;

		if ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count > $count ) {

			$styleA_count = $count;
			$styleB_count = 0;
			$styleC_count = 0;
			$styleD_count = 0;
			$styleZ_count = 0;

		}

		/* */

		$rpw_rand = rand( 1, 9999999 ); ?>

        <style type="text/css" scoped>

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .listing-box,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .widget-listing-z,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':visited' ); ?> .listing-box,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':visited' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $background_color ) ) . ',' . esc_attr( $range ) / 100; ?>); color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .listing-box-d,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':visited' ); ?> .listing-box-d { background: transparent; border: 2px solid; border-color: <?php echo esc_attr( $border_color ); ?>; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .listing-date-z,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':visited' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':visited' ); ?> .listing-date-z { color: <?php echo esc_attr( $date_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .listing-box-3,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':visited' ); ?> .listing-box-3 { background: transparent; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand ); ?> .listing-img-3-outer img { opacity: <?php echo esc_attr( $range_C_D ) / 100; ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':hover' ); ?> .listing-box,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':hover' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $text_color ) ) . ', 1'; ?>); color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':hover' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':hover' ); ?> .listing-date-z { color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.rpw-' . $rpw_rand . ':hover' ); ?> .listing-img-3-outer img { opacity: 0.3; }

		</style>

        <?php

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			} else {

				echo '<div class="pb11"></div>';

			}

			/* function */

			if ( $recent == 'true' ) {

				$loop_args = array(

					'showposts' => esc_attr( $count ),
					'ignore_sticky_posts' => 1

				);

			} else {

				$loop_args = array(

					'showposts' => esc_attr( $count ),
					'orderby' => 'rand',
					'ignore_sticky_posts' => 1

				);

			}

			$rPosts = new WP_Query( $loop_args );

			while ( $rPosts->have_posts() ) : $rPosts->the_post();

			//Combine Widget Listing Settings Styles

			$w_listingOrder ++;

			if ( $styleA_count > 0 && ( $w_listingOrder > $count - ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'a';

			}

			if ( $styleB_count > 0 && ( $w_listingOrder > $count - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'b';

			}

			if ( $styleC_count > 0 && ( $w_listingOrder > $count - ( $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - ( $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'c';

			}

			if ( $styleD_count > 0 && ( $w_listingOrder > $count - ( $styleD_count + $styleZ_count ) && $w_listingOrder <= $count - $styleZ_count ) ) {

				$w_listing_style = 'd';

			}

			if ( $styleZ_count > 0 && ( $w_listingOrder > $count - $styleZ_count && $w_listingOrder <= $count ) ) {

				$w_listing_style = 'z';

			} ?>

            <a class="brnhmbx-posts-widget <?php echo esc_attr( 'rpw-' . $rpw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
                <div class="mb20">

                    <?php if ( $w_listing_style == 'a' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?></div><?php }

					} else if ( $w_listing_style == 'b' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					} else if ( $w_listing_style == 'c' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-3-outer"><?php }

					} else if ( $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					}

					if ( has_post_thumbnail() && $w_listing_style == 'c' ) { ?>

                    <div class="listing-box-3 clearfix">

                    <?php } else if ( has_post_thumbnail() && $w_listing_style == 'd' ) { ?>

                    <div class="listing-box-d clearfix">

                    <?php } else if ( $w_listing_style == 'z' ) { ?>

					<div class="widget-listing-z clearfix">
						<?php if ( has_post_thumbnail() ) { ?><?php echo the_post_thumbnail( 'brnhmbx-bourz-small-thumbnail-image' ); ?><?php } ?>
                        <div class="widget-listing-z-info <?php if ( has_post_thumbnail() ) { echo 'widget-listing-z-info-with-t'; } ?>">
                        	<div class="table-cell-middle"><?php if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date-z"><?php echo get_the_date(); ?></div><?php } ?><span class="brnhmbx-font-2 fw700 fst-italic widget-listing-z-title"><?php the_title(); ?></span></div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="listing-box clearfix<?php if ( $w_listing_style == 'b' ) { echo ' listing-box-b'; } ?>">

                    <?php }

					if ( $w_listing_style != 'z' ) {

						if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><?php echo get_the_date(); ?></div><?php } ?>
                        <div class="listing-title brnhmbx-font-2 fw700 fst-italic"><?php the_title(); ?></div>

                    </div>

                    <?php }

					if ( $w_listing_style == 'b' || $w_listing_style == 'c' || $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?></div></div></div><?php }

					} ?>

                </div>
            </a>

			<?php endwhile;

			wp_reset_postdata();

			/* */

		}

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

/* brnhmbx_bourz_customSearchWidget Class */
class brnhmbx_bourz_customSearchWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customSearchWidget',
			'Bourz Widget: Search',
			array( 'description' => "You can search for anything on your site. Can you believe it? :)" )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'text_color' => '#4f4047', 'background_color' => '#e4be64' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.sew-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e4be64',
					change: _.throttle( function() { $('.sew-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.sew-t-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.sew-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Background Color:</label>
		<br />
		<input class="sew-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Text Color:</label>
		<br />
		<input class="sew-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['text_color'] = $new_instance['text_color'];
		$instance['background_color'] = $new_instance['background_color'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		if ( $id == 'brnhmbx_bourz_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) { $fw_col_number = '-col4'; }
			echo '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_home_widgets' ) {

			$hw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) { $hw_col_number = '-col2'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) { $hw_col_number = '-col2-sidebar'; }
			echo '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_upper_widgets' ) {

			$uw_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) { $uw_col_number = '-col2'; }
			echo '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '">';

		} else if ( $id == 'brnhmbx_bourz_header_widgets' ) {

			$hew_col_number = '';
			if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) { $hew_col_number = '-col2'; }
			echo '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '">';

		} else {

			echo '<div id="' . esc_attr( $this->id ) . '" class="widget-item clearfix">'; //Widget starts to print information

		}

		$defaults = array( 'text_color' => '#4f4047', 'background_color' => '#e4be64' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$text_color = $instance['text_color'];
		$background_color = $instance['background_color'];

		$brnhmbx_bourz_tra_TypeKeyword = get_theme_mod( 'brnhmbx_bourz_tra_TypeKeyword', 'Type keyword to search' );

		/* function */ ?>

        <div class="clearfix search-widget zig-zag" style="background-color: <?php echo esc_attr( $background_color ); ?>;">
	        <div class="clearfix search-widget-inner" style="background-color: <?php echo esc_attr( $background_color ); ?>; border-color: <?php echo esc_attr( $text_color ); ?>;">
                <div class="search-widget-input-box">
                    <form role="search" method="get" id="searchform_custom" action="<?php echo home_url( '/' ); ?>">
                        <input class="brnhmbx-font-1 search-widget-input" type="text" value="<?php echo esc_attr( $brnhmbx_bourz_tra_TypeKeyword ); ?>" name="s" id="s_custom" style="background-color: <?php echo esc_attr( $background_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>;" />
                    </form>
                </div>
                <div class="fs16 search-widget-s-icon">
                    <div class="table-cell-middle pr15" style="color: <?php echo esc_attr( $text_color ); ?>;"><i class="fa fa-search"></i></div>
                </div>
            </div>
        </div>

        <?php

		/* */

		echo '</div>'; //Widget ends printing information

	}

}

/* brnhmbx_bourz_customSelectedPostsWidget Class */
class brnhmbx_bourz_customSelectedPostsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customSelectedPostsWidget',
			'Bourz Widget: Selected Posts',
			array( 'description' => "Display the posts you've selected. Very useful for the posts you want to put forward." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'SELECTED POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'post_1' => '0', 'post_2' => '0', 'post_3' => '0', 'post_4' => '0', 'post_5' => '0', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.spw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#e9e9e9',
					change: _.throttle( function() { $('.spw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.spw-t-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.spw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.spw-d-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.spw-d-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.spw-bo-color-picker').wpColorPicker( {

		            defaultColor: '#FFF',
					change: _.throttle( function() { $('.spw-bo-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

        <p>Post 1 ID: <input id="get-dropdown-val-1" name="<?php echo esc_attr( $this->get_field_name( 'post_1' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['post_1'] ); ?>" style="width: 50px;" /></p>
        <p>Post 2 ID: <input id="get-dropdown-val-2" name="<?php echo esc_attr( $this->get_field_name( 'post_2' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['post_2'] ); ?>" style="width: 50px;" /></p>
        <p>Post 3 ID: <input id="get-dropdown-val-3" name="<?php echo esc_attr( $this->get_field_name( 'post_3' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['post_3'] ); ?>" style="width: 50px;" /></p>
        <p>Post 4 ID: <input id="get-dropdown-val-4" name="<?php echo esc_attr( $this->get_field_name( 'post_4' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['post_4'] ); ?>" style="width: 50px;" /></p>
        <p>Post 5 ID: <input id="get-dropdown-val-5" name="<?php echo esc_attr( $this->get_field_name( 'post_5' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['post_5'] ); ?>" style="width: 50px;" /></p>
		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p>Number of posts to show: <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is bigger than the number of posts to show, your settings will be ignored and all the posts will be shown in Style A.</em>

        <p>Post count for "Style A": <input name="<?php echo esc_attr( $this->get_field_name( 'styleA_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleA_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style B": <input name="<?php echo esc_attr( $this->get_field_name( 'styleB_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleB_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style C": <input name="<?php echo esc_attr( $this->get_field_name( 'styleC_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleC_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style D": <input name="<?php echo esc_attr( $this->get_field_name( 'styleD_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleD_count'] ); ?>" style="width: 50px;" /></p>
        <p>Post count for "Style Z": <input name="<?php echo esc_attr( $this->get_field_name( 'styleZ_count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['styleZ_count'] ); ?>" style="width: 50px;" /></p>

        <em>If the sum of Style A, B, C, D and Z is smaller than the number of posts to show, Style A will take effect to complete the count.</em>

        <p>
        <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instance['date'], 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>">Display post date?</label>
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Header Color:</label>
		<br />
		<input class="spw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>">Date Color:</label>
		<br />
		<input class="spw-d-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'date_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_color' ) ); ?>" value="<?php echo esc_attr( $instance['date_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>">Box Color:</label>
		<br />
		<input class="spw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
        </p>

        <p>Box Opacity:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>">Border/Header/Date Color for Style C and D:</label>
		<br />
		<input class="spw-bo-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" value="<?php echo esc_attr( $instance['border_color'] ); ?>" />
        </p>

        <p>Lens Opacity for Style C and D:<br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'range_C_D' ) ); ?>" type="range" min="0" max="100" step="10" value="<?php echo esc_attr( $instance['range_C_D'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'SELECTED POSTS';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '5';
		$instance['styleA_count'] = $new_instance['styleA_count'];
		$instance['styleB_count'] = $new_instance['styleB_count'];
		$instance['styleC_count'] = $new_instance['styleC_count'];
		$instance['styleD_count'] = $new_instance['styleD_count'];
		$instance['styleZ_count'] = $new_instance['styleZ_count'];
		$instance['date'] = $new_instance['date'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['background_color'] = $new_instance['background_color'];
		$instance['date_color'] = $new_instance['date_color'];
		$instance['border_color'] = $new_instance['border_color'];
		$instance['range'] = $new_instance['range'];
		$instance['range_C_D'] = $new_instance['range_C_D'];
		$instance['post_1'] = $new_instance['post_1'];
		$instance['post_2'] = $new_instance['post_2'];
		$instance['post_3'] = $new_instance['post_3'];
		$instance['post_4'] = $new_instance['post_4'];
		$instance['post_5'] = $new_instance['post_5'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'SELECTED POSTS', 'opt_hdr' => 'You can combine different listing styles.', 'count' => 5, 'styleA_count' => 2, 'styleB_count' => 3, 'styleC_count' => 0, 'styleD_count' => 0, 'styleZ_count' => 0, 'date' => 'on', 'post_1' => '0', 'post_2' => '0', 'post_3' => '0', 'post_4' => '0', 'post_5' => '0', 'text_color' => '#a06161', 'date_color' => '#4f4047', 'background_color' => '#e9e9e9', 'border_color' => '#FFF', 'range' => '100', 'range_C_D' => '50' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$count = $instance['count'];
		$styleA_count = $instance['styleA_count'];
		$styleB_count = $instance['styleB_count'];
		$styleC_count = $instance['styleC_count'];
		$styleD_count = $instance['styleD_count'];
		$styleZ_count = $instance['styleZ_count'];
		$date = $instance['date'] ? 'true' : 'false';
		$text_color = $instance['text_color'];
		$background_color = $instance['background_color'];
		$date_color = $instance['date_color'];
		$border_color = $instance['border_color'];
		$range = $instance['range'];
		$range_C_D = $instance['range_C_D'];
		$post_1 = $instance['post_1'];
		$post_2 = $instance['post_2'];
		$post_3 = $instance['post_3'];
		$post_4 = $instance['post_4'];
		$post_5 = $instance['post_5'];

		/* Combine Widget Listing Settings */

		$w_listing_style = 'a';
		$w_listingOrder = 0;
		$w_selectedCount = 0;

		if ( $post_1 != 0 && $post_1 != 999999 ) { $w_selectedCount++; }
		if ( $post_2 != 0 && $post_2 != 999999 ) { $w_selectedCount++; }
		if ( $post_3 != 0 && $post_3 != 999999 ) { $w_selectedCount++; }
		if ( $post_4 != 0 && $post_4 != 999999 ) { $w_selectedCount++; }
		if ( $post_5 != 0 && $post_5 != 999999 ) { $w_selectedCount++; }

		if ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count > $w_selectedCount ) {

			$styleA_count = $count;
			$styleB_count = 0;
			$styleC_count = 0;
			$styleD_count = 0;
			$styleZ_count = 0;

		}

		/* */

		$spw_rand = rand( 1, 9999999 ); ?>

        <style type="text/css" scoped>

			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .listing-box,
			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .widget-listing-z,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':visited' ); ?> .listing-box,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':visited' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $background_color ) ) . ',' . esc_attr( $range ) / 100; ?>); color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .listing-box-d,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':visited' ); ?> .listing-box-d { background: transparent; border: 2px solid; border-color: <?php echo esc_attr( $border_color ); ?>; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .listing-date-z,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':visited' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':visited' ); ?> .listing-date-z { color: <?php echo esc_attr( $date_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .listing-box-3,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':visited' ); ?> .listing-box-3 { background: transparent; color: <?php echo esc_attr( $border_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand ); ?> .listing-img-3-outer img { opacity: <?php echo esc_attr( $range_C_D ) / 100; ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':hover' ); ?> .listing-box,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':hover' ); ?> .widget-listing-z { background: rgba(<?php echo esc_attr( bourz_hex2rgb( $text_color ) ) . ', 1'; ?>); color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':hover' ); ?> .listing-box .listing-date,
			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':hover' ); ?> .listing-date-z { color: <?php echo esc_attr( $background_color ); ?>; }

			<?php echo esc_attr( 'a.spw-' . $spw_rand . ':hover' ); ?> .listing-img-3-outer img { opacity: 0.3; }

		</style>

        <?php

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			} else {

				echo '<div class="pb11"></div>';

			}

			/* function */

			$loop_args = array(

				'showposts' => esc_attr( $count ),
				'post_type' => 'post',
				'post__in' => array( esc_attr( $post_1 ), esc_attr( $post_2 ), esc_attr( $post_3 ), esc_attr( $post_4 ), esc_attr( $post_5 ) ),
				'ignore_sticky_posts' => 1,
				'orderby' => 'post__in'

			);

			$rPosts = new WP_Query( $loop_args );

			while ( $rPosts->have_posts() ) : $rPosts->the_post();

			//Combine Widget Listing Settings Styles

			$w_listingOrder ++;

			if ( $styleA_count > 0 && ( $w_listingOrder > $w_selectedCount - ( $styleA_count + $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $w_selectedCount - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'a';

			}

			if ( $styleB_count > 0 && ( $w_listingOrder > $w_selectedCount - ( $styleB_count + $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $w_selectedCount - ( $styleC_count + $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'b';

			}

			if ( $styleC_count > 0 && ( $w_listingOrder > $w_selectedCount - ( $styleC_count + $styleD_count + $styleZ_count ) && $w_listingOrder <= $w_selectedCount - ( $styleD_count + $styleZ_count ) ) ) {

				$w_listing_style = 'c';

			}

			if ( $styleD_count > 0 && ( $w_listingOrder > $w_selectedCount - ( $styleD_count + $styleZ_count ) && $w_listingOrder <= $w_selectedCount - $styleZ_count ) ) {

				$w_listing_style = 'd';

			}

			if ( $styleZ_count > 0 && ( $w_listingOrder > $w_selectedCount - $styleZ_count && $w_listingOrder <= $w_selectedCount ) ) {

				$w_listing_style = 'z';

			} ?>

            <a class="brnhmbx-posts-widget <?php echo esc_attr( 'spw-' . $spw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
                <div class="mb20">

                    <?php if ( $w_listing_style == 'a' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?></div><?php }

					} else if ( $w_listing_style == 'b' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					} else if ( $w_listing_style == 'c' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-3-outer"><?php }

					} else if ( $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?><div class="listing-img-3-outer"><?php the_post_thumbnail( 'brnhmbx-bourz-thumbnail-image' ); ?><div class="listing-box-container"><div class="listing-box-2-outer"><?php }

					}

					if ( has_post_thumbnail() && $w_listing_style == 'c' ) { ?>

                    <div class="listing-box-3 clearfix">

                    <?php } else if ( has_post_thumbnail() && $w_listing_style == 'd' ) { ?>

                    <div class="listing-box-d clearfix">

                    <?php } else if ( $w_listing_style == 'z' ) { ?>

					<div class="widget-listing-z clearfix">
						<?php if ( has_post_thumbnail() ) { ?><?php echo the_post_thumbnail( 'brnhmbx-bourz-small-thumbnail-image' ); ?><?php } ?>
                        <div class="widget-listing-z-info <?php if ( has_post_thumbnail() ) { echo 'widget-listing-z-info-with-t'; } ?>">
                        	<div class="table-cell-middle"><?php if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date-z"><?php echo get_the_date(); ?></div><?php } ?><span class="brnhmbx-font-2 fw700 fst-italic widget-listing-z-title"><?php the_title(); ?></span></div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="listing-box clearfix<?php if ( $w_listing_style == 'b' ) { echo ' listing-box-b'; } ?>">

                    <?php }

					if ( $w_listing_style != 'z' ) { ?>

                        <?php if ( $date == 'true' ) { ?><div class="brnhmbx-font-4 fw700 listing-date"><?php echo get_the_date(); ?></div><?php } ?>
                        <div class="listing-title brnhmbx-font-2 fw700 fst-italic"><?php the_title(); ?></div>

                    </div>

                    <?php }

					if ( $w_listing_style == 'b' || $w_listing_style == 'c' || $w_listing_style == 'd' ) {

						if ( has_post_thumbnail() ) { ?></div></div></div><?php }

					} ?>

                </div>
            </a>

			<?php endwhile;

			wp_reset_postdata();

			/* */

		}

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

/* brnhmbx_bourz_customSocialWidget Class */
class brnhmbx_bourz_customSocialWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'brnhmbx_bourz_customSocialWidget',
			'Bourz Widget: Social',
			array( 'description' => "Place your social account icons in a sleek list." )

		);
	}

	//Designing the widget, which will be displayed in the admin dashboard widget location.
	public function form( $instance ) {

		$defaults = array( 'name' => 'SOCIAL NETWORK', 'opt_hdr' => 'Optional Headline', 'text_color' => '#a06161', 'hover_color' => '#4f4047', 'facebook' => 'http://', 'twitter' => 'http://', 'instagram' => 'http://', 'pinterest' => 'http://', 'google' => 'http://', 'tumblr' => 'http://', 'flickr' => 'http://', 'digg' => 'http://', 'linkedin' => 'http://', 'vimeo' => 'http://', 'youtube' => 'http://', 'behance' => 'http://', 'dribble' => 'http://', 'deviantart' => 'http://', 'github' => 'http://', 'bloglovin' => 'http://', 'lastfm' => 'http://', 'soundcloud' => 'http://', 'vk' => 'http://' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		?>

        <script type='text/javascript'>

            jQuery( document ).ready( function($) {

                $('.sw-bg-color-picker').wpColorPicker( {

		            defaultColor: '#4f4047',
					change: _.throttle( function() { $('.sw-bg-color-picker').trigger( 'change' ) }, 3000 ),

				} );

				$('.sw-t-color-picker').wpColorPicker( {

		            defaultColor: '#a06161',
					change: _.throttle( function() { $('.sw-t-color-picker').trigger( 'change' ) }, 3000 ),

				} );

            } );

        </script>

		<p>Title: <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width: 100%;" /></p>
        <p>Optional Headline: <input name="<?php echo esc_attr( $this->get_field_name( 'opt_hdr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['opt_hdr'] ); ?>" style="width: 100%;" /></p>
        <p><em>Write the entire URL addresses. Leave blank if not preferred.</em></p>
        <p>Facebook: <input name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook'] ); ?>" style="width: 100%;" />
        <p>Twitter: <input name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter'] ); ?>" style="width: 100%;" />
        <p>Instagram: <input name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram'] ); ?>" style="width: 100%;" />
        <p>Pinterest: <input name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" style="width: 100%;" />
        <p>Google+: <input name="<?php echo esc_attr( $this->get_field_name( 'google' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['google'] ); ?>" style="width: 100%;" />
        <p>Tumblr: <input name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" style="width: 100%;" />
        <p>Flickr: <input name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['flickr'] ); ?>" style="width: 100%;" />
        <p>Digg: <input name="<?php echo esc_attr( $this->get_field_name( 'digg' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['digg'] ); ?>" style="width: 100%;" />
        <p>LinkedIn: <input name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" style="width: 100%;" />
        <p>Vimeo: <input name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vimeo'] ); ?>" style="width: 100%;" />
        <p>YouTube: <input name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube'] ); ?>" style="width: 100%;" />
        <p>Behance: <input name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['behance'] ); ?>" style="width: 100%;" />
        <p>Dribbble: <input name="<?php echo esc_attr( $this->get_field_name( 'dribble' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['dribble'] ); ?>" style="width: 100%;" />
        <p>DeviantArt: <input name="<?php echo esc_attr( $this->get_field_name( 'deviantart' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['deviantart'] ); ?>" style="width: 100%;" />
        <p>Github: <input name="<?php echo esc_attr( $this->get_field_name( 'github' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['github'] ); ?>" style="width: 100%;" />
        <p>Bloglovin: <input name="<?php echo esc_attr( $this->get_field_name( 'bloglovin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['bloglovin'] ); ?>" style="width: 100%;" />
        <p>Lastfm: <input name="<?php echo esc_attr( $this->get_field_name( 'lastfm' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['lastfm'] ); ?>" style="width: 100%;" />
        <p>SoundCloud: <input name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['soundcloud'] ); ?>" style="width: 100%;" />
        <p>VK: <input name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vk'] ); ?>" style="width: 100%;" />

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">Button Color:</label>
		<br />
		<input class="sw-t-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'hover_color' ) ); ?>">Button Hover Color:</label>
		<br />
		<input class="sw-bg-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'hover_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hover_color' ) ); ?>" value="<?php echo esc_attr( $instance['hover_color'] ); ?>" />
        </p>

		<?php

	}

	// Update the new values in database
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = ( !empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'SOCIAL NETWORK';
		$instance['opt_hdr'] = $new_instance['opt_hdr'];
		$instance['facebook'] = ( !empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : 'http://';
		$instance['twitter'] = ( !empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : 'http://';
		$instance['instagram'] = ( !empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : 'http://';
		$instance['pinterest'] = ( !empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : 'http://';
		$instance['google'] = ( !empty( $new_instance['google'] ) ) ? strip_tags( $new_instance['google'] ) : 'http://';
		$instance['tumblr'] = ( !empty( $new_instance['tumblr'] ) ) ? strip_tags( $new_instance['tumblr'] ) : 'http://';
		$instance['flickr'] = ( !empty( $new_instance['flickr'] ) ) ? strip_tags( $new_instance['flickr'] ) : 'http://';
		$instance['digg'] = ( !empty( $new_instance['digg'] ) ) ? strip_tags( $new_instance['digg'] ) : 'http://';
		$instance['linkedin'] = ( !empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : 'http://';
		$instance['vimeo'] = ( !empty( $new_instance['vimeo'] ) ) ? strip_tags( $new_instance['vimeo'] ) : 'http://';
		$instance['youtube'] = ( !empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : 'http://';
		$instance['behance'] = ( !empty( $new_instance['behance'] ) ) ? strip_tags( $new_instance['behance'] ) : 'http://';
		$instance['dribble'] = ( !empty( $new_instance['dribble'] ) ) ? strip_tags( $new_instance['dribble'] ) : 'http://';
		$instance['deviantart'] = ( !empty( $new_instance['deviantart'] ) ) ? strip_tags( $new_instance['deviantart'] ) : 'http://';
		$instance['github'] = ( !empty( $new_instance['github'] ) ) ? strip_tags( $new_instance['github'] ) : 'http://';
		$instance['bloglovin'] = ( !empty( $new_instance['bloglovin'] ) ) ? strip_tags( $new_instance['bloglovin'] ) : 'http://';
		$instance['lastfm'] = ( !empty( $new_instance['lastfm'] ) ) ? strip_tags( $new_instance['lastfm'] ) : 'http://';
		$instance['soundcloud'] = ( !empty( $new_instance['soundcloud'] ) ) ? strip_tags( $new_instance['soundcloud'] ) : 'http://';
		$instance['vk'] = ( !empty( $new_instance['vk'] ) ) ? strip_tags( $new_instance['vk'] ) : 'http://';
		$instance['text_color'] = $new_instance['text_color'];
		$instance['hover_color'] = $new_instance['hover_color'];

		return $instance;

	}

	//Display the stored widget information in webpage.
	function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget ); //Widget starts to print information

		$defaults = array( 'name' => 'SOCIAL NETWORK', 'opt_hdr' => 'Optional Headline', 'text_color' => '#a06161', 'hover_color' => '#4f4047', 'facebook' => 'http://', 'twitter' => 'http://', 'instagram' => 'http://', 'pinterest' => 'http://', 'google' => 'http://', 'tumblr' => 'http://', 'flickr' => 'http://', 'digg' => 'http://', 'linkedin' => 'http://', 'vimeo' => 'http://', 'youtube' => 'http://', 'behance' => 'http://', 'dribble' => 'http://', 'deviantart' => 'http://', 'github' => 'http://', 'bloglovin' => 'http://', 'lastfm' => 'http://', 'soundcloud' => 'http://', 'vk' => 'http://' );
		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$opt_hdr = $instance['opt_hdr'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$instagram = $instance['instagram'];
		$pinterest = $instance['pinterest'];
		$google = $instance['google'];
		$tumblr = $instance['tumblr'];
		$flickr = $instance['flickr'];
		$digg = $instance['digg'];
		$linkedin = $instance['linkedin'];
		$vimeo = $instance['vimeo'];
		$youtube = $instance['youtube'];
		$behance = $instance['behance'];
		$dribble = $instance['dribble'];
		$deviantart = $instance['deviantart'];
		$github = $instance['github'];
		$bloglovin = $instance['bloglovin'];
		$lastfm = $instance['lastfm'];
		$soundcloud = $instance['soundcloud'];
		$vk = $instance['vk'];
		$text_color = $instance['text_color'];
		$hover_color = $instance['hover_color'];

		$social_accounts = array( $facebook, $twitter, $instagram, $pinterest, $google, $tumblr, $flickr, $digg, $linkedin, $vimeo, $youtube, $behance, $dribble, $deviantart, $github, $bloglovin, $lastfm, $soundcloud, $vk );

		$social_faIcons = array(
			'fa-facebook',
			'fa-twitter',
			'fa-instagram',
			'fa-pinterest-p',
			'fa-google-plus',
			'fa-tumblr',
			'fa-flickr',
			'fa-digg',
			'fa-linkedin',
			'fa-vimeo',
			'fa-youtube',
			'fa-behance',
			'fa-dribbble',
			'fa-deviantart',
			'fa-github',
			'fa-heart',
			'fa-lastfm',
			'fa-soundcloud',
			'fa-vk'
		);

		/* */

		$sw_rand = rand( 1, 9999999 );  ?>

		<style type="text/css" scoped>

			<?php echo esc_attr( 'a.sw-' . $sw_rand ); ?>.social-widget-button,
			<?php echo esc_attr( 'a.sw-' . $sw_rand ); ?>.social-widget-button:visited { color: <?php echo esc_attr( $text_color ); ?>; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			<?php echo esc_attr( 'a.sw-' . $sw_rand ); ?>.social-widget-button:hover { color: <?php echo esc_attr( $hover_color ); ?>; }

		</style>

        <?php

		if ( !empty( $name ) ) {

			echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

			if ( !empty( $opt_hdr ) ) {

				echo '<div class="brnhmbx-font-2 fw400 fst-italic widget-item-opt-hdr">' . esc_attr( $opt_hdr ) . '</div>';

			} else {

				echo '<div class="pb11"></div>';

			}

			/* function */

			echo '<div class="t-a-c"><div class="social-widget-outer"><ul class="social-widget clearfix">';

			foreach ( $social_accounts as $key => $sa ) {

				if ( $sa != 'http://' && $sa != '' ) {

					echo '<li><a class="' . esc_attr( 'sw-' . $sw_rand ) . ' social-widget-button clearfix" href="' . esc_url( $sa ) . '" target="_blank"><i class="fa ' . esc_attr( $social_faIcons[ $key ] ) . '"></i></a></li>';

				}

			}

			echo '</ul></div></div>';

			/* */

		}

		echo wp_kses_post( $after_widget ); //Widget ends printing information

	}

}

if ( !function_exists( 'bourz_widgets_register' ) ) {
	function bourz_widgets_register() {

		// Register Widgets
		if ( class_exists( 'brnhmbx_bourz_customAdWidget' ) ) { register_widget( 'brnhmbx_bourz_customAdWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customCatsWidget' ) ) { register_widget( 'brnhmbx_bourz_customCatsWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customSearchWidget' ) ) { register_widget( 'brnhmbx_bourz_customSearchWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customSocialWidget' ) ) { register_widget( 'brnhmbx_bourz_customSocialWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customImageWidget' ) ) { register_widget( 'brnhmbx_bourz_customImageWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customEmptySpaceWidget' ) ) { register_widget( 'brnhmbx_bourz_customEmptySpaceWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customRecentCommentsWidget' ) ) { register_widget( 'brnhmbx_bourz_customRecentCommentsWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customFacebookFindUsWidget' ) ) { register_widget( 'brnhmbx_bourz_customFacebookFindUsWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customPostWidget' ) ) { register_widget( 'brnhmbx_bourz_customPostWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customRecentPostsWidget' ) ) { register_widget( 'brnhmbx_bourz_customRecentPostsWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customPopularPostsWidget' ) ) { register_widget( 'brnhmbx_bourz_customPopularPostsWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customSelectedPostsWidget' ) ) { register_widget( 'brnhmbx_bourz_customSelectedPostsWidget' ); }
		if ( class_exists( 'brnhmbx_bourz_customCatPostsWidget' ) ) { register_widget( 'brnhmbx_bourz_customCatPostsWidget' ); }

	}
}
add_action( 'widgets_init', 'bourz_widgets_register' );

/* Hit Counter */
if ( !function_exists( 'bourz_getPostViews' ) ) {
	function bourz_getPostViews( $postID ) {

	    $count_key = 'post_views_count';
	    $count = get_post_meta( $postID, $count_key, true );

	    if ( $count == '' ) {

	        delete_post_meta( $postID, $count_key );
	        add_post_meta( $postID, $count_key, '0' );
	        return '0';

	    }

	    return $count;

	}
}

if ( !function_exists( 'bourz_setPostViews' ) ) {
	function bourz_setPostViews( $postID ) {

	    $count_key = 'post_views_count';
	    $count = get_post_meta( $postID, $count_key, true );

	    if ( $count == '' ) {

	        $count = 0;
	        delete_post_meta( $postID, $count_key );
	        add_post_meta( $postID, $count_key, '0' );

	    } else {

	        $count ++;
	        update_post_meta( $postID, $count_key, $count );

	    }

	}
}
/* */

/* Banner Management System - Leaderboard Banners */
if ( !function_exists( 'bourz_banner_positions' ) ) {
	function bourz_banner_positions() {

		$positions = [
			'hidden',
			'above-full-slider',
			'below-cover-slider',
			'above-among-slider',
			'below-among-slider',
			'below-upper-widgets',
			'after-first-post',
			'below-blog-posts',
			'below-home-widgets',
			'above-post',
			'below-post',
			'below-post-comments',
			'above-page',
			'below-page',
			'below-page-comments',
		];

		return $positions;

	}
}

if ( !function_exists( 'bourz_detectLeaderboard' ) ) {
	function bourz_detectLeaderboard( $current_position ) {

		$brnhmbx_bourz_b1 = get_theme_mod( 'brnhmbx_bourz_opt_BannerPos_1', 'above-full-slider' );
		$brnhmbx_bourz_b2 = get_theme_mod( 'brnhmbx_bourz_opt_BannerPos_2', 'below-among-slider' );
		$brnhmbx_bourz_b3 = get_theme_mod( 'brnhmbx_bourz_opt_BannerPos_3', 'below-blog-posts' );
		$brnhmbx_bourz_b4 = get_theme_mod( 'brnhmbx_bourz_opt_BannerPos_4', 'below-page' );
		$brnhmbx_bourz_b5 = get_theme_mod( 'brnhmbx_bourz_opt_BannerPos_5', 'below-home-widgets' );

		if ( $brnhmbx_bourz_b1 == $current_position ) { bourz_callLeaderboard( 'brnhmbx_bourz_opt_BannerPos_1', 'above-full-slider', 'brnhmbx_bourz_text_Banner_1', 'brnhmbx_bourz_sh_Banner_1_Archive', 'brnhmbx_bourz_sh_Banner_1_Post', 'brnhmbx_bourz_opt_ResponsiveBanner_1', $current_position ); }

		if ( $brnhmbx_bourz_b2 == $current_position ) { bourz_callLeaderboard( 'brnhmbx_bourz_opt_BannerPos_2', 'below-among-slider', 'brnhmbx_bourz_text_Banner_2', 'brnhmbx_bourz_sh_Banner_2_Archive', 'brnhmbx_bourz_sh_Banner_2_Post', 'brnhmbx_bourz_opt_ResponsiveBanner_2', $current_position ); }

		if ( $brnhmbx_bourz_b3 == $current_position ) { bourz_callLeaderboard( 'brnhmbx_bourz_opt_BannerPos_3', 'below-blog-posts', 'brnhmbx_bourz_text_Banner_3', 'brnhmbx_bourz_sh_Banner_3_Archive', 'brnhmbx_bourz_sh_Banner_3_Post', 'brnhmbx_bourz_opt_ResponsiveBanner_3', $current_position ); }

		if ( $brnhmbx_bourz_b4 == $current_position ) { bourz_callLeaderboard( 'brnhmbx_bourz_opt_BannerPos_4', 'below-page', 'brnhmbx_bourz_text_Banner_4', 'brnhmbx_bourz_sh_Banner_4_Archive', 'brnhmbx_bourz_sh_Banner_4_Post', 'brnhmbx_bourz_opt_ResponsiveBanner_4', $current_position ); }

		if ( $brnhmbx_bourz_b5 == $current_position ) { bourz_callLeaderboard( 'brnhmbx_bourz_opt_BannerPos_5', 'below-home-widgets', 'brnhmbx_bourz_text_Banner_5', 'brnhmbx_bourz_sh_Banner_5_Archive', 'brnhmbx_bourz_sh_Banner_5_Post', 'brnhmbx_bourz_opt_ResponsiveBanner_5', $current_position ); }

	}
}

if ( !function_exists( 'bourz_callLeaderboard' ) ) {
	function bourz_callLeaderboard( $banner, $default_position, $code, $show_archive, $show_post, $responsive, $current_position ) {

		$marginTop = '';

		if ( $current_position == 'below-post-comments' || $current_position == 'below-page-comments' ) { $marginTop = ' leaderboard-outer-pp-bottom'; }
		if ( $current_position == 'above-full-slider' ) { $marginTop = ' leaderboard-outer-afs'; }

		$banner_output = '<div class="brnhmbx-font-3' . esc_attr( $marginTop ) . ' leaderboard-outer';

		if ( get_theme_mod( $responsive, 'static' ) == 'responsive' ) { $banner_output .= ' leaderboard-responsive'; } else { $banner_output .= ' leaderboard-static'; }

		if ( get_theme_mod( $banner, $default_position ) == 'above-full-slider' || get_theme_mod( $banner, $default_position ) == 'below-cover-slider' || get_theme_mod( $banner, $default_position ) == 'below-upper-widgets' ) {

			$banner_output .= ' leaderboard-full';

		} else {

			if ( is_category() || is_author() || is_tag() || is_archive() || is_search() ) {

				if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout_Archive', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout_Archive', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout_Archive', '2col_sidebar' ) == '1_2col_sidebar' ) {

					$banner_output .= ' leaderboard-among';

				} else {

					$banner_output .= ' leaderboard-full';

				}

			} else if ( is_page() ) {

				if ( get_theme_mod( 'brnhmbx_bourz_sh_SidebarInnerPage', 1 ) ) {

					$banner_output .= ' leaderboard-among';

				} else {

					$banner_output .= ' leaderboard-full';

				}

			} else if ( is_single() ) {

				if ( !is_attachment() ) {

					if ( ( get_post_format() == '' || get_post_format() == 'aside' || get_post_format() == 'link' ) && get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Standard', 1 ) ) {

						$banner_output .= ' leaderboard-among';

					} else if ( get_post_format() == 'gallery' && get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Gallery', 1 ) ) {

						$banner_output .= ' leaderboard-among';

					} else if ( get_post_format() == 'video' && get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Video', 1 ) ) {

						$banner_output .= ' leaderboard-among';

					} else {

						$banner_output .= ' leaderboard-full';

					}

				} else {

					$banner_output .= ' leaderboard-full';

				}

			} else {

				if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) {

					$banner_output .= ' leaderboard-among';

				} else {

					$banner_output .= ' leaderboard-full';

				}

			}

		}

		$banner_output .= '"><div class="leaderboard-inner';

		$ad_code = apply_filters( 'widget_text', get_theme_mod( $code, '' ) );
		$banner_output .= '">' . wp_kses_post( $ad_code ) . '</div></div>';

		if ( get_theme_mod( $code, '' ) ) {

			if ( get_theme_mod( $banner, $default_position ) == 'above-full-slider' || get_theme_mod( $banner, $default_position ) == 'below-cover-slider' || get_theme_mod( $banner, $default_position ) == 'above-among-slider' || get_theme_mod( $banner, $default_position ) == 'below-among-slider' ) {

				if ( is_home() || is_page() ) { echo wp_kses_post( $banner_output ); }
				if ( is_archive() && get_theme_mod( $show_archive, 0 ) ) { echo wp_kses_post( $banner_output ); }
				if ( is_single() && get_theme_mod( $show_post, 0 ) ) { echo wp_kses_post( $banner_output ); }

			} else {

				echo wp_kses_post( $banner_output );

			}

		}

	}
}
/* */

?>
