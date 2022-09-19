<?php
/**
 * FolioXarxa initialization setup
 *
 * @package FolioXarxa
 */
namespace FolioXarxa\Setup;

use FolioXarxa\Assets\AssetResolver;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'folio-xarxa', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Body open hook
	add_theme_support( 'body-open' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'folio-xarxa-featured', 1180, 640, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( 
		array(
			'primary-menu' => esc_html__( 'Primary menu', 'folio-xarxa' ),
		) 
	);


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output validW HTML5.
	 */
	add_theme_support( 
		'html5', 
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', 
		array(
			'width'      => 210,
			'height'       => 72,
			//'flex-width'  => true,
			//'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) 
	);


	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Custom stylesheet for visual editor
	add_editor_style( AssetResolver::resolve( 'css/editor-styles.css' ) );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Disable custom font sizes
	//add_theme_support( 'disable-custom-font-sizes' );

	// Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'folio-xarxa' ),
			'size'      => 16,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Normal', 'folio-xarxa' ),
			'size'      => 18,
			'slug'      => 'normal'
		),
		array(
			'name'      => __( 'Medium', 'folio-xarxa' ),
			'size'      => 22,
			'slug'      => 'medium'
		),
		array(
			'name'      => __( 'Large', 'folio-xarxa' ),
			'size'      => 28,
			'slug'      => 'large'
		),
		array(
			'name'      => __( 'XLarge', 'folio-xarxa' ),
			'size'      => 36,
			'slug'      => 'xlarge'
		),
		array(
			'name'      => __( 'Huge', 'folio-xarxa' ),
			'size'      => 42,
			'slug'      => 'huge'
		),
	) );


}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function content_width() {
	$GLOBALS['content_width'] = apply_filters( __NAMESPACE__ . '\\content_width', 1280 );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\content_width', 0 );


/**
 * Sets up theme custom colors support
 *
 * Note this function is hooked into init hook
 * to access cpt taxonomies
 */
function init() {

	// Disable Custom Colors
	//add_theme_support( 'disable-custom-colors' );
	
	// Editor Color Palette

	$primary = 		'#00233D';
	$secondary = 	'#B8B8D1';
	$red =     		'#FD4C5C';
	$red_light =    '#FF6B6C';
	$orange =  		'#FFC145';
	$green =   		'#7DE7B4';
	$green_light =  '#A5FFD4';
	$dark =  		'#000B33';
	$white =   		'#FFFFFF';

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary', 'folio-xarxa' ),
			'slug'  => 'primary',
			'color'	=> $primary,
		),
		array(
			'name'  => __( 'Primary', 'folio-xarxa' ) . ' 75%',
			'slug'  => 'primary-75',
			'color'	=> $primary.'bf',
		),
		array(
			'name'  => __( 'Primary', 'folio-xarxa' ). ' 50%',
			'slug'  => 'primary-50',
			'color'	=> $primary.'80',
		),
		array(
			'name'  => __( 'Primary', 'folio-xarxa' ). ' 20%',
			'slug'  => 'primary-20',
			'color'	=> $primary.'33',
		),
		array(
			'name'  => __( 'Primary', 'folio-xarxa' ). ' 10%',
			'slug'  => 'primary-10',
			'color'	=> $primary.'1a',
		),
		array(
			'name'  => __( 'Secondary', 'folio-xarxa' ),
			'slug'  => 'secondary',
			'color' => $secondary,
		),
		array(
			'name'  => __( 'Secondary', 'folio-xarxa' ) . ' 75%',
			'slug'  => 'secondary-75',
			'color'	=> $secondary.'bf',
		),
		array(
			'name'  => __( 'Secondary', 'folio-xarxa' ). ' 50%',
			'slug'  => 'secondary-50',
			'color'	=> $secondary.'80',
		),
		array(
			'name'  => __( 'Secondary', 'folio-xarxa' ). ' 20%',
			'slug'  => 'secondary-20',
			'color'	=> $secondary.'33',
		),
		array(
			'name'  => __( 'Secondary', 'folio-xarxa' ). ' 10%',
			'slug'  => 'secondary-10',
			'color'	=> $secondary.'1a',
		),
		array(
			'name'  => __( 'Red', 'folio-xarxa' ),
			'slug'  => 'red',
			'color' => $red,
		),
		array(
			'name'  => __( 'Red Light', 'folio-xarxa' ),
			'slug'  => 'red-light',
			'color' => $red_light,
		),
		array(
			'name'  => __( 'Green', 'folio-xarxa' ),
			'slug'  => 'green',
			'color' => $green,
		),
		array(
			'name'  => __( 'Green Light', 'folio-xarxa' ),
			'slug'  => 'green-light',
			'color' => $green_light,
		),
		array(
			'name'  => __( 'Orange', 'folio-xarxa' ),
			'slug'  => 'orange',
			'color' => $orange,
		),
		array(
			'name'  => __( 'Dark', 'folio-xarxa' ),
			'slug'  => 'dark',
			'color' => $dark,
		),
		array(
			'name'  => __( 'White', 'folio-xarxa' ),
			'slug'  => 'white',
			'color' => $white,
		),
	) );

	/*add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => __( 'Primary to secondary gradient', 'folio-xarsa' ),
				'gradient' => 'linear-gradient(135deg,rgb(0, 35, 61,1) 0%,rgb(184,184,209,1) 100%)',
				'slug'     =>  'primary-to-secondary',
			),
		   
		)
	);*/

}

add_action( 'init', __NAMESPACE__ . '\\init' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function widgets_init() {

	register_sidebar([
		'id'            => 'footer',
		'name'          => 	__('Footer', 'folio-xarxa'),
		'description'   =>  __( 'Add widgets here to appear in your footer site.', 'folio-xarxa' ),
		'before_widget' => '<section class="widget col %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	]);

}
add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );


/**
 * Remove widgets on theme activation
 */
function theme_activation ($old_theme, $WP_theme = null) {
  $widgets = array (
    'footer' => array ( false )
  );
  update_option('sidebars_widgets', $widgets);
}

add_action('after_switch_theme', __NAMESPACE__ . '\\theme_activation', 10, 2);


/**
 * Enqueue scripts and styles.
 */
function assets() {

	// Register jQuery in footer
	/*if( ! is_admin() && ! is_customize_preview() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
	}*/

	// registers scripts and stylesheets
	wp_register_style  ( 'folio-xarxa-style', AssetResolver::resolve( 'css/style.css' ), [], NULL );
	wp_register_script ( 'folio-xarxa-manifest', AssetResolver::resolve( 'js/manifest.js' ), [], NULL, true );
	wp_register_script ( 'folio-xarxa-vendor', AssetResolver::resolve( 'js/vendor.js' ), [], NULL, true );
	wp_register_script ( 'folio-xarxa-app', AssetResolver::resolve( 'js/app.js' ), ['jquery'], NULL, true );

	// enqueue global assets
	wp_enqueue_style  ( 'folio-xarxa-style' );
	//wp_style_add_data ( 'folio-xarxa-style', 'rtl', 'replace' );
	//wp_enqueue_script ( 'jquery' );
	wp_enqueue_script ( 'folio-xarxa-manifest' );
	wp_enqueue_script ( 'folio-xarxa-vendor' );
	wp_enqueue_script ( 'folio-xarxa-app' );

	// localization data
	wp_localize_script( 'folio-xarxa-app', 'folioXarxaData', array (
		'ajaxurl' 	=> admin_url( 'admin-ajax.php' ),				// ajax url
		'nonce' 	=> wp_create_nonce( 'folio-xarxa-theme' ),		// ajax nonce
 		't' => array(												// translations array
			'externalLink'			 => __( '(opens in new window)', 'folio-xarxa' ),
			'closeMenu'				 => __( 'Close menu', 'folio-xarxa' ),
			'loading'                => __( 'Loading', 'folio-xarxa' ),
			'expandCollapse'		 => __( "expand / collapse", "folio-xarxa" ),
			'loadMore'               => __( 'Load more', 'folio-xarxa' ),
		)
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets' );


/**
 * Enqueue editor blocks styles and scripts
 */
function block_editor_assets() {

	// registers stylesheet
	wp_register_style( 'folio-xarxa-editor-blocks-styles', AssetResolver::resolve( 'css/editor-blocks.css' ), [], NULL );

	// enqueue
	wp_enqueue_style( 'folio-xarxa-editor-blocks-styles' );

}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\block_editor_assets', 100 );


/*
 *  Admin styles
 */
function admin_styles() {
	if ( is_admin() ) {
		wp_enqueue_style("folio-xarxa-admin-styles", AssetResolver::resolve( 'css/admin.css' ), [], NULL);
	}
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\admin_styles' );
  


function filter_login_head() {
	$image = AssetResolver::resolve( 'images/folio-xarsa-logo.svg' );
	$width = 105;
	$height = 36;
    if ( has_custom_logo() ) {
		$custom = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$image = $custom[0];
		$width = $custom[1];
		$height = $custom[2];
	}
    ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo esc_url( $image ); ?>);
			background-size: contain;
			background-position: center;
			width: <?php echo absint( $width ) ?>px;
			height: <?php echo absint( $height ) ?>px;
			max-width: 100%;
        }
    </style>
	<?php
}
add_action( 'login_head', __NAMESPACE__ . '\\filter_login_head', 100 );


/**
 * Changing the logo link from wordpress.org to your site
 */
function login_url() {  return home_url('/'); }
add_filter('login_headerurl', __NAMESPACE__ . '\\login_url');


/**
 * Changing the alt text on the logo to show your site name
 */
function login_title() { return get_option('blogname'); }
add_filter('login_headertext', __NAMESPACE__ . '\\login_title');



/**
 * Admin notices
 */
function show_admin_notices() {
	$plugin_messages = array();

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

  	// Required UOC FolioXarxa Plugin
	if(!is_plugin_active( 'folio-xarxa-companion/folio-xarxa-companion.php' )){
		$plugin_messages[] = __('This theme requires you to install the Folio Xarxa Companion Plugin.', 'folio-xarxa');
  	}

	if(count($plugin_messages) > 0){
		echo '<div id="message" class="error">';
		foreach($plugin_messages as $message){
			echo '<p><strong>'.$message.'</strong></p>';
		}
		echo '</div>';
	}

}
//add_action('admin_notices',  __NAMESPACE__ . '\\show_admin_notices');
