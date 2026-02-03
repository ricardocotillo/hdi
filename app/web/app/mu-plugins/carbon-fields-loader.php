<?php
/**
 * Plugin Name: Carbon Fields Loader
 * Description: Initializes Carbon Fields for the theme
 * Version: 1.0.0
 */

// Boot Carbon Fields
add_action( 'after_setup_theme', function() {
	require_once dirname( dirname( dirname( __DIR__ ) ) ) . '/vendor/autoload.php';
	\Carbon_Fields\Carbon_Fields::boot();
}, 5 );
