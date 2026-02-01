<?php
/**
 * Theme Functions
 */

/**
 * Enqueue styles and scripts
 */
function blankslate_child_enqueue_assets() {
	// Enqueue Font Awesome 5 Free
	wp_enqueue_style( 'fontawesome-5', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
	
	// Enqueue header and footer styles
	wp_enqueue_style( 'blankslate-child-header', get_stylesheet_directory_uri() . '/header-styles.css', array(), '1.0.0' );
	wp_enqueue_style( 'blankslate-child-footer', get_stylesheet_directory_uri() . '/footer-styles.css', array(), '1.0.0' );
	
	// Enqueue main stylesheet
	wp_enqueue_style( 'blankslate-child', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Enqueue livereload script para desarrollo
	if ( defined( 'WP_ENV' ) && 'development' === WP_ENV || isset( $_ENV['WP_ENV'] ) && 'development' === $_ENV['WP_ENV'] ) {
		wp_enqueue_script( 'livereload', get_stylesheet_directory_uri() . '/livereload.js', array(), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'blankslate_child_enqueue_assets' );

/**
 * Register navigation menus
 */
function blankslate_child_register_menus() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'blankslate-child' ),
		'footer'  => __( 'Footer Menu', 'blankslate-child' ),
	) );
}
add_action( 'after_setup_theme', 'blankslate_child_register_menus' );

/**
 * Register footer widget areas
 */
function blankslate_child_register_widgets() {
	register_sidebar( array(
		'name'          => __( 'Footer Column 1', 'blankslate-child' ),
		'id'            => 'footer-1',
		'description'   => __( 'First column in footer', 'blankslate-child' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 2', 'blankslate-child' ),
		'id'            => 'footer-2',
		'description'   => __( 'Second column in footer', 'blankslate-child' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 3', 'blankslate-child' ),
		'id'            => 'footer-3',
		'description'   => __( 'Third column in footer', 'blankslate-child' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 4', 'blankslate-child' ),
		'id'            => 'footer-4',
		'description'   => __( 'Fourth column in footer', 'blankslate-child' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'blankslate_child_register_widgets' );
