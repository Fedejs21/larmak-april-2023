<?php
/**
 * Functions and definitions
 *
 * @package Energia
 */

if(!defined('DEV_MODE')){
    define('DEV_MODE', true);
}

if ( ! function_exists( 'energia_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function energia_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'energia', get_template_directory() . '/languages' );

		// Custom Header
		add_theme_support( "custom-header" );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'energia' ),
			'footer-bottom' => esc_html__( 'Footer Bottom', 'energia' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'energia_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'post-formats', array(
			'gallery',
			'video',
		) );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
        /* Add theme image size */
        add_image_size( 'energia-medium', 768, 768, true );
	}
endif;
add_action( 'after_setup_theme', 'energia_setup' );

add_action( 'cms_locations', function ( $cms_locations ) {
	return $cms_locations;
} );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function energia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'energia_content_width', 640 );
}

add_action( 'after_setup_theme', 'energia_content_width', 0 );

/**
 * Register widget area.
 */
function energia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'energia' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here.', 'energia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if (class_exists('ReduxFramework')) {
		register_sidebar( array(
			'name'          => esc_html__( 'Page Sidebar', 'energia' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets here.', 'energia' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'energia' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'energia' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

    if (class_exists('ReduxFramework')) {
        register_sidebar( array(
            'name'          => esc_html__( 'Emergency Sidebar', 'energia' ),
            'id'            => 'sidebar-emergency',
            'description'   => esc_html__( 'Add widgets here to show in header.', 'energia' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}

add_action( 'widgets_init', 'energia_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function energia_scripts() {
	$theme = wp_get_theme( get_template() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style('font-awesome5', get_template_directory_uri() . '/assets/css/font-awesome5.min.css', array(), '5.8.0' );
    wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), $theme->get( 'Version' )  );
	wp_enqueue_style( 'material-design-iconic-font', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0' );
	wp_enqueue_style( 'energia-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'energia-style', get_stylesheet_uri() );
	wp_enqueue_style( 'energia-google-fonts', energia_fonts_url() );

	/* Lib JS */
    wp_enqueue_script('jquery-cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', array( 'jquery' ), '1.4.1', true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), 'all', true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );

    /* Theme JS */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'energia-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $theme->get( 'Version' ), true );
    wp_register_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.1', true);
	wp_register_script( 'energia-carousel', get_template_directory_uri() . '/assets/js/cms-carousel-owl.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_enqueue_script( 'energia-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_localize_script( 'energia-main', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    /*
     * Elementor Widget JS
     */
    // Counter Widget
    wp_register_script( 'cms-counter-widget-js', get_template_directory_uri() . '/elementor/js/cms-counter-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Progress Bar Widget
    wp_register_script( 'cms-progressbar-widget-js', get_template_directory_uri() . '/elementor/js/cms-progressbar-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Clients List Widget
    wp_register_script( 'cms-clients-list-widget-js', get_template_directory_uri() . '/elementor/js/cms-clients-list-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // CMS Post Carousel Widget
    wp_register_script( 'cms-post-carousel-widget-js', get_template_directory_uri() . '/elementor/js/cms-post-carousel-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    wp_register_script('cms-post-grid-widget-js', get_template_directory_uri() . '/elementor/js/cms-post-grid-widget.js', [ 'isotope', 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-toggle-widget-js', get_template_directory_uri() . '/elementor/js/cms-toggle-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-accordion-widget-js', get_template_directory_uri() . '/elementor/js/cms-accordion-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('cms-tabs-widget-js', get_template_directory_uri() . '/elementor/js/cms-tabs-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
}

add_action( 'wp_enqueue_scripts', 'energia_scripts' );

/* add editor styles */
function energia_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}

add_action( 'admin_init', 'energia_add_editor_styles' );

/* add admin styles */
function energia_admin_style() {
	$theme = wp_get_theme( get_template() );
	wp_enqueue_style( 'energia-admin-style', get_template_directory_uri() . '/assets/css/admin.css' );
	wp_enqueue_style( 'font-material-icon', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', array(), '2.2.0' );
    wp_enqueue_script('energia-main-admin', get_template_directory_uri() . '/assets/js/main-admin.js', array( 'jquery' ), $theme->get('Version'), true);
}

add_action( 'admin_enqueue_scripts', 'energia_admin_style' );

/**
 * Helper functions for this theme.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme options
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Page options
 */
require_once get_template_directory() . '/inc/page-options.php';

/**
 * CSS Generator.
 */
if ( ! class_exists( 'CSS_Generator' ) ) {
	require_once get_template_directory() . '/inc/classes/class-css-generator.php';
}

/**
 * Breadcrumb.
 */
require_once get_template_directory() . '/inc/classes/class-breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/* Load list require plugins */
require_once( get_template_directory() . '/inc/require-plugins.php' );

/* Load lib Font */
require_once get_template_directory() . '/inc/libs/fontawesome.php';
require_once get_template_directory() . '/inc/libs/materialdesign.php';


/**
 * Additional widgets for the theme
 */
require_once get_template_directory() . '/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/widgets/widget-social.php';
require_once get_template_directory() . '/widgets/widget-contact-box.php';
require_once get_template_directory() . '/widgets/class.widget-extends.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/extends.php';


if ( ! function_exists( 'energia_fonts_url' ) ) :
	/**
	 * Register Google fonts.
	 *
	 * Create your own energia_fonts_url() function to override in a child theme.
	 *
	 * @since league 1.1
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function energia_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

        if ( 'off' !== _x( 'on', 'IBM Plex Sans font: on or off', 'energia' ) ) {
            $fonts[] = 'IBM Plex Sans:400,400i,500,500i,600,600i,700,700i';
        }
		
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'energia' ) ) {
			$fonts[] = 'Roboto:300,400,400i,500,500i,600,600i,700,700i';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/* Favicon */
function energia_site_favicon(){
    
    $favicon = energia_get_opt( 'favicon' );
    
    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}
add_action('wp_head', 'energia_site_favicon');

/**
 * Add Template Woocommerce
 */
if(class_exists('Woocommerce')){
    require_once( get_template_directory() . '/woocommerce/wc-function-hooks.php' );
}
