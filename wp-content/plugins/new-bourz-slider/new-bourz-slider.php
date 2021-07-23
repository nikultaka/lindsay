<?php
/*
Plugin Name: New Bourz Slider
Plugin URI: http://www.burnhambox.com/bourz
Description: New Bourz Slider
Version: 2.0
Author: Burnhambox
Author URI: http://www.burnhambox.com
License: GNU
*/

/* Slider Post Type */
function bourz_new_create_slider_post_type() {

	$labels = array(
		'all_items' => 'All Slides',
		'edit_item' => 'Edit Slide',
		'add_new' => 'Add New Slide',
		'add_new_item' => 'Add New Slide',
		'not_found' => 'No slides found.',
		'not_found_in_trash' => 'No slides found in Trash.',
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-images-alt',
		'capability_type' => 'post',
		'rewrite' => array( 'new_bourz_slide_group', 'post_tag' ),
		'label'  => 'New Bourz Slider',
		'supports' => array( 'thumbnail' ),
	);

	register_post_type( 'new_bourz_slider', $args );

}
add_action( 'init', 'bourz_new_create_slider_post_type' );
/* */

/* Add Meta Box */
function bourz_new_slider_add_meta_box() {

	add_meta_box( 'new_bourz-slide-meta-box', 'Slide Properties', 'bourz_new_slide_meta_box_markup', 'new_bourz_slider', 'normal', 'high' );

}
add_action( 'add_meta_boxes', 'bourz_new_slider_add_meta_box' );

function bourz_new_slide_meta_box_markup( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'new_bourz-slider-meta-box-nonce' );

	$new_bourz_slide_title = get_post_meta( $post->ID, 'new_bourz-slide-title', true );
	$new_bourz_slide_url = get_post_meta( $post->ID, 'new_bourz-slide-url', true );
	$new_bourz_slide_new_window = get_post_meta( $post->ID, 'new_bourz-slide-new-window', true );
	$new_bourz_slide_to_post = get_post_meta( $post->ID, 'new_bourz-slide-to-post', true );
	$new_bourz_slide_excerpt = get_post_meta( $post->ID, 'new_bourz-slide-excerpt', true );

	$posts = get_posts( array( 'numberposts' => -1 ) );

	?>

    <p>
    <b>a)</b> You can directly insert a post into your slider by selecting it from the <b>"Post Direction"</b> drop down. After selecting it, you can override its properties <em>(Title, Slide Image etc.)</em> if you wish.
    <br />
    <b>b)</b> To create a brand new slide, just do not select a post and fill in the other fields <em>(Title, URL etc.)</em>.
    </p>
    <p>
    <b>Note:</b> Don't forget that you should use the same group name for the slides/posts you want to see in the same slider. See <a href="edit-tags.php?taxonomy=new_bourz_slide_group&post_type=new_bourz_slider"><em>Slide Groups</em></a>.
    </p>
    <hr />
	<p>Post Direction:<br />
	<select id="new_bourz-slide-to-post" name="new_bourz-slide-to-post" class="widefat" style="max-width: 300px;">
        <option <?php echo esc_attr( $new_bourz_slide_to_post ) == 0 ? 'selected="selected"' : '';?> value="0">- Select a Post -</option>
		<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
        <option <?php echo $post->ID == esc_attr( $new_bourz_slide_to_post ) ? 'selected="selected"' : '';?> value="<?php echo esc_attr( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></option>
		<?php endforeach; ?>
	</select>
	</p>
	<p>Title:<br />
	<input type="text" name="new_bourz-slide-title" id="new_bourz-slide-title" value="<?php echo esc_attr( $new_bourz_slide_title ); ?>" class="widefat" style="max-width: 300px;" />
	</p>
	<p>Excerpt:<br />
	<textarea name="new_bourz-slide-excerpt" id="new_bourz-slide-excerpt" class="widefat" rows="5" style="max-width: 300px;"><?php echo esc_attr( $new_bourz_slide_excerpt ); ?></textarea>
	</p>
    <p>URL:<br />
	<input type="text" name="new_bourz-slide-url" id="new_bourz-slide-url" value="<?php echo esc_url( $new_bourz_slide_url ); ?>" class="widefat" style="max-width: 300px;" />
	</p>
    <p><input name="new_bourz-slide-new-window" id="new_bourz-slide-new-window" type="checkbox" value="true"<?php if ( $new_bourz_slide_new_window == 'true' ) { echo ' checked'; } ?>><label for="new_bourz-slide-new-window"> Open in new window</label></p>

<?php }

function bourz_new_slider_save_meta_box( $post_id ) {

	if ( !isset( $_POST['new_bourz-slider-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['new_bourz-slider-meta-box-nonce'], basename( __FILE__ ) ) ) { return $post_id; }
	if ( !current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	$new_bourz_slide_title = '';
	$new_bourz_slide_url = '';
	$new_bourz_slide_new_window = '';
	$new_bourz_slide_to_post = '';
	$new_bourz_slide_excerpt = '';

	if( isset( $_POST['new_bourz-slide-title'] ) ) { $new_bourz_slide_title = $_POST['new_bourz-slide-title']; }
	if( isset( $_POST['new_bourz-slide-url'] ) ) { $new_bourz_slide_url = $_POST['new_bourz-slide-url']; }
	if( isset( $_POST['new_bourz-slide-new-window'] ) ) { $new_bourz_slide_new_window = $_POST['new_bourz-slide-new-window']; }
	if( isset( $_POST['new_bourz-slide-to-post'] ) ) { $new_bourz_slide_to_post = $_POST['new_bourz-slide-to-post']; }
	if( isset( $_POST['new_bourz-slide-excerpt'] ) ) { $new_bourz_slide_excerpt = $_POST['new_bourz-slide-excerpt']; }

	update_post_meta( $post_id, 'new_bourz-slide-title', $new_bourz_slide_title );
	update_post_meta( $post_id, 'new_bourz-slide-url', $new_bourz_slide_url );
	update_post_meta( $post_id, 'new_bourz-slide-new-window', $new_bourz_slide_new_window );
	update_post_meta( $post_id, 'new_bourz-slide-to-post', $new_bourz_slide_to_post );
	update_post_meta( $post_id, 'new_bourz-slide-excerpt', $new_bourz_slide_excerpt );

}
add_action( 'save_post', 'bourz_new_slider_save_meta_box' );
/* */

/* Manage/Edit/Move Columns & Meta Boxes */
function bourz_new_slider_columns( $columns ) {

	$new_columns = array(
		'cb' => '<input type=\"checkbox\" />',
		'new_bourz-slide-image' => 'Image',
		'new_bourz-slide-title' => 'Title',
		'new_bourz-slide-groups' => 'Slide Groups',
		'new_bourz-slide-to-post' => 'Post Direction',
		'new_bourz-slide-url' => 'URL',
	);

	return $new_columns;

}
add_filter( 'manage_new_bourz_slider_posts_columns' , 'bourz_new_slider_columns' );

function bourz_new_slider_custom_columns( $column, $post_id ) {

	switch ( $column ) {
		case 'new_bourz-slide-image':
			$temp_image_path = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'brnhmbx-bourz-small-thumbnail-image' );
			if ( $temp_image_path ) { $final_image_path = $temp_image_path[0]; } else { $final_image_path = plugin_dir_url( __FILE__ ) . 'images/no-thumbnail.png'; }
			echo '<a href="post.php?post=' . esc_attr( $post_id ) . '&action=edit"><img src="' . esc_url( $final_image_path ) . '" /></a>';
			break;
		case 'new_bourz-slide-title':
			$temp_title = get_post_meta( $post_id, 'new_bourz-slide-title', true );
			if ( $temp_title ) { $temp_title = '<b>' . wp_kses_post( $temp_title ) . '</b>'; } else { $temp_title = '<em>No Title</em>'; }
			echo '<a href="post.php?post=' . esc_attr( $post_id ) . '&action=edit">' . wp_kses_post( $temp_title ) . '</a>';
			break;
		case 'new_bourz-slide-groups':
			$terms = get_the_terms( $post_id, 'new_bourz_slide_group' );
			if ( is_array( $terms ) ) {
				foreach( $terms as $key => $term ) {
					$terms[$key] = '<a href="edit.php?post_type=new_bourz_slider&new_bourz_slide_group=' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</a>';
				}
				echo implode( ', ', $terms );
			}
			break;
		case 'new_bourz-slide-to-post':
			$temp_post_title = get_the_title( get_post_meta( $post_id, 'new_bourz-slide-to-post', true ) );
			if ( $temp_post_title != 'Auto Draft' && $temp_post_title != '' ) { echo '<b>' . wp_kses_post( $temp_post_title ) . '</b>'; } else { echo '&mdash;'; }
			break;
		case 'new_bourz-slide-url':
			$temp_url = get_post_meta( $post_id, 'new_bourz-slide-url', true );
			if ( $temp_url ) { echo esc_url( $temp_url ); } else { echo '&mdash;'; }
			break;
	}

}
add_action( 'manage_posts_custom_column', 'bourz_new_slider_custom_columns', 10, 2 );

function bourz_new_slider_edit_slide_groups_columns( $columns ) {

	unset( $columns['description'], $columns['slug'] );

	$new_columns = array(
		'new_bourz-slide-shortcode' => 'Slider Shortcode',
	);

    return array_merge( $columns, $new_columns );

}
add_filter( 'manage_edit-new_bourz_slide_group_columns', 'bourz_new_slider_edit_slide_groups_columns' );

function bourz_new_slide_groups_columns( $out, $column, $term_id ) {

	switch ( $column ) {
		case 'new_bourz-slide-shortcode':
			$term = get_term( $term_id, 'new_bourz_slide_group' );
			$out = '<input style="width: 100%;" readonly type="text" value="[new_bourzslider group=&quot;' . esc_attr( $term->slug ) . '&quot;]" />';
			break;
	}

	return $out;

}
add_filter( 'manage_new_bourz_slide_group_custom_column', 'bourz_new_slide_groups_columns', 10, 3 );

function bourz_new_slider_move_meta_boxes(){

    remove_meta_box( 'postimagediv', 'new_bourz_slider', 'side' );
    add_meta_box( 'postimagediv', 'Slide Image', 'post_thumbnail_meta_box', 'new_bourz_slider', 'normal', 'low' );

}
add_action( 'do_meta_boxes', 'bourz_new_slider_move_meta_boxes' );
/* */

/* Slide Group Taxonomy */
function bourz_new_slide_group_tax() {

	$labels = array(
		'add_new_item' => 'Add New Slide Group',
		'edit_item' => 'Edit Slide Group',
		'separate_items_with_commas' => 'Separate groups with commas',
		'choose_from_most_used' => 'Choose from the most used groups',
		'not_found' => 'No groups found.',
	);

	register_taxonomy( 'new_bourz_slide_group', 'new_bourz_slider', array(
			'label' => 'Slide Groups',
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => false,
		)
	);

}
add_action( 'init', 'bourz_new_slide_group_tax' );
/* */

/* Hide "Quick Edit" link */
function bourz_new_slider_hide_quick_edit( $actions, $post ){

	global $current_screen;

    if( $current_screen->post_type == 'new_bourz_slider' ) {
		unset( $actions['inline hide-if-no-js'] );
	}

    return $actions;

}
add_filter( 'post_row_actions', 'bourz_new_slider_hide_quick_edit', 10, 2 );
/* */

function bourz_new_getExcerptByID( $post_id ) {

	global $post;
	$save_post = $post;
	$post = get_post( $post_id );
	$output = get_the_excerpt();
	$post = $save_post;
	return $output;

}

/* Slider Shortcode */
function bourz_new_slider_shortcode( $atts = null ) {

	global $add_my_script, $ss_atts;
	$add_my_script = true;
	$ss_atts = shortcode_atts(
		array(
			'group' => '',
			'limit' => -1,
		), $atts, 'new_bourzslider'
	);

	$args = array(
		'post_type' => 'new_bourz_slider',
		'posts_per_page' => $ss_atts['limit'],
	);

	if ( $ss_atts['group'] != '' ) {
		$args['tax_query'] = array(
			array( 'taxonomy' => 'new_bourz_slide_group', 'field' => 'slug', 'terms' => $ss_atts['group'] )
		);
	}

	$the_query = new WP_Query( $args );
	$slides = array();

	$brnhmbx_bourz_opt_bxControls = get_theme_mod( 'brnhmbx_bourz_opt_bxControls_Main', 'bullet' );
	$brnhmbx_bourz_opt_SliderStyle = get_theme_mod( 'brnhmbx_bourz_opt_SliderStyle', 'b' );
	$brnhmbx_bourz_sliderHeight = get_theme_mod( 'brnhmbx_bourz_sliderHeight', 600 );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {

			$the_query->the_post();
			$slide_callPost = false;
			$actual_base_ID = get_the_ID();
			$slide_postID = get_post_meta( get_the_ID(), 'new_bourz-slide-to-post', true );

			if ( $slide_postID != 0 && $slide_postID != '' ) {

				$actual_base_ID = $slide_postID;
				$url = get_the_permalink( $actual_base_ID );

				if ( get_post_meta( get_the_ID(), 'new_bourz-slide-excerpt', true ) ) {

					$caption_text = get_post_meta( get_the_ID(), 'new_bourz-slide-excerpt', true );

				} else {

					$caption_text = bourz_new_getExcerptByID( $actual_base_ID );

				}

				if ( get_post_thumbnail_id( get_the_ID() ) ) {

					$img_path = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'brnhmbx-bourz-slider-image' );

				} else {

					$img_path = wp_get_attachment_image_src( get_post_thumbnail_id( $actual_base_ID ), 'brnhmbx-bourz-slider-image' );

				}

			} else {

				$url = get_post_meta( get_the_ID(), 'new_bourz-slide-url', true );
				$caption_text = get_post_meta( get_the_ID(), 'new_bourz-slide-excerpt', true );
				$img_path = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'brnhmbx-bourz-slider-image' );

			}

			$button_target = get_post_meta( get_the_ID(), 'new_bourz-slide-new-window', true );

			$linker_open = '';
			$linker_close = '';
			$padding_if_not_empty = '';

			$slide_image = get_template_directory_uri() . '/css/images/image-placeholder.jpg';
			$header = '';

			$replaceCaptionReadMore = '/\<div class="btnReadMore(.*)\<\/div>/';
			$caption_final_text = preg_replace( $replaceCaptionReadMore, '', $caption_text );

			$caption = '';
			$padding_caption = '';

			$date = '';
			$comment_icon = '';
			$padding_comment_icon = '';
			$categories = '';

			//

			if ( $url != '' && $url != 'http://' ) {

				$linker_open = '<a class="slide-a" href="' . esc_url( $url ) . '" target="' . esc_attr( $button_target ) . '">';
				$linker_close = '</a>';
			}

			//

			if ( $img_path ) {

				$slide_image = $img_path[0];

			}

			//

			$new_bourz_slide_title = get_post_meta( get_the_ID(), 'new_bourz-slide-title', true );

			if ( $new_bourz_slide_title ) {

				$header = '<div class="slider-header brnhmbx-font-1 fw700">' . esc_attr( $new_bourz_slide_title ) . '</div>';
				$padding_caption = 'padding-top: 10px; padding-bottom: 5px;';

			} else {

				if ( get_the_title( $slide_postID ) ) {

					$header = '<div class="slider-header brnhmbx-font-1 fw700">' . esc_attr( get_the_title( $slide_postID ) ) . '</div>';
					$padding_caption = 'padding-top: 10px; padding-bottom: 5px;';

				}

			}

			//

			if ( $caption_text && get_theme_mod( 'brnhmbx_bourz_bptsCaption', 1 ) ) {

				$caption = '<div class="slider-caption brnhmbx-font-2 fst-italic" style="' . esc_attr( $padding_caption ) . '">' . esc_attr( $caption_final_text ) . '</div>';

			}

			//

			if ( get_theme_mod( 'brnhmbx_bourz_bptsDate', 1 ) ) {

				$date = '<div class="slider-date brnhmbx-font-4 fw700">' . get_the_date( '', $actual_base_ID ) . '</div>';
				$padding_comment_icon = 'margin-left: 30px;';

			}

			//

			if ( get_theme_mod( 'brnhmbx_bourz_bptsComment', 1 ) && comments_open( $actual_base_ID ) ) {

				$comment_icon = '<div class="slider-comment-icon brnhmbx-font-4 fw700" style="' . esc_attr( $padding_comment_icon ) . '"><div class="slider-comment-icon-inner"><i class="fa fa-comment"></i></div><div class="slider-comment-icon-number">' . get_comments_number( $actual_base_ID ) . '</div></div>';

			}

			//

			$categories = '<div class="slider-categories brnhmbx-font-1">';

			$brnhmbx_bourz_categories = get_the_category( $actual_base_ID );
			$brnhmbx_bourz_separator = ', ';
			$brnhmbx_bourz_output = '';

			if ( $brnhmbx_bourz_categories && get_theme_mod( 'brnhmbx_bourz_bptsCategories', 1 ) ) {

				foreach( $brnhmbx_bourz_categories as $brnhmbx_bourz_category ) {

					$brnhmbx_bourz_output .= esc_attr( $brnhmbx_bourz_category->cat_name ) . wp_kses_post( $brnhmbx_bourz_separator );

				}

				$categories .= trim( $brnhmbx_bourz_output, $brnhmbx_bourz_separator );

				$categories .= '</div>';

			} else {

				$categories = '';

			}

			//

			if ( $brnhmbx_bourz_opt_SliderStyle == 'a' ) {

				if ( $caption || $header || $date || $comment_icon || $categories ) { $padding_if_not_empty = ' slide-text-padding'; }

				$slide_info = 'slide-info';

			} else if ( $brnhmbx_bourz_opt_SliderStyle == 'b' || $brnhmbx_bourz_opt_SliderStyle == 'c' ) {

				if ( $caption || $header || $date || $comment_icon || $categories ) { $padding_if_not_empty = ' slide-text-padding-2'; }

				$slide_info = 'slide-info-2';

			}

			//

			$slides[] = '
			<li>' . wp_kses_post( $linker_open ) . '<div class="slide-container" style="background-image: url(' . esc_url( $slide_image ) . '); height: ' . esc_attr( $brnhmbx_bourz_sliderHeight ) . 'px;">
				<div class="slide-info-outer">
                    <div class="' . esc_attr( $slide_info ) . '">
                        <div class="slide-info-inner">
							<div class="slide-text-outer">
								<div class="slide-text' . esc_attr( $padding_if_not_empty ) . '">' . wp_kses_post( $date ) . wp_kses_post( $comment_icon ) . wp_kses_post( $header ) . wp_kses_post( $caption ) . wp_kses_post( $categories ) . '</div>
							</div>
                        </div>
                    </div>
                </div>
			</div>' . wp_kses_post( $linker_close ) . '</li>';

		}
	}

	wp_reset_query();

	return '<div class="bourz-slider-container zig-zag clearfix"><ul class="bxslider-main" style="overflow: hidden; height: ' . esc_attr( $brnhmbx_bourz_sliderHeight ) . 'px;">' . implode( '', $slides ) . '</ul></div>';

}
add_shortcode( 'new_bourzslider', 'bourz_new_slider_shortcode' );
/* */

/* Slide Ordering Engine */
class bourz_new_slider_order_engine {

    function __construct() {

		add_action( 'admin_init', array( $this, 'bourz_new_slider_refresh' ) );
		add_action( 'admin_init', array( $this, 'bourz_new_slider_load_scripts' ) );
		add_action( 'wp_ajax_update-menu-order', array( $this, 'bourz_new_slider_update_order' ) );
		add_action( 'pre_get_posts', array( $this, 'bourz_new_slider_pre_get_posts' ) );

    }

	function bourz_new_slider_check_scripts() {

        $active = false;
        $objects = array( 'new_bourz_slider' );
        if ( isset( $_GET['orderby'] ) || strstr( $_SERVER['REQUEST_URI'], 'action=edit') || strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) ) { return false; }
        if ( isset( $_GET['post_type'] ) && !isset( $_GET['taxonomy'] ) && in_array( $_GET['post_type'], $objects ) ) { $active = true; }
        return $active;

    }

    function bourz_new_slider_load_scripts() {

		if ( $this->bourz_new_slider_check_scripts() ) {
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'new_bourz-slider-order-js', plugin_dir_url( __FILE__ ) . 'assets/slider-order.js', array( 'jquery' ), null, true );
			wp_enqueue_style( 'new_bourz-slider-order-css', plugin_dir_url( __FILE__ ) . 'assets/slider-order.css', array(), null );
		}

    }

    function bourz_new_slider_refresh() {

        global $wpdb;

		$result = $wpdb->get_results("
			SELECT count(*) as cnt, max(menu_order) as max, min(menu_order) as min
			FROM $wpdb->posts
			WHERE post_type = 'new_bourz_slider' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
		");

		$results = $wpdb->get_results("
			SELECT ID
			FROM $wpdb->posts
			WHERE post_type = 'new_bourz_slider' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
			ORDER BY menu_order ASC
		");

		foreach ( $results as $key => $result ) {
			$wpdb->update( $wpdb->posts, array( 'menu_order' => $key + 1 ), array( 'ID' => $result->ID ) );
		}

    }

    function bourz_new_slider_update_order() {

        global $wpdb;
        parse_str( $_POST['order'], $data );

        if ( !is_array( $data ) )
            return false;

        $id_arr = array();
        foreach ( $data as $key => $values ) {
            foreach ( $values as $position => $id ) {
                $id_arr[] = $id;
            }
        }

        $menu_order_arr = array();
        foreach ( $id_arr as $key => $id ) {
            $results = $wpdb->get_results( "SELECT menu_order FROM $wpdb->posts WHERE ID = " . intval( $id ) );
            foreach ( $results as $result ) {
                $menu_order_arr[] = $result->menu_order;
            }
        }

        sort( $menu_order_arr );

        foreach ( $data as $key => $values ) {
            foreach ( $values as $position => $id ) {
                $wpdb->update( $wpdb->posts, array( 'menu_order' => $menu_order_arr[$position] ), array( 'ID' => intval( $id ) ) );
            }
        }

    }

    function bourz_new_slider_pre_get_posts( $wp_query ) {

        $objects = array( 'new_bourz_slider' );

        if ( isset( $wp_query->query['post_type'] ) && !isset( $_GET['orderby'] ) ) {
            if ( in_array( $wp_query->query['post_type'], $objects ) ) {
                $wp_query->set( 'orderby', 'menu_order' );
                $wp_query->set( 'order', 'ASC' );
            }
        }

    }

}
$bourz_new_slider_order_engine = new bourz_new_slider_order_engine();
/* */
?>
