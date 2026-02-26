<?php
get_header(); ?>

<div class="container taxonomy-container">
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
    
    <div class="taxonomy-wrapper flex gap-5">
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
            <div class="filter-contact">
                <a href="<?php echo esc_url( $whatsapps[0]['link'] ); ?>" class="btn-contactanos"><i aria-hidden="true" class="fab fa-whatsapp"></i> Contáctanos</a>
                    <div id="crmWebToEntityForm" class="hartridge-form-wrapper">
                        <form id="webform5991704000039491574" action="https://crm.zoho.com/crm/WebForm" method="POST" accept-charset="UTF-8" class="hartridge-form">
                            <input type="hidden" name="xnQsjsdp" value="0fae662cc62565f1629fb79a440f5449583f8959ff6a0d53b992dd1b437a9c39">
                            <input type="hidden" name="zc_gad" id="zc_gad" value="">
                            <input type="hidden" name="xmIwtLD" value="39fae2cb362aab76075e3f1d1396c2d4532f5eba900f34fd63d509d9334b570d22e3c88616f72630cf9a500f168bfb99">
                            <input type="hidden" name="actionType" value="Q3VzdG9tTW9kdWxlNg==">
                            <input type="hidden" name="returnURL" value="null">
                            <input type="hidden" name="COBJ6CF3" value="principal">
                            <input type="hidden" name="aG9uZXlwb3Q" value="">

                            <h3 class="hartridge-form-title">CONTÁCTANOS</h3>

                            <div class="hartridge-form-group">
                                <input type="text" class="hartridge-form-control" id="NAME" name="NAME" placeholder="Nombres y Apellidos" oninput="hideError('NAME')">
                                <div id="err-NAME" class="hartridge-error-tooltip">
                                    <span class="hartridge-error-text">Completa este campo</span>
                                </div>
                            </div>

                            <div class="hartridge-form-row">
                                <div class="hartridge-form-group">
                                    <input type="text" class="hartridge-form-control" id="COBJ6CF2" name="COBJ6CF2" placeholder="Teléfono" oninput="hideError('COBJ6CF2')">
                                    <div id="err-COBJ6CF2" class="hartridge-error-tooltip">
                                        <span class="hartridge-error-text">Completa este campo</span>
                                    </div>
                                </div>
                                <div class="hartridge-form-group">
                                    <input type="text" class="hartridge-form-control" id="Email" name="Email" placeholder="Correo" oninput="hideError('Email')">
                                    <div id="err-Email" class="hartridge-error-tooltip">
                                        <span class="hartridge-error-text">Completa este campo</span>
                                    </div>
                                </div>
                            </div>

                            <div class="hartridge-form-group">
                                <textarea class="hartridge-form-control" id="COBJ6CF1" name="COBJ6CF1" rows="4" placeholder="Comentarios"></textarea>
                            </div>

                            <div class="hartridge-form-footer">
                                <button type="button" class="hartridge-btn-send" onclick="validateSequentially()">Enviar</button>
                            </div>
                        </form>
                    </div>

                    <script>
                        function validateSequentially() {
                            const fields = [
                                { id: 'NAME', msg: 'Por favor, ingresa tu nombre' },
                                { id: 'COBJ6CF2', msg: 'El teléfono es obligatorio' },
                                { id: 'Email', msg: 'El correo es obligatorio', isEmail: true }
                            ];

                            // 1. Limpiar todos los errores previos
                            fields.forEach(f => hideError(f.id));

                            // 2. Validar uno por uno
                            for (let i = 0; i < fields.length; i++) {
                                const field = fields[i];
                                const input = document.getElementById(field.id);
                                const value = input.value.trim();

                                // Verificar si está vacío
                                if (value === "") {
                                    showError(field.id, field.msg);
                                    input.focus();
                                    return; // Se detiene en el primer error
                                }

                                // Verificar formato de email
                                if (field.isEmail) {
                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!emailRegex.test(value)) {
                                        showError(field.id, "Ingresa un correo electrónico válido");
                                        input.focus();
                                        return; // Se detiene aquí
                                    }
                                }
                            }

                            // Si pasa todas las validaciones
                            const submitBtn = document.querySelector('.hartridge-btn-send');
                            submitBtn.disabled = true;
                            submitBtn.textContent = 'Enviando...';
                            
                            document.getElementById('webform5991704000039491574').submit();
                        }

                        function showError(id, msg) {
                            const tooltip = document.getElementById('err-' + id);
                            const input = document.getElementById(id);
                            if (tooltip) {
                                tooltip.querySelector('.hartridge-error-text').innerText = msg;
                                tooltip.style.display = 'block';
                                input.classList.add('hartridge-field-error');
                            }
                        }

                        function hideError(id) {
                            const tooltip = document.getElementById('err-' + id);
                            const input = document.getElementById(id);
                            if (tooltip) tooltip.style.display = 'none';
                            if (input) input.classList.remove('hartridge-field-error');
                        }
                    </script>
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
        </main>
    </div>
    


    <div class="w-full">
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