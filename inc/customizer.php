<?php
/**
 * FolioXarxa customizer
 *
 * @package FolioXarxa
 */

namespace FolioXarxa\Customizer;

use FolioXarxa\Assets\AssetResolver;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function customize_register( $wp_customize ) {

	// require_once get_parent_theme_file_path( 'inc/customizer/customizer-range.php' );
	require_once get_parent_theme_file_path( 'inc/customizer/customizer-separator.php' );
	require_once get_parent_theme_file_path( 'inc/customizer/customizer-toggle.php' );
	require_once get_parent_theme_file_path( 'inc/customizer/customizer-heading.php' );

	// Register the toggle custom control
	$wp_customize->register_control_type( 'FolioXarxa\Customizer\Toggle_Custom_Control' );


	$btn_choices = array (
		'btn-default' => __( '&mdash; Select &mdash;', 'folio-xarxa' ),
		'btn-primary' => __( 'Primary', 'folio-xarxa' ), 
		'btn-secondary' => __( 'Secondary', 'folio-xarxa' ), 
		'btn-info' => __( 'Gray', 'folio-xarxa' ), 
		'btn-success' => __( 'Green', 'folio-xarxa' ), 
		'btn-warning' => __( 'Orange', 'folio-xarxa' ), 
		'btn-danger' => __( 'Red', 'folio-xarxa' ), 
	);

	$align_choices = array (
		'' => __( '&mdash; Select &mdash;', 'folio-xarxa' ),
		'text-left' => __( 'Left', 'folio-xarxa' ), 
		'text-center' => __( 'Center', 'folio-xarxa' ), 
		'text-right' => __( 'Right', 'folio-xarxa' ), 
		'text-justify' => __( 'Justify', 'folio-xarxa' ),  
	);

	$layout_choices = array (
		'' => __( '&mdash; Select &mdash;', 'folio-xarxa' ),
		'list' => __( 'List', 'folio-xarxa' ), 
		'grid' => __( 'Grid', 'folio-xarxa' ), 
		'masonry' => __( 'Masonry', 'folio-xarxa' ), 
	);

	$content_choices = array (
		'' => __( '&mdash; Select &mdash;', 'folio-xarxa' ),
		'full' => __( 'Full content', 'folio-xarxa' ), 
		'excerpt' => __( 'Summary', 'folio-xarxa' ), 
	);


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'FolioXarxa\Customizer\customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'FolioXarxa\Customizer\customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section( 'folio-xarxa' , array (
		'title' 		=> __( 'Folio Settings', 'folio-xarxa' ),
		'capability' 	=> 'edit_theme_options',
		'priority'		=> 1
	) );


	$wp_customize->add_setting('folio_xarxa_secc_general', array()); // dummy

	$wp_customize->add_control( new Sub_Section_Heading_Custom_Control( $wp_customize, 'folio_xarxa_secc_general',
            array(
                'label'   => __( 'General Settings', 'folio-xarxa' ),
                'section' => 'folio-xarxa',
            )
    ) );

	$wp_customize->add_setting( 'folio_xarxa_align', array (
		'default' 		=> '',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_select',
	) );
	  
	$wp_customize->add_control( 'folio_xarxa_align', array (
		'label' => __( 'Content Align', 'folio-xarxa' ),
		'section' => 'folio-xarxa',
		'type' => 'select',
		'choices' => $align_choices
	) );

	$wp_customize->add_setting( 'folio_xarxa_archive_layout', array (
		'default' 		=> '',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_select',
	) );
	  
	$wp_customize->add_control( 'folio_xarxa_archive_layout', array (
		'label' => __( 'Archive Layout', 'folio-xarxa' ),
		'section' => 'folio-xarxa',
		'type' => 'select',
		'choices' => $layout_choices
	) );


	$wp_customize->add_setting( 'folio_xarxa_archive_content', array (
		'default' 		=> 'excerpt',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_select',
	) );
	  
	$wp_customize->add_control( 'folio_xarxa_archive_content', array (
		'label' => __( 'Archive content', 'folio-xarxa' ),
		'section' => 'folio-xarxa',
		'type' => 'select',
		'choices' => $content_choices
	) );

	$wp_customize->add_setting( 'folio_xarxa_archive_thumb_show', array (
        'default' 		=> true,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );

	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_archive_thumb_show', array (
		'label'       => esc_html__( 'Display Featured Image in Archive', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );

	$wp_customize->add_setting( 'folio_xarxa_cats_show', array (
        'default' 		=> false,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );

	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_cats_show', array (
		'label'       => esc_html__( 'Display Categories', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting( 'folio_xarxa_tags_show', array (
        'default' 		=> true,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );

	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_tags_show', array (
		'label'       => esc_html__( 'Display Tags', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting('folio_xarxa_secc_heading', array()); // dummy

	$wp_customize->add_control( new Sub_Section_Heading_Custom_Control( $wp_customize, 'folio_xarxa_secc_heading',
            array(
                'label'   => __( 'Heading Settings', 'folio-xarxa' ),
                'section' => 'folio-xarxa',
            )
    ) );

	$wp_customize->add_setting( 'folio_xarxa_lang_show', array (
        'default' 		=> true,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );

	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_lang_show', array (
		'label'       => esc_html__( 'Display Custom WPML Lang Menu', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting( 'folio_xarxa_cta_show', array (
        'default' 		=> false,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );


	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_cta_show', array (
		'label'       => esc_html__( 'Display Header CTA', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting('folio_xarxa_separator_1');
	$wp_customize->add_control(new Separator_Custom_control ( $wp_customize, 'folio_xarxa_separator_1', array (
		'type'		=> 'separator',
		'section' => 'folio-xarxa',
	) ) );

	$wp_customize->add_setting( 'folio_xarxa_cta_type', array (
		'default' 		=> 'btn-primary',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_select',
	) );
	  
	$wp_customize->add_control( 'folio_xarxa_cta_type', array (
		'label' => __( 'CTA Button Type', 'folio-xarxa' ),
		'section' => 'folio-xarxa',
		'type' => 'select',
		'choices' => $btn_choices
	) );

	$wp_customize->add_setting( 'folio_xarxa_cta_outline', array (
        'default' 		=> false,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );


	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_cta_outline', array (
		'label'       => esc_html__( 'Button outline style', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting( 'folio_xarxa_cta_title', array (
        'default' 		=> '',
		'sanitize_callback' => 'wp_kses',
    ) );
 
    $wp_customize->add_control( 'folio_xarxa_cta_title', array ( 
		'type' 			=> 'text',
        'section' 		=> 'folio-xarxa',
		'label' 		=> __( 'CTA Title', 'folio-xarxa' ),
	) );


	$wp_customize->add_setting( 'folio_xarxa_cta_url', array (
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_url',
	) );
	  
	$wp_customize->add_control( 'folio_xarxa_cta_url', array (
		'type' => 'url',
		'section' => 'folio-xarxa',
		'label' => __( 'CTA Link' , 'folio-xarsa'),
		'input_attrs' => array(
		  'placeholder' => 'https://',
		),
	) );

	$wp_customize->add_setting( 'folio_xarxa_cta_target', array (
        'default' 		=> false,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );


	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_cta_target', array (
		'label'       => esc_html__( 'Opens in new window', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting('folio_xarxa_secc_footer', array()); // dummy

	$wp_customize->add_control( new Sub_Section_Heading_Custom_Control( $wp_customize, 'folio_xarxa_secc_footer',
            array(
                'label'   => __( 'Footer Settings', 'folio-xarxa' ),
                'section' => 'folio-xarxa',
            )
    ) );


	$wp_customize->add_setting( 'folio_xarxa_gototop_show', array (
        'default' 		=> true,
		//'transport'         => 'postMessage',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_checkbox',
    ) );

	$wp_customize->add_control( new Toggle_Custom_Control( $wp_customize, 'folio_xarxa_gototop_show', array (
		'label'       => esc_html__( 'Display Go To Top', 'folio-xarxa' ),
		'section'     => 'folio-xarxa',
		'type'        => 'toggle',
	) ) );


	$wp_customize->add_setting( 'folio_xarxa_footer_text', array (
        'default' 		=> '',
		'sanitize_callback' => 'wp_kses',
    ) );
 
    $wp_customize->add_control( 'folio_xarxa_footer_text', array ( 
		'type' 			=> 'textarea',
        'section' 		=> 'folio-xarxa',
		'label' 		=> __( 'Footer Text', 'folio-xarxa' ),
	) );

	$wp_customize->add_setting( 'folio_xarxa_footer_align', array (
		'default' 		=> '',
		'sanitize_callback' => 'FolioXarxa\Customizer\sanitize_select',
	) );
	  
	$wp_customize->add_control( 'folio_xarxa_footer_align', array (
		'label' => __( 'Footer Text Align', 'folio-xarxa' ),
		'section' => 'folio-xarxa',
		'type' => 'select',
		'choices' => $align_choices
	) );

}
add_action( 'customize_register', __NAMESPACE__ . '\\customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customize_preview_js() {
	wp_enqueue_script ( 'folio-xarxa-customizer', AssetResolver::resolve( 'js/customizer.js' ), [ 'customize-preview' ], NULL, true );
}
add_action( 'customize_preview_init', __NAMESPACE__ . '\\customize_preview_js' );


/**
 * Select sanitization function
 * input must be a slug: lowercase alphanumeric characters, dashes and underscores allowed
 */
function sanitize_select( $input, $setting ){
	$input = sanitize_key($input);
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );  
}

/**
 * Checkbox sanitization callback
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}


/**
 * Url sanitization callback
 *
 * @param string $url url
 * @return string saintized url
 */
function sanitize_url( $url ) {
	return esc_url_raw( $url );
}



/**
 * This function adds some styles to the WordPress Customizer
 */
function customizer_styles() { ?>
	<style>
		.sub-section-heading-control .customize-control-title {
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', __NAMESPACE__ . '\\customizer_styles', 999 );
