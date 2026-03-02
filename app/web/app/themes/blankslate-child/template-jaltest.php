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
                    <div id="crmWebToEntityForm">
                        <div id="form-container">
                            <div class="hartridge-form-title">CONTÁCTANOS</div>
                            <form id="zohoContactForm" class="flex flex-col gap-3">
                                <input type="hidden" name="xnQsjsdp" value="0fae662cc62565f1629fb79a440f5449583f8959ff6a0d53b992dd1b437a9c39">
                                <input type="hidden" name="xmIwtLD" value="39fae2cb362aab76075e3f1d1396c2d4532f5eba900f34fd63d509d9334b570d22e3c88616f72630cf9a500f168bfb99">
                                <input type="hidden" name="actionType" value="Q3VzdG9tTW9kdWxlNg==">
                                <input type="hidden" name="COBJ6CF3" value="jaltest">
                                <input type="hidden" name="aG9uZXlwb3Q" value="">

                                <div class="mb-3 position-relative">
                                    <input type="text" class="form-control hartridge-form-control" id="NAME" name="NAME" placeholder="Nombres y Apellidos">
                                </div>

                                <div class="row g-3 mb-3 flex flex-col md:flex-row gap-2 md:items-center">
                                    <div class="col-md-6 position-relative">
                                        <input type="text" class="form-control hartridge-form-control" id="COBJ6CF2" name="COBJ6CF2" placeholder="Teléfono">
                                    </div>
                                    <div class="col-md-6 position-relative">
                                        <input type="text" class="form-control hartridge-form-control" id="Email" name="Email" placeholder="Correo electrónico">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <textarea class="form-control hartridge-form-control" id="COBJ6CF1" name="COBJ6CF1" rows="3" placeholder="Comentarios"></textarea>
                                </div>

                                <div class="clearfix">
                                    <button type="button" class="btn btn-send" onclick="handleAjaxSubmit()">Enviar</button>
                                </div>
                            </form>
                        </div>

                        <div id="success-container" class="hidden">
                            <div class="mb-3">
                                <span style="font-size: 60px; color: #28a745;">✔</span>
                            </div>
                            <h3 class="fw-bold">¡Enviado con éxito!</h3>
                            <p>Gracias por contactarnos, nos comunicaremos pronto.</p>
                            <button class="btn btn-outline-primary mt-3" onclick="resetForm()">Enviar otro mensaje</button>
                        </div>
                    </div>

                    <script>
                        async function handleAjaxSubmit() {
                            const form = document.getElementById('zohoContactForm');
                            
                            const fields = [
                                { id: 'NAME', msg: 'Completa este campo' },
                                { id: 'COBJ6CF2', msg: 'Completa este campo' },
                                { id: 'Email', msg: 'Ingresa un correo válido', isEmail: true }
                            ];

                            // Limpiar errores previos
                            document.querySelectorAll('.error-tooltip-custom').forEach(el => el.remove());
                            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid-custom'));

                            for (let field of fields) {
                                const input = document.getElementById(field.id);
                                const val = input.value.trim();
                                let isError = false;

                                if (val === "") isError = true;
                                else if (field.isEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) isError = true;

                                if (isError) {
                                    showBalloonError(input, field.msg);
                                    return;
                                }
                            }

                            const btn = document.querySelector('.btn-send');
                            btn.disabled = true;
                            btn.innerText = "Enviando...";

                            const formData = new FormData(form);

                            try {
                                await fetch('https://crm.zoho.com/crm/WebForm', {
                                    method: 'POST',
                                    mode: 'no-cors', // Evita problemas de seguridad CORS con Zoho
                                    body: formData
                                });

                                document.getElementById('form-container').style.display = 'none';
                                document.getElementById('success-container').style.display = 'block';

                            } catch (error) {
                                alert('Ocurrió un error al enviar. Por favor intentalo de nuevo.');
                                btn.disabled = false;
                                btn.innerText = "Enviar";
                            }
                        }

                        function showBalloonError(input, msg) {
                            const tooltip = document.createElement('div');
                            tooltip.className = 'error-tooltip-custom';
                            tooltip.innerHTML = `<div class="error-icon">!</div><span>${msg}</span>`;
                            
                            input.parentElement.appendChild(tooltip);
                            input.classList.add('is-invalid-custom');
                            input.focus();

                            input.addEventListener('input', () => {
                                tooltip.remove();
                                input.classList.remove('is-invalid-custom');
                            }, { once: true });
                        }

                        function resetForm() {
                            document.getElementById('zohoContactForm').reset();
                            document.getElementById('form-container').style.display = 'block';
                            document.getElementById('success-container').style.display = 'none';
                            const btn = document.querySelector('.btn-send');
                            btn.disabled = false;
                            btn.innerText = "Enviar";
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
                    echo wp_get_attachment_image( $modelos_image, 'full', false, array( 'class' => 'w-full modelos-image', 'alt' => get_the_title() ) );
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
