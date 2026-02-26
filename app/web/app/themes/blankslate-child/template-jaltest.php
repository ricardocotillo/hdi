<?php
/**
 * Template Name: Jaltest
 * Template Post Type: page
 */
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		
		// Display header image
		$banner_1 = carbon_get_post_meta( get_the_ID(), 'crb_jaltest_banner_1' );
		$banner_2 = carbon_get_post_meta( get_the_ID(), 'crb_jaltest_banner_2' );
		$banner_3 = carbon_get_post_meta( get_the_ID(), 'crb_jaltest_banner_3' );
		$banner_4 = carbon_get_post_meta( get_the_ID(), 'crb_jaltest_banner_4' );
		?>
		<?php if ( $banner_1 ) : ?>
			<header class="w-full jaltest-banner-container">
				<?php echo wp_get_attachment_image( $banner_1, 'full', false, array( 'class' => 'page-header-image w-full h-auto', 'alt' => get_the_title() ) ); ?>
                
                <div class="jaltest-form-overlay">
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
			</header>
        <?php endif; ?>
        <section class="w-full">
            <section class="container">
                    <?php
                    $equipment_items = carbon_get_post_meta( get_the_ID(), 'crb_page_equipment_items' );
                    if ( ! empty( $equipment_items ) ) :
                        ?>
                        <section class="jaltest-items flex gap-5">
                            <?php foreach ( $equipment_items as $item ) : ?>
                                <div class="jaltest-item w-1/3 flex flex-col items-center bg-white text-center p-6">
                                    <?php
                                    $logo_id = isset( $item['logo'] ) ? $item['logo'] : 0;
                                    if ( $logo_id ) :
                                        echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'jaltest-item-logo mb-4', 'alt' => '' ) );
                                    endif;
                                    ?>
                                    <?php if ( ! empty( $item['title'] ) ) : ?>
                                        <h3 class="jaltest-item-title mb-3"><?php echo esc_html( $item['title'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $item['content'] ) ) : ?>
                                        <div class="jaltest-item-content">
                                            <?php echo wp_kses_post( $item['content'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    <?php endif; ?>                
            </section>
        </section>
		<?php if ( $banner_2 ) : ?>
			<section class="w-full">
				<?php echo wp_get_attachment_image( $banner_2, 'full', false, array( 'class' => 'page-header-image w-full h-auto', 'alt' => get_the_title() ) ); ?>
			</section>
        <?php endif; ?>
        <section class="w-full modelos-disponibles-container">
            <section class="container relative">
                <?php
                $modelos_image = carbon_get_post_meta( get_the_ID(), 'crb_imagen_modelos_disponibles' );
                if ( $modelos_image ) :
                    echo wp_get_attachment_image( $modelos_image, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => get_the_title() ) );
                endif;
                ?>
                <?php
                $titulo_modelos = carbon_get_post_meta( get_the_ID(), 'crb_titulo_modelos_disponibles' );
                if ( ! empty( $titulo_modelos ) ) :
                    ?>
                    <div class="modelos-titulo absolute">
                        <h2 class="text-white"><?php echo esc_html( $titulo_modelos ); ?></h2>
                    </div>
                    <?php
                endif;
                ?>
            </section>
        </section>
        <section class="w-full">
                <section class="container text-center" id="equipos-scanner">
                    <?php
                    // Buscar productos con categoría scanner
                    $hartridge_productos_args = array(
                        'post_type' => 'productos',
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorias-de-producto',
                                'field' => 'slug',
                                'terms' => 'scanner',
                            ),
                        ),
                    );
                    $hartridge_productos_query = new WP_Query( $hartridge_productos_args );
                    
                    if ( $hartridge_productos_query->have_posts() ) :
                        ?>
                        <div class="productos-grid">
                            <?php
                            while ( $hartridge_productos_query->have_posts() ) :
                                $hartridge_productos_query->the_post();
                                ?>
                                <article class="producto-item">
                                    <div class="producto-image">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="producto-content">
                                        <h3 class="producto-title"><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>" class="btn-ver-mas" aria-label="Ver más detalles de <?php the_title_attribute(); ?>">
                                           VER MÁS
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                    <a href="#todos-modelos" class="btn-ver-mas btn-ver-todos">Ver Todos</a>
                </section>
        </section>
        <?php if ( $banner_3 ) : 
            $banner_3_url = wp_get_attachment_image_src( $banner_3, 'full' );
            if ( $banner_3_url ) {
                $banner_3_url = $banner_3_url[0];
            }    
        ?>
            <section class="w-full jaltest-beneficios-section relative" style="background-image: url('<?php echo esc_url( $banner_3_url ); ?>'); background-size: cover; background-position: center;">
                <?php
                $beneficios_titulo = carbon_get_post_meta( get_the_ID(), 'crb_titulo_beneficios' );
                $beneficios_items = carbon_get_post_meta( get_the_ID(), 'crb_page_beneficios_items' );
                if ( ! empty( $beneficios_titulo ) || ! empty( $beneficios_items ) ) :
                    ?>
                    <div class="jaltest-beneficios-overlay">
                        <div class="container jaltest-beneficios-content">
                            <?php if ( ! empty( $beneficios_titulo ) ) : ?>
                                <div class="jaltest-beneficios-title">
                                    <?php echo wp_kses_post( $beneficios_titulo ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $beneficios_items ) ) : ?>
                                <div class="jaltest-beneficios-items">
                                    <?php foreach ( $beneficios_items as $item ) : ?>
                                        <div class="jaltest-beneficios-item">
                                            <?php
                                            $logo_id = isset( $item['logo'] ) ? $item['logo'] : 0;
                                            if ( $logo_id ) :
                                                echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'jaltest-beneficios-logo', 'alt' => '' ) );
                                            endif;
                                            ?>

                                            <?php if ( ! empty( $item['title'] ) ) : ?>
                                                <div class="jaltest-beneficios-text">
                                                    <?php echo wp_kses_post( $item['title'] ); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
        <section class="w-full">
            <section class="container" id="todos-modelos">
                <?php
                $titulo_productos_mas_vendidos = carbon_get_post_meta( get_the_ID(), 'crb_titulo_productos_mas_vendidos' );
                if ( ! empty( $titulo_productos_mas_vendidos ) ) :
                    ?>
                    <div class="text-center">
                        <?php echo wp_kses_post( $titulo_productos_mas_vendidos ); ?>
                    </div>
                    <?php
                endif;
                ?>
            </section>
                <section class="container text-center" id="equipos-scanner">
                    <?php
                    // Buscar productos con categoría scanner
                    $hartridge_productos_args = array(
                        'post_type' => 'productos',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorias-de-producto',
                                'field' => 'slug',
                                'terms' => 'scanner',
                            ),
                        ),
                    );
                    $hartridge_productos_query = new WP_Query( $hartridge_productos_args );
                    
                    if ( $hartridge_productos_query->have_posts() ) :
                        ?>
                        <div class="productos-grid">
                            <?php
                            while ( $hartridge_productos_query->have_posts() ) :
                                $hartridge_productos_query->the_post();
                                ?>
                                <article class="producto-item">
                                    <div class="producto-image">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="producto-content">
                                        <h3 class="producto-title"><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>" class="btn-ver-mas" aria-label="Ver más detalles de <?php the_title_attribute(); ?>">
                                           VER MÁS
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </section>            
        </section>                
		<?php if ( $banner_4 ) : ?>
			<section class="w-full">
				<?php echo wp_get_attachment_image( $banner_4, 'full', false, array( 'class' => 'page-header-image w-full h-auto', 'alt' => get_the_title() ) ); ?>

			</section>
        <?php endif; ?> 
            <section class="w-full">
                <section class="container" id="novedades-jaltest">
                    <h2><?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_jaltest_novedades_title' ) ); ?></h2>
                    <section class="novedades-grid" id="novedades-jaltest-items">
                        <?php
                        $novedades_items = carbon_get_post_meta( get_the_ID(), 'crb_jaltest_news' );
                        if ( ! empty( $novedades_items ) ) :
                            ?>
                                <?php foreach ( $novedades_items as $item ) : ?>
                                    <div class="novedad-item">
                                        <?php
                                        $image_id = isset( $item['image'] ) ? $item['image'] : 0;
                                        $title = isset( $item['title'] ) ? $item['title'] : '';
                                        $link = isset( $item['link'] ) ? $item['link'] : '';
                                        ?>
                                        <?php if ( $image_id ) : ?>
                                            <a href="<?php echo esc_url( $link ); ?>" class="novedad-item-image-wrapper" <?php echo $link ? 'target="_blank" rel="noopener"' : ''; ?>>
                                                <?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'novedad-item-image', 'alt' => esc_attr( $title ) ) ); ?>
                                                <?php if ( ! empty( $title ) ) : ?>
                                                    <h3 class="novedad-item-title"><?php echo esc_html( $title ); ?></h3>
                                                <?php endif; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php
                        endif;
                        ?>
                    </section>
                </section>
            </section>               
        <section class="w-full hartridge-map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15606.773360171788!2d-77.033909!3d-12.064608000000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c954ef5b57bb%3A0xc5d449156b33dc2c!2sHDI%20Diesel%20Turbo%20%26%20Autoparts!5e0!3m2!1ses!2sus!4v1771966709996!5m2!1ses!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                            
        </section>
		<?php
	endwhile;
endif;

get_footer('jaltest');
