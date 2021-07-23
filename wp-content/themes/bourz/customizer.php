<?php
/* Customize Appearance Options */
function bourz_customizeAppearance( $wp_customize ) {

	/* Custom Text Area Control in Customizer */
	class bourz_customTextAreaControl extends WP_Customize_Control {

		public $type = 'textarea';

		public function render_content() { ?>
			<label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="8" style="width: 100%; resize: none;" <?php esc_url( $this->link() ); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php }

	}
	/* */

	/* Font Selector */
	class bourz_font_selector extends WP_Customize_Control {

			public $type = 'select';

			public function render_content() { ?>

				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
					<select <?php $this->link(); ?>>
                    	<?php
						foreach ( bourz_font_labels() as $key => $val ) {
							$add_underscore = str_replace( ' ', '_', $key ); ?>
							<option value="<?php echo esc_attr( $add_underscore ); ?>" <?php if( $this->value() == $add_underscore ) echo 'selected="selected"'; ?>><?php echo esc_attr( $key ); ?></option>
						<?php } ?>
					</select>
				</label>

			<?php }

	}
	/* */

	/* BRNHMBX Font Switcher */
	class bourz_FontSwitcher extends WP_Customize_Control {

		public $type = 'select';

		public function render_content() { ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div style="margin-bottom: 10px;"><em><?php echo esc_html( $this->description ); ?></em></div>
                <select <?php $this->link(); ?> style="width: 100%;">
                	<option value="brnhmbx-font-1" <?php if( $this->value() == 'brnhmbx-font-1' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Primary Font' ); ?></option>
                    <option value="brnhmbx-font-2" <?php if( $this->value() == 'brnhmbx-font-2' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Secondary Font' ); ?></option>
                    <option value="brnhmbx-font-3" <?php if( $this->value() == 'brnhmbx-font-3' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Tertiary Font' ); ?></option>
                    <option value="brnhmbx-font-4" <?php if( $this->value() == 'brnhmbx-font-4' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Quaternary Font' ); ?></option>
                </select>
            </label>

		<?php }

	}
	/* */

	/* BRNHMBX Banner Placement */
	class bourz_BannerPlacement extends WP_Customize_Control {

		public $type = 'select';

		public function render_content() { ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div style="margin-bottom: 10px;"><em><?php echo esc_html( $this->description ); ?></em></div>
                <select <?php $this->link(); ?> style="width: 100%;">
                	<option value="hidden" <?php if( $this->value() == 'hidden' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Hidden' ); ?></option>
                    <option value="above-full-slider" <?php if( $this->value() == 'above-full-slider' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Above Slider' ); ?></option>
                    <option value="below-cover-slider" <?php if( $this->value() == 'below-cover-slider' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Below Slider' ); ?></option>
                    <option value="above-among-slider" <?php if( $this->value() == 'above-among-slider' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Above Slider (Among the Posts)' ); ?></option>
                    <option value="below-among-slider" <?php if( $this->value() == 'below-among-slider' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Below Slider (Among the Posts)' ); ?></option>
                    <option value="below-upper-widgets" <?php if( $this->value() == 'below-upper-widgets' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Below Upper Widgets' ); ?></option>
                    <option value="after-first-post" <?php if( $this->value() == 'after-first-post' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'After First Post' ); ?></option>
                    <option value="below-blog-posts" <?php if( $this->value() == 'below-blog-posts' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Below Blog Posts' ); ?></option>
                    <option value="below-home-widgets" <?php if( $this->value() == 'below-home-widgets' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Below Home Widgets' ); ?></option>
                    <option value="above-post" <?php if( $this->value() == 'above-post' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Post Pages (Above the Post)' ); ?></option>
                    <option value="below-post" <?php if( $this->value() == 'below-post' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Post Pages (Below the Post)' ); ?></option>
                    <option value="below-post-comments" <?php if( $this->value() == 'below-post-comments' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Post Pages (Below Post Comments)' ); ?></option>
                    <option value="above-page" <?php if( $this->value() == 'above-page' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Pages (Above the Page)' ); ?></option>
                    <option value="below-page" <?php if( $this->value() == 'below-page' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Pages (Below the Page)' ); ?></option>
                    <option value="below-page-comments" <?php if( $this->value() == 'below-page-comments' ) echo 'selected="selected"'; ?>><?php echo esc_html( 'Pages (Below Page Comments)' ); ?></option>
                </select>
            </label>

		<?php }

	}
	/* */

	/* Sanitizers */
	function bourz_get_font_list() {
		$font_list = array();
		foreach ( bourz_font_labels() as $key => $val ) {
			$add_underscore = str_replace( ' ', '_', $key );
			$font_list[] = esc_attr( $add_underscore );
		}
		return $font_list;
	}

	function bourz_sanitize_select( $input ) {
		$current_font_list = bourz_get_font_list();
    return ( in_array( $input, $current_font_list ) ? $input : 'null' );
	}

	function bourz_get_banner_positions() {
		if ( function_exists( 'bourz_banner_positions' ) ) {
			$banner_position_list = array();
			foreach ( bourz_banner_positions() as $key ) {
				$banner_position_list[] = esc_attr( $key );
			}
			return $banner_position_list;
		} else {
			return 0;
		}
	}

	function bourz_sanitize_banner_positions( $input ) {
		if ( function_exists( 'bourz_banner_positions' ) ) {
			$banner_positions = bourz_get_banner_positions();
	    return ( in_array( $input, $banner_positions ) ? $input : 'null' );
		} else {
			return 0;
		}
	}

	function bourz_get_font_switchers() {
		$banner_switchers_list = array();
		foreach ( bourz_font_switchers() as $key ) {
			$banner_switchers_list[] = esc_attr( $key );
		}
		return $banner_switchers_list;
	}

	function bourz_sanitize_font_switchers( $input ) {
		$banner_switchers = bourz_get_font_switchers();
    return ( in_array( $input, $banner_switchers ) ? $input : 'null' );
	}

	function bourz_sanitize_file( $file, $setting ) {
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png'
    );
    $file_ext = wp_check_filetype( $file, $mimes );
    return ( $file_ext['ext'] ? $file : $setting->default );
  }

	function bourz_sanitize_null( $input ) {
		return 0;
	}

	function bourz_sanitize_let_html( $input ) {
		return force_balance_tags( wp_kses_post( $input ) );
	}

	function bourz_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function bourz_sanitize_choices( $input, $setting ) {
		global $wp_customize;
		$control = $wp_customize->get_control( $setting->id );
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}

	function bourz_sanitize_integer( $input ) {
		if( is_numeric( $input ) ) {
			return intval( $input );
		}
	}
	/* */

	/* Allowed HTML */
	$bourz_allowed_html = array(
			'a' => array(
				'href' => array(),
				'target' => array(),
		),
		'span' => array(
			'class' => array(),
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'hr' => array(),
	);
	/* */

	////////////////////////////////////////////////////
	/*/////////////////// SECTIONS ///////////////////*/
	////////////////////////////////////////////////////

	$wp_customize->add_section( 'brnhmbx_bourz_sectionFeaturedImage', array(
		'title' => esc_html__( '1. Featured Image Settings', 'bourz' ),
		'priority' => 0,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionFonts', array(
		'title' => esc_html__( '2. Font Settings', 'bourz' ),
		'priority' => 3,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionBackground', array(
		'title' => esc_html__( '3. Site Background', 'bourz' ),
		'priority' => 5,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionHeader', array(
		'title' => esc_html__( '4. Header', 'bourz' ),
		'priority' => 10,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionSlider', array(
		'title' => esc_html__( '5. Slider Settings', 'bourz' ),
		'priority' => 15,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionHomeWidgets', array(
		'title' => esc_html__( '6. Sidebar, Upper & Home Widgets', 'bourz' ),
		'priority' => 20,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionLayout', array(
		'title' => esc_html__( '7. Layout Options', 'bourz' ),
		'priority' => 25,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionPostColors', array(
		'title' => esc_html__( '8. Post & Page Colors', 'bourz' ),
		'priority' => 30,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionPostFormatStandard', array(
		'title' => esc_html__( '9. Post Format: Standard', 'bourz' ),
		'priority' => 35,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionPostFormatGallery', array(
		'title' => esc_html__( '10. Post Format: Gallery', 'bourz' ),
		'priority' => 40,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionPostFormatVideo', array(
		'title' => esc_html__( '11. Post Format: Video', 'bourz' ),
		'priority' => 45,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionRP', array(
		'title' => esc_html__( '12. Related Posts', 'bourz' ),
		'priority' => 50,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionPC', array(
		'title' => esc_html__( '13. Post & Page Comments', 'bourz' ),
		'priority' => 55,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionFooter', array(
		'title' => esc_html__( '14. Footer', 'bourz' ),
		'priority' => 60,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionFooterWidgets', array(
		'title' => esc_html__( '15. Footer Widgets', 'bourz' ),
		'priority' => 65,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionShowHide', array(
		'title' => esc_html__( '16. Show/Hide Elements', 'bourz' ),
		'priority' => 70,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionSocial', array(
		'title' => esc_html__( '17. Social Accounts', 'bourz' ),
		'description' => wp_kses( __( 'Write the entire URL addresses.<br>Leave blank if not preferred.', 'bourz' ), $bourz_allowed_html ),
		'priority' => 75,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionGoogleMaps', array(
		'title' => esc_html__( '18. Google Maps', 'bourz' ),
		'priority' => 80,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionTranslation', array(
		'title' => esc_html__( '19. Translation', 'bourz' ),
		'priority' => 85,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionBanner', array(
		'title' => esc_html__( '20. Banner Management', 'bourz' ),
		'priority' => 90,
	) );

	$wp_customize->add_section( 'brnhmbx_bourz_sectionCSS', array(
		'title' => esc_html__( '21. Custom CSS', 'bourz' ),
		'description' => esc_html__( 'Write your CSS code to override styles.', 'bourz' ),
		'priority' => 95,
	) );

	////////////////////////////////////////////////////
	/*/////////////////// SETTINGS ///////////////////*/
	////////////////////////////////////////////////////

	/* Featured Image Settings */
	if ( !function_exists( 'wp_site_icon' ) ) {
		$wp_customize->add_setting( 'brnhmbx_bourz_upload_Favicon', array( 'sanitize_callback' => 'bourz_sanitize_file' ) );
	}
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_1', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_imageWidth', array( 'default' => 1200, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_imageHeight', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_HomeImg_Standard', array( 'default' => 'home', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_thumbnailImageWidth', array( 'default' => 600, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_thumbnailImageHeight', array( 'default' => 400, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	/* */

	/* Font Settings */
	$wp_customize->add_setting( 'brnhmbx_bourz_Uppercase', array( 'default' => '1', 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_1', array( 'default' => 'Palanquin', 'sanitize_callback' => 'bourz_sanitize_select' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_1_italic', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_1_bold', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_2', array( 'default' => 'PT_Serif', 'sanitize_callback' => 'bourz_sanitize_select' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_2_italic', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_2_bold', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_3', array( 'default' => 'Palanquin', 'sanitize_callback' => 'bourz_sanitize_select' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_3_italic', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_3_bold', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_4', array( 'default' => 'Karla', 'sanitize_callback' => 'bourz_sanitize_select' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_4_italic', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_4_bold', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_10', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_swiFont_Menu', array( 'default' => 'brnhmbx-font-1', 'sanitize_callback' => 'bourz_sanitize_font_switchers' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_swiFont_HLT', array( 'default' => 'brnhmbx-font-2', 'sanitize_callback' => 'bourz_sanitize_font_switchers' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_swiFont_HAT', array( 'default' => 'brnhmbx-font-1', 'sanitize_callback' => 'bourz_sanitize_font_switchers' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_swiFont_HAE', array( 'default' => 'brnhmbx-font-2', 'sanitize_callback' => 'bourz_sanitize_font_switchers' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_swiFont_PostNav', array( 'default' => 'brnhmbx-font-1', 'sanitize_callback' => 'bourz_sanitize_font_switchers' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_swiFont_RP', array( 'default' => 'brnhmbx-font-2', 'sanitize_callback' => 'bourz_sanitize_font_switchers' ) );
	/* */

	/* Site Background */
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Background', array( 'default' => '#e9e9e9', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_upload_Background', array( 'sanitize_callback' => 'bourz_sanitize_file' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_centerBackground', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_repeatBackground', array( 'default' => 'no-repeat', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	/* */

	/* Header */
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Logo', array( 'default' => wp_title(), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_Logo', array( 'default' => 'Montserrat', 'sanitize_callback' => 'bourz_sanitize_select' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_font_size_Logo', array( 'default' => 30, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Logo', array( 'default' => '#cd0060', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_upload_Logo', array( 'sanitize_callback' => 'bourz_sanitize_file' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_upload_MobileLogo', array( 'sanitize_callback' => 'bourz_sanitize_file' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_upload_StickyLogo', array( 'sanitize_callback' => 'bourz_sanitize_file' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_MenuPos', array( 'default' => 'menu-left', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_MenuWidth', array( 'default' => 'boxed', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_menuContainerHeight', array( 'default' => 50, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_menuPaddingLeft', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_menuPaddingRight', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_triggerSlicknav', array( 'default' => 960, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'bourz_slicknav_apl', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_LogoPos', array( 'default' => 'logo-left', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_maxLogoHeight', array( 'default' => 50, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_logoPaddingTop', array( 'default' => 40, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_logoPaddingRight', array( 'default' => 40, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_logoPaddingBottom', array( 'default' => 40, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_triggerSticky', array( 'default' => 300, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_StickyLogo', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_TopLineWidth', array( 'default' => 'full_boxed', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_SpotMessages', array( 'default' => 'tagline', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_5', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_spotMessages_1', array( 'default' => 'Spot Message 1', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_spotMessages_2', array( 'default' => 'Spot Message 2', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_spotMessages_3', array( 'default' => 'Spot Message 3', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_spotDuration', array( 'default' => 4000, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_6', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderBottomPadding', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_TopLineBottomPadding', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_stickyHeader', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderSocial', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderSearch', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderMenu', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_TopLine_Text', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_TopLine_Background', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_transparent_TopLine_Background', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Logo_Background', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_transparent_Logo_Background', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Menu_Background', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_transparent_Menu_Background', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Menu_Border', array( 'default' => '#cd0060', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_BorderedMenu', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_MenuLink', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_MenuLink_Hover', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_MenuLevel_Background', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_MenuLink_Level', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_MenuLink_Level_Hover', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_HeaderLink', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_HeaderLink_Hover', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	/* */

	/* Slider Settings */
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_7', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderWidth', array( 'default' => 1200, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderHeight', array( 'default' => 600, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_SliderPosition', array( 'default' => 'cover', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderShortcode', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_SliderStyle', array( 'default' => 'b', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_bxCenteredText', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_8', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bpts', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderCategory', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bptsNumber', array( 'default' => 5, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bptsExclude', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_SliderHomeView', array( 'default' => 'home-all', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderHideMobile', array( 'default' => 'always', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_bxControls_Main', array( 'default' => 'bullet', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_bxDarkControls', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_bxRectanglePagers', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_bxPagerPosition_Main', array( 'default' => 'left', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderPause', array( 'default' => 4000, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bxAuto_Main', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderMode', array( 'default' => 'horizontal', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_9', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bptsDate', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bptsComment', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bptsCategories', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bptsCaption', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SliderArchive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SliderPost', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderInfinite', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sliderRandom', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Sli_Header', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Sli_Caption', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Sli_BBO', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_rng_Sli_Bor', array( 'default' => 100, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Sli_Box', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_rng_Sli_Box', array( 'default' => 50, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	/* */

	/* Sidebar, Upper & Home Widgets */
	$wp_customize->add_setting( 'brnhmbx_bourz_headerWidgetsCol', array( 'default' => '3col', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderWidgets', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderWidgetsFront', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderWidgetsPage', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderWidgetsPost', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HeaderWidgetsArchive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_upperWidgetsCol', array( 'default' => '3col', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_UpperWidgets', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_UpperWidgetsFront', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_UpperWidgetsPage', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_UpperWidgetsPost', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_UpperWidgetsArchive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_homeWidgetsCol', array( 'default' => '2col', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HomeWidgets', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_HomeWidgetsFront', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_Background', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_BotSdw', array( 'default' => '#d8d1d1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_Title', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_OptHdr', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_CatsBackground', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_CatsText', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_Content', array( 'default' => '#777', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_Link', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_LinkHover', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_InputBackground', array( 'default' => '#e9e9e9', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_W_InputText', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	/* */

	/* Layout Options */
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_PageWidth', array( 'default' => 'boxed', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_Layout', array( 'default' => '2col_sidebar', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_HomePosts', array( 'default' => 'all', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_HomePosts', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_Layout_Archive', array( 'default' => '2col_sidebar', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_2', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_styleA_count', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_styleB_count', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_styleZ_count', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_3', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_minHeight_styleA', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_minHeight_styleB', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_explanation_4', array( 'default' => '0', 'sanitize_callback' => 'bourz_sanitize_null' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SidebarPost_Standard', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SidebarPost_Gallery', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SidebarPost_Video', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SidebarInnerPage', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ExtraSidebar_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ExtraSidebar_Page', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ExtraSidebar_Post', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	/* */

	/* Post & Page Colors */
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Background', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Header', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Content', array( 'default' => '#777', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_DCB', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Link', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Link_Hover', array( 'default' => '#cd0060', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_InputBackground', array( 'default' => '#e9e9e9', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_InputText', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_BotSdw', array( 'default' => '#d8d1d1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_PostBackground', array( 'default' => '#d8d1d1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Header_Post', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_DCB_Post', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Link_Post', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Standard_Link_Hover_Post', array( 'default' => '#cd0060', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Site_RMB', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Site_RMT', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	/* */

	/* Post Format: Standard */
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_FeaImg_Single_Standard', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ignoreExcerpt_Standard', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ignoreExcerpt_Standard_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_FeaImg_Standard', array( 'default' => 'fea', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	/* */

	/* Post Format: Gallery */
	$wp_customize->add_setting( 'brnhmbx_bourz_ignoreExcerpt_Gallery', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ignoreExcerpt_Gallery_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_FeaImg_Gallery', array( 'default' => 'gal', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_GalleryPos_Gallery', array( 'default' => 'content', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_bxControls', array( 'default' => 'arrow', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_bxAuto', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	/* */

	/* Post Format: Video */
	$wp_customize->add_setting( 'brnhmbx_bourz_ignoreExcerpt_Video', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_ignoreExcerpt_Video_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_FeaImg_Video', array( 'default' => 'gal', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	/* */

	/* Related Posts */
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_RelatedPosts', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_RPDate', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_RPStyle', array( 'default' => 'b', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_RPBase', array( 'default' => 'tag', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_RP_Header', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_RP_Date', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_RP_Box', array( 'default' => '#ebe4ca', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_rng_RP_Box', array( 'default' => 100, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_rng_RP_C_Box', array( 'default' => 50, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	/* */

	/* Post & Page Comments */
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_PostComments', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_PageComments', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_PC_BotSdw', array( 'default' => '#dfdbdb', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_PC_DPL', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	/* */

	/* Footer */
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_FooterWidth', array( 'default' => 'boxed', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Footer', array( 'default' => '2019 Bourz. All rights reserved.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_InstagramShortcode', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_InstagramText', array( 'default' => 'FOLLOW @ INSTAGRAM', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Footer_Content', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Footer_Background', array( 'default' => '#777', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Footer_Link', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_Footer_Link_Hover', array( 'default' => '#d8d1d1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_bottomLine', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_FooterMenu', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_FooterSocial', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	/* */

	/* Footer Widgets */
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_FooterWidgetsWidth', array( 'default' => 'boxed', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_footerWidgetsCol', array( 'default' => '4col', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_Background', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_Title', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_OptHdr', array( 'default' => '#d8d1d1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_CatsBackground', array( 'default' => '#d8d1d1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_CatsText', array( 'default' => '#4f4047', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_Content', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_Link', array( 'default' => '#FFF', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_LinkHover', array( 'default' => '#a06161', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_InputBackground', array( 'default' => '#e9e9e9', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_color_WF_InputText', array( 'default' => '#999', 'sanitize_callback' => 'sanitize_hex_color' ) );
	/* */

	/* Show/Hide Elements */
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_FilterBar', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Date', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Date_Home', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_btnComments', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_btnComments_Home', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Hits', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Excerpt', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Excerpt_Home', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_TagBar', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_TagBar_Home', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_CategoryBar', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_CategoryBar_Home', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_btnReadMore', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Author', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_AuthorBox', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SocialBar', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SocialBar_Page', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SocialBar_Facebook', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SocialBar_Twitter', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SocialBar_Google', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_BotSdw', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_WidgetLiner', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_PostBorder', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_PageNaviBullet', array( 'default' => 'arrow', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_BulletBo', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	/* */

	/* Social Accounts */
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_SocialAccounts', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Facebook', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Twitter', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Instagram', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Pinterest', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Google', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Tumblr', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Flickr', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Digg', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_LinkedIn', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Vimeo', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_YouTube', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Behance', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Dribble', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_DeviantArt', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Github', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Bloglovin', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_Lastfm', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_SoundCloud', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_social_VK', array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );
	/* */

	/* Google Maps */
	$wp_customize->add_setting( 'brnhmbx_bourz_mapPage', array( 'sanitize_callback' => 'bourz_returnMapPageID' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_coorN', array( 'default' => '49.0138', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_coorE', array( 'default' => '8.38624', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_rng_MapZoom', array( 'default' => 15, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_mapHeight', array( 'default' => 500, 'sanitize_callback' => 'bourz_sanitize_integer' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Map', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_enableMapKey', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_mapAPI', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	/* */

	/* Translation */
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Lang', array( 'default' => ( get_bloginfo( 'language' ) ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_404', array( 'default' => 'PAGE NOT FOUND', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Nothing', array( 'default' => 'NOTHING FOUND', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_SearchResults', array( 'default' => 'Search Results', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Page', array( 'default' => 'PAGE', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Tag', array( 'default' => 'Tag', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Category', array( 'default' => 'Category', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Author', array( 'default' => 'Author', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Archives', array( 'default' => 'Archives', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_OlderPosts', array( 'default' => 'OLDER POSTS', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_NewerPosts', array( 'default' => 'NEWER POSTS', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_By', array( 'default' => 'By', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_BackToTop', array( 'default' => 'BACK TO TOP', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_TypeKeyword', array( 'default' => 'Type keyword to search', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_ReadMore', array( 'default' => 'READ MORE', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Share', array( 'default' => 'SHARE', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Views', array( 'default' => 'Views', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Sticky', array( 'default' => 'STICKY', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Comment', array( 'default' => 'COMMENT', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Comments', array( 'default' => 'COMMENTS', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Name', array( 'default' => 'NAME', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Email', array( 'default' => 'E-MAIL', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Website', array( 'default' => 'WEBSITE', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_MustBeLogged', array( 'default' => 'YOU MUST BE LOGGED IN TO POST A COMMENT', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Logged', array( 'default' => 'LOGGED IN', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_LogOut', array( 'default' => 'LOG OUT', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_LeaveReply', array( 'default' => 'LEAVE A REPLY', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_CancelReply', array( 'default' => 'CANCEL REPLY', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_PostComment', array( 'default' => 'Post Comment', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_At', array( 'default' => 'at', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Reply', array( 'default' => 'REPLY', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Edit', array( 'default' => 'EDIT', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_Awaiting', array( 'default' => 'COMMENT AWAITING APPROVAL', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_About', array( 'default' => 'About', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_AllByAuthor', array( 'default' => 'View All Posts by Author', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_tra_AuthorWebsite', array( 'default' => 'Visit Author Website', 'sanitize_callback' => 'sanitize_text_field' ) );
	/* */

	/* Banner Management */
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_ResponsiveBannerHide', array( 'default' => '640', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Banner_1', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_BannerPos_1', array( 'default' => 'above-full-slider', 'sanitize_callback' => 'bourz_sanitize_banner_positions' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_ResponsiveBanner_1', array( 'default' => 'static', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_1_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_1_Post', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Banner_2', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_BannerPos_2', array( 'default' => 'below-among-slider', 'sanitize_callback' => 'bourz_sanitize_banner_positions' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_ResponsiveBanner_2', array( 'default' => 'static', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_2_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_2_Post', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Banner_3', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_BannerPos_3', array( 'default' => 'below-blog-posts', 'sanitize_callback' => 'bourz_sanitize_banner_positions' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_ResponsiveBanner_3', array( 'default' => 'static', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_3_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_3_Post', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Banner_4', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_BannerPos_4', array( 'default' => 'below-page', 'sanitize_callback' => 'bourz_sanitize_banner_positions' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_ResponsiveBanner_4', array( 'default' => 'static', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_4_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_4_Post', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Banner_5', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_BannerPos_5', array( 'default' => 'below-home-widgets', 'sanitize_callback' => 'bourz_sanitize_banner_positions' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_opt_ResponsiveBanner_5', array( 'default' => 'static', 'sanitize_callback' => 'bourz_sanitize_choices' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_5_Archive', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_5_Post', array( 'default' => 0, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_text_Banner_Header', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	$wp_customize->add_setting( 'brnhmbx_bourz_sh_Banner_Header', array( 'default' => 1, 'sanitize_callback' => 'bourz_sanitize_checkbox' ) );
	/* */

	/* Custom CSS */
	$wp_customize->add_setting( 'brnhmbx_bourz_text_CSS', array( 'default' => '', 'sanitize_callback' => 'bourz_sanitize_let_html' ) );
	/* */

	////////////////////////////////////////////////////
	/*/////////////////// CONTROLS ///////////////////*/
	////////////////////////////////////////////////////

	/* Featured Image Settings */
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_1', array(
        'label' => esc_html__( 'Important Note', 'bourz' ),
		'description' => wp_kses( __( 'When you upload an image into your media library, it gets the sizes below. If you change these settings AFTER you uploaded an image, the image will not change its sizes. So, you have to re-upload it or use a plugin like <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> which is a very good practice.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionFeaturedImage',
        'settings' => 'brnhmbx_bourz_explanation_1',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_imageWidth', array(
        'label' => esc_html__( '1.1. Featured Image Width', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "1200"<br>Write "0" to not to resize the images.<br>Works for newly added images only.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionFeaturedImage',
        'settings' => 'brnhmbx_bourz_imageWidth',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_imageHeight', array(
        'label' => esc_html__( '1.2. Featured Image Height', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "0"<br>Write "0" to not to crop the images.<br>Works for newly added images only.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionFeaturedImage',
        'settings' => 'brnhmbx_bourz_imageHeight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_thumbnailImageWidth', array(
        'label' => esc_html__( '1.3. Thumbnail Image Width', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "600"<br>Used in related posts, widgets etc.<br>Write "0" to not to crop the images.<br>Works for newly added images only.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionFeaturedImage',
        'settings' => 'brnhmbx_bourz_thumbnailImageWidth',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_thumbnailImageHeight', array(
        'label' => esc_html__( '1.4. Thumbnail Image Height', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "400"<br>Used in related posts, widgets etc.<br>Write "0" to not to crop the images.<br>Works for newly added images only.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionFeaturedImage',
        'settings' => 'brnhmbx_bourz_thumbnailImageHeight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_HomeImg_Standard', array(
        'label' => esc_html__( '1.5. Home Thumbnail Options', 'bourz' ),
		'description' => esc_html__( 'Does not affect post pages.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFeaturedImage',
        'settings' => 'brnhmbx_bourz_opt_HomeImg_Standard',
		'type' => 'radio',
		'choices' => array(
			'home' => 'Use Thumbnail Image',
			'fea' => 'Use Featured Image'
		)
    ) );
	/* */

	/* Font Settings */
	$wp_customize->add_control( 'brnhmbx_bourz_Uppercase', array(
        'label' => esc_html__( 'UPPERCASE dates, captions etc.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_Uppercase',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_font_selector( $wp_customize, 'brnhmbx_bourz_font_1', array(
		'label' => esc_html__( '2.1. Primary Font', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
		'description' => wp_kses( __( 'Menu items, main headers etc.<br>Theme default: "Palanquin"', 'bourz' ), $bourz_allowed_html ),
        'settings' => 'brnhmbx_bourz_font_1'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_1_italic', array(
        'label' => esc_html__( 'Use Italic Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_1_italic',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_1_bold', array(
        'label' => esc_html__( 'Use Bold Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_1_bold',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_font_selector( $wp_customize, 'brnhmbx_bourz_font_2', array(
		'label' => esc_html__( '2.2. Secondary Font', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
		'description' => wp_kses( __( 'Homepage headers, excerpts etc.<br>Theme default: "PT Serif"', 'bourz' ), $bourz_allowed_html ),
        'settings' => 'brnhmbx_bourz_font_2',
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_2_italic', array(
        'label' => esc_html__( 'Use Italic Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_2_italic',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_2_bold', array(
        'label' => esc_html__( 'Use Bold Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_2_bold',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_font_selector( $wp_customize, 'brnhmbx_bourz_font_3', array(
		'label' => esc_html__( '2.3. Tertiary Font', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
		'description' => wp_kses( __( 'Content font.<br>Theme default: "Palanquin"', 'bourz' ), $bourz_allowed_html ),
        'settings' => 'brnhmbx_bourz_font_3',
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_3_italic', array(
        'label' => esc_html__( 'Use Italic Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_3_italic',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_3_bold', array(
        'label' => esc_html__( 'Use Bold Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_3_bold',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_font_selector( $wp_customize, 'brnhmbx_bourz_font_4', array(
		'label' => esc_html__( '2.4. Quaternary Font', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
		'description' => wp_kses( __( 'Dates, form headers etc.<br>Theme default: "Karla"', 'bourz' ), $bourz_allowed_html ),
        'settings' => 'brnhmbx_bourz_font_4',
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_4_italic', array(
        'label' => esc_html__( 'Use Italic Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_4_italic',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_4_bold', array(
        'label' => esc_html__( 'Use Bold Where Allowed', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_font_4_bold',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_10', array(
        'label' => esc_html__( '2.5. Font Switching', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_explanation_10',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( new bourz_FontSwitcher( $wp_customize, 'brnhmbx_bourz_swiFont_Menu', array(
		'label' => esc_html__( 'Menu Items', 'bourz' ),
		'description' => esc_html__( 'Theme default: "Primary Font"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_swiFont_Menu'
	) ) );
	$wp_customize->add_control( new bourz_FontSwitcher( $wp_customize, 'brnhmbx_bourz_swiFont_HLT', array(
		'label' => esc_html__( 'Homepage Post Titles', 'bourz' ),
		'description' => esc_html__( 'Theme default: "Secondary Font"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_swiFont_HLT'
	) ) );
	$wp_customize->add_control( new bourz_FontSwitcher( $wp_customize, 'brnhmbx_bourz_swiFont_HAT', array(
		'label' => esc_html__( 'Post Page Titles', 'bourz' ),
		'description' => esc_html__( 'Theme default: "Primary Font"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_swiFont_HAT'
	) ) );
	$wp_customize->add_control( new bourz_FontSwitcher( $wp_customize, 'brnhmbx_bourz_swiFont_HAE', array(
		'label' => esc_html__( 'Post Page Excerpt', 'bourz' ),
		'description' => esc_html__( 'Theme default: "Secondary Font"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_swiFont_HAE'
	) ) );
	$wp_customize->add_control( new bourz_FontSwitcher( $wp_customize, 'brnhmbx_bourz_swiFont_PostNav', array(
		'label' => esc_html__( 'Post Navigation', 'bourz' ),
		'description' => esc_html__( 'Theme default: "Primary Font"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_swiFont_PostNav'
	) ) );
	$wp_customize->add_control( new bourz_FontSwitcher( $wp_customize, 'brnhmbx_bourz_swiFont_RP', array(
		'label' => esc_html__( 'Related Posts', 'bourz' ),
		'description' => esc_html__( 'Theme default: "Secondary Font"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFonts',
        'settings' => 'brnhmbx_bourz_swiFont_RP'
	) ) );
	/* */

	/* Site Background */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Background', array(
        'label' => esc_html__( '3.1. Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionBackground', 'settings' => 'brnhmbx_bourz_color_Background'
	) ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'brnhmbx_bourz_upload_Background', array(
				'label' => esc_html__( '3.2. Background Image', 'bourz' ),

				'section' => 'brnhmbx_bourz_sectionBackground',
				'settings' => 'brnhmbx_bourz_upload_Background'
			)
		)
	);
	$wp_customize->add_control( 'brnhmbx_bourz_centerBackground', array(
        'label' => esc_html__( 'Centered Background Image', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBackground',
        'settings' => 'brnhmbx_bourz_centerBackground',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_repeatBackground', array(
        'label' => esc_html__( '3.3. Background Repeat Options', 'bourz' ),
		'description' => esc_html__( 'Only used if "Centered" is unchecked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBackground',
        'settings' => 'brnhmbx_bourz_repeatBackground',
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => 'No Repeat',
			'repeat-x' => 'Repeat Only Horizontally',
			'repeat-y' => 'Repeat Only Vertically',
		)
    ) );
	/* */

	/* Header */
	if ( !function_exists( 'wp_site_icon' ) ) {
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'brnhmbx_bourz_upload_Favicon', array(
					'label' => esc_html__( 'Upload a Favicon', 'bourz' ),

					'section' => 'brnhmbx_bourz_sectionFeaturedImage',
					'settings' => 'brnhmbx_bourz_upload_Favicon'
				)
			)
		);
	}
	$wp_customize->add_control( 'brnhmbx_bourz_text_Logo', array(
        'label' => esc_html__( '4.1. Logo Text', 'bourz' ),
		'description' => esc_html__( 'Leave blank if you want to use the "Site Title". If a logo image is uploaded, this will never be shown.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_text_Logo',
		'type' => 'text',
    ) );
	$wp_customize->add_control( new bourz_font_selector( $wp_customize, 'brnhmbx_bourz_font_Logo', array(
		'label' => esc_html__( '4.2. Logo Font', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
		'description' => esc_html__( 'Theme default: "Montserrat"', 'bourz' ),
        'settings' => 'brnhmbx_bourz_font_Logo'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_font_size_Logo', array(
        'label' => esc_html__( '4.3. Logo Font Size', 'bourz' ),
		'description' => esc_html__( 'Theme default: "30"(px)', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_font_size_Logo',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 50px;',
		),
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Logo', array(
        'label' => esc_html__( '4.4. Logo Text Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_Logo'
	) ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'brnhmbx_bourz_upload_Logo', array(
				'label' => esc_html__( '4.5. Logo Image', 'bourz' ),
				'section' => 'brnhmbx_bourz_sectionHeader',
				'settings' => 'brnhmbx_bourz_upload_Logo'
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'brnhmbx_bourz_upload_MobileLogo', array(
				'label' => esc_html__( 'Mobile Logo Image', 'bourz' ),
				'section' => 'brnhmbx_bourz_sectionHeader',
				'settings' => 'brnhmbx_bourz_upload_MobileLogo'
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'brnhmbx_bourz_upload_StickyLogo', array(
				'label' => esc_html__( '4.6. Sticky Logo Image', 'bourz' ),
				'section' => 'brnhmbx_bourz_sectionHeader',
				'settings' => 'brnhmbx_bourz_upload_StickyLogo'
			)
		)
	);
	$wp_customize->add_control( 'brnhmbx_bourz_opt_MenuPos', array(
        'label' => esc_html__( '4.7. Menu Position', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_opt_MenuPos',
		'type' => 'radio',
		'choices' => array(
			'menu-left' => 'Left',
			'menu-center' => 'Center',
			'menu-right' => 'Right'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_MenuWidth', array(
		'label' => esc_html__( '4.8. Menu Container Width', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',

        'settings' => 'brnhmbx_bourz_opt_MenuWidth',
		'type' => 'radio',
		'choices' => array(
			'boxed' => 'Boxed',
			'full' => 'Fullwidth',
			'full_boxed' => 'Fullwidth Background + Boxed'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_menuContainerHeight', array(
        'label' => esc_html__( '4.9. Menu Container Height', 'bourz' ),
		'description' => esc_html__( 'min 35.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_menuContainerHeight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_menuPaddingLeft', array(
        'label' => esc_html__( '4.10. Menu Container Left Padding', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_menuPaddingLeft',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_menuPaddingRight', array(
        'label' => esc_html__( '4.11. Menu Container Right Padding', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_menuPaddingRight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_triggerSlicknav', array(
        'label' => esc_html__( '4.12. Trigger Mobile Menu', 'bourz' ),
		'description' => esc_html__( 'Trigger mobile menu when window width is smaller than:', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_triggerSlicknav',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 80px;',
		),
    ) );
		$wp_customize->add_control( 'bourz_slicknav_apl', array(
			'label' => esc_html__( 'Clickable Parent Menu Items in Mobile Menu', 'bourz' ),
			'section' => 'brnhmbx_bourz_sectionHeader',
			'settings' => 'bourz_slicknav_apl',
			'type' => 'checkbox'
		) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_LogoPos', array(
        'label' => esc_html__( '4.13. Logo Position', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_opt_LogoPos',
		'type' => 'radio',
		'choices' => array(
			'logo-top' => 'Top',
			'logo-left' => 'Left',
			'logo-bottom' => 'Bottom'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_maxLogoHeight', array(
        'label' => esc_html__( '4.14. Logo Height', 'bourz' ),
		'description' => esc_html__( 'Will be ignored if higher than "Menu Container Height" when "Logo Position" is "Left". Only used if a logo image is uploaded.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_maxLogoHeight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 50px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_logoPaddingTop', array(
        'label' => esc_html__( '4.15. Logo Top Padding', 'bourz' ),
		'description' => esc_html__( 'Only used if "Logo Position" is NOT "Left".', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_logoPaddingTop',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_logoPaddingRight', array(
        'label' => esc_html__( '4.16. Logo Right Padding', 'bourz' ),
		'description' => esc_html__( 'Space between the logo and the menu. Only used if "Logo Position" is "Left".', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_logoPaddingRight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_logoPaddingBottom', array(
        'label' => esc_html__( '4.17. Logo Bottom Padding', 'bourz' ),
		'description' => esc_html__( 'Only used if "Logo Position" is NOT "Left".', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_logoPaddingBottom',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_triggerSticky', array(
        'label' => esc_html__( '4.18. Sticky Header', 'bourz' ),
		'description' => esc_html__( 'Trigger sticky header when scroll position is higher than:', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_triggerSticky',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 80px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_stickyHeader', array(
        'label' => esc_html__( 'Sticky Header', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_stickyHeader',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_TopLineWidth', array(
		'label' => esc_html__( '4.19. Top Line Container Width', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',

        'settings' => 'brnhmbx_bourz_opt_TopLineWidth',
		'type' => 'radio',
		'choices' => array(
			'boxed' => 'Boxed',
			'full' => 'Fullwidth',
			'full_boxed' => 'Fullwidth Background + Boxed'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_SpotMessages', array(
		'label' => esc_html__( '4.20. Tagline Options', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',

        'settings' => 'brnhmbx_bourz_opt_SpotMessages',
		'type' => 'radio',
		'choices' => array(
			'tagline' => 'Show Tagline',
			'spot' => 'Show Spot Messages',
			'none' => 'Hide'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_5', array(
        'label' => esc_html__( '4.21. Spot Messages', 'bourz' ),
		'description' => wp_kses( __( 'Only used if "Show Spot Messages" is selected. You can use <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Font Awesome</a> here.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_explanation_5',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_spotMessages_1', array(
        'label' => esc_html__( 'Spot Message 1', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_spotMessages_1',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_spotMessages_2', array(
        'label' => esc_html__( 'Spot Message 2', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_spotMessages_2',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_spotMessages_3', array(
        'label' => esc_html__( 'Spot Message 3', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_spotMessages_3',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_spotDuration', array(
        'label' => esc_html__( 'Spot Message Duration', 'bourz' ),
		'description' => esc_html__( 'Theme default: "4000"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_spotDuration',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 80px; margin-bottom: 20px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_6', array(
        'label' => esc_html__( '4.22. Show/Hide', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_explanation_6',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderBottomPadding', array(
        'label' => esc_html__( 'Padding Below Menu', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_HeaderBottomPadding',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_TopLineBottomPadding', array(
        'label' => esc_html__( 'Padding Below Top Line', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_TopLineBottomPadding',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_StickyLogo', array(
        'label' => esc_html__( 'Show Sticky Logo', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_StickyLogo',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderSocial', array(
        'label' => esc_html__( 'Show Social Account Icons', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_HeaderSocial',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderSearch', array(
        'label' => esc_html__( 'Show Search', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_HeaderSearch',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderMenu', array(
        'label' => esc_html__( 'Show Header Menu', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_HeaderMenu',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_TopLine_Text', array(
        'label' => esc_html__( 'Top Line Text Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_TopLine_Text'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_TopLine_Background', array(
        'label' => esc_html__( 'Top Line Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_TopLine_Background'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_transparent_TopLine_Background', array(
        'label' => esc_html__( 'Transparent Top Line Background', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_transparent_TopLine_Background',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Logo_Background', array(
        'label' => esc_html__( 'Logo Background Color', 'bourz' ), 'description' => esc_html__( 'Only used if "Logo Position" is NOT "Left".', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_Logo_Background'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_transparent_Logo_Background', array(
        'label' => esc_html__( 'Transparent Logo Background', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_transparent_Logo_Background',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Menu_Background', array(
        'label' => esc_html__( 'Menu Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_Menu_Background'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_transparent_Menu_Background', array(
        'label' => esc_html__( 'Transparent Menu Background', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_transparent_Menu_Background',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Menu_Border', array(
        'label' => esc_html__( 'Menu Border Color', 'bourz' ), 'description' => esc_html__( 'Only used if "Bordered Menu Container" is checked.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_Menu_Border'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_BorderedMenu', array(
        'label' => esc_html__( 'Bordered Menu Container', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHeader',
        'settings' => 'brnhmbx_bourz_sh_BorderedMenu',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_MenuLink', array(
        'label' => esc_html__( 'Menu Link Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_MenuLink'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_MenuLink_Hover', array(
        'label' => esc_html__( 'Menu Link Hover Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_MenuLink_Hover'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_MenuLevel_Background', array(
        'label' => esc_html__( 'Menu Level Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_MenuLevel_Background'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_MenuLink_Level', array(
        'label' => esc_html__( 'Menu Level Link Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_MenuLink_Level'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_MenuLink_Level_Hover', array(
        'label' => esc_html__( 'Menu Level Link Hover Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_MenuLink_Level_Hover'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_HeaderLink', array(
        'label' => esc_html__( 'Header Menu Link Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_HeaderLink'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_HeaderLink_Hover', array(
        'label' => esc_html__( 'Header Menu Link Hover Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHeader', 'settings' => 'brnhmbx_bourz_color_HeaderLink_Hover'
	) ) );
	/* */

	/* Slider Settings */
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_7', array(
        'label' => esc_html__( 'Important Note', 'bourz' ),
		'description' => wp_kses( __( 'When you upload an image into your media library, it gets the sizes below. If you change these settings AFTER you uploaded an image, the image will not change its sizes. So, you have to re-upload it or use a plugin like <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> which is a very good practice.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_explanation_7',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderWidth', array(
        'label' => esc_html__( '5.1. Slide Image Width', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "1200"<br>Since the slider is responsive, display results may seem different. If you want to use "Fullwidth" option for instance, to set it 2560 and upload big images make sense.<br>Works for only new added images.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderWidth',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderHeight', array(
        'label' => esc_html__( '5.2. Slide Image Height', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "600"<br>This value is fixed, not responsive.<br>Works for only new added images.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderHeight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_SliderPosition', array(
        'label' => esc_html__( '5.3. Slider Position & View', 'bourz' ),
		'description' => wp_kses( __( 'When you choose "Fullwidth" for slider, it makes the container fullwidth, not the image. So, you should try to upload a bigger image or use a plugin like <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> to resize the uploaded images if they are already big enough.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_opt_SliderPosition',
		'type' => 'radio',
		'choices' => array(
			'full' => 'Fullwidth',
			'cover' => 'Cover',
			'among' => 'Among the Posts'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderShortcode', array(
        'label' => esc_html__( '5.4. Shortcode', 'bourz' ),
		'description' => wp_kses( __( 'Example usages:<br>Old Slider:<br>[bourzslider group="your_group"]<br>New Slider:<br>[new_bourzslider group="your_group"]', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderShortcode',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_SliderStyle', array(
        'label' => esc_html__( '5.5. Slider Style', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_opt_SliderStyle',
		'type' => 'radio',
		'choices' => array(
			'a' => 'Style A',
			'b' => 'Style B',
			'c' => 'Style C'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_bxCenteredText', array(
        'label' => esc_html__( 'Center Text for Style B and C', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sh_bxCenteredText',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_8', array(
        'label' => esc_html__( '5.6. Blog Posts in Slider', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_explanation_8',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bpts', array(
        'label' => esc_html__( 'Show Blog Posts in Slider', 'bourz' ),
		'description' => esc_html__( 'Disables the shortcode if checked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bpts',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderCategory', array(
		'description' => esc_html__( 'Write a category slug to show the category posts in slider. Leave blank to show all posts. Only used if "Show Blog Posts in Slider" is checked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderCategory',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bptsNumber', array(
		'description' => wp_kses( __( 'Number of the posts to show in slider:<br>Only used if "Show Blog Posts in Slider" is checked.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bptsNumber',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bptsExclude', array(
        'label' => esc_html__( 'Exclude the Slider Posts From Feed', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bptsExclude',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_SliderHomeView', array(
        'label' => esc_html__( '5.7. Home View Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_opt_SliderHomeView',
		'type' => 'radio',
		'choices' => array(
			'home-all' => 'During Pagination',
			'home-front' => 'Only on the First Page of Pagination',
			'home-hide' => 'Hide at Home'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderHideMobile', array(
		'label' => esc_html__( '5.8. Mobile Settings', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderHideMobile',
		'type' => 'radio',
		'choices' => array(
			'always' => 'Always Show',
			'320' => 'Hide at 320px',
			'480' => 'Hide at 480px',
			'640' => 'Hide at 640px'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_bxControls_Main', array(
		'label' => esc_html__( '5.9. Control Settings', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_opt_bxControls_Main',
		'type' => 'radio',
		'choices' => array(
			'arrow' => 'Show Prev/Next Arrows',
			'bullet' => 'Show Pager Bullets',
			'both' => 'Show Both',
			'none' => 'None'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_bxDarkControls', array(
        'label' => esc_html__( 'Use Dark Bullets/Arrows', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sh_bxDarkControls',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_bxRectanglePagers', array(
        'label' => esc_html__( 'Use Rectangle Bullets', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sh_bxRectanglePagers',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_bxPagerPosition_Main', array(
		'label' => esc_html__( '5.10. Pager Bullets Position', 'bourz' ),
		'description' => esc_html__( 'Only used if "Show Pager Bullets" or "Show Both" is selected.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_opt_bxPagerPosition_Main',
		'type' => 'radio',
		'choices' => array(
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderPause', array(
        'label' => esc_html__( '5.11. Autoplay Duration', 'bourz' ),
		'description' => wp_kses( __( 'Theme default: "4000"<br>Only used if "Autoplay Slides" is checked.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderPause',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bxAuto_Main', array(
		'label' => esc_html__( 'Autoplay Slides', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bxAuto_Main',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderMode', array(
		'label' => esc_html__( '5.12. Transition Effect', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderMode',
		'type' => 'radio',
		'choices' => array(
			'horizontal' => 'Horizontal',
			'fade' => 'Fade'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_9', array(
        'label' => esc_html__( '5.13. Show/Hide & Other Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_explanation_9',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bptsDate', array(
        'label' => esc_html__( 'Show Post Dates', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bptsDate',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bptsComment', array(
        'label' => esc_html__( 'Show Post Comments Icon', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bptsComment',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bptsCategories', array(
        'label' => esc_html__( 'Show Categories', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bptsCategories',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bptsCaption', array(
        'label' => esc_html__( 'Show Excerpt', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_bptsCaption',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SliderArchive', array(
        'label' => esc_html__( 'Show Slider on Archive Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sh_SliderArchive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SliderPost', array(
        'label' => esc_html__( 'Show Slider on Post Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sh_SliderPost',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderInfinite', array(
		'label' => esc_html__( 'Infinite Loop', 'bourz' ),
		'description' => esc_html__( 'If checked, clicking "Next" while on the last slide will transition to the first slide and vice-versa.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderInfinite',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sliderRandom', array(
		'label' => esc_html__( 'Start with a Random Slide', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSlider',
        'settings' => 'brnhmbx_bourz_sliderRandom',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Sli_Header', array(
        'label' => esc_html__( 'Header Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionSlider', 'settings' => 'brnhmbx_bourz_color_Sli_Header'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Sli_Caption', array(
        'label' => esc_html__( 'Excerpt Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionSlider', 'settings' => 'brnhmbx_bourz_color_Sli_Caption'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Sli_BBO', array(
        'label' => esc_html__( 'Box Border Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionSlider', 'settings' => 'brnhmbx_bourz_color_Sli_BBO'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_rng_Sli_Bor', array(
		'type'        => 'range',
		'section'     => 'brnhmbx_bourz_sectionSlider',
		'label'       => 'Box Border Opacity',

		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
			'step'  => 10
		)
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Sli_Box', array(
        'label' => esc_html__( 'Box Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionSlider', 'settings' => 'brnhmbx_bourz_color_Sli_Box'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_rng_Sli_Box', array(
		'type'        => 'range',
		'section'     => 'brnhmbx_bourz_sectionSlider',
		'label'       => 'Slider Box Opacity',

		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
			'step'  => 10
		)
	) );
	/* */

	/* Sidebar, Upper & Home Widgets */
	$wp_customize->add_control( 'brnhmbx_bourz_headerWidgetsCol', array(
        'label' => esc_html__( '6.1. Header Widget Columns', 'bourz' ),
		'description' => esc_html__( '3 columns option is only used with layouts have no sidebar.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_headerWidgetsCol',
		'type' => 'radio',
		'choices' => array(
			'2col' => '2 Columns',
			'3col' => '3 Columns'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderWidgets', array(
        'label' => esc_html__( 'Show Header Widgets', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HeaderWidgets',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderWidgetsFront', array(
        'label' => esc_html__( 'First Page Header Widgets', 'bourz' ),
		'description' => esc_html__( 'Shows header widgets only on the first page of pagination.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HeaderWidgetsFront',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderWidgetsPage', array(
        'label' => esc_html__( 'Show Header Widgets on Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HeaderWidgetsPage',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderWidgetsPost', array(
        'label' => esc_html__( 'Show Header Widgets on Posts', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HeaderWidgetsPost',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HeaderWidgetsArchive', array(
        'label' => esc_html__( 'Show Header Widgets on Archives', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HeaderWidgetsArchive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_upperWidgetsCol', array(
        'label' => esc_html__( '6.2. Upper Widget Columns', 'bourz' ),
		'description' => esc_html__( '3 columns option is only used with layouts have no sidebar.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_upperWidgetsCol',
		'type' => 'radio',
		'choices' => array(
			'2col' => '2 Columns',
			'3col' => '3 Columns'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_UpperWidgets', array(
        'label' => esc_html__( 'Show Upper Widgets', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_UpperWidgets',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_UpperWidgetsFront', array(
        'label' => esc_html__( 'First Page Upper Widgets', 'bourz' ),
		'description' => esc_html__( 'Shows upper widgets only on the first page of pagination.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_UpperWidgetsFront',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_UpperWidgetsPage', array(
        'label' => esc_html__( 'Show Upper Widgets on Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_UpperWidgetsPage',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_UpperWidgetsPost', array(
        'label' => esc_html__( 'Show Upper Widgets on Posts', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_UpperWidgetsPost',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_UpperWidgetsArchive', array(
        'label' => esc_html__( 'Show Upper Widgets on Archives', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_UpperWidgetsArchive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_homeWidgetsCol', array(
        'label' => esc_html__( '6.3. Home Widget Columns', 'bourz' ),
		'description' => esc_html__( '3 columns option is only used with layouts have no sidebar.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_homeWidgetsCol',
		'type' => 'radio',
		'choices' => array(
			'2col' => '2 Columns',
			'3col' => '3 Columns'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HomeWidgets', array(
        'label' => esc_html__( 'Show Home Widgets', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HomeWidgets',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_HomeWidgetsFront', array(
        'label' => esc_html__( 'First Page Home Widgets', 'bourz' ),
		'description' => esc_html__( 'Shows home widgets only on the first page of pagination.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionHomeWidgets',
        'settings' => 'brnhmbx_bourz_sh_HomeWidgetsFront',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_Background', array(
        'label' => esc_html__( 'Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_Background'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_BotSdw', array(
        'label' => esc_html__( 'Bottom Shadow Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_BotSdw'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_Title', array(
        'label' => esc_html__( 'Title Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_Title'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_OptHdr', array(
        'label' => esc_html__( 'Headline Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_OptHdr'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_CatsBackground', array(
        'label' => esc_html__( 'Button Background Color', 'bourz' ), 'description' => esc_html__( 'Used for "Tags/Categories Widget" only.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_CatsBackground'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_CatsText', array(
        'label' => esc_html__( 'Button Text Color', 'bourz' ), 'description' => esc_html__( 'Used for "Tags/Categories Widget" only.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_CatsText'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_Content', array(
        'label' => esc_html__( 'Content Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_Content'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_Link', array(
        'label' => esc_html__( 'Link Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_Link'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_LinkHover', array(
        'label' => esc_html__( 'Link Hover Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_LinkHover'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_InputBackground', array(
        'label' => esc_html__( 'Input Background Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_InputBackground'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_W_InputText', array(
        'label' => esc_html__( 'Input Text Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionHomeWidgets', 'settings' => 'brnhmbx_bourz_color_W_InputText'
	) ) );
	/* */

	/* Layout Options */
	$wp_customize->add_control( 'brnhmbx_bourz_opt_PageWidth', array(
		'label' => esc_html__( '7.1. Container Width', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',

        'settings' => 'brnhmbx_bourz_opt_PageWidth',
		'type' => 'radio',
		'choices' => array(
			'boxed' => 'Boxed',
			'full' => 'Fullwidth'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_Layout', array(
		'label' => esc_html__( '7.2. Home Display Options', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_opt_Layout',
		'type' => 'radio',
		'choices' => array(
			'1col' => '1 Column',
			'1col_sidebar' => '1 Column + Sidebar',
			'2col' => '2 Columns',
			'2col_sidebar' => '2 Columns + Sidebar',
			'1_2col_sidebar' => '(1 + 2) Columns + Sidebar',
			'3col' => '3 Columns',
			'2_3col' => '(2 + 3) Columns'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_text_HomePosts', array(
		'label' => esc_html__( 'Show/Hide Specific Categories on Homepage', 'bourz' ),
        'description' => wp_kses( __( 'Write category IDs you want to show or hide. Use comma (,) between them.<br>Example: 2,5,8', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_text_HomePosts',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_HomePosts', array(
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_opt_HomePosts',
		'type' => 'radio',
		'choices' => array(
			'all' => 'Show All Categories',
			'hidecats' => 'Hide Chosen Categories',
			'showcats' => 'Show Chosen Categories'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_Layout_Archive', array(
		'label' => esc_html__( '7.3. Archive Display Options', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_opt_Layout_Archive',
		'type' => 'radio',
		'choices' => array(
			'1col' => '1 Column',
			'1col_sidebar' => '1 Column + Sidebar',
			'2col' => '2 Columns',
			'2col_sidebar' => '2 Columns + Sidebar',
			'1_2col_sidebar' => '(1 + 2) Columns + Sidebar',
			'3col' => '3 Columns',
			'2_3col' => '(2 + 3) Columns'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_2', array(
        'label' => esc_html__( '7.4. Listing Style Options', 'bourz' ),
		'description' => wp_kses( __( 'If the sum of Style A, B and Z is bigger than the number of posts per page, your settings will be ignored and all the posts will be shown in Style A.<br><br>If the sum of Style A, B and Z is smaller than the number of posts per page, Style A will take effect to complete the count.', 'bourz' ), $bourz_allowed_html ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_explanation_2',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_styleA_count', array(
        'section' => 'brnhmbx_bourz_sectionLayout',
		'description' => esc_html__( 'Number of posts to show in "Style A":', 'bourz' ),
        'settings' => 'brnhmbx_bourz_styleA_count',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_styleB_count', array(
        'section' => 'brnhmbx_bourz_sectionLayout',
		'description' => esc_html__( 'Number of posts to show in "Style B":', 'bourz' ),
        'settings' => 'brnhmbx_bourz_styleB_count',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_styleZ_count', array(
        'section' => 'brnhmbx_bourz_sectionLayout',
		'description' => esc_html__( 'Number of posts to show in "Style Z":', 'bourz' ),
        'settings' => 'brnhmbx_bourz_styleZ_count',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_3', array(
        'label' => esc_html__( '7.5. Listing Style Heights', 'bourz' ),
		'description' => esc_html__( 'If you have problems about equalizing the heights of your posts (homepage views), you can set a static size to make their heights equal.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_explanation_3',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_minHeight_styleA', array(
        'section' => 'brnhmbx_bourz_sectionLayout',
		'description' => esc_html__( 'Minimum height for Style A item:', 'bourz' ),
        'settings' => 'brnhmbx_bourz_minHeight_styleA',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_minHeight_styleB', array(
        'section' => 'brnhmbx_bourz_sectionLayout',
		'description' => esc_html__( 'Minimum height for Style B item:', 'bourz' ),
        'settings' => 'brnhmbx_bourz_minHeight_styleB',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_explanation_4', array(
        'label' => esc_html__( '7.6. Sidebar Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_explanation_4',
		'input_attrs' => array(
			'style' => 'display: none;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SidebarPost_Standard', array(
		'label' => esc_html__( 'Show Sidebar on Standard Posts', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_sh_SidebarPost_Standard',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SidebarPost_Gallery', array(
		'label' => esc_html__( 'Show Sidebar on Gallery Posts', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_sh_SidebarPost_Gallery',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SidebarPost_Video', array(
		'label' => esc_html__( 'Show Sidebar on Video Posts', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_sh_SidebarPost_Video',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SidebarInnerPage', array(
		'label' => esc_html__( 'Show Sidebar on Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_sh_SidebarInnerPage',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ExtraSidebar_Archive', array(
        'label' => esc_html__( 'Enable "Sidebar - Archive"', 'bourz' ),
		'description' => esc_html__( 'Uncheck to use the default sidebar.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_ExtraSidebar_Archive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ExtraSidebar_Page', array(
        'label' => esc_html__( 'Enable "Sidebar - Page"', 'bourz' ),
		'description' => esc_html__( 'Uncheck to use the default sidebar.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_ExtraSidebar_Page',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ExtraSidebar_Post', array(
        'label' => esc_html__( 'Enable "Sidebar - Post"', 'bourz' ),
		'description' => esc_html__( 'Uncheck to use the default sidebar.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionLayout',
        'settings' => 'brnhmbx_bourz_ExtraSidebar_Post',
		'type' => 'checkbox'
    ) );
	/* */

	/* Post & Page Colors */
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Background', array(
        'label' => esc_html__( 'Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Background'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Header', array(
        'label' => esc_html__( 'Header Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Header'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Content', array(
        'label' => esc_html__( 'Content Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Content'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_DCB', array(
        'label' => esc_html__( 'Secondary Content Color', 'bourz' ), 'description' => esc_html__( 'Used for form headers etc.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_DCB'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Link', array(
        'label' => esc_html__( 'Link Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Link'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Link_Hover', array(
        'label' => esc_html__( 'Link Hover Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Link_Hover'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_InputBackground', array(
        'label' => esc_html__( 'Input Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_InputBackground'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_InputText', array(
        'label' => esc_html__( 'Input Text Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_InputText'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_BotSdw', array(
        'label' => esc_html__( 'Bottom Shadow Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_BotSdw'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_PostBackground', array(
        'label' => esc_html__( 'Post Page Title Area Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_PostBackground'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Header_Post', array(
        'label' => esc_html__( 'Post Page Title Area Header Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Header_Post'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_DCB_Post', array(
        'label' => esc_html__( 'Post Page Title Area Secondary Content Color', 'bourz' ), 'description' => esc_html__( 'Used for hits counter etc.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_DCB_Post'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Link_Post', array(
        'label' => esc_html__( 'Post Page Title Area Link Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Link_Post'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Standard_Link_Hover_Post', array(
        'label' => esc_html__( 'Post Page Title Area Link Hover Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Standard_Link_Hover_Post'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Site_RMB', array(
        'label' => esc_html__( 'Post/Page Navigation Button Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Site_RMB'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Site_RMT', array(
        'label' => esc_html__( 'Post/Page Navigation Button Text Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPostColors', 'settings' => 'brnhmbx_bourz_color_Site_RMT'
	) ) );
	/* */

	/* Post Format: Standard */
	$wp_customize->add_control( 'brnhmbx_bourz_sh_FeaImg_Single_Standard', array(
		'label' => esc_html__( 'Show Featured Image on Post Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatStandard',
        'settings' => 'brnhmbx_bourz_sh_FeaImg_Single_Standard',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ignoreExcerpt_Standard', array(
		'label' => esc_html__( 'Show full post at Home Page', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatStandard',
        'settings' => 'brnhmbx_bourz_ignoreExcerpt_Standard',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ignoreExcerpt_Standard_Archive', array(
		'label' => esc_html__( 'Show full post on Archive Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatStandard',
        'settings' => 'brnhmbx_bourz_ignoreExcerpt_Standard_Archive',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_FeaImg_Standard', array(
        'label' => esc_html__( '9.1. Featured Image Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionPostFormatStandard',
        'settings' => 'brnhmbx_bourz_opt_FeaImg_Standard',
		'type' => 'radio',
		'choices' => array(
			'fea' => 'Show featured image',
			'no' => 'No image'
		)
    ) );
	/* */

	/* Post Format: Gallery */
	$wp_customize->add_control( 'brnhmbx_bourz_ignoreExcerpt_Gallery', array(
		'label' => esc_html__( 'Show full post at Home Page', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatGallery',
        'settings' => 'brnhmbx_bourz_ignoreExcerpt_Gallery',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ignoreExcerpt_Gallery_Archive', array(
		'label' => esc_html__( 'Show full post on Archive Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatGallery',
        'settings' => 'brnhmbx_bourz_ignoreExcerpt_Gallery_Archive',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_FeaImg_Gallery', array(
        'label' => esc_html__( '10.1. Featured Image Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionPostFormatGallery',
        'settings' => 'brnhmbx_bourz_opt_FeaImg_Gallery',
		'type' => 'radio',
		'choices' => array(
			'fea' => 'Show featured image',
			'gal' => 'Show gallery image(s)',
			'no' => 'No image'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_GalleryPos_Gallery', array(
        'label' => esc_html__( '10.2. Gallery Position', 'bourz' ),
		'description' => esc_html__( 'Choose the gallery position on post page.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatGallery',
        'settings' => 'brnhmbx_bourz_opt_GalleryPos_Gallery',
		'type' => 'radio',
		'choices' => array(
			'content' => 'Only in Content',
			'iof' => 'Instead of Featured Image',
			'both' => 'Both'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_bxControls', array(
		'label' => esc_html__( '10.3. Gallery Slider Settings', 'bourz' ),
		'description' => esc_html__( 'Video sliders will use these settings too but they can not have pager bullets.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatGallery',
        'settings' => 'brnhmbx_bourz_opt_bxControls',
		'type' => 'radio',
		'choices' => array(
			'arrow' => 'Show Prev/Next Arrows',
			'bullet' => 'Show Pager Bullets',
			'both' => 'Show Both',
			'none' => 'None'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_bxAuto', array(
		'label' => esc_html__( 'Autoplay Slides', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatGallery',
        'settings' => 'brnhmbx_bourz_bxAuto',
		'type' => 'checkbox',
    ) );
	/* */

	/* Post Format: Video */
	$wp_customize->add_control( 'brnhmbx_bourz_ignoreExcerpt_Video', array(
		'label' => esc_html__( 'Show full post at Home Page', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatVideo',
        'settings' => 'brnhmbx_bourz_ignoreExcerpt_Video',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_ignoreExcerpt_Video_Archive', array(
		'label' => esc_html__( 'Show full post on Archive Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPostFormatVideo',
        'settings' => 'brnhmbx_bourz_ignoreExcerpt_Video_Archive',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_FeaImg_Video', array(
        'label' => esc_html__( '11.1. Featured Image Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionPostFormatVideo',
        'settings' => 'brnhmbx_bourz_opt_FeaImg_Video',
		'type' => 'radio',
		'choices' => array(
			'fea' => 'Show featured image',
			'gal' => 'Show video(s)',
			'no' => 'No image'
		)
    ) );
	/* */

	/* Related Posts */
	$wp_customize->add_control( 'brnhmbx_bourz_sh_RelatedPosts', array(
		'label' => esc_html__( 'Show Related Posts', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionRP',
        'settings' => 'brnhmbx_bourz_sh_RelatedPosts',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_RPDate', array(
		'label' => esc_html__( 'Show Date', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionRP',
        'settings' => 'brnhmbx_bourz_sh_RPDate',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_RPStyle', array(
		'label' => esc_html__( '12.1. Listing Style', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionRP',

        'settings' => 'brnhmbx_bourz_opt_RPStyle',
		'type' => 'radio',
		'choices' => array(
			'a' => 'Style A',
			'b' => 'Style B',
			'c' => 'Style C',
			'd' => 'Style D'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_RPBase', array(
		'label' => esc_html__( '12.2. Related Term', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionRP',

        'settings' => 'brnhmbx_bourz_opt_RPBase',
		'type' => 'radio',
		'choices' => array(
			'tag' => 'Tag',
			'category' => 'Category'
		)
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_RP_Header', array(
        'label' => esc_html__( 'Header Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionRP', 'settings' => 'brnhmbx_bourz_color_RP_Header'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_RP_Date', array(
        'label' => esc_html__( 'Date Color for Style A and B', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionRP', 'settings' => 'brnhmbx_bourz_color_RP_Date'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_RP_Box', array(
        'label' => esc_html__( 'Box Color for Style A and B', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionRP', 'settings' => 'brnhmbx_bourz_color_RP_Box'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_rng_RP_Box', array(
		'type'        => 'range',
		'section'     => 'brnhmbx_bourz_sectionRP',
		'label'       => 'Box Opacity for Style A and B',

		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
			'step'  => 10
		)
	) );
	$wp_customize->add_control( 'brnhmbx_bourz_rng_RP_C_Box', array(
		'type'        => 'range',
		'section'     => 'brnhmbx_bourz_sectionRP',
		'label'       => 'Lens Opacity for Style C and D',

		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
			'step'  => 10
		)
	) );
	/* */

	/* Post & Page Comments */
	$wp_customize->add_control( 'brnhmbx_bourz_sh_PostComments', array(
		'label' => esc_html__( 'Show Post Comments', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPC',
        'settings' => 'brnhmbx_bourz_sh_PostComments',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_PageComments', array(
		'label' => esc_html__( 'Show Page Comments', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionPC',
        'settings' => 'brnhmbx_bourz_sh_PageComments',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_PC_BotSdw', array(
        'label' => esc_html__( 'Button Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionPC', 'settings' => 'brnhmbx_bourz_color_PC_BotSdw'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_PC_DPL', array(
        'label' => esc_html__( 'Secondary Content Color', 'bourz' ), 'description' => esc_html__( 'Used for date etc.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionPC', 'settings' => 'brnhmbx_bourz_color_PC_DPL'
	) ) );
	/* */

	/* Footer */
	$wp_customize->add_control( 'brnhmbx_bourz_opt_FooterWidth', array(
		'label' => esc_html__( '14.1. Container Width', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooter',

        'settings' => 'brnhmbx_bourz_opt_FooterWidth',
		'type' => 'radio',
		'choices' => array(
			'boxed' => 'Boxed',
			'full' => 'Fullwidth'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_text_Footer', array(
        'label' => esc_html__( '14.2. Copyright Text', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooter',
        'settings' => 'brnhmbx_bourz_text_Footer',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_InstagramShortcode', array(
		'label' => esc_html__( '14.3. Instagram Slider Widget', 'bourz' ),
		'description' => esc_html__( 'Instagram Widget Shortcode:', 'bourz' ),
		'section' => 'brnhmbx_bourz_sectionFooter',
		'settings' => 'brnhmbx_bourz_InstagramShortcode',
		'type' => 'text',
	) );
	$wp_customize->add_control( 'brnhmbx_bourz_InstagramText', array(
		'description' => esc_html__( 'Instagram Widget Button Text:', 'bourz' ),
		'section' => 'brnhmbx_bourz_sectionFooter',
		'settings' => 'brnhmbx_bourz_InstagramText',
		'type' => 'text',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Footer_Content', array(
        'label' => esc_html__( 'Copyright Text Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooter', 'settings' => 'brnhmbx_bourz_color_Footer_Content'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Footer_Background', array(
        'label' => esc_html__( 'Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooter', 'settings' => 'brnhmbx_bourz_color_Footer_Background'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Footer_Link', array(
        'label' => esc_html__( 'Link Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooter', 'settings' => 'brnhmbx_bourz_color_Footer_Link'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_Footer_Link_Hover', array(
        'label' => esc_html__( 'Link Hover Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooter', 'settings' => 'brnhmbx_bourz_color_Footer_Link_Hover'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_bottomLine', array(
        'label' => esc_html__( 'Show Footer', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooter',
        'settings' => 'brnhmbx_bourz_sh_bottomLine',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_FooterMenu', array(
        'label' => esc_html__( 'Show Footer Menu', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooter',
        'settings' => 'brnhmbx_bourz_sh_FooterMenu',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_FooterSocial', array(
        'label' => esc_html__( 'Show Social Account Icons', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooter',
        'settings' => 'brnhmbx_bourz_sh_FooterSocial',
		'type' => 'checkbox'
    ) );
	/* */

	/* Footer Widgets */
	$wp_customize->add_control( 'brnhmbx_bourz_opt_FooterWidgetsWidth', array(
		'label' => esc_html__( '15.1. Container Width', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooterWidgets',

        'settings' => 'brnhmbx_bourz_opt_FooterWidgetsWidth',
		'type' => 'radio',
		'choices' => array(
			'boxed' => 'Boxed',
			'full' => 'Fullwidth'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_footerWidgetsCol', array(
		'label' => esc_html__( '15.2. Widget Columns', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionFooterWidgets',

        'settings' => 'brnhmbx_bourz_footerWidgetsCol',
		'type' => 'radio',
		'choices' => array(
			'2col' => '2 Columns',
			'3col' => '3 Columns',
			'4col' => '4 Columns'
		)
    ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_Background', array(
        'label' => esc_html__( 'Background Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_Background'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_Title', array(
        'label' => esc_html__( 'Title Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_Title'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_OptHdr', array(
        'label' => esc_html__( 'Headline Color', 'bourz' ),  'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_OptHdr'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_CatsBackground', array(
        'label' => esc_html__( 'Button Background Color', 'bourz' ), 'description' => esc_html__( 'Used for "Tags/Categories Widget" only.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_CatsBackground'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_CatsText', array(
        'label' => esc_html__( 'Button Text Color', 'bourz' ), 'description' => esc_html__( 'Used for "Tags/Categories Widget" only.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_CatsText'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_Content', array(
        'label' => esc_html__( 'Content Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_Content'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_Link', array(
        'label' => esc_html__( 'Link Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_Link'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_LinkHover', array(
        'label' => esc_html__( 'Link Hover Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_LinkHover'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_InputBackground', array(
        'label' => esc_html__( 'Input Background Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_InputBackground'
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brnhmbx_bourz_color_WF_InputText', array(
        'label' => esc_html__( 'Input Text Color', 'bourz' ), 'description' => esc_html__( 'Used for WP default widgets.', 'bourz' ), 'section' => 'brnhmbx_bourz_sectionFooterWidgets', 'settings' => 'brnhmbx_bourz_color_WF_InputText'
	) ) );
	/* */

	/* Show/Hide Elements */
	$wp_customize->add_control( 'brnhmbx_bourz_sh_FilterBar', array(
		'label' => esc_html__( 'Show Filter Bar on Archive Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_FilterBar',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Date', array(
		'label' => esc_html__( 'Show Date', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_Date',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Date_Home', array(
		'label' => esc_html__( 'Show Date', 'bourz' ),
		'description' => esc_html__( 'For indexed views like home, archives etc.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_Date_Home',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_btnComments', array(
		'label' => esc_html__( 'Show Comments Icon', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_btnComments',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_btnComments_Home', array(
		'label' => esc_html__( 'Show Comments Icon', 'bourz' ),
		'description' => esc_html__( 'For indexed views like home, archives etc.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_btnComments_Home',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Hits', array(
		'label' => esc_html__( 'Show Hit Counter', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_Hits',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Excerpt', array(
		'label' => esc_html__( 'Show Excerpt', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_Excerpt',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Excerpt_Home', array(
		'label' => esc_html__( 'Show Excerpt', 'bourz' ),
		'description' => esc_html__( 'For indexed views like home, archives etc.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_Excerpt_Home',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_TagBar', array(
		'label' => esc_html__( 'Show Tags', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_TagBar',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_TagBar_Home', array(
		'label' => esc_html__( 'Show Tags', 'bourz' ),
		'description' => esc_html__( 'For indexed views like home, archives etc.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_TagBar_Home',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_CategoryBar', array(
		'label' => esc_html__( 'Show Categories', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_CategoryBar',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_CategoryBar_Home', array(
		'label' => esc_html__( 'Show Categories', 'bourz' ),
		'description' => esc_html__( 'For indexed views like home, archives etc.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_CategoryBar_Home',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_btnReadMore', array(
		'label' => esc_html__( 'Show Read More Button', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_btnReadMore',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Author', array(
		'label' => esc_html__( 'Show Author', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_Author',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_AuthorBox', array(
		'label' => esc_html__( 'Show Author Box on Post Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_AuthorBox',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SocialBar', array(
		'label' => esc_html__( 'Show Share Icons', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_SocialBar',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SocialBar_Page', array(
		'label' => esc_html__( 'Show Share Icons on Pages', 'bourz' ),
		'description' => esc_html__( 'Only used if "Show Share Icons" is checked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_SocialBar_Page',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SocialBar_Facebook', array(
		'label' => esc_html__( 'Show Facebook Share Icon', 'bourz' ),
		'description' => esc_html__( 'Only used if "Show Share Icons" is checked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_SocialBar_Facebook',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SocialBar_Twitter', array(
		'label' => esc_html__( 'Show Twitter Share Icon', 'bourz' ),
		'description' => esc_html__( 'Only used if "Show Share Icons" is checked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_SocialBar_Twitter',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SocialBar_Google', array(
		'label' => esc_html__( 'Show Google Share Icon', 'bourz' ),
		'description' => esc_html__( 'Only used if "Show Share Icons" is checked.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_SocialBar_Google',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_BotSdw', array(
        'label' => esc_html__( 'Show Bottom Lines', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_BotSdw',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_WidgetLiner', array(
        'label' => esc_html__( 'Show Widget Header Liners', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_WidgetLiner',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_PostBorder', array(
        'label' => esc_html__( 'Show 2px Border on Posts/Pages', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_PostBorder',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_PageNaviBullet', array(
        'label' => esc_html__( '16.1. Prev/Next Post Button Options', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_opt_PageNaviBullet',
		'type' => 'radio',
		'choices' => array(
			'arrow' => 'Arrow Bullet',
			'image' => 'Image Bullet',
			'none' => 'No Bullet'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_BulletBo', array(
        'label' => esc_html__( 'Show Border Around the Button', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionShowHide',
        'settings' => 'brnhmbx_bourz_sh_BulletBo',
		'type' => 'checkbox',
    ) );
	/* */

	/* Social Accounts */
	$wp_customize->add_control( 'brnhmbx_bourz_sh_SocialAccounts', array(
        'label' => esc_html__( 'Show Social Account Icons', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_sh_SocialAccounts',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Facebook', array(
        'label' => esc_html__( 'Facebook', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Facebook',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Twitter', array(
        'label' => esc_html__( 'Twitter', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Twitter',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Instagram', array(
        'label' => esc_html__( 'Instagram', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Instagram',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Pinterest', array(
        'label' => esc_html__( 'Pinterest', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Pinterest',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Google', array(
        'label' => esc_html__( 'Google+', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Google',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Tumblr', array(
        'label' => esc_html__( 'Tumblr', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Tumblr',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Flickr', array(
        'label' => esc_html__( 'Flickr', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Flickr',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Digg', array(
        'label' => esc_html__( 'Digg', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Digg',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_LinkedIn', array(
        'label' => esc_html__( 'LinkedIn', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_LinkedIn',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Vimeo', array(
        'label' => esc_html__( 'Vimeo', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Vimeo',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_YouTube', array(
        'label' => esc_html__( 'YouTube', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_YouTube',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Behance', array(
        'label' => esc_html__( 'Behance', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Behance',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Dribble', array(
        'label' => esc_html__( 'Dribbble', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Dribble',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_DeviantArt', array(
        'label' => esc_html__( 'DeviantArt', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_DeviantArt',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Github', array(
        'label' => esc_html__( 'Github', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Github',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Bloglovin', array(
		'label' => esc_html__( 'Bloglovin', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Bloglovin',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_Lastfm', array(
        'label' => esc_html__( 'Last.fm', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_Lastfm',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_SoundCloud', array(
        'label' => esc_html__( 'SoundCloud', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_SoundCloud',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_social_VK', array(
        'label' => esc_html__( 'VK', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionSocial',
        'settings' => 'brnhmbx_bourz_social_VK',
		'type' => 'text',
    ) );
	/* */

	/* Google Maps */
	$wp_customize->add_control( 'brnhmbx_bourz_mapPage', array(
        'label' => esc_html__( 'Choose a Page', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionGoogleMaps',
        'settings' => 'brnhmbx_bourz_mapPage',
		 'type' => 'dropdown-pages',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_coorN', array(
        'label' => esc_html__( 'Coordinate N', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionGoogleMaps',
        'settings' => 'brnhmbx_bourz_coorN',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_coorE', array(
        'label' => esc_html__( 'Coordinate E', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionGoogleMaps',
        'settings' => 'brnhmbx_bourz_coorE',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_rng_MapZoom', array(
		'type'        => 'range',
		'section'     => 'brnhmbx_bourz_sectionGoogleMaps',
		'label'       => 'Zoom Level',

		'input_attrs' => array(
			'min'   => 5,
			'max'   => 19,
			'step'  => 1
		)
	) );
	$wp_customize->add_control( 'brnhmbx_bourz_mapHeight', array(
        'label' => esc_html__( 'Map Height', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionGoogleMaps',
        'settings' => 'brnhmbx_bourz_mapHeight',
		'type' => 'number',
		'input_attrs' => array(
			'style' => 'width: 65px;',
		),
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Map', array(
        'label' => esc_html__( 'Show Map', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionGoogleMaps',
        'settings' => 'brnhmbx_bourz_sh_Map',
		'type' => 'checkbox',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_enableMapKey', array(
		'label' => esc_html__( 'Enable Map API Key', 'bourz' ),
		'section' => 'brnhmbx_bourz_sectionGoogleMaps',
		'settings' => 'brnhmbx_bourz_enableMapKey',
		'type' => 'checkbox',
	) );
	$wp_customize->add_control( 'brnhmbx_bourz_mapAPI', array(
		'label' => esc_html__( 'API Key', 'bourz' ),
		'description' => esc_html__( 'Only used if "Enable Map API Key" is checked.', 'bourz' ),
		'section' => 'brnhmbx_bourz_sectionGoogleMaps',
		'settings' => 'brnhmbx_bourz_mapAPI',
		'type' => 'text',
	) );

	function bourz_returnMapPageID( $input ) {

		if( is_numeric( $input ) ) {

			return intval( $input );

		}

	}
	/* */

	/* Translation */
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Lang', array(
        'label' => esc_html__( '19.1. Site Language', 'bourz' ),
		'description' => esc_html__( 'Original: "', 'bourz' ) . esc_html( get_bloginfo( 'language' ) ) . '"',
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Lang',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_404', array(
        'label' => esc_html__( '19.2. Wording', 'bourz' ),
		'description' => esc_html__( 'Original: "PAGE NOT FOUND"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_404',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Nothing', array(
		'description' => esc_html__( 'Original: "NOTHING FOUND"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Nothing',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_SearchResults', array(
		'description' => esc_html__( 'Original: "Search Results"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_SearchResults',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Page', array(
		'description' => esc_html__( 'Original: "PAGE"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Page',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Tag', array(
		'description' => esc_html__( 'Original: "Tag"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Tag',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Category', array(
		'description' => esc_html__( 'Original: "Category"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Category',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Author', array(
		'description' => esc_html__( 'Original: "Author"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Author',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Archives', array(
		'description' => esc_html__( 'Original: "Archives"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Archives',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_OlderPosts', array(
		'description' => esc_html__( 'Original: "OLDER POSTS"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_OlderPosts',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_NewerPosts', array(
		'description' => esc_html__( 'Original: "NEWER POSTS"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_NewerPosts',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_By', array(
		'description' => esc_html__( 'Original: "By"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_By',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_BackToTop', array(
		'description' => esc_html__( 'Original: "BACK TO TOP"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_BackToTop',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_TypeKeyword', array(
		'description' => esc_html__( 'Original: "Type keyword to search"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_TypeKeyword',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_ReadMore', array(
		'description' => esc_html__( 'Original: "READ MORE"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_ReadMore',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Share', array(
		'description' => esc_html__( 'Original: "SHARE"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Share',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Views', array(
		'description' => esc_html__( 'Original: "Views"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Views',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Sticky', array(
		'description' => esc_html__( 'Original: "STICKY"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Sticky',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Comment', array(
		'description' => esc_html__( 'Original: "COMMENT"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Comment',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Comments', array(
		'description' => esc_html__( 'Original: "COMMENTS"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Comments',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Name', array(
		'description' => esc_html__( 'Original: "NAME"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Name',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Email', array(
		'description' => esc_html__( 'Original: "E-MAIL"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Email',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Website', array(
		'description' => esc_html__( 'Original: "WEBSITE"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Website',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_MustBeLogged', array(
		'description' => esc_html__( 'Original: "YOU MUST BE LOGGED IN TO POST A COMMENT"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_MustBeLogged',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Logged', array(
		'description' => esc_html__( 'Original: "LOGGED IN"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Logged',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_LogOut', array(
		'description' => esc_html__( 'Original: "LOG OUT"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_LogOut',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_LeaveReply', array(
		'description' => esc_html__( 'Original: "LEAVE A REPLY"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_LeaveReply',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_CancelReply', array(
		'description' => esc_html__( 'Original: "CANCEL REPLY"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_CancelReply',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_PostComment', array(
		'description' => esc_html__( 'Original: "Post Comment"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_PostComment',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_At', array(
		'description' => esc_html__( 'Original: "at"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_At',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Reply', array(
		'description' => esc_html__( 'Original: "REPLY"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Reply',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Edit', array(
		'description' => esc_html__( 'Original: "EDIT"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Edit',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_Awaiting', array(
		'description' => esc_html__( 'Original: "COMMENT AWAITING APPROVAL"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_Awaiting',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_About', array(
		'description' => esc_html__( 'Original: "About"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_About',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_AllByAuthor', array(
		'description' => esc_html__( 'Original: "View All Posts by Author"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_AllByAuthor',
		'type' => 'text',
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_tra_AuthorWebsite', array(
		'description' => esc_html__( 'Original: "Visit Author Website"', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionTranslation',
        'settings' => 'brnhmbx_bourz_tra_AuthorWebsite',
		'type' => 'text',
    ) );
	/* */

	/* Banner Management */
	$wp_customize->add_control( 'brnhmbx_bourz_opt_ResponsiveBannerHide', array(
        'label' => esc_html__( '20.0. Responsive Options', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_opt_ResponsiveBannerHide',
		'type' => 'radio',
		'choices' => array(
			'always' => 'Always Show',
			'480' => 'Hide at 480px',
			'640' => 'Hide at 640px',
			'800' => 'Hide at 800px',
			'960' => 'Hide at 960px'
		)
    ) );
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_Banner_1', array(
		'label' => esc_html__( '20.1. Banner 1', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_text_Banner_1',
		'type' => 'text',
    ) ) );
	$wp_customize->add_control( new bourz_BannerPlacement( $wp_customize, 'brnhmbx_bourz_opt_BannerPos_1', array(
		'label' => esc_html__( 'Choose a Position', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
		'description' => esc_html__( 'Choose the placement for "Banner 1"', 'bourz' ),
        'settings' => 'brnhmbx_bourz_opt_BannerPos_1'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_ResponsiveBanner_1', array(
        'label' => esc_html__( 'Responsive?', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_opt_ResponsiveBanner_1',
		'type' => 'radio',
		'choices' => array(
			'static' => 'Static',
			'responsive' => 'Responsive'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_1_Archive', array(
        'label' => esc_html__( 'Show "Banner 1" on Archive Pages', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_1_Archive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_1_Post', array(
        'label' => esc_html__( 'Show "Banner 1" on Post Pages', 'bourz' ),
		'description' => esc_html__( 'The checkboxes above are only used if "Above Slider" or "Below Slider" is selected.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_1_Post',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_Banner_2', array(
		'label' => esc_html__( '20.2. Banner 2', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_text_Banner_2',
		'type' => 'text',
    ) ) );
	$wp_customize->add_control( new bourz_BannerPlacement( $wp_customize, 'brnhmbx_bourz_opt_BannerPos_2', array(
		'label' => esc_html__( 'Choose a Position', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
		'description' => esc_html__( 'Choose the placement for "Banner 2"', 'bourz' ),
        'settings' => 'brnhmbx_bourz_opt_BannerPos_2'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_ResponsiveBanner_2', array(
        'label' => esc_html__( 'Responsive?', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_opt_ResponsiveBanner_2',
		'type' => 'radio',
		'choices' => array(
			'static' => 'Static',
			'responsive' => 'Responsive'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_2_Archive', array(
        'label' => esc_html__( 'Show "Banner 2" on Archive Pages', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_2_Archive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_2_Post', array(
        'label' => esc_html__( 'Show "Banner 2" on Post Pages', 'bourz' ),
		'description' => esc_html__( 'The checkboxes above are only used if "Above Slider" or "Below Slider" is selected.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_2_Post',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_Banner_3', array(
		'label' => esc_html__( '20.3. Banner 3', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_text_Banner_3',
		'type' => 'text',
    ) ) );
	$wp_customize->add_control( new bourz_BannerPlacement( $wp_customize, 'brnhmbx_bourz_opt_BannerPos_3', array(
		'label' => esc_html__( 'Choose a Position', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
		'description' => esc_html__( 'Choose the placement for "Banner 3"', 'bourz' ),
        'settings' => 'brnhmbx_bourz_opt_BannerPos_3'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_ResponsiveBanner_3', array(
        'label' => esc_html__( 'Responsive?', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_opt_ResponsiveBanner_3',
		'type' => 'radio',
		'choices' => array(
			'static' => 'Static',
			'responsive' => 'Responsive'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_3_Archive', array(
        'label' => esc_html__( 'Show "Banner 3" on Archive Pages', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_3_Archive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_3_Post', array(
        'label' => esc_html__( 'Show "Banner 3" on Post Pages', 'bourz' ),
		'description' => esc_html__( 'The checkboxes above are only used if "Above Slider" or "Below Slider" is selected.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_3_Post',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_Banner_4', array(
		'label' => esc_html__( '20.4. Banner 4', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_text_Banner_4',
		'type' => 'text',
    ) ) );
	$wp_customize->add_control( new bourz_BannerPlacement( $wp_customize, 'brnhmbx_bourz_opt_BannerPos_4', array(
		'label' => esc_html__( 'Choose a Position', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
		'description' => esc_html__( 'Choose the placement for "Banner 4"', 'bourz' ),
        'settings' => 'brnhmbx_bourz_opt_BannerPos_4'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_ResponsiveBanner_4', array(
        'label' => esc_html__( 'Responsive?', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_opt_ResponsiveBanner_4',
		'type' => 'radio',
		'choices' => array(
			'static' => 'Static',
			'responsive' => 'Responsive'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_4_Archive', array(
        'label' => esc_html__( 'Show "Banner 4" on Archive Pages', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_4_Archive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_4_Post', array(
        'label' => esc_html__( 'Show "Banner 4" on Post Pages', 'bourz' ),
		'description' => esc_html__( 'The checkboxes above are only used if "Above Slider" or "Below Slider" is selected.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_4_Post',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_Banner_5', array(
		'label' => esc_html__( '20.5. Banner 5', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_text_Banner_5',
		'type' => 'text',
    ) ) );
	$wp_customize->add_control( new bourz_BannerPlacement( $wp_customize, 'brnhmbx_bourz_opt_BannerPos_5', array(
		'label' => esc_html__( 'Choose a Position', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
		'description' => esc_html__( 'Choose the placement for "Banner 5"', 'bourz' ),
        'settings' => 'brnhmbx_bourz_opt_BannerPos_5'
	) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_opt_ResponsiveBanner_5', array(
        'label' => esc_html__( 'Responsive?', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_opt_ResponsiveBanner_5',
		'type' => 'radio',
		'choices' => array(
			'static' => 'Static',
			'responsive' => 'Responsive'
		)
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_5_Archive', array(
        'label' => esc_html__( 'Show "Banner 5" on Archive Pages', 'bourz' ),

        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_5_Archive',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_5_Post', array(
        'label' => esc_html__( 'Show "Banner 5" on Post Pages', 'bourz' ),
		'description' => esc_html__( 'The checkboxes above are only used if "Above Slider" or "Below Slider" is selected.', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_5_Post',
		'type' => 'checkbox'
    ) );
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_Banner_Header', array(
		'label' => esc_html__( '20.6. Header Banner', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_text_Banner_Header',
		'type' => 'text',
    ) ) );
	$wp_customize->add_control( 'brnhmbx_bourz_sh_Banner_Header', array(
        'label' => esc_html__( 'Show Header Banner', 'bourz' ),
		'description' => esc_html__( 'Note: 4. Header > 4.13. Logo Position must be "Top" or "Bottom".', 'bourz' ),
        'section' => 'brnhmbx_bourz_sectionBanner',
        'settings' => 'brnhmbx_bourz_sh_Banner_Header',
		'type' => 'checkbox'
    ) );
	/* */

	/* Custom CSS */
	$wp_customize->add_control( new bourz_customTextAreaControl( $wp_customize, 'brnhmbx_bourz_text_CSS', array(
        'section' => 'brnhmbx_bourz_sectionCSS',
        'settings' => 'brnhmbx_bourz_text_CSS',
		'type' => 'text',
    ) ) );
	/* */

}
add_action( 'customize_register', 'bourz_customizeAppearance' );
?>
