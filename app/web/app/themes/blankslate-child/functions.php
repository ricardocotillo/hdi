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
	wp_enqueue_style( 'blankslate-child-empresa', get_stylesheet_directory_uri() . '/empresa-styles.css', array(), '1.0.0' );
	
	// Enqueue main stylesheet
	wp_enqueue_style( 'blankslate-child', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Enqueue main script
	wp_enqueue_script( 'blankslate-child-main', get_stylesheet_directory_uri() . '/js/main.js', array(), '1.0.0', true );

	// Owl Carousel assets for Servicios template
	if ( is_page_template( 'template-servicios.php' ) ) {
		wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array( 'owl-carousel' ), '2.3.4' );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'servicios-carousel', get_stylesheet_directory_uri() . '/js/servicios-carousel.js', array( 'jquery', 'owl-carousel' ), '1.0.0', true );
	}
	
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





/**
 * Add Carbon Fields to Custom Post Type: Catálogo
 */
add_action( 'carbon_fields_loaded', function() {
	Container::make( 'post_meta', __( 'Detalles del Catálogo' ) )
		->where( 'post_type', '=', 'newcatalogo' )
		->add_fields( array(
			Field::make( 'file', 'crb_catalogo_pdf', __( 'Archivo PDF' ) )
				->set_width( 50 )
				->set_help_text( 'Carga un archivo PDF para este catálogo' ),
			Field::make( 'date', 'crb_catalogo_fecha', __( 'Fecha' ) )
				->set_width( 50 )
				->set_help_text( 'Selecciona una fecha para este catálogo' ),
		) );
} );

/**
 * Add Carbon Fields to Page: Header Image
 */
add_action( 'carbon_fields_loaded', function() {
	Container::make( 'post_meta', __( 'Imagen de Cabecera' ) )
		->where( 'post_type', '=', 'page' )
		->set_priority( 'high' )
		->add_fields( array(
			Field::make( 'image', 'crb_page_header_image', __( 'Imagen de Cabecera' ) )
				->set_help_text( 'Carga una imagen para mostrar en la cabecera de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Texto de Empresa' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_company_text', __( 'Texto de Empresa' ) )
				->set_help_text( 'Agrega contenido de texto para la sección de empresa de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Imagen de Empresa' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'image', 'crb_page_company_image', __( 'Imagen de Empresa' ) )
				->set_help_text( 'Carga una imagen para mostrar en la sección de empresa de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Texto de Misión' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_mission_text', __( 'Texto de Misión' ) )
				->set_help_text( 'Agrega contenido de texto para la sección de misión de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Imagen de Misión' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'image', 'crb_page_mission_image', __( 'Imagen de Misión' ) )
				->set_help_text( 'Carga una imagen para mostrar en la sección de misión de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Texto de Visión' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_vision_text', __( 'Texto de Visión' ) )
				->set_help_text( 'Agrega contenido de texto para la sección de visión de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Imagen de Visión' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'image', 'crb_page_vision_image', __( 'Imagen de Visión' ) )
				->set_help_text( 'Carga una imagen para mostrar en la sección de visión de esta página' ),
		) );

	Container::make( 'post_meta', __( 'Texto Política SIG' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_policy_sig_text', __( 'Texto Política SIG' ) )
				->set_help_text( 'Agrega el texto para la sección de política SIG' ),
		) );

	Container::make( 'post_meta', __( 'PDF Política SIG' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'file', 'crb_page_policy_sig_pdf', __( 'PDF Política SIG' ) )
				->set_help_text( 'Carga el PDF de la política SIG' ),
		) );

	Container::make( 'post_meta', __( 'Texto Botón' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_page_button_text', __( 'Texto Botón' ) )
				->set_help_text( 'Agrega el texto del botón para esta página' ),
		) );

	Container::make( 'post_meta', __( 'Video Corporativo' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_page_video_title', __( 'Título de Video Corporativo' ) )
				->set_help_text( 'Agrega el título del video corporativo' ),
			Field::make( 'text', 'crb_page_video_url', __( 'URL de Video (YouTube)' ) )
				->set_help_text( 'Pega el link de YouTube para mostrar el video' ),
		) );

	Container::make( 'post_meta', __( 'Valores Corporativos' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-empresa.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_page_values_title', __( 'Título de Valores Corporativos' ) )
				->set_help_text( 'Agrega el título de la sección de valores corporativos' ),
			Field::make( 'complex', 'crb_page_values_list', __( 'Valores Corporativos' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'icon', __( 'Icono (clase CSS o nombre)' ) )
						->set_width( 30 ),
					Field::make( 'textarea', 'text', __( 'Texto de Valor' ) )
						->set_width( 70 ),
				) )
				->set_min( 1 ),
		) );

/* servicios */
	Container::make( 'post_meta', __( 'Galería de Laboratorio' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_page_laboratory_gallery', __( 'Galería de Laboratorio' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) ),
				) )
				->set_min( 1 ),
		) );


	Container::make( 'post_meta', __( 'Texto de Laboratorio' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_laboratory_text', __( 'Texto de Laboratorio' ) )
				->set_help_text( 'Agrega contenido de texto para la sección de laboratorio de esta página' ),
		) );

		
	Container::make( 'post_meta', __( 'Texto de boton de Laboratorio' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_page_laboratory_button_text', __( 'Texto de Botón de Laboratorio' ) )
				->set_help_text( 'Agrega el texto del botón para la sección de laboratorio de esta página' ),
		) );
		

	Container::make( 'post_meta', __( 'Galería de Servicios de Campo' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_page_field_services_gallery', __( 'Galería de Servicios de Campo' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) ),
				) )
				->set_min( 1 ),
		) );


	Container::make( 'post_meta', __( 'Texto de Servicios de Campo' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_field_services_text', __( 'Texto de Servicios de Campo' ) )
				->set_help_text( 'Agrega contenido de texto para la sección de servicios de campo de esta página' ),
		) );

		
	Container::make( 'post_meta', __( 'Texto de boton de Servicios de Campo' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_page_field_services_button_text', __( 'Texto de Botón de Servicios de Campo' ) )
				->set_help_text( 'Agrega el texto del botón para la sección de servicios de campo de esta página' ),
		) );
		
		
	Container::make( 'post_meta', __( 'Galería de red de Servicios' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_page_field_red_services_gallery', __( 'Galería de Red de Servicios' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) ),
				) )
				->set_min( 1 ),
		) );


	Container::make( 'post_meta', __( 'Texto de Red de Servicios' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_page_field_red_services_text', __( 'Texto de Red de Servicios' ) )
				->set_help_text( 'Agrega contenido de texto para la sección de red de servicios de esta página' ),
		) );

		
	Container::make( 'post_meta', __( 'Texto de boton de Red de Servicios' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-servicios.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_page_field_red_services_button_text', __( 'Texto de Botón de Red de Servicios' ) )
				->set_help_text( 'Agrega el texto del botón para la sección de red de servicios de esta página' ),
		) );		

/* servicios */
/* equipamiento */
Container::make( 'post_meta', __( 'Galería de Equipamiento' ) )
	->where( 'post_type', '=', 'page' )
	->where('post_template', '=', 'template-equipamiento.php' )
	->add_fields( array(
		Field::make( 'complex', 'crb_page_equipment_gallery', __( 'Galería de Equipamiento' ) )
			->set_layout( 'grid' )
			->add_fields( array(
				Field::make( 'image', 'image', __( 'Imagen' ) ),
			) )
			->set_min( 2 )
			->set_max( 2 ),
	) );

	Container::make( 'post_meta', __( 'Contenido de Equipamiento' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-equipamiento.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_page_equipment_content', __( 'Contenido de Equipamiento' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) )
						->set_width( 50 ),
					Field::make( 'rich_text', 'content', __( 'Contenido' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 ),
		) );

/* equipamiento */
} );





/**
 * Increase upload file size limit
 */
add_filter( 'upload_size_limit', function() {
	return 100 * 1024 * 1024; // 100MB
} );

add_filter( 'import_upload_size_limit', function() {
	return 100 * 1024 * 1024; // 100MB
} );



