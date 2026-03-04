<?php
get_header(); ?>

<div class="taxonomy-container">
    <?php
    $term = get_queried_object();
    $fabricantes = get_terms( array(
        'taxonomy' => 'fabricantes',
        'hide_empty' => true,
    ) );
    $marcas = get_terms( array(
        'taxonomy' => 'marcas',
        'hide_empty' => true,
    ) );
    
    ?>
    <div class="taxonomy-wrapper-container">
        <div class="container mx-auto taxonomy-wrapper flex gap-5">
            <!-- Panel de Filtros -->
            <aside class="filters-panel">
                <h3 class="filters-title">Seleccione vehículos</h3>
    
                <!-- Fabricantes -->
                <div class="filter-group">
                    <label for="filter-fabricantes">Fabricantes</label>
                    <select id="filter-fabricantes" class="filter-select" data-taxonomy="fabricantes">
                        <option value="">Seleccionar...</option>
                        <?php foreach ( $fabricantes as $fabricante ) : ?>
                            <option value="<?php echo esc_attr( $fabricante->term_id ); ?>"><?php echo esc_html( $fabricante->name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
    
                <!-- Marcas -->
                <div class="filter-group">
                    <label for="filter-marcas">Marcas</label>
                    <select id="filter-marcas" class="filter-select" data-taxonomy="marcas">
                        <option value="">Seleccionar...</option>
                        <?php foreach ( $marcas as $marca ) : ?>
                            <option value="<?php echo esc_attr( $marca->term_id ); ?>"><?php echo esc_html( $marca->name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
    
                <!-- Código OEM -->
                <div class="filter-group">
                    <label for="filter-oem">Código OEM</label>
                    <input type="text" id="filter-oem" class="filter-input" placeholder="Buscar...">
                </div>
    
                <!-- Códigos Fabricante -->
                <div class="filter-group">
                    <label for="filter-fabricante-code">Códigos Fabricante</label>
                    <input type="text" id="filter-fabricante-code" class="filter-input" placeholder="Buscar...">
                </div>
    
                <?php 
                    $whatsapps = carbon_get_theme_option( 'crb_header_whatsapp' );
                ?>
                <!-- Botón Contacto -->
                <div class="filter-contact hide-mobile">
                    <a href="<?php echo esc_url( $whatsapps[0]['link'] ); ?>" class="btn-contactanos"><i aria-hidden="true" class="fab fa-whatsapp"></i> Contáctanos</a>
                </div>
            </aside>
    
            <!-- Productos Grid -->
            <main class="productos-main">
                <div id="productos-grid" class="productos-grid">
                    <?php 
                    if (have_posts()) : 
                        $count = 0;
                        while (have_posts() && $count < 12) : 
                            the_post();
                            $count++;
                            ?>
                            <article class="producto-item">
                                <div class="producto-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php endif; ?>
                                </div>
                                <h3 class="producto-title"><?php the_title(); ?></h3>
                                <a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver más</a>
                            </article>
                            <?php
                        endwhile;
                    else : 
                        ?>
                        <p class="no-productos">No hay productos.</p>
                    <?php endif; ?>
                </div>
    
            </main>
        </div>
        <!-- Botón Ver Más -->
        <?php 
        global $wp_query;
        if ($wp_query->found_posts > 12) :
        ?>
        <div class="ver-mas-container">
            <button id="load-more-btn" class="btn-ver-mas-productos" data-paged="2" data-term-id="<?php echo $term->term_id; ?>" data-taxonomy="<?php echo $term->taxonomy; ?>">
                Ver más
            </button>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="w-full container mx-auto">
        <div class="container">
            <div class="filter-contact filter-contact-mobile">
                <a href="<?php echo esc_url( $whatsapps[0]['link'] ); ?>" class="btn-contactanos"><i aria-hidden="true" class="fab fa-whatsapp"></i> Contáctanos</a>
            </div>
        </div>
    </div>
    <style>
    /* Oculta elementos con la clase .hide-mobile en pantallas menores a 768px */
    @media (max-width: 767px) {
        .hide-mobile {
            display: none !important;
        }
    }
    </style>


    <div class="w-full container mx-auto">
        <section class="container">
            <section class="repuestos text-center">
                <?php
                $repuestos_text = carbon_get_theme_option( 'crb_repuestos_originals_text' );
                if ( ! empty( $repuestos_text ) ) :
                    echo wp_kses_post( $repuestos_text );
                endif;
                ?>
            </section>
    <!-- Section: Brands Carousel -->
        <section class="w-full">
            <div class="container">

                
                <div class="owl-carousel owl-theme home-brands-carousel">
                    <?php
                    $brands_carousel = carbon_get_theme_option( 'crb_distribuidor_grid' );
                    if ( ! empty( $brands_carousel ) ) :
                        foreach ( $brands_carousel as $brand ) :
                            $logo_url = ! empty( $brand['image'] ) ? wp_get_attachment_image_url( $brand['image'], 'medium' ) : '';
                            $link = ! empty( $brand['link'] ) ? $brand['link'] : '#';
                            ?>
                            <div class="brand-carousel-item text-center">
                                <?php if ( $logo_url ) : ?>
                                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="Brand Logo" class="h-24 mx-auto">
                                <?php endif; ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <!-- Section: Parts and Pieces -->
        <section class="home-parts-section bg-white">
            <div class="container text-center text-distribuidor-official">
                <?php 
                $parts_title = carbon_get_theme_option( 'crb_distribuidor_official_text' );
                if ( ! empty( $parts_title ) ) :
                    ?>
                        <?php echo wp_kses_post( $parts_title ); ?>   

                    <div class="owl-carousel owl-theme home-parts-carousel">
                        <?php
                        $parts_gallery = carbon_get_post_meta( get_option('page_on_front'), 'crb_home_parts_gallery' );
                        if ( ! empty( $parts_gallery ) ) :
                            foreach ( $parts_gallery as $part ) :
                                $part_image = ! empty( $part['image'] ) ? wp_get_attachment_image_url( $part['image'], 'medium' ) : '';
                                ?>
                                <div class="parts-item">
                                    <?php if ( $part_image ) : ?>
                                        <img src="<?php echo esc_url( $part_image ); ?>" alt="Parte/Pieza" class="parts-item-image">
                                    <?php endif; ?>
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <section class="w-full">
            <div class="cuadros-container">
                <?php
                $cuadros_azules = carbon_get_theme_option( 'crb_cuadros_azules' );
                if ( ! empty( $cuadros_azules ) ) :
                    foreach ( $cuadros_azules as $cuadro ) :
                        $texto = ! empty( $cuadro['texto'] ) ? $cuadro['texto'] : '';
                        $link = ! empty( $cuadro['link'] ) ? $cuadro['link'] : '#';
                        ?>
                        <div class="cuadro-azul">
                            <a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $texto ); ?></a>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>