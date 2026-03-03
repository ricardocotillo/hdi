<?php
/**
 * Plugin Name: Carbon Fields Loader
 * Description: Initializes Carbon Fields for the theme
 * Version: 1.0.0
 */

// Boot Carbon Fields
add_action( 'after_setup_theme', function() {
	$autoload = dirname( __DIR__, 3 ) . '/vendor/autoload.php';

	if ( file_exists( $autoload ) ) {
		require_once $autoload;
		\Carbon_Fields\Carbon_Fields::boot();
	} else {
		error_log( 'Carbon Fields Loader: autoload no encontrado en ' . $autoload );
	}
}, 5 );
