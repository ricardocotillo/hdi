<?php
/**
 * Theme Functions
 */

/**
 * Helper: Get terms safely using database query
 * Used for taxonomies registered by Custom Post Type UI that may not work with get_terms()
 */
function blankslate_child_get_terms_safe( $taxonomy ) {
	global $wpdb;
	
	// Use $wpdb->prepare() to safely query the database
	$results = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT t.term_id, t.name, t.slug, tt.term_group
			FROM {$wpdb->terms} t
			INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
			WHERE tt.taxonomy = %s
			ORDER BY t.name ASC",
			$taxonomy
		)
	);
	
	return ! empty( $results ) ? $results : array();
}

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
	wp_enqueue_style( 'blankslate-child-menu-lateral', get_stylesheet_directory_uri() . '/menu-lateral.css', array(), '1.0.0' );
	
	// Enqueue main stylesheet
	wp_enqueue_style( 'blankslate-child', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Enqueue main script
	wp_enqueue_script( 'blankslate-child-main', get_stylesheet_directory_uri() . '/js/main.js', array(), '1.0.0', true );
	wp_enqueue_script( 'blankslate-child-menu-lateral', get_stylesheet_directory_uri() . '/menu-lateral.js', array(), '1.0.0', true );

	// Taxonomy page assets
	if ( is_tax() ) {
		wp_enqueue_style( 'blankslate-child-taxonomy', get_stylesheet_directory_uri() . '/taxonomy-styles.css', array(), '1.0.0' );
		wp_enqueue_script( 'blankslate-child-taxonomy', get_stylesheet_directory_uri() . '/js/taxonomy.js', array(), '1.0.0', true );
		
		// Owl Carousel assets for taxonomy pages
		wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array( 'owl-carousel' ), '2.3.4' );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'home-carousel', get_stylesheet_directory_uri() . '/js/home-carousel.js', array( 'jquery', 'owl-carousel' ), '2.1.1', true );
		
		$current_term = get_queried_object();
		wp_localize_script( 'blankslate-child-taxonomy', 'taxonomyData', array(
			'nonce' => wp_create_nonce( 'load_more_productos_nonce' ),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'currentTermId' => $current_term ? $current_term->term_id : '',
			'currentTaxonomy' => $current_term ? $current_term->taxonomy : ''
		) );
	}

	// Owl Carousel assets for Servicios template
	if ( is_page_template( 'template-servicios.php' ) ) {
		wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array( 'owl-carousel' ), '2.3.4' );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'servicios-carousel', get_stylesheet_directory_uri() . '/js/servicios-carousel.js', array( 'jquery', 'owl-carousel' ), '1.0.0', true );
	}

	// Owl Carousel assets and styles for Home template
	if ( is_page_template( 'template-home.php' ) ) {
		wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array( 'owl-carousel' ), '2.3.4' );
		wp_enqueue_style( 'blankslate-child-home', get_stylesheet_directory_uri() . '/home-styles.css', array(), '2.1.1' );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'home-carousel', get_stylesheet_directory_uri() . '/js/home-carousel.js', array( 'jquery', 'owl-carousel' ), '2.1.1', true );
	}

	// Owl Carousel assets and styles for Single Producto page
	if ( is_singular( 'productos' ) ) {
		wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array( 'owl-carousel' ), '2.3.4' );
		wp_enqueue_style( 'blankslate-child-single-productos', get_stylesheet_directory_uri() . '/single-productos-styles.css', array(), '1.0.0' );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'product-single-carousel', get_stylesheet_directory_uri() . '/js/product-single-carousel.js', array( 'jquery', 'owl-carousel' ), '1.0.0', true );
	}

	// Estilos para template de Garantía
	if ( is_page_template( 'template-garantia.php' ) ) {
		wp_enqueue_style( 'blankslate-child-garantia', get_stylesheet_directory_uri() . '/template-garantia-styles.css', array(), '1.0.0' );
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

/**
 * AJAX Handler: Filter Productos
 */
function blankslate_child_filter_productos() {
	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'load_more_productos_nonce' ) ) {
		wp_send_json_error( 'Nonce verification failed' );
	}

	$paged = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;
	$fabricantes = isset( $_POST['fabricantes'] ) ? sanitize_text_field( $_POST['fabricantes'] ) : '';
	$marcas = isset( $_POST['marcas'] ) ? sanitize_text_field( $_POST['marcas'] ) : '';
	$sku = isset( $_POST['sku'] ) ? sanitize_text_field( $_POST['sku'] ) : '';
	$cod_fabricante = isset( $_POST['cod_fabricante'] ) ? sanitize_text_field( $_POST['cod_fabricante'] ) : '';
	$current_term_id = isset( $_POST['current_term_id'] ) ? intval( $_POST['current_term_id'] ) : 0;
	$current_taxonomy = isset( $_POST['current_taxonomy'] ) ? sanitize_text_field( $_POST['current_taxonomy'] ) : '';

	$args = array(
		'posts_per_page' => 12,
		'paged'          => $paged,
	);

	// Build tax_query for taxonomies
	$tax_query = array( 'relation' => 'AND' );
	
	// Add current taxonomy filter (categoria-producto or other)
	if ( ! empty( $current_term_id ) && ! empty( $current_taxonomy ) ) {
		$tax_query[] = array(
			'taxonomy' => $current_taxonomy,
			'field'    => 'term_id',
			'terms'    => $current_term_id,
		);
	}
	
	if ( ! empty( $fabricantes ) ) {
		$tax_query[] = array(
			'taxonomy' => 'fabricantes',
			'field'    => 'term_id',
			'terms'    => intval( $fabricantes ),
		);
	}
	
	if ( ! empty( $marcas ) ) {
		$tax_query[] = array(
			'taxonomy' => 'marcas',
			'field'    => 'term_id',
			'terms'    => intval( $marcas ),
		);
	}

	if ( count( $tax_query ) > 1 ) {
		$args['tax_query'] = $tax_query;
	}

	// Build meta_query for meta fields
	$meta_query = array( 'relation' => 'AND' );
	
	if ( ! empty( $sku ) ) {
		$meta_query[] = array(
			'key'     => 'sku',
			'value'   => $sku,
			'compare' => 'LIKE',
		);
	}
	
	if ( ! empty( $cod_fabricante ) ) {
		$meta_query[] = array(
			'key'     => 'cod-fabricante',
			'value'   => $cod_fabricante,
			'compare' => 'LIKE',
		);
	}

	if ( count( $meta_query ) > 1 ) {
		$args['meta_query'] = $meta_query;
	}

	$query = new WP_Query( $args );
	$html = '';

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			ob_start();
			?>
			<article class="producto-item">
				<div class="producto-image">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium' ); ?>
					<?php endif; ?>
				</div>
				<h3 class="producto-title"><?php the_title(); ?></h3>
				<a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver más</a>
			</article>
			<?php
			$html .= ob_get_clean();
		}
		wp_reset_postdata();
	}

	$has_more = ( $paged * 12 ) < $query->found_posts;

	wp_send_json_success( array(
		'html'     => $html,
		'has_more' => $has_more,
	) );
}
add_action( 'wp_ajax_filter_productos', 'blankslate_child_filter_productos' );
add_action( 'wp_ajax_nopriv_filter_productos', 'blankslate_child_filter_productos' );

/**
 * AJAX Handler: Load More Productos (deprecated, kept for compatibility)
 */
function blankslate_child_load_more_productos() {
	blankslate_child_filter_productos();
}
add_action( 'wp_ajax_load_more_productos', 'blankslate_child_load_more_productos' );
add_action( 'wp_ajax_nopriv_load_more_productos', 'blankslate_child_load_more_productos' );


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
		) )


		->add_tab( __( 'Productos' ), array(
			Field::make( 'complex', 'crb_distribuidor_grid', __( 'Lista de logos de distribuidor oficial se muestra en la sección de productos' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) ),
				) )
				->set_min( 1 ),
			Field::make( 'rich_text', 'crb_repuestos_originals_text', __( 'Texto de repuestos originales' ) ),
			Field::make( 'rich_text', 'crb_distribuidor_official_text', __( 'Texto de distribuidor oficial para' ) ),
			Field::make( 'complex', 'crb_cuadros_azules', __( 'Cuadros Azules' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'texto', __( 'Texto' ) ),
					Field::make( 'text', 'link', __( 'Link' ) ),
				) )
				->set_min( 2 )
				->set_max( 2 ),
		) )
		
		->add_tab( __( 'Detalle Producto' ), array(
			Field::make( 'text', 'crb_producto_boton_cotizar', __( 'Texto Botón Cotizar' ) )
				->set_help_text( 'Texto que aparecerá en el botón de cotizar' )
				->set_default_value( 'Cotizar' ),
			Field::make( 'text', 'crb_producto_boton_cotizar_link', __( 'Link de Botón Cotizar' ) )
				->set_help_text( 'Texto que aparecerá en el botón de cotizar' )
				->set_default_value( 'Cotizar' ),			
			Field::make( 'image', 'crb_producto_icono_delivery', __( 'Imagen de Delivery' ) )
				->set_help_text( 'Sube la imagen para el icono de delivery' ),
			Field::make( 'image', 'crb_producto_icono_factura', __( 'Imagen de Boleta/Factura' ) )
				->set_help_text( 'Sube la imagen para el icono de boleta/factura' ),
		) )
		
		->add_tab( __( 'Formulario 1' ), array(
			Field::make( 'textarea', 'crb_formulario1', __( 'Formulario 1' ) )
    ->set_rows( 20 ),
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
/* equipamiento hartridge */
	Container::make( 'post_meta', __( 'Contenido Hartridge' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-hartridge.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_hartridge_title', __( 'Titulo Hartridge' ) )
				->set_help_text( 'Agrega el titulo de la seccion Hartridge' ),
			Field::make( 'rich_text', 'crb_hartridge_text', __( 'Texto Hartridge' ) )
				->set_help_text( 'Agrega el texto de la seccion Hartridge' ),
			Field::make( 'image', 'crb_hartridge_image', __( 'Imagen Hartridge' ) )
				->set_help_text( 'Carga la imagen de la seccion Hartridge' ),
		) );

	Container::make( 'post_meta', __( 'Items de Equipamiento' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-hartridge.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_page_equipment_items', __( 'Items de Equipamiento' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'logo', __( 'Logo' ) )
						->set_width( 25 ),
					Field::make( 'text', 'title', __( 'Titulo' ) )
						->set_width( 25 ),
					Field::make( 'rich_text', 'content', __( 'Contenido' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 ),
		) );

	Container::make( 'post_meta', __( 'Nuestros Productos' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-hartridge.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_hartridge_products', __( 'Nuestros Productos' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 ),
		) );

	Container::make( 'post_meta', __( 'Banners Hartridge' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-hartridge.php' )
		->add_fields( array(
			Field::make( 'image', 'crb_hartridge_banner_1', __( 'Banner 1' ) ),
			Field::make( 'image', 'crb_hartridge_banner_2', __( 'Banner 2' ) ),
			Field::make( 'text', 'crb_hartridge_novedades_title', __( 'Título de Novedades' ) ),
			Field::make( 'complex', 'crb_hartridge_news', __( 'Novedades Hartridge' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Título' ) )
						->set_width( 33 ),
					Field::make( 'image', 'image', __( 'Imagen' ) )
						->set_width( 33 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 34 ),
				) )
				->set_min( 0 ),
			Field::make( 'text', 'crb_hartridge_videos_title', __( 'Título de Videos' ) ),
			Field::make( 'complex', 'crb_hartridge_videos', __( 'Videos Hartridge' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'url', __( 'URL de Video' ) )
						->set_width( 100 ),
				) )
				->set_min( 0 ),
			Field::make( 'text', 'crb_hartridge_demo_title', __( 'Título Agenda tu Demo' ) ),
			Field::make( 'text', 'crb_hartridge_demo_phone', __( 'Celular' ) ),
			Field::make( 'text', 'crb_hartridge_demo_link_phone', __( 'Celular Link' ) ),
			Field::make( 'text', 'crb_hartridge_demo_email', __( 'Correo' ) ),
			Field::make( 'text', 'crb_hartridge_demo_address', __( 'Dirección' ) ),
			Field::make( 'text', 'crb_hartridge_form_title', __( 'Título del Formulario' ) ),
			Field::make( 'image', 'crb_footer_logo', __( 'Logo Footer' ) ),
			Field::make( 'textarea', 'crb_footer_text', __( 'Texto Footer' ) ),
			Field::make( 'text', 'crb_footer_phone', __( 'Teléfono Footer' ) ),
			Field::make( 'text', 'crb_footer_phone_link', __( 'Link Teléfono Footer' ) ),
			Field::make( 'text', 'crb_footer_email', __( 'Email Footer' ) ),
			Field::make( 'text', 'crb_footer_address', __( 'Dirección Footer' ) ),
			Field::make( 'text', 'crb_footer_address_link', __( 'Link Dirección Footer' ) ),
			Field::make( 'image', 'crb_hdi_logo_footer', __( 'HDI Logo Footer' ) ),
			Field::make( 'complex', 'crb_footer_social_media', __( 'Redes Sociales Footer' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'icon', __( 'Ícono' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) )
				->set_min( 0 ),
			Field::make( 'text', 'crb_hartridge_footer_copyright', __( 'Todos los Derechos Reservados' ) ),
			




			
		) );

/* equipamiento hartridge */


/* equipamiento jaltest */
	Container::make( 'post_meta', __( 'Banners Jaltest' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-jaltest.php' )
		->add_fields( array(
			Field::make( 'image', 'crb_jaltest_banner_1', __( 'Banner 1' ) ),
			Field::make( 'image', 'crb_jaltest_banner_2', __( 'Banner 2' ) ),
			Field::make( 'image', 'crb_jaltest_banner_3', __( 'Banner 3' ) ),
			Field::make( 'image', 'crb_jaltest_banner_4', __( 'Banner 4' ) ),
			
	) );

	Container::make( 'post_meta', __( 'Modelos Disponibles' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-jaltest.php' )
		->add_fields( array(
			Field::make( 'image', 'crb_imagen_modelos_disponibles', __( 'Imagen de fondo' ) ),
			Field::make( 'text', 'crb_titulo_modelos_disponibles', __( 'Título' ) ),
			
	) );	

	Container::make( 'post_meta', __( 'Items de Equipamiento' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-jaltest.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_page_equipment_items', __( 'Items de Equipamiento' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'logo', __( 'Logo' ) )
						->set_width( 50 ),
					Field::make( 'text', 'title', __( 'Titulo' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 ),
	) );

	Container::make( 'post_meta', __( 'Beneficios' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-jaltest.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_titulo_beneficios', __( 'Texto' ) ),
			Field::make( 'complex', 'crb_page_beneficios_items', __( 'Items de Beneficios' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'logo', __( 'Logo' ) )
						->set_width( 50 ),
					Field::make( 'rich_text', 'title', __( 'texto' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 ),
			
	) );	
						

		/* equipamiento jaltest */

/* HOME TEMPLATE */
	Container::make( 'post_meta', __( 'Home - Carrusel de Imágenes' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_home_image_carousel', __( 'Carrusel de Imágenes' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) )
						->set_width( 50 ),
					Field::make( 'text', 'link', __( 'Link' ) )
						->set_width( 50 ),
				) )
				->set_min( 1 ),
		) );

	Container::make( 'post_meta', __( 'Home - Buscador de Vehículos' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_home_brands_description', __( 'Descripción de marcas' ) )
				->set_help_text( 'Texto que aparece antes de las marcas' ),
		) );

	Container::make( 'post_meta', __( 'Home - Carrusel de Marcas' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_home_brands_carousel', __( 'Carrusel de Marcas' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Logo de Marca' ) )
				) )
				->set_min( 1 ),
		) );

	Container::make( 'post_meta', __( 'Home - Nuestros Servicios' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_home_services_title', __( 'Título' ) ),
			Field::make( 'image', 'crb_home_services_image', __( 'Imagen' ) ),
			Field::make( 'rich_text', 'crb_home_services_text', __( 'Texto' ) ),
		) );

	Container::make( 'post_meta', __( 'Home - Lo Más Vendido' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_home_bestsellers_title', __( 'Título' ) ),
			Field::make( 'text', 'crb_home_bestsellers_limit', __( 'Cantidad de Productos' ) )
				->set_default_value( '8' ),
		) );

	Container::make( 'post_meta', __( 'Home - Encuentra Mejores Equipos' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_home_equipment_title', __( 'Título' ) ),
			Field::make( 'image', 'crb_home_equipment_background', __( 'Imagen de Fondo' ) ),
			Field::make( 'image', 'crb_home_equipment_image', __( 'Imagen' ) ),
			Field::make( 'rich_text', 'crb_home_equipment_text', __( 'Texto' ) ),
		) );

	Container::make( 'post_meta', __( 'Home - Novedades' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_home_news_title', __( 'Título' ) ),
			Field::make( 'text', 'crb_home_news_limit', __( 'Cantidad de Posts' ) )
				->set_default_value( '6' ),
		) );

	Container::make( 'post_meta', __( 'Home - Partes y Piezas' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
			Field::make( 'rich_text', 'crb_home_parts_title', __( 'Título' ) ),
			Field::make( 'complex', 'crb_home_parts_gallery', __( 'Galería de Partes y Piezas' ) )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'image', 'image', __( 'Imagen' ) ),
				) )
				->set_min( 1 ),
		) );

	Container::make( 'post_meta', __( 'Home - Consejos' ) )
		->where( 'post_type', '=', 'page' )
		->where('post_template', '=', 'template-home.php' )
		->add_fields( array(
				Field::make( 'image', 'image_consejo_1', __( 'Imagen 1' ) )->set_width( 30 ),
				Field::make( 'image', 'image_consejo_2', __( 'Imagen 2' ) )->set_width( 30 ),
				Field::make( 'image', 'image_consejo_3', __( 'Imagen 3' ) )->set_width( 30 ),
				Field::make( 'text', 'image_consejo_2_link', __( 'Imagen 2 Link' ) )->set_width( 100 ),
		) );

/* HOME TEMPLATE */
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



