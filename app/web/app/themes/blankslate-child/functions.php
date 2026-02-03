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
	
	// Enqueue main script
	wp_enqueue_script( 'blankslate-child-main', get_stylesheet_directory_uri() . '/js/main.js', array(), '1.0.0', true );
	
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
 * Custom walker to add icon to menu items with submenu
 */
class Blankslate_Child_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $id = 0 ) {
		parent::start_el( $output, $data_object, $depth, $args, $id );
		
		if ( in_array( 'menu-item-has-children', $data_object->classes, true ) ) {
			$output = str_replace( '</a>', ' <i class="fas fa-caret-down"></i></a>', $output );
		}
	}
}

/**
 * Add walker to principal menu
 */
add_filter( 'wp_nav_menu_args', 'blankslate_child_nav_menu_args' );
function blankslate_child_nav_menu_args( $args ) {
	if ( 'principal' === $args['menu'] || isset( $args['menu'] ) && is_object( $args['menu'] ) && 'principal' === $args['menu']->name ) {
		$args['walker'] = new Blankslate_Child_Nav_Walker();
	}
	return $args;
}

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


use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Register theme options fields after Carbon Fields is loaded
add_action( 'carbon_fields_loaded', function() {
	Container::make( 'theme_options', __( 'Theme Options' ) )
		->add_tab( __( 'Header' ), array(
			Field::make( 'text', 'crb_header_title', __( 'Título' ) ),
			Field::make( 'complex', 'crb_header_email', __( 'Email' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'text', __( 'Email' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 )
				->set_max( 1 )
				->set_default_value( array( array( 'text' => '', 'link' => '' ) ) ),			
			Field::make( 'complex', 'crb_header_phone', __( 'Teléfonos' ) )	
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'phone', __( 'Teléfono' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) ),
			Field::make( 'complex', 'crb_header_address', __( 'Dirección' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'address', __( 'Dirección' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 )
				->set_max( 1 )
				->set_default_value( array( array( 'address' => '', 'link' => '' ) ) ),	
			Field::make( 'image', 'crb_header_logo', __( 'Logo Header' ) ),
			Field::make( 'complex', 'crb_header_whatsapp', __( 'WhatsApp' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'text', __( 'Texto' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 )
				->set_max( 1 )
				->set_default_value( array( array( 'text' => '', 'link' => '' ) ) ),			
		) )
		->add_tab( __( 'Redes Sociales' ), array(
			Field::make( 'complex', 'crb_social_media', __( 'Social Media Links' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'name', __( 'Network Name' ) )
						->set_width( 33 ),
					Field::make( 'text', 'url', __( 'URL' ) )
						->set_width( 33 ),
					Field::make( 'text', 'icon', __( 'Font Awesome Icon (e.g., fab fa-facebook)' ) )
						->set_width( 34 ),
				) )
				->set_min( 1 ),
		) )
		->add_tab( __( 'Footer' ), array(
			Field::make( 'complex', 'crb_distribution', __( 'Direcciones' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'label', __( 'Label' ) )
						->set_width( 33 ),
					Field::make( 'textarea', 'address', __( 'Dirección' ) )
						->set_width( 33 ),
					Field::make( 'text', 'url', __( 'URL (Opcional)' ) )
						->set_width( 34 ),
				) )
				->set_min( 1 ),
			Field::make( 'image', 'crb_footer_logo', __( 'Logo Footer' ) ),
			Field::make( 'complex', 'crb_footer_contacts', __( 'Teléfonos' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'label', __( 'Label' ) )
						->set_width( 33 ),
					Field::make( 'text', 'phone', __( 'Teléfono' ) )
						->set_width( 33 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 34 ),
				) ),
			Field::make( 'text', 'crb_copyright', __( 'Copyright Text' ) ),	
		) );
} );



