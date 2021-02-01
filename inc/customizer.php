<?php
/**
 * SKT Filmmaker Theme Customizer
 *
 * @package SKT Filmmaker
 */
function skt_filmmaker_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'skt_filmmaker_custom_header_args', array(
		'default-text-color'     => '949494',
		'width'                  => 1600,
		'height'                 => 230,
		'wp-head-callback'       => 'skt_filmmaker_header_style',
 		'default-text-color' => false,
 		'header-text' => false,
	) ) );
}
add_action( 'after_setup_theme', 'skt_filmmaker_custom_header_setup' );
if ( ! function_exists( 'skt_filmmaker_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see skt_filmmaker_custom_header_setup().
 */
function skt_filmmaker_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		.header {
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // skt_filmmaker_header_style 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */ 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function skt_filmmaker_customize_register( $wp_customize ) {
	//Add a class for titles
    class skt_filmmaker_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#b2010d',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','skt-filmmaker'),			
			 'description'	=> esc_html__('More color options in PRO Version','skt-filmmaker'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_section('header_top_bar',array(
			'title'	=> esc_html__('Header Top Social Icons','skt-filmmaker'),				
			'description'	=> esc_html__('More social icon available in PRO Version','skt-filmmaker'),		
			'priority'		=> null
	));
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> esc_html__('Add facebook link here','skt-filmmaker'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> esc_html__('Add twitter link here','skt-filmmaker'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> esc_html__('Add linkedin link here','skt-filmmaker'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'linked_link'
	));
	
	$wp_customize->add_setting('youtube_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('youtube_link',array(
			'label'	=> esc_html__('Add youtube link here','skt-filmmaker'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'youtube_link'
	));	
	
	$wp_customize->add_setting('insta_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('insta_link',array(
			'label'	=> esc_html__('Add Instagram link here','skt-filmmaker'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'insta_link'
	));	

	//Hide Header Social Icons
	$wp_customize->add_setting('hide_header_topbar',array(
			'sanitize_callback' => 'skt_filmmaker_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_header_topbar', array(
    	   'section'   => 'header_top_bar',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','skt-filmmaker'),
    	   'type'      => 'checkbox'
     )); 	//Hide Header Top Bar		 	

	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => esc_html__('Slider Settings', 'skt-filmmaker'),
            'priority' => null,
            'description'	=> esc_html__('Featured Image Size Should be ( 1400 X 774 ) More slider settings available in PRO Version','skt-filmmaker'),		
        )
    );
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'skt_filmmaker_sanitize_integer'
	));
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide one:','skt-filmmaker'),
			'section'	=> 'slider_section'
	));	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',			
			'sanitize_callback'	=> 'skt_filmmaker_sanitize_integer'
	));
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide two:','skt-filmmaker'),
			'section'	=> 'slider_section'
	));	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'skt_filmmaker_sanitize_integer'
	));
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide three:','skt-filmmaker'),
			'section'	=> 'slider_section'
	));	
	//Slider hide
	$wp_customize->add_setting('hide_slides',array(
			'sanitize_callback' => 'skt_filmmaker_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_slides', array(
    	   'section'   => 'slider_section',    	 
		   'label'	=> esc_html__('Uncheck To Show Slider','skt-filmmaker'),
    	   'type'      => 'checkbox'
     )); // Slider Section	
	 
	// Home Section 1
	$wp_customize->add_section('section_thumb_with_content', array(
		'title'	=> esc_html__('Home Section One','skt-filmmaker'),
		'description'	=> esc_html__('Select Page from the dropdown for section','skt-filmmaker'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('sec-column-left1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'sec-column-left1',array('type' => 'dropdown-pages',
			'section' => 'section_thumb_with_content'
	));	
	
	$wp_customize->add_setting('section1_readmore',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('section1_readmore',array(
			'label'	=> __('Add Button Link','skt-filmmaker'),
			'section'	=> 'section_thumb_with_content',
			'setting'	=> 'section1_readmore'
	));	

	//Hide Section 	
	$wp_customize->add_setting('hide_home_secwith_content',array(
			'sanitize_callback' => 'skt_filmmaker_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_home_secwith_content', array(
    	   'section'   => 'section_thumb_with_content',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','skt-filmmaker'),
    	   'type'      => 'checkbox'
     )); // Hide Section 			

// Home Section 2
	$wp_customize->add_section('section_two', array(
		'title'	=> esc_html__('Home Section Two','skt-filmmaker'),
		'description'	=> esc_html__('Select Page from the dropdown','skt-filmmaker'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section2_title',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('section2_title',array(
			'label'	=> __('Section Title','skt-filmmaker'),
			'section'	=> 'section_two',
			'setting'	=> 'section2_title'
	));		
	
	$wp_customize->add_setting('page-column-left1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left1',array('type' => 'dropdown-pages',
			'section' => 'section_two'
	));	
	
	$wp_customize->add_setting('page-column-left2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left2',array('type' => 'dropdown-pages',
			'section' => 'section_two'
	));	
	
	$wp_customize->add_setting('page-column-left3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left3',array('type' => 'dropdown-pages',
			'section' => 'section_two'
	));			
	
	//Hide Section
	$wp_customize->add_setting('hide_sectiontwo',array(
			'sanitize_callback' => 'skt_filmmaker_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_sectiontwo', array(
    	   'section'   => 'section_two',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','skt-filmmaker'),
    	   'type'      => 'checkbox'
     )); //Hide Section	 	 

	// Home Section 3
	$wp_customize->add_section('hm_section_3', array(
		'title'	=> esc_html__('Home Section Three','skt-filmmaker'),
		'description'	=> esc_html__('Select Page from the dropdown for section','skt-filmmaker'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section3_title',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('section3_title',array(
			'label'	=> __('Section Title','skt-filmmaker'),
			'section'	=> 'hm_section_3',
			'setting'	=> 'section3_title'
	));		
	
	$wp_customize->add_setting('page-secthree-1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-secthree-1',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3'
	));	
	
	$wp_customize->add_setting('page-secthree-2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-secthree-2',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3'
	));	
	
	$wp_customize->add_setting('page-secthree-3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-secthree-3',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3'
	));	
	
	$wp_customize->add_setting('page-secthree-4',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'skt_filmmaker_sanitize_integer',
		));
	$wp_customize->add_control(	'page-secthree-4',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3'
	));		

	//Hide Section 	
	$wp_customize->add_setting('hide_home_third_content',array(
			'sanitize_callback' => 'skt_filmmaker_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_home_third_content', array(
    	   'section'   => 'hm_section_3',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','skt-filmmaker'),
    	   'type'      => 'checkbox'
     )); // Hide Section 	
}
add_action( 'customize_register', 'skt_filmmaker_customize_register' );
//Integer
function skt_filmmaker_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
function skt_filmmaker_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//setting inline css.
function skt_filmmaker_custom_css() {
    wp_enqueue_style(
        'skt-filmmaker-custom-style',
        get_template_directory_uri() . '/css/skt-filmmaker-custom-style.css'
    );
        $color = get_theme_mod( 'color_scheme' ); //E.g. #e64d43
		$header_text_color = get_header_textcolor();
        $custom_css = "
					#sidebar ul li a:hover,
					.footerarea a:hover,
					.cols-3 ul li.current_page_item a,				
					.phone-no strong,					
					.left a:hover,
					.blog_lists h4 a:hover,
					.recent-post h6 a:hover,
					.recent-post a:hover,
					.design-by a,
					.fancy-title h2 span,
					.postmeta a:hover,
					.left-fitbox a:hover h3, .right-fitbox a:hover h3, .tagcloud a,
					.blocksbox:hover h3,
					.homefour_section_content h2 span,
					.section5-column:hover h3,
					.cols-3 span,
					.section1top-block-area h2 span,
					.hometwo_section_content h2 span,
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a, .sitenav ul li.menu-item-has-children.hover, .sitenav ul li.current-menu-parent a.parentk,
					.rdmore a,
					.hometwo_section_area h2 small,
					.hometwo_section_area .woocommerce ul.products li.product:hover .woocommerce-loop-product__title,
					.home3_section_area h2 small,
					.sec3-block-button2,
					.designboxbg:hover .designbox-content h3,
					.hometwo-service-column-title a:hover
					{ 
						 color: {$color} !important;
					}
					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					.wpcf7 input[type='submit'],
					a.ReadMore,
					.section2button,
					input.search-submit,
					.recent-post .morebtn:hover, 
					.slide_info .slide_more,
					.sc1-service-box-outer,
					.read-more-btn,
					.woocommerce-product-search button[type='submit'],
					.head-info-area,
					.designs-thumb,
					.hometwo-block-button,
					.nivo-controlNav a,
					.aboutmore,
					.service-thumb-box
					{ 
					   background-color: {$color} !important;
					}
					.nivo-controlNav a.active,
					.sc1-service-box-outer h3 a:hover, .sc1-service-box-outer:hover h3 a,
					.hometwo_section_area .woocommerce ul.products li.product:hover,
					.nivo-controlNav a
					{
					   border-color: {$color} !important;
					}
					.titleborder span:after, .perf-thumb:before{border-bottom-color: {$color} !important;}
					.perf-thumb:after{border-top-color: {$color} !important;}					
					
				";
        wp_add_inline_style( 'skt-filmmaker-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'skt_filmmaker_custom_css' );          
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function skt_filmmaker_customize_preview_js() {
	wp_enqueue_script( 'skt_filmmaker_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'skt_filmmaker_customize_preview_js' );