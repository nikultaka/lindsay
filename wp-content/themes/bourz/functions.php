<?php

if ( !isset( $content_width ) ) {

	$content_width = 2560;

}

/* Include Customizer */
include( get_template_directory() . '/customizer.php' );
/* */

/* Load Widgets Filter */
if ( !function_exists( 'bourz_customLoadWidgets' ) ) {
	function bourz_customLoadWidgets() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );

	}
}
add_action( 'load-widgets.php', 'bourz_customLoadWidgets' );
/* */

/* Google Fonts */
include( get_template_directory() . '/lib/google-fonts.php' );

if ( !function_exists( 'bourz_fonts_url' ) ) {
	function bourz_fonts_url() {

		$font_customizer_names = array();

		foreach ( bourz_font_labels() as $key => $val ) {

			$add_underscore = str_replace( ' ', '_', $key );
			$font_customizer_names[ $add_underscore ] = $key . ':300,300i,400,400i,700,700i';

		}

		if ( !get_theme_mod( 'brnhmbx_bourz_upload_Logo' ) ) { $brnhmbx_bourz_font_Logo =  get_theme_mod( 'brnhmbx_bourz_font_Logo', 'Montserrat' ); } else { $brnhmbx_bourz_font_Logo = ''; }

		$font_holders = array(
			get_theme_mod( 'brnhmbx_bourz_font_1', 'Palanquin' ),
			get_theme_mod( 'brnhmbx_bourz_font_2', 'PT_Serif' ),
			get_theme_mod( 'brnhmbx_bourz_font_3', 'Palanquin' ),
			get_theme_mod( 'brnhmbx_bourz_font_4', 'Karla' ),
			$brnhmbx_bourz_font_Logo
		);

		$font_families = array();

		foreach ( $font_customizer_names as $n => $g ) {
			foreach ( $font_holders as $fh ) {
				if( $n == $fh ) {
					if ( !in_array( $g, $font_families ) ) {
						$font_families[] = $g;
					}
				}
			}
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		return esc_url_raw( $fonts_url );

	}
}
/* */

/* Embed Resources */
if ( !function_exists( 'bourz_embedResources' ) ) {
	function bourz_embedResources() {

		wp_enqueue_style( 'bourz-fonts', bourz_fonts_url(), array(), null );

		wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array( 'bourz-fonts' ) );
		wp_enqueue_style( 'bourz-style', get_stylesheet_uri() );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0', 'all' );
		wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), '', 'all' );
		wp_enqueue_style( 'bourz-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '', 'all' );
		wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/css/slicknav.css', array(), '', 'all' );
		wp_add_inline_style( 'slicknav', bourz_rewriteCSS() );

		/* */

		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bourz-burnhambox-bx-js', get_template_directory_uri() . '/js/burnhambox-bx.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bourz-burnhambox-js', get_template_directory_uri() . '/js/burnhambox.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), '', true );

		if ( is_page() && get_theme_mod( 'brnhmbx_bourz_sh_Map' ) && get_theme_mod( 'brnhmbx_bourz_mapPage' ) == get_the_ID() ) {

			if ( get_theme_mod( 'brnhmbx_bourz_enableMapKey', 0 ) ) { wp_enqueue_script( 'bourz-maps-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( get_theme_mod( 'brnhmbx_bourz_mapAPI', '' ) ), array(), '', false ); } else { wp_enqueue_script( 'bourz-maps-api', '//maps.googleapis.com/maps/api/js', array(), '', false ); }

			wp_enqueue_script( 'bourz-maps-js', get_template_directory_uri() . '/js/maps.js', array( 'jquery' ), '', true );

		}

	}
}
add_action( 'wp_enqueue_scripts', 'bourz_embedResources' );
/* */

/* Theme setup */
if ( !function_exists( 'bourz_themeSetup' ) ) {
	function bourz_themeSetup() {

		// Navigation Menu
		register_nav_menus( array(

			'primary' => esc_html__( 'Primary Menu', 'bourz' ),
			'footer_menu' => esc_html__( 'Footer Menu', 'bourz' ),
			'header_menu' => esc_html__( 'Header Menu', 'bourz' )

		) );

		// If "Crop Images" is set
		$brnhmbx_bourz_imageWidth = 1200;
		$brnhmbx_bourz_imageHeight = '';
		$brnhmbx_bourz_thumbnailImageWidth = get_theme_mod( 'brnhmbx_bourz_thumbnailImageWidth', 600 );
		$brnhmbx_bourz_thumbnailImageHeight = get_theme_mod( 'brnhmbx_bourz_thumbnailImageHeight', 400 );
		$brnhmbx_bourz_sliderWidth = 1200;
		$brnhmbx_bourz_sliderHeight = 600;

		if  ( get_theme_mod( 'brnhmbx_bourz_imageWidth' ) ) {

			$brnhmbx_bourz_imageWidth = get_theme_mod( 'brnhmbx_bourz_imageWidth', 1200 );

		}

		if  ( get_theme_mod( 'brnhmbx_bourz_imageHeight' ) ) {

			$brnhmbx_bourz_imageHeight = get_theme_mod( 'brnhmbx_bourz_imageHeight', 0 );

		}

		if  ( get_theme_mod( 'brnhmbx_bourz_sliderWidth' ) ) {

			$brnhmbx_bourz_sliderWidth = get_theme_mod( 'brnhmbx_bourz_sliderWidth', 1200 );

		}

		if  ( get_theme_mod( 'brnhmbx_bourz_sliderHeight' ) ) {

			$brnhmbx_bourz_sliderHeight = get_theme_mod( 'brnhmbx_bourz_sliderHeight', 600 );

		}

		// Add featured image support. Works for only new added images.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( esc_attr( $brnhmbx_bourz_imageWidth ), esc_attr( $brnhmbx_bourz_imageHeight ), true ); // Featured Image
		add_image_size( 'brnhmbx-bourz-slider-image', esc_attr( $brnhmbx_bourz_sliderWidth ), esc_attr( $brnhmbx_bourz_sliderHeight ), array( 'center', 'top' ) ); // Slider Images
		add_image_size( 'brnhmbx-bourz-small-thumbnail-image', 120, 80, array( 'center', 'top' ) ); // Small Thumbnail Image
		add_image_size( 'brnhmbx-bourz-thumbnail-image', esc_attr( $brnhmbx_bourz_thumbnailImageWidth ), esc_attr( $brnhmbx_bourz_thumbnailImageHeight ), array( 'center', 'top' ) ); // Thumbnail Image

		// Add post type support
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'aside', 'link' ) );

		// Add automatic feed links support
		add_theme_support( 'automatic-feed-links' );

		// Add title-tag support
		add_theme_support( 'title-tag' );

		// Add text-domain
		load_theme_textdomain( 'bourz', get_template_directory() . '/languages ');

		// Add WooCommerce support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add wide images support for Gutenberg
		add_theme_support( 'align-wide' );

	}
}
add_action( 'after_setup_theme', 'bourz_themeSetup' );
/* */

/* Find all galleries and make them slider. */
if ( !function_exists( 'bourz_check_gutenberg_gallery' ) ) {
	function bourz_check_gutenberg_gallery() {

		global $post, $gutenberg_first_image;

		$image_list = '';

		$doc = new DOMDocument();
		libxml_use_internal_errors( true );
		$doc->loadHTML( $post->post_content );
		$xpath = new DOMXPath( $doc );

		$first = true;
		foreach ( $xpath->query('//li[@class="blocks-gallery-item"]/figure/img/@src') as $attr ) {

		  $src = $attr->value;

			if ( $first ) {
				$gutenberg_first_image = $src;
				$first = false;
			}

			$image_list .= '<li><img alt="theme-img-alt" src="' . esc_url( $src ) . '"></li>';

		}

		if ( $image_list ) {

			$image_list = '<ul class="bxslider">' . $image_list;
			$image_list .= '</ul>';

		}

		return $image_list;

	}
}

if ( !function_exists( 'bourz_galleryToSlider' ) ) {
	function bourz_galleryToSlider( $content ) {

		global $post;

			// Make sure the post format is gallery
			if ( !has_post_format( 'gallery' ) ) {

				return $content;

			}

			// Make sure the post has a gallery in it
			if ( !has_shortcode( $post->post_content, 'gallery' ) ) {

				if ( bourz_check_gutenberg_gallery() ) {

					echo bourz_check_gutenberg_gallery();

				} else {

					return $content;

				}

			} else {

				// Retrieve the galleries in the post
				$galleries = get_post_galleries_images( $post );

				$image_list = '<ul class="bxslider">';

				// Loop through all galleries found
				foreach( $galleries as $gallery ) {

					// Loop through each image in each gallery
					foreach( $gallery as $image_url ) {

						$image_list .= '<li><img alt="theme-img-alt" src="' . esc_url( $image_url ) . '"></li>';

					}

				}

				$image_list .= '</ul>';

				return $image_list;

			}

	}
}
/* */

/* Get the first image of the post/gallery */
if ( !function_exists( 'bourz_getTheFirstImage' ) ) {
	function bourz_getTheFirstImage() {

		global $post;

			$image_list = '';
			$first_img = '';
			$firstBo = true;
			ob_start();
			ob_end_clean();

			// Retrieve the galleries in the post
			$galleries = get_post_galleries_images( $post );

			// Check if has a gallery
			if ( $galleries ) {

				// Loop through all galleries found
				foreach( $galleries as $gallery ) {

					// Loop through each image in each gallery
					foreach( $gallery as $image_url ) {

						$image_list = $image_url;

						if ( $firstBo ) {

							$first_img = $image_list;
							$firstBo = false;

						}

					}

				}

				if ( empty( $first_img ) ) {

					$first_img = 'none';

				}

				return $first_img;

			} else if ( bourz_check_gutenberg_gallery() ) {

				// Gutenberg gallery block check
				bourz_check_gutenberg_gallery();
				global $gutenberg_first_image;
				return $gutenberg_first_image;

			} else {

				// Has no gallery, check if has an image
				$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

				if ( $output ) {

					$first_img = $matches[1][0];

				} else {

					$first_img = 'none';

				}

				return $first_img;

			}

	}
}
/* */

/* Clear White Space */
if ( !function_exists( 'bourz_compress' ) ) {
	function bourz_compress( $buffer ) {

		$buffer = preg_replace( '~>\s+<~', '><', $buffer );
		return $buffer;

	}
}
/* */

/* Content Filter */
if ( !function_exists( 'bourz_filterContent' ) ) {
	function bourz_filterContent( $content ) {

	 	global $post;

		// Add bxslider-vid class to iframes to make the videos responsive in posts
		$content = preg_replace( array( '{<iframe}', '{</iframe>}' ), array( '<ul class="bxslider-vid"><li><iframe', '</iframe></li></ul>' ), $content );

		return $content;

	}
}
add_filter( 'the_content', 'bourz_filterContent' );
/* */

/* Add responsive container to embeds for wordpress.tv */
if ( !function_exists( 'bourz_embed_html' ) ) {
	function bourz_embed_html( $html ) {

		$html = preg_replace( array( '{<embed src="//v.wordpress}', '{wmode="transparent">}' ), array( '<div class="video-container"><embed src="//v.wordpress', 'wmode="transparent"></div>' ), $html );

	    return $html;

	}
}
add_filter( 'embed_oembed_html', 'bourz_embed_html', 10, 3 );
/* */

/* Find all videos and make them slider */
if ( !function_exists( 'bourz_videoToSlider' ) ) {
	function bourz_videoToSlider() {

		global $post;

			$result = '';
			ob_start();
			ob_end_clean();
			$output = preg_match_all( '/\[embed(.*)](.*)\[\/embed]/', $post->post_content, $matches );
			$output_gutenberg = preg_match_all( "'<figure class=\"(.*?)is-type-video(.*?)\">(.*?)</figure>'si", $post->post_content, $matches_gutenberg );


			// Make sure the post has a video in it
			if ( $output || $output_gutenberg ) {

				$result = '<ul class="bxslider bxslider-vid">';

			} else {

				$result = 'none';

			}

			if ( $output ) {

				// Replace/remove/add necessary things for Vimeo and YouTube
				for( $i = 0; $i < $output; $i++ ) {

					$result .= '<li>' . preg_replace( array( '/\[embed]/', '/\[\/embed]/', '{https://vimeo.com}', '{watch?.*?v=}', '/&#.*? /' ), array( '<iframe style="border: none;" src="', ' " width="500" height="281" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', '//player.vimeo.com/video', 'embed/', '?enablejsapi=1' ), esc_attr( $matches[0][$i] ) ) . '</li>';

				}

			}

			if ( $output_gutenberg ) {

				// Replace/remove/add necessary things for Vimeo and YouTube
				for( $j = 0; $j < $output_gutenberg; $j++ ) {

					$result .= '<li>' . preg_replace( array( '/&lt;figure class=&quot;(.*?)is-type-video(.*?)&quot;&gt;/', '/&lt;div class=&quot;(.*?)wp-block-embed__wrapper(.*?)&quot;&gt;/', '/&lt;\/div&gt;/', '/&lt;\/figure&gt;/', '{https://vimeo.com}', '{watch?.*?v=}', '/&#.*? /' ), array( '<iframe style="border: none;" src="', '', '', ' " width="500" height="281" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', '//player.vimeo.com/video', 'embed/', '?enablejsapi=1' ), esc_attr( $matches_gutenberg[0][$j] ) ) . '</li>';

				}

			}

			if ( $output || $output_gutenberg ) {

				$result .= '</ul>';

			}

			return $result;

	}
}
/* */

/* Remove embed and gallery tags */
if ( !function_exists( 'bourz_clearEmbeds' ) ) {
function bourz_clearEmbeds() {

	$replaceEmbeddedVideo = '/\<ul class="bxslider-vid"(.*)\<\/ul>/';

	$result = preg_replace(
		array( $replaceEmbeddedVideo ),
		array( '' ),
		bourz_formatGetTheContent() );

	return $result;

}
}
/* */

/* Formatting the content like "the_content" while using "get_the_content" */
if ( !function_exists( 'bourz_formatGetTheContent' ) ) {
	function bourz_formatGetTheContent( $more_link_text = null, $stripteaser = false ) {

		$content = get_the_content( $more_link_text, $stripteaser );
		$content = apply_filters( 'the_content', $content );
		return $content;

	}
}
/* */

/* Combine Listing Styles */
if ( !function_exists( 'bourz_callPostOrder' ) ) {
	function bourz_callPostOrder() {

		//Call the post order in the loop
		global $brnhmbx_bourz_counter;
		return $brnhmbx_bourz_counter;

	}
}

if ( !function_exists( 'bourz_checkStyle_B' ) ) {
	function bourz_checkStyle_B() {

		$brnhmbx_bourz_postPerPage = get_option( 'posts_per_page' );
		$brnhmbx_bourz_styleA_count = get_theme_mod( 'brnhmbx_bourz_styleA_count', 0 );
		$brnhmbx_bourz_styleB_count = get_theme_mod( 'brnhmbx_bourz_styleB_count', 0 );
		$brnhmbx_bourz_styleZ_count = get_theme_mod( 'brnhmbx_bourz_styleZ_count', 0 );

		if ( $brnhmbx_bourz_styleA_count + $brnhmbx_bourz_styleB_count + $brnhmbx_bourz_styleZ_count > $brnhmbx_bourz_postPerPage ) {

			$brnhmbx_bourz_styleB_count = 0;

		}

		$brnhmbx_bourz_postOrder = bourz_callPostOrder();
		$brnhmbx_bourz_postOrder ++;
		$brnhmbx_bourz_styleB_boo = false;

		if ( $brnhmbx_bourz_styleB_count == 0 || is_single() ) {

			$brnhmbx_bourz_styleB_boo = false;

		} else {

			if ( $brnhmbx_bourz_postOrder > $brnhmbx_bourz_postPerPage - ( $brnhmbx_bourz_styleB_count + $brnhmbx_bourz_styleZ_count ) && $brnhmbx_bourz_postOrder <= $brnhmbx_bourz_postPerPage - $brnhmbx_bourz_styleZ_count ) {

				$brnhmbx_bourz_styleB_boo = true;

			}

		}

		return $brnhmbx_bourz_styleB_boo;

	}
}

if ( !function_exists( 'bourz_checkStyle_Z' ) ) {
	function bourz_checkStyle_Z() {

		$brnhmbx_bourz_postPerPage = get_option( 'posts_per_page' );
		$brnhmbx_bourz_styleA_count = get_theme_mod( 'brnhmbx_bourz_styleA_count', 0 );
		$brnhmbx_bourz_styleB_count = get_theme_mod( 'brnhmbx_bourz_styleB_count', 0 );
		$brnhmbx_bourz_styleZ_count = get_theme_mod( 'brnhmbx_bourz_styleZ_count', 0 );

		if ( $brnhmbx_bourz_styleA_count + $brnhmbx_bourz_styleB_count + $brnhmbx_bourz_styleZ_count > $brnhmbx_bourz_postPerPage ) {

			$brnhmbx_bourz_styleZ_count = 0;

		}

		$brnhmbx_bourz_postOrder = bourz_callPostOrder();
		$brnhmbx_bourz_postOrder ++;
		$brnhmbx_bourz_styleZ_boo = false;

		if ( $brnhmbx_bourz_styleZ_count == 0 || is_single() ) {

			$brnhmbx_bourz_styleZ_boo = false;

		} else {

			if ( $brnhmbx_bourz_postOrder > $brnhmbx_bourz_postPerPage - $brnhmbx_bourz_styleZ_count ) {

				$brnhmbx_bourz_styleZ_boo = true;

			}

		}

		if ( is_search() ) {

			$brnhmbx_bourz_styleZ_boo = true;

		}

		return $brnhmbx_bourz_styleZ_boo;

	}
}
/* */

/* Set "Read More" button */
if ( !function_exists( 'bourz_setMoreButton' ) ) {
	function bourz_setMoreButton() {

		global $post;

		$brnhmbx_bourz_readMore_1 = '<div class="btnReadMore"><a href="';
		$brnhmbx_bourz_readMore_2 = esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_ReadMore', 'READ MORE' ) ) . '</a></div>';

		if ( get_theme_mod( 'brnhmbx_bourz_sh_btnReadMore', 1 ) ) {

			if( !strstr( $post->post_content, '<!--more-->' ) ) { return '...' . $brnhmbx_bourz_readMore_1 . esc_url( get_permalink() ) . '">' . $brnhmbx_bourz_readMore_2; }

		}

	}
}
add_filter( 'excerpt_more', 'bourz_setMoreButton' );
/* */

/* Append "Read More" button */
if ( !function_exists( 'bourz_appendMoreButton' ) ) {
	function bourz_appendMoreButton() {

		global $post;

		$brnhmbx_bourz_readMore_1 = '<div class="btnReadMore"><a href="';
		$brnhmbx_bourz_readMore_2 = esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_ReadMore', 'READ MORE' ) ) . '</a></div>';

		if ( get_theme_mod( 'brnhmbx_bourz_sh_Excerpt_Home', 1 ) ) {

			echo '<div class="home-excerpt fs14 brnhmbx-font-3 clearfix">';

			if( strstr( $post->post_content, '<!--more-->' ) ) {

				$excerpt = get_the_excerpt();

				if ( get_theme_mod( 'brnhmbx_bourz_sh_btnReadMore', 1 ) ) {

					echo wp_kses_post( $excerpt ) . $brnhmbx_bourz_readMore_1 . esc_url( get_permalink() ) . '">' . $brnhmbx_bourz_readMore_2 . '</div>';

				}

			} else {

				if ( $post->post_excerpt ) {

					$excerpt = get_the_excerpt();

					if ( get_theme_mod( 'brnhmbx_bourz_sh_btnReadMore', 1 ) ) {

						echo wp_kses_post( $excerpt ) . $brnhmbx_bourz_readMore_1 . esc_url( get_permalink() ) . '">' . $brnhmbx_bourz_readMore_2 . '</div>';

					} else {

						echo wp_kses_post( $excerpt ) . '</div>';

					}

				} else {

					echo get_the_excerpt();
					echo '</div>';

				}

			}

		}

	}
}
/* */

/* Apply layout options */
if ( !function_exists( 'bourz_applyLayout' ) ) {
	function bourz_applyLayout() {

		/* Radio Default Values */
		$brnhmbx_bourz_opt_Layout = get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' );
		$brnhmbx_bourz_opt_Layout_Archive = get_theme_mod( 'brnhmbx_bourz_opt_Layout_Archive', '2col_sidebar' );
		/* */

		$layout = '';

		if ( is_single() ) {

			if ( !is_attachment() ) {

				if ( ( get_post_format() == '' || get_post_format() == 'aside' || get_post_format() == 'link' ) && get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Standard', 1 ) ) {

					// Show sidebar at standard posts
					$layout = '-sidebar';

				} else if ( get_post_format() == 'gallery' && get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Gallery', 1 ) ) {

					// Show sidebar at gallery posts
					$layout = '-sidebar';

				} else if ( get_post_format() == 'video' && get_theme_mod( 'brnhmbx_bourz_sh_SidebarPost_Video', 1 ) ) {

					// Show sidebar at video posts
					$layout = '-sidebar';

				}

			}

		} else if ( is_category() || is_author() || is_tag() || is_archive() || is_search() ) {

			if ( $brnhmbx_bourz_opt_Layout_Archive == '1col' ) {

				// No sidebar
				$layout = '';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '2col' ) {

				// 2 columns //-c(olumn)c(ount)2
				$layout = '-cc2';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '3col' || $brnhmbx_bourz_opt_Layout_Archive == '2_3col' ) {

				// 3 columns //-c(olumn)c(ount)3
				$layout = '-cc3';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '1col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '2col_sidebar' || $brnhmbx_bourz_opt_Layout_Archive == '1_2col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar-cc2';

			}

		} else if ( is_page() ) {

			if ( get_theme_mod( 'brnhmbx_bourz_sh_SidebarInnerPage', 1 ) || ( function_exists( 'WC' ) && ( is_cart() || is_checkout() || is_account_page() ) ) ) {

				// Show sidebar at inner pages
				$layout = '-sidebar';

			}

		} else if ( is_404() ) {

			$layout = '';

		} else {

			if ( $brnhmbx_bourz_opt_Layout == '1col' ) {

				// No sidebar
				$layout = '';

			} else if ( $brnhmbx_bourz_opt_Layout == '2col' ) {

				// 2 columns //-c(olumn)c(ount)2
				$layout = '-cc2';

			} else if ( $brnhmbx_bourz_opt_Layout == '3col' || $brnhmbx_bourz_opt_Layout == '2_3col' ) {

				// 3 columns //-c(olumn)c(ount)3
				$layout = '-cc3';

			} else if ( $brnhmbx_bourz_opt_Layout == '1col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar';

			} else if ( $brnhmbx_bourz_opt_Layout == '2col_sidebar' || $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar-cc2';

			}

		}

		return $layout;

	}
}
/* */

/* Apply column options */
if ( !function_exists( 'bourz_applyColumns' ) ) {
	function bourz_applyColumns() {

		/* Radio Default Values */
		$brnhmbx_bourz_opt_Layout = get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' );
		$brnhmbx_bourz_opt_Layout_Archive = get_theme_mod( 'brnhmbx_bourz_opt_Layout_Archive', '2col_sidebar' );
		/* */

		$column = '';

		if ( is_category() || is_author() || is_tag() || is_archive() || is_search() ) {

			if ( $brnhmbx_bourz_opt_Layout_Archive == '1col' ) {

				// No sidebar
				$column = '';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '2col' ) {

				// 2 Columns (No sidebar)
				$column = 'col-1-2';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '3col' || $brnhmbx_bourz_opt_Layout_Archive == '2_3col' ) {

				// 3 Columns (No sidebar)
				$column = 'col-1-3';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '1col_sidebar' ) {

				// 1 Column + Sidebar
				$column = '';

			} else if ( $brnhmbx_bourz_opt_Layout_Archive == '2col_sidebar' || $brnhmbx_bourz_opt_Layout_Archive == '1_2col_sidebar' ) {

				// 2 Columns + Sidebar
				$column = 'col-1-2-sidebar';

			}

		} else {

			if ( $brnhmbx_bourz_opt_Layout == '1col' ) {

				// No sidebar
				$column = '';

			} else if ( $brnhmbx_bourz_opt_Layout == '2col' ) {

				// 2 Columns (No sidebar)
				$column = 'col-1-2';

			} else if ( $brnhmbx_bourz_opt_Layout == '3col' || $brnhmbx_bourz_opt_Layout == '2_3col' ) {

				// 3 Columns (No sidebar)
				$column = 'col-1-3';

			} else if ( $brnhmbx_bourz_opt_Layout == '1col_sidebar' ) {

				// 1 Column + Sidebar
				$column = '';

			} else if ( $brnhmbx_bourz_opt_Layout == '2col_sidebar' || $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) {

				// 2 Columns + Sidebar
				$column = 'col-1-2-sidebar';

			}

		}

		return $column;

	}
}
/* */

/* Pagination */
if ( !function_exists( 'bourz_Pagination' ) ) {
	function bourz_Pagination() {

		global $wp_query, $indexPosts;

		$brnhmbx_bourz_big = 999999999; // need an unlikely integer

		if ( get_theme_mod( 'brnhmbx_bourz_bptsExclude', '0' ) ) {

			if ( is_home() ) {

				$brnhmbx_bourz_current_query_mnp = $indexPosts->max_num_pages;

			} else {

				$brnhmbx_bourz_current_query_mnp = $wp_query->max_num_pages;

			}

		} else {

			$brnhmbx_bourz_current_query_mnp = $wp_query->max_num_pages;

		}

		$brnhmbx_bourz_paginate_links = paginate_links( array(

			'base' => str_replace( $brnhmbx_bourz_big, '%#%', esc_url( get_pagenum_link( $brnhmbx_bourz_big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $brnhmbx_bourz_current_query_mnp,
			'prev_text'          => esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_NewerPosts', 'NEWER POSTS' ) ),
			'next_text'          => esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_OlderPosts', 'OLDER POSTS' ) ),
			'before_page_number' => '<span class="page-number-inner brnhmbx-font-4 fw700 fs12">',
			'after_page_number' => '</span>',
			'end_size'           => 1,
			'mid_size'           => 1

		) );

		if ( $brnhmbx_bourz_paginate_links ) {

			echo '<div class="pagenavi clearfix brnhmbx-font-1 fw700 fs14';

			if ( get_query_var( 'paged' ) <= 1 ) {

				echo ' pagenavi-fp';

			} else if ( get_query_var( 'paged' ) == $brnhmbx_bourz_current_query_mnp ) {

				echo ' pagenavi-lp';

			} else {

				echo ' pagenavi-cp';

			}

			echo '">';
			echo wp_kses_post( $brnhmbx_bourz_paginate_links );
			echo '</div>';

		}

	}
}
/* */

/* Social Icons */
if ( !function_exists( 'bourz_placeSocialIcons' ) ) {
	function bourz_placeSocialIcons( $location ) {

		$brnhmbx_bourz_social_accounts = array(
			get_theme_mod( 'brnhmbx_bourz_social_Facebook' ),
			get_theme_mod( 'brnhmbx_bourz_social_Twitter' ),
			get_theme_mod( 'brnhmbx_bourz_social_Instagram' ),
			get_theme_mod( 'brnhmbx_bourz_social_Pinterest' ),
			get_theme_mod( 'brnhmbx_bourz_social_Google' ),
			get_theme_mod( 'brnhmbx_bourz_social_Tumblr' ),
			get_theme_mod( 'brnhmbx_bourz_social_Flickr' ),
			get_theme_mod( 'brnhmbx_bourz_social_Digg' ),
			get_theme_mod( 'brnhmbx_bourz_social_LinkedIn' ),
			get_theme_mod( 'brnhmbx_bourz_social_Vimeo' ),
			get_theme_mod( 'brnhmbx_bourz_social_YouTube' ),
			get_theme_mod( 'brnhmbx_bourz_social_Behance' ),
			get_theme_mod( 'brnhmbx_bourz_social_Dribble' ),
			get_theme_mod( 'brnhmbx_bourz_social_DeviantArt' ),
			get_theme_mod( 'brnhmbx_bourz_social_Github' ),
			get_theme_mod( 'brnhmbx_bourz_social_Bloglovin' ),
			get_theme_mod( 'brnhmbx_bourz_social_Lastfm' ),
			get_theme_mod( 'brnhmbx_bourz_social_SoundCloud' ),
			get_theme_mod( 'brnhmbx_bourz_social_VK' )
		);

		$brnhmbx_bourz_social_hdrs = array( 'Facebook', 'Twitter', 'Instagram', 'Pinterest', 'Google+', 'Tumblr', 'Flickr', 'Digg', 'Linkedin', 'Vimeo', 'Youtube', 'Behance', 'Dribble', 'Deviant Art', 'Github', 'Bloglovin', 'Last FM', 'Soundclo.', 'VK' );

		$brnhmbx_bourz_social_faIcons = array(
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

		$brnhmbx_bourz_social_show = false;
		$brnhmbx_bourz_social_html = '<div class="' . esc_attr( $location ) . ' brnhmbx-font-1 fs10">';

		foreach ( $brnhmbx_bourz_social_accounts as $key => $sa ) {

			if ( $sa != 'http://' && $sa != '' ) {

				$brnhmbx_bourz_social_show = true;
				$brnhmbx_bourz_social_html .= '<a class="social-menu-item" href="' . esc_url( $sa ) . '" target="_blank"><i class="fa ' . esc_attr( $brnhmbx_bourz_social_faIcons[ $key ] ) . '"></i><span>' . esc_html( $brnhmbx_bourz_social_hdrs[ $key ] ) . '</span></a>';

			}

		}

		$brnhmbx_bourz_social_html .= '</div>';

		if ( $location == 'footer-social' && ( !$brnhmbx_bourz_social_show || !get_theme_mod( 'brnhmbx_bourz_sh_SocialAccounts', 1 ) || !get_theme_mod( 'brnhmbx_bourz_sh_FooterSocial', 1 ) ) ) {

			if ( get_theme_mod( 'brnhmbx_bourz_sh_FooterMenu', 1 ) ) {

				$brnhmbx_bourz_social_html = '<div class="' . esc_attr( $location ) . ' fs10"><a href="javascript:void(0);" class="brnhmbx-font-1 btn-to-top"><i class="fa fa-chevron-up"></i>' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_BackToTop', 'BACK TO TOP' ) ) . '</a></div>';

			} else {

				$brnhmbx_bourz_social_html = '<div class="' . esc_attr( $location ) . ' brnhmbx-font-1 fs10"></div>';

			}

		}

		return $brnhmbx_bourz_social_html;

	}
}
/* */

/* WP title filter */
if ( !function_exists( 'bourz_wp_title' ) ) {
	function bourz_wp_title( $title, $sep ) {

		if ( is_feed() ) {

			return $title;

		}

		global $page, $paged;

		// Add the blog name
		if ( !is_customize_preview() ) {

			$title .= bloginfo( 'name', 'display' );

		}

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_home() || is_front_page() ) ) {

			$title .= esc_html( " $sep $site_description" );

		}

		return $title;

	}
}
add_filter( 'wp_title', 'bourz_wp_title', 10, 2 );
/* */

/* Place Slider */
if ( !function_exists( 'bourz_placeSlider' ) ) {
	function bourz_placeSlider() {

		$sliderShortcode = get_theme_mod( 'brnhmbx_bourz_sliderShortcode', '' );

		if ( $sliderShortcode ) {

			if ( is_home() ) {

				if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderHomeView', 'home-all' ) == 'home-all' ) {

					echo do_shortcode( esc_attr( $sliderShortcode ) );

				} else if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderHomeView', 'home-all' ) == 'home-front' && get_query_var( 'paged' ) <= 1 ) {

					echo do_shortcode( esc_attr( $sliderShortcode ) );

				} else if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderHomeView', 'home-all' ) == 'home-hide' ) {

					//Hide Slider

				}

			}

			if ( is_archive() && get_theme_mod( 'brnhmbx_bourz_sh_SliderArchive', 0 ) ) {

				echo do_shortcode( esc_attr( $sliderShortcode ) );

			}

			if ( is_single() && get_theme_mod( 'brnhmbx_bourz_sh_SliderPost', 0 ) ) {

				echo do_shortcode( esc_attr( $sliderShortcode ) );

			}

		}

	}
}
/* */

/* "Show Blog Posts" Feature for Slider */
if ( !function_exists( 'bourz_blogPostsToSlider' ) ) {
	function bourz_blogPostsToSlider() {

		$category = get_theme_mod( 'brnhmbx_bourz_sliderCategory', '' );

		if ( $category ) {

			$loop_args = array(

				'showposts' => get_theme_mod( 'brnhmbx_bourz_bptsNumber', '5' ),
				'category_name' => $category,
				'ignore_sticky_posts' => 1

			);

		} else {

			$loop_args = array(

				'showposts' => get_theme_mod( 'brnhmbx_bourz_bptsNumber', '5' ),
				'ignore_sticky_posts' => 1

			);

		}

		$wp_query = new WP_Query( $loop_args );
		$slides = array();

		$brnhmbx_bourz_opt_bxControls = get_theme_mod( 'brnhmbx_bourz_opt_bxControls_Main', 'bullet' );
		$brnhmbx_bourz_opt_SliderStyle = get_theme_mod( 'brnhmbx_bourz_opt_SliderStyle', 'b' );
		$brnhmbx_bourz_sliderHeight = get_theme_mod( 'brnhmbx_bourz_sliderHeight', 600 );

		if ( $wp_query->have_posts() ) {

			while ( $wp_query->have_posts() ) {

				$wp_query->the_post();
				$img_path = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'brnhmbx-bourz-slider-image' );
				$url = get_the_permalink();
				$button_target = '_self';

				$linker_open = '';
				$linker_close = '';
				$padding_if_not_empty = '';

				$slide_image = get_template_directory_uri() . '/css/images/image-placeholder.jpg';
				$header = '';

				$caption_text = get_the_excerpt();
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

				if ( get_the_title() ) {

					$header = '<div class="slider-header brnhmbx-font-1 fw700">' . get_the_title() . '</div>';
					$padding_caption = 'padding-top: 10px; padding-bottom: 5px;';

				}

				//

				if ( $caption_text && get_theme_mod( 'brnhmbx_bourz_bptsCaption', 1 ) ) {

					$caption = '<div class="slider-caption brnhmbx-font-2 fst-italic" style="' . esc_attr( $padding_caption ) . '">' . esc_attr( $caption_final_text ) . '</div>';

				}

				//

				if ( get_theme_mod( 'brnhmbx_bourz_bptsDate', 1 ) ) {

					$date = '<div class="slider-date brnhmbx-font-4 fw700">' . get_the_date() . '</div>';
					$padding_comment_icon = 'margin-left: 30px;';

				}

				//

				if ( get_theme_mod( 'brnhmbx_bourz_bptsComment', 1 ) && comments_open() ) {

					$comment_icon = '<div class="slider-comment-icon brnhmbx-font-4 fw700" style="' . esc_attr( $padding_comment_icon ) . '"><div class="slider-comment-icon-inner"><i class="fa fa-comment"></i></div><div class="slider-comment-icon-number">' . get_comments_number() . '</div></div>';

				}

				//

				$categories = '<div class="slider-categories brnhmbx-font-1">';

				$brnhmbx_bourz_categories = get_the_category();
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

		wp_reset_postdata();

		$bpts = '<div class="bourz-slider-container zig-zag clearfix"><ul class="bxslider-main" style="overflow: hidden; height: ' . esc_attr( $brnhmbx_bourz_sliderHeight ) . 'px;">' . implode( '', $slides ) . '</ul></div>';

		if ( get_theme_mod( 'brnhmbx_bourz_bpts', '0' ) ) {

			if ( is_home() ) {

				if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderHomeView', 'home-all' ) == 'home-all' ) {

					echo wp_kses_post( $bpts );

				} else if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderHomeView', 'home-all' ) == 'home-front' && get_query_var( 'paged' ) <= 1 ) {

					echo wp_kses_post( $bpts );

				} else if ( get_theme_mod( 'brnhmbx_bourz_opt_SliderHomeView', 'home-all' ) == 'home-hide' ) {

					//Hide Slider

				}

			}

			if ( is_archive() && get_theme_mod( 'brnhmbx_bourz_sh_SliderArchive', 0 ) ) {

				echo wp_kses_post( $bpts );

			}

			if ( is_single() && get_theme_mod( 'brnhmbx_bourz_sh_SliderPost', 0 ) ) {

				echo wp_kses_post( $bpts );

			}

		}

	}
}
/* */

/* Exclude posts when "Show Blog Posts in Slider" is chosen */
if ( !function_exists( 'bourz_excludePostsUsedInSlider' ) ) {
	function bourz_excludePostsUsedInSlider() {

		$excludePostIDs = array();

		if ( get_theme_mod( 'brnhmbx_bourz_bpts', 0 ) ) {

			$category = get_theme_mod( 'brnhmbx_bourz_sliderCategory', '' );

			if ( $category ) {

				$loop_args = array(

					'showposts' => get_theme_mod( 'brnhmbx_bourz_bptsNumber', '5' ),
					'category_name' => $category,
					'ignore_sticky_posts' => 1

				);

			} else {

				$loop_args = array(

					'showposts' => get_theme_mod( 'brnhmbx_bourz_bptsNumber', '5' ),
					'ignore_sticky_posts' => 1

				);

			}

			$wp_query = new WP_Query( $loop_args );

			if ( $wp_query->have_posts() ) {

				while ( $wp_query->have_posts() ) {

					$wp_query->the_post();
					array_push( $excludePostIDs, get_the_ID() );

				}

			}

			wp_reset_postdata();

		} else {

			$loop_args = array(

					'post_type' => 'new_bourz_slider',
					'ignore_sticky_posts' => 1

				);

			$wp_query = new WP_Query( $loop_args );

			if ( $wp_query->have_posts() ) {

				while ( $wp_query->have_posts() ) {

					$wp_query->the_post();
					array_push( $excludePostIDs, get_post_meta( get_the_ID(), 'new_bourz-slide-to-post', true ) );

				}

			}

			wp_reset_postdata();

		}

		return $excludePostIDs;

	}
}
/* */

if ( !function_exists( 'bourz_ourWidgetsInit' ) ) {
	function bourz_ourWidgetsInit() {

		/* Get footer widgets column number */
		$fw_col_number = '';
		$uw_col_number = '';
		$hw_col_number = '';
		$hew_col_number = '';

		if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '2col' ) {

			$fw_col_number = '-col2';

		} else if ( get_theme_mod( 'brnhmbx_bourz_footerWidgetsCol', '4col' ) == '4col' ) {

			$fw_col_number = '-col4';

		}

		if ( get_theme_mod( 'brnhmbx_bourz_headerWidgetsCol', '3col' ) == '2col' ) {

			$hew_col_number = '-col2';

		}

		if ( get_theme_mod( 'brnhmbx_bourz_upperWidgetsCol', '3col' ) == '2col' ) {

			$uw_col_number = '-col2';

		}

		if ( get_theme_mod( 'brnhmbx_bourz_homeWidgetsCol', '2col' ) == '2col' ) {

			$hw_col_number = '-col2';

		}

		//If layout has sidebar, go for -col2-sidebar
		if ( get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '2col_sidebar' || get_theme_mod( 'brnhmbx_bourz_opt_Layout', '2col_sidebar' ) == '1_2col_sidebar' ) {

			$hw_col_number = '-col2-sidebar';

		}
		/* */

		// Add Widget Areas
		register_sidebar( array(
			'name' => 'Sidebar - Home',
			'id' => 'brnhmbx_bourz_sidebar_home',
			'before_widget' => '<div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div>',
		) );

		register_sidebar( array(
			'name' => 'Sidebar - Archive',
			'id' => 'brnhmbx_bourz_sidebar_archive',
			'before_widget' => '<div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div>',
		) );

		register_sidebar( array(
			'name' => 'Sidebar - Page',
			'id' => 'brnhmbx_bourz_sidebar_page',
			'before_widget' => '<div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div>',
		) );

		register_sidebar( array(
			'name' => 'Sidebar - Post',
			'id' => 'brnhmbx_bourz_sidebar_post',
			'before_widget' => '<div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div>',
		) );

		register_sidebar( array(
			'name' => 'Header Widgets',
			'id' => 'brnhmbx_bourz_header_widgets',
			'before_widget' => '<div class="widget-item-header-outer' . esc_attr( $hew_col_number ) . '"><div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div></div>',
		) );

		register_sidebar( array(
			'name' => 'Upper Widgets',
			'id' => 'brnhmbx_bourz_upper_widgets',
			'before_widget' => '<div class="widget-item-upper-outer' . esc_attr( $uw_col_number ) . '"><div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div></div>',
		) );

		register_sidebar( array(
			'name' => 'Home Widgets',
			'id' => 'brnhmbx_bourz_home_widgets',
			'before_widget' => '<div class="widget-item-home-outer' . esc_attr( $hw_col_number ) . '"><div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div></div>',
		) );

		register_sidebar( array(
			'name' => 'Footer Widgets',
			'id' => 'brnhmbx_bourz_footer_widgets',
			'before_widget' => '<div class="widget-item-footer-outer' . esc_attr( $fw_col_number ) . '"><div id="%1$s" class="widget-item-footer clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div></div>',
		) );

		register_sidebar( array(
			'name' => 'WooCommerce Widgets',
			'id' => 'brnhmbx_bourz_woo_widgets',
			'before_widget' => '<div id="%1$s" class="widget-item zig-zag clearfix %2$s"><div class="widget-item-inner">',
			'before_title' => '<h2 class="brnhmbx-font-1 liner"><span>',
			'after_title' => '</span></h2>',
			'after_widget' => '</div></div>',
		) );

	}
}
add_action( 'widgets_init', 'bourz_ourWidgetsInit' );

/* HEX to RGB */
if ( !function_exists( 'bourz_hex2rgb' ) ) {
	function bourz_hex2rgb( $hex ) {

		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {

			$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1).substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1).substr( $hex, 2, 1 ) );

		} else {

			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );

		}

		$rgb = array( $r, $g, $b );
		return implode( ',', $rgb ); // returns the rgb values separated by commas

	}
}
/* */

/* Customize Default Tag Cloud Widget */
if ( !function_exists( 'bourz_defaultTagCloud' ) ) {
	function bourz_defaultTagCloud( $args ) {

		$args['largest'] = 15; //largest tag
		$args['smallest'] = 8; //smallest tag
		return $args;

	}
}
add_filter( 'widget_tag_cloud_args', 'bourz_defaultTagCloud' );
/* */

/* Author Box */
if ( !function_exists( 'bourz_author_box' ) ) {
	function bourz_author_box() {

		global $post;

		if ( is_single() && isset( $post->post_author ) ) {

			$display_name = get_the_author_meta( 'display_name', $post->post_author );

			if ( !$display_name ) {

				$display_name = get_the_author_meta( 'nickname', $post->post_author );

			}

			$user_description = get_the_author_meta( 'user_description', $post->post_author );
			$user_website = get_the_author_meta( 'url', $post->post_author );
			$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author ) );

			$author_details = '<div class="author-avatar clearfix fw700">' . get_avatar( get_the_author_meta( 'user_email' ) , 40 ) . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_About', 'About' ) ) . ' <a href="'. esc_url( $user_posts ) .'">' . esc_html( $display_name ) . '</a></div>';

			if ( $user_description ) {

				$author_details .= '<div class="brnhmbx-font-3 fs14">' . wp_kses_post( $user_description ) . '</div>';

			}

			$author_details .= '<div class="author-links author-all-posts fw700"><a href="'. esc_url( $user_posts ) .'">' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_AllByAuthor', 'View All Posts by Author' ) ) . '</a></div>';

			if ( $user_website ) {

				$author_details .= '<div class="author-links author-website fw700"><a href="' . esc_url( $user_website ) .'" target="_blank" rel="nofollow">' . esc_attr( get_theme_mod( 'brnhmbx_bourz_tra_AuthorWebsite', 'Visit Author Website' ) ) . '</a></div>';

			}

			$content = '<div class="author-box-outer zig-zag clearfix brnhmbx-font-4"><div class="author-box' . bourz_applyLayout() . '">' . wp_kses_post( $author_details ) . '</div></div>';

		}

		return $content;

	}
}

/* Assign Menu Warnings */
if ( !function_exists( 'bourz_assign_PrimaryMenu' ) ) {
	function bourz_assign_PrimaryMenu() {
		echo '<div class="assign-menu brnhmbx-font-1">Please assign a Primary Menu.</div>';
	}
}
if ( !function_exists( 'bourz_assign_HeaderMenu' ) ) {
	function bourz_assign_HeaderMenu() {
		echo '<div class="assign-menu brnhmbx-font-1">Please assign a Header Menu.</div>';
	}
}
if ( !function_exists( 'bourz_assign_FooterMenu' ) ) {
	function bourz_assign_FooterMenu() {
		echo '<div class="assign-menu brnhmbx-font-1">Please assign a Footer Menu.</div>';
	}
}
/* */

/* Related Products Count */
if ( !function_exists( 'bourz_related_products_args' ) ) {
	function bourz_related_products_args( $args ) {

		$args['posts_per_page'] = 4;
		$args['columns'] = 2;
		return $args;

	}
}
add_filter( 'woocommerce_output_related_products_args', 'bourz_related_products_args' );
/* */

/* WooCommerce change number or products per row */
if ( !function_exists( 'bourz_loop_columns' ) ) {

	function bourz_loop_columns() {

		return 2;

	}

}
add_filter( 'loop_shop_columns', 'bourz_loop_columns' );
/* */

/* Enqueue Gutenberg editor styles */
if ( !function_exists( 'bourz_gutenberg_styles' ) ) {
	function bourz_gutenberg_styles() {

		wp_enqueue_style( 'bourz-fonts', bourz_fonts_url(), array(), null );
		wp_enqueue_style( 'bourz-gutenberg', get_template_directory_uri() . '/css/gutenberg-editor.css', false, '@@pkg.version', 'all' );
		wp_add_inline_style( 'bourz-gutenberg', bourz_rewrite_gutenberg_editor_css() );

	}
}
add_action( 'enqueue_block_editor_assets', 'bourz_gutenberg_styles' );
/* */

/* Font Switchers */
if ( !function_exists( 'bourz_font_switchers' ) ) {
	function bourz_font_switchers() {

		$switchers = [
			'brnhmbx-font-1',
			'brnhmbx-font-2',
			'brnhmbx-font-3',
			'brnhmbx-font-4',
		];

		return $switchers;

	}
}
/* */

/* Include the TGM_Plugin_Activation class. */
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bourz_register_required_plugins' );

if ( !function_exists( 'bourz_register_required_plugins' ) ) {
	function bourz_register_required_plugins() {

	    $plugins = array(

			/*
			Contact Form 7
			Instagram Feed
			Mail Chimp for WP
			Regenerate Thumbnails
			Q2W3 Fixed Widget
			Bourz Components
			New Bourz Slider
			Widget Importer & Exporter
			*/

			array(
				'name' => 'Widget Importer & Exporter',
				'slug' => 'widget-importer-exporter',
				'required' => false
			),

			array(
				'name' => 'Contact Form 7',
				'slug' => 'contact-form-7',
				'required' => false
			),

			array(
				'name' => 'Instagram Feed',
				'slug' => 'instagram-feed',
				'required' => false
			),

			array(
				'name' => 'Mail Chimp for WP',
				'slug' => 'mailchimp-for-wp',
				'required' => false
			),

			array(
				'name' => 'Regenerate Thumbnails',
				'slug' => 'regenerate-thumbnails',
				'required' => false
			),

			array(
				'name' => 'Q2W3 Fixed Widget',
				'slug' => 'q2w3-fixed-widget',
				'required' => false
			),

			array(
				'name' => 'Bourz Components',
				'slug' => 'bourz-components',
				'source' => get_template_directory() . '/lib/plugins/bourz-components.zip',
				'required' => false,
			),

			array(
	      'name' => 'New Bourz Slider',
	      'slug' => 'new-bourz-slider',
	      'source' => get_template_directory_uri() . '/lib/plugins/new-bourz-slider.zip',
	      'required' => false,
	    ),

	    );

			$config = array(
			'id'           => 'bourz',       // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

		);

	    tgmpa( $plugins, $config );

	}
}
/* */

/* Output Customize CSS */
if ( !function_exists( 'bourz_rewriteCSS' ) ) {
	function bourz_rewriteCSS() {

		$brnhmbx_bourz_opt_bxControls = get_theme_mod( 'brnhmbx_bourz_opt_bxControls_Main', 'bullet' );
		$brnhmbx_bourz_opt_SliderStyle = get_theme_mod( 'brnhmbx_bourz_opt_SliderStyle', 'b' );
		$brnhmbx_bourz_opt_SliderPosition = get_theme_mod( 'brnhmbx_bourz_opt_SliderPosition', 'cover' );
		$brnhmbx_bourz_opt_bxPagerPosition_Main = get_theme_mod( 'brnhmbx_bourz_opt_bxPagerPosition_Main', 'left' );
		$brnhmbx_bourz_sliderHideMobile = get_theme_mod( 'brnhmbx_bourz_sliderHideMobile', 'always' );

		$brnhmbx_bourz_opt_ResponsiveBannerHide = get_theme_mod( 'brnhmbx_bourz_opt_ResponsiveBannerHide', '640' );

		$menuContainerHeight = get_theme_mod( 'brnhmbx_bourz_menuContainerHeight', '50' );
		$maxLogoHeight = get_theme_mod( 'brnhmbx_bourz_maxLogoHeight', '50' );

		if ( $menuContainerHeight < 35 ) { $menuContainerHeight = 35; }
		if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-left' && $maxLogoHeight > $menuContainerHeight ) { $maxLogoHeight = $menuContainerHeight; }

			/* General */

			$bourz_css = '

			body { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ) . '; }

			';

			if ( get_theme_mod( 'brnhmbx_bourz_upload_Background' ) ) {

				$bourz_css .= '

				body { background: url(' . esc_url( get_theme_mod( 'brnhmbx_bourz_upload_Background' ) ) . ')

				';

				if ( get_theme_mod( 'brnhmbx_bourz_centerBackground', 1 ) ) { $bourz_css .= ' top;'; }
				if ( !get_theme_mod( 'brnhmbx_bourz_centerBackground' ) ) { $bourz_css .= ' ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_repeatBackground', 'no-repeat' ) ); }

				$bourz_css .= '; }';

			}

			$bourz_css .= '

			input, textarea, select { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_InputBackground', '#e9e9e9' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_InputText', '#999' ) ) . '; }
			table, th, td { border-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_InputBackground', '#e9e9e9' ) ) . '; }
			blockquote, pre, .woocommerce .term-description { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_PostBackground', '#d8d1d1' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header_Post', '#4f4047' ) ) . '; }

			';

			/* Misc */

			if ( get_theme_mod( 'brnhmbx_bourz_sh_BotSdw', 1 ) ) {

				$bourz_css .= '

				.zig-zag:after {
					background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_BotSdw', '#d8d1d1' ) ) . ';
					display: block;
					bottom: 0px;
					left: 0px;
					width: 100%;
					height: 2px;
				}

				';

			}

			$bourz_css .= '

			span.page-numbers.dots,
			span.page-numbers.current,
			.pagenavi a.page-numbers,
			.pagenavi a.page-numbers:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMB', '#4f4047' ) ) . '; }
			.pagenavi a.page-numbers:hover { opacity: 0.7; }
			span.page-numbers.current { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMB', '#4f4047' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMT', '#FFF' ) ) . '; }

			.pagenavi a.next.page-numbers,
			.pagenavi a.prev.page-numbers,
			a .page-navi-btn,
			a .page-navi-btn:visited,
			.nothing-found,
			.page-404,
			.filter-bar { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMB', '#4f4047' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMT', '#FFF' ) ) . '; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			.pagenavi a.next.page-numbers:hover,
			.pagenavi a.prev.page-numbers:hover,
			a .page-navi-btn:hover { opacity: 1; background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMT', '#FFF' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Site_RMB', '#4f4047' ) ) . '; }

			';

			if ( get_theme_mod( 'brnhmbx_bourz_sh_BulletBo', 1 ) ) { $bourz_css .= '.page-navi-border { border: 2px solid; padding: 10px; }'; }

			if ( get_theme_mod( 'brnhmbx_bourz_opt_PageNaviBullet', 'arrow' ) != 'arrow' ) { $bourz_css .= '.page-navi-prev-info { padding-left: 10px; } .page-navi-next-info { padding-right: 10px; }'; }

			$bourz_css .= '

			#googleMap { height: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_mapHeight', 500 ) ) . 'px; }

			';

			/* Layout */

			if ( get_theme_mod( 'brnhmbx_bourz_opt_PageWidth', 'boxed' ) == 'boxed' ) {

				$bourz_css .= '

				.site-mid,
				.header-widgets-container { max-width: 1240px; }

				';

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_PageWidth', 'boxed' ) == 'full' ) {

				$bourz_css .= '

				.site-mid,
				.header-widgets-container { max-width: 100%; }

				';

			}

			/* Post Formats */

			if ( get_theme_mod( 'brnhmbx_bourz_opt_GalleryPos_Gallery', 'content' ) == 'iof' && has_post_format( 'gallery' ) ) {

				$bourz_css .= '

				.gallery,
				.tiled-gallery,
				.jetpack-slideshow { display: none; }

				';

			}

			/* Article */

			$bourz_css .= '

			article.post { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Content', '#777' ) ) . '; }

			article a,
			article a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link', '#a06161' ) ) . '; }
			article a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Hover', '#cd0060' ) ) . '; }

			article .home-excerpt-outer a,
			article .home-excerpt-outer a:visited,
			article .post-styleZ a,
			article .post-styleZ a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; }
			article .home-excerpt-outer a:hover,
			article .post-styleZ a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Hover', '#cd0060' ) ) . '; }
			article .listing-comment a,
			article .listing-comment a:visited,
			article .listing-comment-w-o-date a,
			article .listing-comment-w-o-date a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link', '#a06161' ) ) . '; }
			article .listing-comment a:hover,
			article .listing-comment-w-o-date a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Hover', '#cd0060' ) ) . '; }
			article .home-excerpt,
			article .home-cat-tag-page { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Content', '#777' ) ) . '; }

			article .header-area a,
			article .header-area a:visited,
			article .header-area-sidebar a,
			article .header-area-sidebar a:visited,
			.author-box-outer a,
			.author-box-outer a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Post', '#a06161' ) ) . '; }
			article .header-area a:hover,
			article .header-area-sidebar a:hover,
			.author-box-outer a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Hover_Post', '#cd0060' ) ) . '; }
			.header-area .author-bar-date-views,
			.header-area .share-bar span,
			.header-area-sidebar .author-bar-date-views,
			.header-area-sidebar .share-bar span { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_DCB_Post', '#999' ) ) . '; }
			.header-area,
			.header-area .header-area-date,
			.header-area-sidebar,
			.header-area-sidebar .header-area-date,
			.brnhmbx-wc-outer h1.page-title,
			article.post h1.header-area-title,
			.author-box-outer { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_PostBackground', '#d8d1d1' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header_Post', '#4f4047' ) ) . '; }

			.author-box-outer:after { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header_Post', '#4f4047' ) ) . ' !important; }

			.article-content-outer,
			.article-content-outer-sidebar { border-color:

			';

			if ( get_theme_mod( 'brnhmbx_bourz_sh_PostBorder', 1 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header_Post', '#4f4047' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ); }

			$bourz_css .= ' !important; }

			article.post h1, article.post h2, article.post h3, article.post h4, article.post h5, article.post h6 { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; }
			.sticky-icon { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; }
			article .wp-caption p.wp-caption-text { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link', '#a06161' ) ) ) . ', 0.7); color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . ';}
			.wpcf7-form p { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_DCB', '#999' ) ) . '; }

			';

			/* Related Posts */

			$bourz_css .= '

			.related-posts a .listing-box,
			.related-posts a:visited .listing-box { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_RP_Box', '#ebe4ca' ) ) ) . ',' . esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_RP_Box', '100' ) ) / 100 . '); color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_RP_Header', '#a06161' ) ) . '; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			.related-posts a .listing-box-d,
			.related-posts a:visited .listing-box-d { background: transparent; border: 2px solid; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_RP_Header', '#a06161' ) ) . '; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			.related-posts a .listing-box .listing-date,
			.related-posts a:visited .listing-box .listing-date { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_RP_Date', '#4f4047' ) ) . '; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			.related-posts a .listing-box-3,
			.related-posts a:visited .listing-box-3 { background: transparent; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_RP_Header', '#a06161' ) ) . '; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			.related-posts a .listing-img-3-outer img { opacity: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_RP_C_Box', '50' ) ) / 100 . '; -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
			.related-posts a:hover .listing-box { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_RP_Header', '#a06161' ) ) ) . ', 1' . '); color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_RP_Box', '#ebe4ca' ) ) . '; }
			.related-posts a:hover .listing-box .listing-date { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_RP_Box', '#ebe4ca' ) ) . '; }
			.related-posts a:hover .listing-img-3-outer img { opacity: 0.3; }

			';

			/* Post Comments */

			$bourz_css .= '

			.comments-container { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Content', '#777' ) ) . '; }
			.comment-reply-title,
			.comments .comments-hdr { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; }
			.comments a,
			.comments a:visited,
			.comment-author-name { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link', '#a06161' ) ) . '; }
			.comments a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Hover', '#cd0060' ) ) . '; }
			.comments-paging .page-numbers.current,
			.comment-date,
			.must-log-in,
			.logged-in-as,
			.comment-input-hdr,
			.comments-num { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_PC_DPL', '#999' ) ) . '; }
			.comments span.page-numbers.current { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_PC_BotSdw', '#dfdbdb' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; }
			input[type="submit"] { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; }
			input[type="submit"]:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; }
			a.comment-edit-link,
			a.comment-reply-link,
			a.comment-edit-link:visited,
			a.comment-reply-link:visited,
			.comment-item-outer:after,
			.comment-awaiting { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_PC_BotSdw', '#dfdbdb' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; }
			a.comment-edit-link:hover,
			a.comment-reply-link:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; }
			.comment-text h1, .comment-text h2, .comment-text h3, .comment-text h4, .comment-text h5, .comment-text h6 { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . ' }

			';

			/* Menu & Header */

			if ( get_theme_mod( 'brnhmbx_bourz_opt_TopLineWidth', 'full_boxed' ) == 'boxed' ) {

				$bourz_css .= '

				.top-line-outer { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ) . '; }
				.top-line-inner { background-color:

				';

				if ( get_theme_mod( 'brnhmbx_bourz_transparent_TopLine_Background', 0 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_TopLine_Background', '#4f4047' ) ); }

				$bourz_css .= '; }';

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_TopLineWidth', 'full_boxed' ) == 'full' || get_theme_mod( 'brnhmbx_bourz_opt_TopLineWidth', 'full_boxed' ) == 'full_boxed' ) {

				$bourz_css .= '

				.top-line-outer,
				.top-line-inner { background-color:
				';

				if ( get_theme_mod( 'brnhmbx_bourz_transparent_TopLine_Background', 0 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_TopLine_Background', '#4f4047' ) ); }

				$bourz_css .= '; padding: 0px; }';

			}

			if ( get_theme_mod( 'brnhmbx_bourz_opt_TopLineWidth', 'full_boxed' ) == 'full' ) { $bourz_css .= '.top-line-container { max-width: 100%; }'; }

			$bourz_css .= '

			.spot-messages,
			.spot-messages a,
			.spot-messages a:visited,
			.header-menu-outer .assign-menu { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_TopLine_Text', '#FFF' ) ) . '; }

			.mobile-header,
			#sticky-menu-container { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Menu_Background', '#4f4047' ) ) . '; }
			.brnhmbx-menu-button,
			.slicknav_menu a,
			.slicknav_menu a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLink', '#4f4047' ) ) . '; }
			.slicknav_menu a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLink_Hover', '#a06161' ) ) . '; }

			.logo-text a,
			.logo-text a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Logo', '#cd0060' ) ) . '; }
			h1.logo-text { font-size: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_font_size_Logo', '30' ) ) . 'px; }
			.mobile-header h1.logo-text,
			#sticky-menu h1.logo-text { font-size: 25px; }

			';

			if ( !get_theme_mod( 'brnhmbx_bourz_sh_StickyLogo', 1 ) ) { $bourz_css .= '.sticky-logo-outer { margin: 0px; }'; }

			$bourz_css .= '

			.header-menu-outer a,
			.header-menu-outer a:visited,
			.header-menu-outer li.nav-sep { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_HeaderLink', '#FFF' ) ) . '; }
			.header-menu-outer a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_HeaderLink_Hover', '#a06161' ) ) . '; }

			.site-nav2 a,
			.site-nav2 a:visited,
			.btn-to-top,
			.header-social .social-menu-item,
			.brnhmbx-top-search-button,
			.top-search input { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLink', '#4f4047' ) ) . '; }
			.site-nav2 a:hover,
			.btn-to-top:hover,
			.header-social .social-menu-item:hover,
			.brnhmbx-top-search-button:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLink_Hover', '#a06161' ) ) . '; }
			.site-nav2 li ul { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLevel_Background', '#4f4047' ) ) . '; }
			.site-nav2 li ul a,
			.site-nav2 li ul a:visited { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLink_Level', '#FFF' ) ) . '; }
			.site-nav2 li ul a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_MenuLink_Level_Hover', '#a06161' ) ) . '; }

			';

			if ( get_theme_mod( 'brnhmbx_bourz_transparent_Menu_Background', 1 ) ) {

				$bourz_css .= '

				.menu-sticky,
				.mobile-header { background-color: #FFF; }

				.site-top-container,
				.top-search input { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ) . '; }

				';

			} else {

				$bourz_css .= '

				.site-top-container,
				.menu-sticky,
				.top-search input { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Menu_Background', '#4f4047' ) ) . '; }

				';

			}

			if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuPos', 'menu-left' ) == 'menu-left' ) {

				/* Default */

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuPos', 'menu-left' ) == 'menu-center' ) {

				$bourz_css .= '

				.site-top-container { text-align: center; }
				.site-top-container .top-extra-outer { float: none; display: inline-block; margin-left: 30px; }

				';

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuPos', 'menu-left' ) == 'menu-right' ) {

				$bourz_css .= '

				.site-top-container { text-align: right; }
				.site-top-container .top-extra-outer { margin-left: 30px; }

				';

				if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-left' ) {

					$bourz_css .= '

					.site-top-container { position: relative; }
					.site-logo-outer { position: absolute; left: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_menuPaddingLeft', 0 ) ) . 'px; }

					';

				}

			}

			if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-top' || get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-bottom' ) {

				$bourz_css .= '

				.site-logo-outer { display: block; text-align: center; padding: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_logoPaddingTop', 40 ) ) . 'px 0px ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_logoPaddingBottom', 40 ) ) . 'px 0px; background-color:

				';

				if ( get_theme_mod( 'brnhmbx_bourz_transparent_Logo_Background', 1 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Logo_Background', '#4f4047' ) ); }

				$bourz_css .= '; }

				.site-logo-container { display: inline-block;

				';

				if ( get_theme_mod( 'brnhmbx_bourz_text_Banner_Header', '' ) && get_theme_mod( 'brnhmbx_bourz_sh_Banner_Header', 1 ) ) { $bourz_css .= 'float: left;'; }

				$bourz_css .= ' }

				.site-logo-container img { height: auto; }

				.site-logo-left-handler { display: inline-table; vertical-align: middle; margin: 0px; }

				.site-logo-left-handler,
				.top-extra { height: ' . esc_attr( $menuContainerHeight ) . 'px; }
				.site-logo-container img { max-height: ' . esc_attr( $maxLogoHeight ) . 'px; }

				';

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_LogoPos', 'logo-left' ) == 'logo-left' ) {

				$bourz_css .= '

				.site-logo-outer,
				.site-logo-outer-handler { display: inline-table; vertical-align: middle; margin: 0px ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_logoPaddingRight', 40 ) ) . 'px 0px 0px; text-align: left; }
				.site-logo-container { display: table-cell; vertical-align: middle; }
				.site-logo-container img { height: auto; }

				.site-logo-outer,
				.site-logo-outer-handler,
				.top-extra { height: ' . esc_attr( $menuContainerHeight ) . 'px; }
				.site-logo-container img { max-height: ' . esc_attr( $maxLogoHeight ) . 'px; }

				';

			}

			$bourz_css .= '

			.sticky-logo-outer,
			#sticky-menu .top-extra { height: 50px; }

			.site-top-container { padding-left: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_menuPaddingLeft', 0 ) ) . 'px; padding-right: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_menuPaddingRight', 0 ) ) . 'px; }

			';

			if ( get_theme_mod( 'brnhmbx_bourz_sh_BorderedMenu', 0 ) ) {

				$bourz_css .= '

				.site-top-container { border: 2px solid; border-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Menu_Border', '#cd0060' ) ) . '; }

				';

			}

			if ( get_theme_mod( 'brnhmbx_bourz_sh_HeaderBottomPadding', 1 ) ) {

				$bourz_css .= '.site-top { margin-bottom: 20px; }';

				if ( get_theme_mod( 'brnhmbx_bourz_opt_SpotMessages', 'tagline' ) == 'none'  ) { $bourz_css .= 'body { margin-top: 70px; }'; }

			}

			if ( get_theme_mod( 'brnhmbx_bourz_sh_TopLineBottomPadding', 1 ) ) { $bourz_css .= '.top-line-outer { margin-bottom: 20px; }'; }

			if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuWidth', 'boxed' ) == 'boxed' ) {

				$bourz_css .= '

				.site-top { max-width: 1240px; padding: 0 20px 0px 20px; }

				';

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuWidth', 'boxed' ) == 'full' ) {

				$bourz_css .= '

				.site-top { max-width: 100%; padding: 0px; }

				';

			} else if ( get_theme_mod( 'brnhmbx_bourz_opt_MenuWidth', 'boxed' ) == 'full_boxed' ) {

				$bourz_css .= '

				.site-top { max-width: 100%; padding: 0px; }

				.site-top-container { max-width: 1240px; margin: auto; padding-left: 20px; padding-right: 20px; }
				.site-top-container-outer { background-color:

				';

				if ( get_theme_mod( 'brnhmbx_bourz_transparent_Menu_Background', 1 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Background', '#e9e9e9' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Menu_Background', '#4f4047' ) ); }

				$bourz_css .= '; }';

			}

			/* Trigger Slicknav Menu */

			$bourz_css .= '

			@media all and (min-width: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_triggerSlicknav', '960' ) ) . 'px) {

				#site-menu,
				#site-menu-sticky,
				#sticky-menu { display: block; }
				.mobile-header { display: none; }
				.site-top { margin-top: 0px; display: block; }
				body { margin-top: 0px; }

				.spot-messages {
					float: left;
					width: 50%;
				}

				.header-menu-outer {
					float: right;
					width: 50%;
					display: inline;
				}

			}

			';

			/* Slider */

			$bourz_css .= '

			.slider-caption { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Sli_Caption', '#FFF' ) ) . '; }
			.slide-info-inner { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Sli_Header', '#FFF' ) ) . '; }
			.slide-text-outer { border-color: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_BBO', '#FFF' ) ) ) . ',' . esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_Sli_Bor', '100' ) / 100 ) . '); }

			';

			if ( get_theme_mod( 'brnhmbx_bourz_sh_bxCenteredText', 0 ) ) { $bourz_css .= '.slide-text { margin: 0 auto; text-align: center; }'; }

			if ( $brnhmbx_bourz_opt_SliderStyle == 'a' ) {

				$bourz_css .= '

				.slide-text { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_Box', '#4f4047' ) ) ) . ',' . esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_Sli_Box', '50' ) / 100 ) . '); -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
				.slide-a:hover .slide-text { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_Box', '#4f4047' ) ) ) . ', 1); }

				';

			} else if ( $brnhmbx_bourz_opt_SliderStyle == 'b' ) {

				$bourz_css .= '

				.slide-info-2 { max-width: 1280px; }
				.slide-info-outer { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_Box', '#4f4047' ) ) ) . ',' . esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_Sli_Box', '50' ) / 100 ) . '); -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
				.slide-a:hover .slide-info-outer { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_Box', '#4f4047' ) ) ) . ', 0.3); }

				';

			} else if ( $brnhmbx_bourz_opt_SliderStyle == 'c' ) {

				$bourz_css .= '

				.slide-info-2 { max-width: 1200px; }
				.slide-text-outer { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_Box', '#4f4047' ) ) ) . ',' . esc_attr( get_theme_mod( 'brnhmbx_bourz_rng_Sli_Box', '50' ) / 100 ) . '); -webkit-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
				.slide-a:hover .slide-text-outer { background: rgba(' . esc_attr( bourz_hex2rgb( get_theme_mod( 'brnhmbx_bourz_color_Sli_Box', '#4f4047' ) ) ) . ', 1); }

				';

			}

			if ( $brnhmbx_bourz_opt_SliderStyle == 'b' || $brnhmbx_bourz_opt_SliderStyle == 'c' ) {

				if ( $brnhmbx_bourz_opt_bxControls == 'bullet' || $brnhmbx_bourz_opt_bxControls == 'both' ) {

					$bourz_css .= '

					.slide-text-padding-2 { padding-bottom: 45px; }

					';

				} else {

					$bourz_css .= '

					.slide-text-padding-2 { padding-bottom: 15px; }

					';

				}

				$bourz_css .= '

				.slide-container { text-align: left; }
				.slide-info-inner { vertical-align: bottom; }
				.slide-text { max-width: 700px; }

				@media all and (min-width: 480px) {

					.slider-caption { font-size: 16px; line-height: 1.5em; }

				}

				@media all and (min-width: 640px) {

					.slider-header { font-size: 60px; line-height: 1em; }
					.slider-caption { font-size: 20px; line-height: 1.2em; }
					.slide-text-outer { border: none; padding: 0px; margin: 0px; }

				}

				';

			}

			if ( get_theme_mod( 'brnhmbx_bourz_sh_bxDarkControls', 0 ) ) {

				$bourz_css .= '

				.bx-wrapper .bx-prev { background: url(' . get_template_directory_uri() . '/css/images/btn-prev-dark.png) no-repeat; }
				.bx-wrapper .bx-next { background: url(' . get_template_directory_uri() . '/css/images/btn-next-dark.png) no-repeat; }
				.bx-wrapper .bx-pager.bx-default-pager a { background-color: #000; }

				';

			} else {

				$bourz_css .= '

				.bx-wrapper .bx-prev { background: url(' . get_template_directory_uri() . '/css/images/btn-prev.png) no-repeat; }
				.bx-wrapper .bx-next { background: url(' . get_template_directory_uri() . '/css/images/btn-next.png) no-repeat; }
				.bx-wrapper .bx-pager.bx-default-pager a { background-color: #FFF; }

				';

			}

			if ( get_theme_mod( 'brnhmbx_bourz_sh_bxRectanglePagers', 0 ) ) {

				$bourz_css .= '

				.bx-wrapper .bx-pager.bx-default-pager a { width: 40px; height: 6px; }

				';

			} else {

				$bourz_css .= '

				.bx-wrapper .bx-pager.bx-default-pager a { width: 10px; height: 10px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }

				';

			}

			if ( $brnhmbx_bourz_opt_bxPagerPosition_Main == 'left' ) {

				$bourz_css .= '

				.bx-wrapper .bx-pager { text-align: left; padding-left: 20px; }
				.bx-wrapper .bx-pager.bx-default-pager a { text-indent: -9999px; }

				@media all and (min-width: 640px) {

				';

					if ( $brnhmbx_bourz_opt_SliderStyle == 'a' ) {

						$bourz_css .= '

						.bx-pager-outer { max-width: 1240px; }
						.bx-wrapper .bx-pager { padding-left: 35px; }

						';

						if ( $brnhmbx_bourz_opt_SliderPosition == 'full' ) { $bourz_css .= ' .bx-wrapper .bx-pager { padding-left: 15px; } '; }

					} else if ( $brnhmbx_bourz_opt_SliderStyle == 'b' || $brnhmbx_bourz_opt_SliderStyle == 'c' ) {

						$bourz_css .= '

						.bx-pager-outer { max-width: 1200px; }
						.bx-wrapper .bx-pager { padding-left: 35px; }

						';

						if ( $brnhmbx_bourz_opt_SliderStyle == 'b' && $brnhmbx_bourz_opt_SliderPosition == 'full' ) { $bourz_css .= ' .bx-pager-outer { max-width: 1280px; } '; }

					}

				$bourz_css .= '}';

			} else if ( $brnhmbx_bourz_opt_bxPagerPosition_Main == 'center' ) {

				$bourz_css .= '

				.bx-wrapper .bx-pager { text-align: center; }
				.bx-wrapper .bx-pager.bx-default-pager a { text-indent: -9999px; }

				';

			} else if ( $brnhmbx_bourz_opt_bxPagerPosition_Main == 'right' ) {

				$bourz_css .= '

				.bx-wrapper .bx-pager { text-align: right; padding-right: 20px; }
				.bx-wrapper .bx-pager.bx-default-pager a { text-indent: 9999px; }

				@media all and (min-width: 640px) {

				';

					if ( $brnhmbx_bourz_opt_SliderStyle == 'a' ) {

						$bourz_css .= '

						.bx-pager-outer { max-width: 1240px; }
						.bx-wrapper .bx-pager { padding-right: 35px; }

						';

						if ( $brnhmbx_bourz_opt_SliderPosition == 'full' ) { $bourz_css .= ' .bx-wrapper .bx-pager { padding-right: 15px; } '; }

					} else if ( $brnhmbx_bourz_opt_SliderStyle == 'b' || $brnhmbx_bourz_opt_SliderStyle == 'c' ) {

						$bourz_css .= '

						.bx-pager-outer { max-width: 1200px; }
						.bx-wrapper .bx-pager { padding-right: 35px; }

						';

						if ( $brnhmbx_bourz_opt_SliderStyle == 'b' && $brnhmbx_bourz_opt_SliderPosition == 'full' ) { $bourz_css .= ' .bx-pager-outer { max-width: 1280px; } '; }

					}

				$bourz_css .= '}';

			}

			if ( $brnhmbx_bourz_sliderHideMobile == '320' ) {

				$bourz_css .= '

				@media all and (min-width: 320px) { .bourz-slider-container { display: block; } }

				';

			} else if ( $brnhmbx_bourz_sliderHideMobile == '480' ) {

				$bourz_css .= '

				@media all and (min-width: 480px) { .bourz-slider-container { display: block; } }

				';

			} else if ( $brnhmbx_bourz_sliderHideMobile == '640' ) {

				$bourz_css .= '

				@media all and (min-width: 640px) { .bourz-slider-container { display: block; } }

				';

			} else {

				$bourz_css .= '

				.bourz-slider-container { display: block; }

				';

			}

			/* Sidebar, Upper & Home Widgets */

			$bourz_css .= '

			.widget-item h2 { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Title', '#4f4047' ) ) . '; }
			.widget-item .widget-item-opt-hdr { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_OptHdr', '#999' ) ) . '; }

			.widget-item { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Background', '#FFF' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Content', '#777' ) ) . '; }
			.widget-item a { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Link', '#4f4047' ) ) . '; }
			.widget-item a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_LinkHover', '#a06161' ) ) . '; }

			.widget-item .wp-tag-cloud li { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_CatsBackground', '#4f4047' ) ) . '; }
			.widget-item .wp-tag-cloud li a { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_CatsText', '#FFF' ) ) . '; }
			.widget-item .wp-tag-cloud li:hover { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_CatsText', '#FFF' ) ) . '; }
			.widget-item .wp-tag-cloud li:hover a { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_CatsBackground', '#4f4047' ) ) . '; }

			.widget-item input,
			.widget-item textarea,
			.widget-item select { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_InputBackground', '#e9e9e9' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_InputText', '#999' ) ) . '; }

			.widget-item .liner span:before,
			.widget-item .liner span:after { border-bottom-color:

			';

			if ( get_theme_mod( 'brnhmbx_bourz_sh_WidgetLiner', 1 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Title', '#4f4047' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Background', '#FFF' ) ); }

			$bourz_css .= '; }

			.widget-item.zig-zag:after { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_BotSdw', '#d8d1d1' ) ) . '; }

			';

			/* Footer */

			if ( get_theme_mod( 'brnhmbx_bourz_opt_FooterWidgetsWidth', 'boxed' ) == 'boxed' ) { $bourz_css .= '.footer-box-inner { max-width: 1240px; }'; }
			if ( get_theme_mod( 'brnhmbx_bourz_opt_FooterWidth', 'boxed' ) == 'boxed' ) { $bourz_css .= '.footer-bottom { max-width: 1240px; }'; }

			$bourz_css .= '

			.footer-box-outer,
			.footer-widget-area .zig-zag:after { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Background', '#4f4047' ) ) . '; }

			.footer-bottom-outer { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Footer_Background', '#777' ) ) . '; }
			.footer-bottom-outer a,
			.footer-menu-outer li.nav-sep { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Footer_Link', '#FFF' ) ) . '; }
			.footer-bottom-outer a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Footer_Link_Hover', '#d8d1d1' ) ) . '; }
			.footer-text,
			.footer-menu-outer .assign-menu { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Footer_Content', '#FFF' ) ) . '; }

			.widget-item-footer h2 { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Title', '#FFF' ) ) . '; }
			.widget-item-footer .widget-item-opt-hdr { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_OptHdr', '#d8d1d1' ) ) . '; }

			.widget-item-footer { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Content', '#FFF' ) ) . '; }
			.widget-item-footer a { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Link', '#FFF' ) ) . '; }
			.widget-item-footer a:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_LinkHover', '#a06161' ) ) . '; }

			.widget-item-footer .wp-tag-cloud li { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_CatsBackground', '#d8d1d1' ) ) . '; }
			.widget-item-footer .wp-tag-cloud li a { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_CatsText', '#4f4047' ) ) . '; }
			.widget-item-footer .wp-tag-cloud li:hover { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_CatsText', '#4f4047' ) ) . '; }
			.widget-item-footer .wp-tag-cloud li:hover a { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_CatsBackground', '#d8d1d1' ) ) . '; }

			.widget-item-footer input,
			.widget-item-footer textarea,
			.widget-item-footer select { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_InputBackground', '#e9e9e9' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_InputText', '#999' ) ) . '; }

			.widget-item-footer .liner span:before,
			.widget-item-footer .liner span:after { border-bottom-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Title', '#FFF' ) ) . '; }

			.widget-item-footer .liner span:before,
			.widget-item-footer .liner span:after { border-bottom-color:

			';

			if ( get_theme_mod( 'brnhmbx_bourz_sh_WidgetLiner', 1 ) ) { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Title', '#FFF' ) ); } else { $bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Background', '#4f4047' ) ); }

			$bourz_css .= '; }

			.instagram-label { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_CatsBackground', '#d8d1d1' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_CatsText', '#4f4047' ) ) . '; }

			';

			/* Banner Management */

			if ( $brnhmbx_bourz_opt_ResponsiveBannerHide == '480' ) {

				$bourz_css .= '

				@media all and (min-width: 480px) { .leaderboard-responsive.leaderboard-full { display: block; } }
				@media all and (min-width: 800px) { .leaderboard-responsive.leaderboard-among { display: block; } }

				';

			} else if ( $brnhmbx_bourz_opt_ResponsiveBannerHide == '640' ) {

				$bourz_css .= '

				@media all and (min-width: 640px) { .leaderboard-responsive.leaderboard-full { display: block; } }
				@media all and (min-width: 960px) { .leaderboard-responsive.leaderboard-among { display: block; } }

				';

			} else if ( $brnhmbx_bourz_opt_ResponsiveBannerHide == '800' ) {

				$bourz_css .= '

				@media all and (min-width: 800px) { .leaderboard-responsive.leaderboard-full { display: block; } }
				@media all and (min-width: 1120px) { .leaderboard-responsive.leaderboard-among { display: block; } }

				';

			} else if ( $brnhmbx_bourz_opt_ResponsiveBannerHide == '960' ) {

				$bourz_css .= '

				@media all and (min-width: 960px) { .leaderboard-responsive.leaderboard-full { display: block; } }
				@media all and (min-width: 1280px) { .leaderboard-responsive.leaderboard-among { display: block; } }

				';

			} else {

				$bourz_css .= '

				.leaderboard-responsive.leaderboard-full,
				.leaderboard-responsive.leaderboard-among { display: block; }

				';

			}

			/* Mail Chimp */

			$bourz_css .= '

			.mc4wp-form input[type="submit"] { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; }
			.mc4wp-form input[type="submit"]:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' ) ) . '; background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' ) ) . '; }

			.widget-item .mc4wp-form input[type="submit"] { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Link', '#4f4047' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Background', '#FFF' ) ) . '; }
			.widget-item .mc4wp-form input[type="submit"]:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Link', '#4f4047' ) ) . '; background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_W_Background', '#FFF' ) ) . '; }

			.widget-item-footer .mc4wp-form input[type="submit"] { background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_LinkHover', '#a06161' ) ) . '; color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Link', '#FFF' ) ) . '; }
			.widget-item-footer .mc4wp-form input[type="submit"]:hover { color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_LinkHover', '#a06161' ) ) . '; background-color: ' . esc_attr( get_theme_mod( 'brnhmbx_bourz_color_WF_Link', '#FFF' ) ) . '; }

			';

			/* Woo Commerce */

			if ( function_exists( 'WC' ) ) {

			$brnhmbx_color_Standard_Background = get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' );
			$brnhmbx_color_Standard_Content = get_theme_mod( 'brnhmbx_bourz_color_Standard_Content', '#777' );
			$brnhmbx_color_Standard_Header = get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' );
			$brnhmbx_color_Standard_DCB = get_theme_mod( 'brnhmbx_bourz_color_Standard_DCB', '#999' );
			$brnhmbx_color_Standard_RMB = get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' );
			$brnhmbx_color_Standard_RMT = get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' );
			$brnhmbx_color_Standard_Link = get_theme_mod( 'brnhmbx_bourz_color_Standard_Link', '#a06161' );
			$brnhmbx_color_Standard_InputText = get_theme_mod( 'brnhmbx_bourz_color_Standard_InputText', '#999' );
			$brnhmbx_color_Standard_InputBackground = get_theme_mod( 'brnhmbx_bourz_color_Standard_InputBackground', '#e9e9e9' );

			$bourz_css .= '

			.brnhmbx-wc-outer {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_Background ) . ';
				color: ' . esc_attr( $brnhmbx_color_Standard_Content ) . ';
			}

			.brnhmbx-wc-outer h1,
			.brnhmbx-wc-outer h2,
			.brnhmbx-wc-outer h3,
			.star-rating,
			p.stars span a,
			.amount,
			.price ins,
			.products li a h3,
			.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong[itemprop="author"] {
				color: ' . esc_attr( $brnhmbx_color_Standard_Header ) . ';
			}

			a.woocommerce-review-link,
			a.woocommerce-review-link:visited,
			.woocommerce-result-count {
				color: ' . esc_attr( $brnhmbx_color_Standard_DCB ) . ';
			}

			.woocommerce .woocommerce-error,
			.woocommerce .woocommerce-info,
			.woocommerce .woocommerce-message {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			.button.add_to_cart_button.product_type_variable,
			.button.add_to_cart_button.product_type_simple,
			button.single_add_to_cart_button.button.alt,
			.woocommerce .woocommerce-message a.button,
			.woocommerce .woocommerce-message a.button:visited,
			.woocommerce #review_form #respond .form-submit input.submit,
			ul.products li a.added_to_cart.wc-forward,
			.woo-p-widget a.added_to_cart.wc-forward,
			.woo-p-widget .product_type_simple {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_RMB ) . ';
				color: ' . esc_attr( $brnhmbx_color_Standard_RMT ) . ';
			}

			.woo-p-widget .product_type_simple {
				color: ' . esc_attr( $brnhmbx_color_Standard_RMT ) . ' !important;
			}

			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_RMB ) . ' !important;
				color: ' . esc_attr( $brnhmbx_color_Standard_RMT ) . ' !important;
			}

			.button.add_to_cart_button.product_type_variable:hover,
			.button.add_to_cart_button.product_type_simple:hover,
			button.single_add_to_cart_button.button.alt:hover,
			.woocommerce .woocommerce-message a.button:hover,
			.woocommerce #review_form #respond .form-submit input.submit:hover,
			ul.products li a.added_to_cart.wc-forward:hover,
			.woo-p-widget a.added_to_cart.wc-forward:hover,
			.woo-p-widget .product_type_simple:hover {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_RMT ) . ' !important;
				color: ' . esc_attr( $brnhmbx_color_Standard_RMB ) . ' !important;
				opacity: 1;
			}

			.woocommerce #respond input#submit:hover,
			.woocommerce a.button:hover,
			.woocommerce button.button:hover,
			.woocommerce input.button:hover {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_RMT ) . ' !important;
				color: ' . esc_attr( $brnhmbx_color_Standard_RMB ) . ' !important;
				opacity: 1;
			}

			.price del,
			a .price del,
			.price del span.amount {
				color: ' . esc_attr( $brnhmbx_color_Standard_Header ) . ' !important;
			}

			.posted_in a,
			.posted_in a:visited,
			.tagged_as a,
			.tagged_as a:visited {
				color: ' . esc_attr( $brnhmbx_color_Standard_DCB ) . ';
			}

			.woocommerce span.onsale {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_RMB ) . ';
				color: ' . esc_attr( $brnhmbx_color_Standard_RMT ) . ';
			}

			.woocommerce a.reset_variations,
			.woocommerce a.reset_variations:visited,
			.woocommerce a.shipping-calculator-button,
			.woocommerce a.shipping-calculator-button:visited,
			.woocommerce a.woocommerce-remove-coupon,
			.woocommerce a.woocommerce-remove-coupon:visited,
			p.stock.out-of-stock,
			p.stock.in-stock,
			.woocommerce a.edit,
			.woocommerce a.edit:visited,
			div.price_slider_amount button {
				color: ' . esc_attr( $brnhmbx_color_Standard_Link ) . ';
			}

			.woocommerce div.product .woocommerce-tabs ul.tabs:before {
				border-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			.woocommerce div.product .woocommerce-tabs ul.tabs li {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
				border-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a:visited,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
				font-weight: normal;
				color: ' . esc_attr( $brnhmbx_color_Standard_InputText ) . ';
			}

			.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_Background ) . ';
				color: ' . esc_attr( $brnhmbx_color_Standard_Header ) . ';
			}

			.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta time[itemprop="datePublished"],
			.woocommerce #respond label,
			.woocommerce p.form-row label {
				color: ' . esc_attr( $brnhmbx_color_Standard_DCB ) . ';
			}

			.woocommerce #reviews #comments ol.commentlist li .comment-text div.description {
				border-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			.order-info mark {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			.select2-results {
				color: ' . esc_attr( $brnhmbx_color_Standard_Content ) . ';
			}

			.select2-results .select2-highlighted {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
				color: ' . esc_attr( $brnhmbx_color_Standard_Content ) . ';
			}

			.woocommerce-checkout #payment{
				background: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			.woocommerce-message a {
				color: ' . esc_attr( $brnhmbx_color_Standard_Link ) . ';
			}

			';

			/* Price Filter Widget */

			$bourz_css .= '

			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_Link ) . ';
			}

			.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {
				background-color: ' . esc_attr( $brnhmbx_color_Standard_InputBackground ) . ';
			}

			';

			}

			/* UPPERCASE */

			if ( get_theme_mod( 'brnhmbx_bourz_Uppercase', '1' ) ) {

			$bourz_css .= '

			.slider-date,
			.wp-tag-cloud li a,
			.rss-date,
			.listing-date,
			.listing-date-z,
			.social-menu-item span,
			.share-icon-outer,
			.page-navi-next-info,
			.page-navi-prev-info,
			.comment-date,
			.wp-caption-text,
			.author-bar-date-views,
			input[type="submit"],
			.filter-bar,
			.button.add_to_cart_button.product_type_variable,
			.button.add_to_cart_button.product_type_simple,
			button.single_add_to_cart_button.button.alt,
			.woocommerce .woocommerce-message a.button,
			.woocommerce .woocommerce-message a.button:visited,
			.woocommerce #review_form #respond .form-submit input.submit,
			ul.products li a.added_to_cart.wc-forward,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woo-p-widget a.added_to_cart.wc-forward,
			.woo-p-widget .product_type_simple,
			.woocommerce div.product .woocommerce-tabs ul.tabs li,
			.author-avatar,
			.author-links { text-transform: uppercase; }

			';

			}

			/* Fonts */

				$bourz2017_font_primary = get_theme_mod( 'brnhmbx_bourz_font_1', 'Palanquin' );
				$bourz2017_font_secondary = get_theme_mod( 'brnhmbx_bourz_font_2', 'PT_Serif' );
				$bourz2017_font_tertiary = get_theme_mod( 'brnhmbx_bourz_font_3', 'Palanquin' );
				$bourz2017_font_quaternary = get_theme_mod( 'brnhmbx_bourz_font_4', 'Karla' );

				$brnhmbx_bourz_font_Logo = '';
				if ( !get_theme_mod( 'brnhmbx_bourz_upload_Logo' ) ) { $brnhmbx_bourz_font_Logo =  get_theme_mod( 'brnhmbx_bourz_font_Logo', 'Montserrat' ); }

				foreach ( bourz_font_labels() as $key => $val ) {
					$add_underscore = str_replace( ' ', '_', $key );
					if ( $add_underscore == $bourz2017_font_primary ) { $font_primary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
					if ( $add_underscore == $bourz2017_font_secondary ) { $font_secondary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
					if ( $add_underscore == $bourz2017_font_tertiary ) { $font_tertiary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
					if ( $add_underscore == $bourz2017_font_quaternary ) { $font_quaternary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
					if ( $add_underscore == $brnhmbx_bourz_font_Logo ) { $font_for_logo = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ' !important;'; }
				}

			$bourz_css .= '

			.brnhmbx-font-1,

			';

			if( get_theme_mod( 'brnhmbx_bourz_swiFont_Menu', 'brnhmbx-font-1' ) == 'brnhmbx-font-1' ) { $bourz_css .= '.footer-nav, '; }

			$bourz_css .= '.comment-reply-title, input[type="submit"], .widget_mc4wp_form_widget, .widget_categories .widget-item-inner, .widget_archive .widget-item-inner, .widget_calendar .widget-item-inner, .widget_nav_menu .widget-item-inner, .widget_meta .widget-item-inner, .widget_pages .widget-item-inner, .widget_recent_comments .widget-item-inner, .widget_recent_entries .widget-item-inner, .widget_search .widget-item-inner, .widget_tag_cloud .widget-item-inner, .widget_text .widget-item-inner, .widget_rss .widget-item-inner, p.comment-form-cookies-consent label[for="wp-comment-cookies-consent"] {
				' . wp_kses_post( $font_primary ) . '
			}

			.brnhmbx-font-2,

			';

			if( get_theme_mod( 'brnhmbx_bourz_swiFont_Menu', 'brnhmbx-font-1' ) == 'brnhmbx-font-2' ) { $bourz_css .= '.footer-nav, '; }

			$bourz_css .= '.widget_rss cite, blockquote {
				' . wp_kses_post( $font_secondary ) . '
			}

			.brnhmbx-font-3,

			';

			if( get_theme_mod( 'brnhmbx_bourz_swiFont_Menu', 'brnhmbx-font-1' ) == 'brnhmbx-font-3' ) { $bourz_css .= '.footer-nav, '; }

			$bourz_css .= '.comment-form input, .comment-form textarea, .comment-form p.comment-subscription-form {
				' . wp_kses_post( $font_tertiary ) . '
			}

			.brnhmbx-font-4,

			';

			if( get_theme_mod( 'brnhmbx_bourz_swiFont_Menu', 'brnhmbx-font-1' ) == 'brnhmbx-font-4' ) { $bourz_css .= '.footer-nav, '; }

			$bourz_css .= '.rss-date, .wpcf7-form p {
				' . wp_kses_post( $font_quaternary ) . '
			}

			';

			if ( function_exists( 'WC' ) ) {

			$bourz_css .= '

			.woocommerce h1,
			.woocommerce h2,
			.button.add_to_cart_button.product_type_variable,
			.button.add_to_cart_button.product_type_simple,
			button.single_add_to_cart_button.button.alt,
			.woocommerce .woocommerce-message a.button,
			.woocommerce .woocommerce-message a.button:visited,
			.woocommerce #review_form #respond .form-submit input.submit,
			ul.products li a.added_to_cart.wc-forward,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woo-p-widget a.added_to_cart.wc-forward,
			.woo-p-widget .product_type_simple,
			.woocommerce div.product .woocommerce-tabs ul.tabs li {
				' . wp_kses_post( $font_primary ) . '
			}

			.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong[itemprop="author"], .woocommerce .term-description {
				' . wp_kses_post( $font_secondary ) . '
			}

			';

			}

			if ( $brnhmbx_bourz_font_Logo ) {

				$bourz_css .= '

				.logo-text {
					' . wp_kses_post( $font_for_logo ) . '
				}

				';

			}

			if ( !get_theme_mod( 'brnhmbx_bourz_font_1_italic', 1 ) ) { $bourz_css .= '.brnhmbx-font-1.fst-italic { font-style: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_1_bold', 1 ) ) { $bourz_css .= '.brnhmbx-font-1.fw700 { font-weight: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_2_italic', 1 ) ) { $bourz_css .= '.brnhmbx-font-2.fst-italic { font-style: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_2_bold', 1 ) ) { $bourz_css .= '.brnhmbx-font-2.fw700 { font-weight: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_3_italic', 1 ) ) { $bourz_css .= '.brnhmbx-font-3.fst-italic { font-style: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_3_bold', 1 ) ) { $bourz_css .= '.brnhmbx-font-3.fw700 { font-weight: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_4_italic', 1 ) ) { $bourz_css .= '.brnhmbx-font-4.fst-italic { font-style: normal; }'; }
			if ( !get_theme_mod( 'brnhmbx_bourz_font_4_bold', 1 ) ) { $bourz_css .= '.brnhmbx-font-4.fw700 { font-weight: normal; }'; }

			/* Gutenberg */

			$bourz_color_Standard_Background = get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' );
			$bourz_color_Standard_Content = get_theme_mod( 'brnhmbx_bourz_color_Standard_Content', '#777' );
			$bourz_color_Standard_Title = get_theme_mod( 'brnhmbx_bourz_color_Standard_Header_Post', '#4f4047' );
			$bourz_color_Standard_TitleBackground = get_theme_mod( 'brnhmbx_bourz_color_Standard_PostBackground', '#d8d1d1' );
			$bourz_color_Standard_DCB = get_theme_mod( 'brnhmbx_bourz_color_Standard_DCB', '#999' );

			$bourz_css .= '

			.wp-block-pullquote { border-color: ' . esc_attr( $bourz_color_Standard_Title ) . '; }
			.wp-block-pullquote.is-style-default { background-color: ' . esc_attr( $bourz_color_Standard_TitleBackground ) . '; }

			.wp-block-verse { ' . wp_kses_post( $font_secondary ) . '; }

			.wp-block-image figcaption,
			.wp-block-embed figcaption,
			.wp-block-audio figcaption,
			.wp-block-video figcaption,
			.wp-block-latest-posts time { color: ' . esc_attr( $bourz_color_Standard_DCB ) . '; }

			.wp-block-table td,
			.wp-block-separator { border-color: ' . esc_attr( $bourz_color_Standard_DCB ) . '; }

			.wp-block-media-text { color: ' . esc_attr( $bourz_color_Standard_Title ) . '; }

			.wp-block-verse,
			.wp-block-code,
			.wp-block-preformatted { background-color: ' . esc_attr( $bourz_color_Standard_Background ) . '; color: ' . esc_attr( $bourz_color_Standard_Content ) . '; }

			';

			/* User Logged In */
			if ( is_admin_bar_showing() ) {

				$bourz_css .= '

				.mobile-header { top: 45px; }
				@media all and (min-width: 783px) { .mobile-header { top: 32px; } }

				';

			}

			$bourz_css .= esc_attr( get_theme_mod( 'brnhmbx_bourz_text_CSS', '' ) );

			return $bourz_css;

	}
}
/* */

/* Output Gutenberg Editor Inline Styles */
if ( !function_exists( 'bourz_rewrite_gutenberg_editor_css' ) ) {
	function bourz_rewrite_gutenberg_editor_css() {

		$bourz_color_Standard_Background = get_theme_mod( 'brnhmbx_bourz_color_Standard_Background', '#FFF' );
		$bourz_color_Standard_Content = get_theme_mod( 'brnhmbx_bourz_color_Standard_Content', '#777' );
		$bourz_color_Standard_Header = get_theme_mod( 'brnhmbx_bourz_color_Standard_Header', '#4f4047' );
		$bourz_color_Standard_Link = get_theme_mod( 'brnhmbx_bourz_color_Standard_Link', '#a06161' );
		$bourz_color_Standard_Link_Hover = get_theme_mod( 'brnhmbx_bourz_color_Standard_Link_Hover', '#cd0060' );
		$bourz_color_Standard_InputText = get_theme_mod( 'brnhmbx_bourz_color_Standard_InputText', '#999' );
		$bourz_color_Standard_InputBackground = get_theme_mod( 'brnhmbx_bourz_color_Standard_InputBackground', '#e9e9e9' );
		$bourz_color_Standard_Title = get_theme_mod( 'brnhmbx_bourz_color_Standard_Header_Post', '#4f4047' );
		$bourz_color_Standard_TitleBackground = get_theme_mod( 'brnhmbx_bourz_color_Standard_PostBackground', '#d8d1d1' );
		$bourz_color_Standard_DCB = get_theme_mod( 'brnhmbx_bourz_color_Standard_DCB', '#999' );

		$bourz2017_font_primary = get_theme_mod( 'brnhmbx_bourz_font_1', 'Palanquin' );
		$bourz2017_font_secondary = get_theme_mod( 'brnhmbx_bourz_font_2', 'PT_Serif' );
		$bourz2017_font_tertiary = get_theme_mod( 'brnhmbx_bourz_font_3', 'Palanquin' );
		$bourz2017_font_quaternary = get_theme_mod( 'brnhmbx_bourz_font_4', 'Karla' );

		foreach ( bourz_font_labels() as $key => $val ) {
			$add_underscore = str_replace( ' ', '_', $key );
			if ( $add_underscore == $bourz2017_font_primary ) { $font_primary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
			if ( $add_underscore == $bourz2017_font_secondary ) { $font_secondary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
			if ( $add_underscore == $bourz2017_font_tertiary ) { $font_tertiary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
			if ( $add_underscore == $bourz2017_font_quaternary ) { $font_quaternary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
		}

		$gutenberg_editor_css = '

			.editor-writing-flow .editor-post-title__input {
				' . wp_kses_post( $font_primary ) . '
			}

			.editor-writing-flow,
			.editor-writing-flow textarea,
			.editor-writing-flow select,
			.editor-writing-flow input[type="text"],
			.editor-writing-flow h1,
			.editor-writing-flow h2,
			.editor-writing-flow h3,
			.editor-writing-flow h4,
			.editor-writing-flow h5,
			.editor-writing-flow h6,
			.editor-writing-flow .wp-block-cover .wp-block-cover-text,
			.editor-writing-flow .wp-block-media-text,
			.editor-writing-flow .wp-block-archives select,
			.editor-writing-flow .wp-block-categories select {
				' . wp_kses_post( $font_tertiary ) . '
			}

			.editor-writing-flow .wp-block-verse pre,
			.editor-writing-flow .wp-block-quote,
			.editor-writing-flow .wp-block-pullquote,
			.editor-writing-flow .wp-block-quote .wp-block-quote__citation,
			.editor-writing-flow .wp-block-pullquote .wp-block-pullquote__citation {
				' . wp_kses_post( $font_secondary ) . '
			}

			.edit-post-visual-editor { background-color: ' . esc_attr( $bourz_color_Standard_Background ) . '; }
			.editor-writing-flow,
			.editor-writing-flow pre { color: ' . esc_attr( $bourz_color_Standard_Content ) . '; }
			.editor-writing-flow .editor-post-title__input { color: ' . esc_attr( $bourz_color_Standard_Title ) . '; }
			.editor-writing-flow h1,
			.editor-writing-flow h2,
			.editor-writing-flow h3,
			.editor-writing-flow h4,
			.editor-writing-flow h5,
			.editor-writing-flow h6 { color: ' . esc_attr( $bourz_color_Standard_Header ) . '; }
			.editor-writing-flow .wp-block-image figcaption,
			.editor-writing-flow .wp-block-embed figcaption,
			.editor-writing-flow .wp-block-audio figcaption,
			.editor-writing-flow .wp-block-video figcaption,
			.editor-writing-flow .wp-block-latest-posts time,
			.editor-writing-flow .wp-block-latest-comments time { color: ' . esc_attr( $bourz_color_Standard_DCB ) . '; }
			.editor-writing-flow .wp-block-quote,
			.editor-writing-flow .wp-block-quote .wp-block-quote__citation,
			.editor-writing-flow .wp-block-pullquote { border-color: ' . esc_attr( $bourz_color_Standard_Title ) . '; color: ' . esc_attr( $bourz_color_Standard_Title ) . '; background-color: ' . esc_attr( $bourz_color_Standard_TitleBackground ) . '; }
			.editor-writing-flow .wp-block-table td,
			.editor-writing-flow .wp-block-separator { border-color: ' . esc_attr( $bourz_color_Standard_DCB ) . '; }
			.editor-writing-flow .wp-block-code textarea { background-color: ' . esc_attr( $bourz_color_Standard_Background ) . '; color: ' . esc_attr( $bourz_color_Standard_Content ) . '; }
			.editor-writing-flow .wp-block-archives select,
			.editor-writing-flow .wp-block-categories select { background-color: ' . esc_attr( $bourz_color_Standard_InputBackground ) . '; color: ' . esc_attr( $bourz_color_Standard_InputText ) . '; }
			.editor-writing-flow a { color: ' . esc_attr( $bourz_color_Standard_Link ) . '; }
			.editor-writing-flow a:hover { color: ' . esc_attr( $bourz_color_Standard_Link_Hover ) . '; }
			.editor-writing-flow .wp-block-media-text { color: ' . esc_attr( $bourz_color_Standard_Title ) . '; }

		';

		return $gutenberg_editor_css;

	}
}
/* */
