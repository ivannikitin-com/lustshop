<?php
/**
 * lustshop Theme Customizer
 *
 * @package lustshop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lustshop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'lustshop_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'lustshop_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'lustshop_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lustshop_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lustshop_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lustshop_customize_preview_js() {
	wp_enqueue_script( 'lustshop-customizer', get_template_directory_uri() . 'dist/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'lustshop_customize_preview_js' );

// Add settings for theme
add_action('customize_register', function($customizer) {
	$customizer->add_section(
		'settings-site', array(
			'title'         => __( 'Settings theme', 'lustshop' ),
			'description'   => __( 'Contact information on the site', 'lustshop'),
			'priority'      => 11,
		)
	);

	$customizer->add_setting( 'lustshop_phone_number', array(
		'default' => ''
	) );
	$customizer->add_control(
		'lustshop_phone_number',
		array(
			'label'     => __('Phone number', 'lustshop'),
			'section'   => 'settings-site',
			'type'      => 'text',
		)
	);

	$customizer->add_setting( 'lustshop_email', array(
		'default' => ''
	) );
	$customizer->add_control(
		'lustshop_email',
		array(
			'label'     => __('E-mail', 'lustshop'),
			'section'   => 'settings-site',
			'type'      => 'email',
		)
	);

	$customizer->add_setting( 'lustshop_placeholder', array(
		'default' => ''
	) );
	$customizer->add_control(
		'lustshop_placeholder',
		array(
			'label'     => __('Image ID Placeholder', 'lustshop'),
			'section'   => 'settings-site',
			'type'      => 'text',
		)
	);
});