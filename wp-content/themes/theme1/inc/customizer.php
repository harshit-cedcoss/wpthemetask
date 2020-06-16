<?php
/**
 * Theme1: Customizer
 *
 * @package WordPress
 * @subpackage Theme1
 * @since Theme1 1.0
 */

/**
 * Add custom sections and setting to the Admin Customizer
 */
class TheMinimalist_Customizer {
	/**
	 *  Adding a constructor function.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customize_sections' ) );
	}
	/**
	 * Initialisation section
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_customize_sections( $wp_customize ) {
		$this->author_callout_section( $wp_customize );
	}
	/**
	 * Author Section, Setting and Controls
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	private function author_callout_section( $wp_customize ) {
		// Author Section Panel.
		$wp_customize->add_section(
			'basic-author-callout-section',
			array(
				'title'       => 'Author',
				'priority'    => 2,
				'description' => __( 'The Author Section is only displayed on a blog page' ),
			)
		);
		// Background Color Section Panel.
		$wp_customize->add_section(
			'background-color-section',
			array(
				'title'       => 'Background-Color',
				'priority'    => 10,
				'description' => __( 'Background color for any page' ),
			)
		);
		// Add settings for background color.
		$wp_customize->add_setting(
			'background-color-setting',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanatize_background_color'),
			)
		);
		// Add Settings for author-options.
		$wp_customize->add_setting(
			'basic-author-callout-display-options',
			array(
				'default'           => 'No',
				'sanitize_callback' => array( $this, 'sanatize_custom_display_option' ),
			)
		);
		// Add Control.
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'basic-author-callout-display-control',
				array(
					'label'    => 'Dispaly this section',
					'section'  => 'basic-author-callout-section',
					'settings' => 'basic-author-callout-display-options',
					'type'     => 'select',
					'choices'  => array(
						'No'  => 'No',
						'Yes' => 'Yes',
					),
				)
			)
		);

		// Add settings for text area.
		$wp_customize->add_setting(
			'basic-author-callout-text',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanatize_custom_text' ),
			)
		);

		// Add Control for text.
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'basic-author-callout-text-control',
				array(
					'label'    => 'About Author',
					'section'  => 'basic-author-callout-section',
					'settings' => 'basic-author-callout-text',
					'type'     => 'textarea',
				)
			)
		);

		// Add Settings for Author Image.
		$wp_customize->add_setting(
			'basic-author-callout-image',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( $this, 'sanatize_custom_url' ),
			)
		);

		// Add Control for Author Image.
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'basic-author-callout-image-control',
				array(
					'label'    => 'Author Image',
					'section'  => 'basic-author-callout-section',
					'settings' => 'basic-author-callout-image',
					'width'    => 200,
					'height'   => 160,
				)
			)
		);
	}
	/**
	 * Sanitizing the input.
	 */
	public function sanatize_custom_option( $input ) {
		return ( 'No' === $input ) ? 'No' : 'Yes';
	}
	/**
	 * Sanitizing the text input.
	 */
	public function sanatize_custom_text( $input ) {
		return filter_var( $input, FILTER_SANITIZE_STRING );
	}
	/**
	 * Sanitizing the image input.
	 */
	public function sanatize_custom_url( $input ) {
		return filter_var( $input, FILTER_SANITIZE_URL );
	}

}
