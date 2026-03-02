<?php
/**
 * Template Name: Hartridge
 * Template Post Type: page
 */
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		
		// Display header image
		$header_image = carbon_get_post_meta( get_the_ID(), 'crb_page_header_image' );
		?>
		<?php if ( $header_image ) : ?>
			<header class="w-full">
				<?php echo wp_get_attachment_image( $header_image, 'full', false, array( 'class' => 'page-header-image w-full h-auto', 'alt' => get_the_title() ) ); ?>
			</header>
        <?php endif; ?>
        <section class="w-full equipamiento-content">
            <section class="w-full items-hartridge-content">
                <section class="container">
                    <?php
                    $equipment_items = carbon_get_post_meta( get_the_ID(), 'crb_page_equipment_items' );
                    if ( ! empty( $equipment_items ) ) :
                        ?>
                        <section class="hartridge-items flex gap-10">
                            <?php foreach ( $equipment_items as $item ) : ?>
                                <div class="hartridge-item w-1/3 flex flex-col items-center bg-white text-center p-6">
                                    <?php
                                    $logo_id = isset( $item['logo'] ) ? $item['logo'] : 0;
                                    if ( $logo_id ) :
                                        echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'hartridge-item-logo mb-4', 'alt' => '' ) );
                                    endif;
                                    ?>
                                    <?php if ( ! empty( $item['title'] ) ) : ?>
                                        <h3 class="hartridge-item-title mb-3"><?php echo esc_html( $item['title'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $item['content'] ) ) : ?>
                                        <div class="hartridge-item-content">
                                            <?php echo wp_kses_post( $item['content'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    <?php endif; ?>
                </section>
            </section>
            <section class="w-full que-es-hartridge">
                <section class="container">
                    <?php
                    $hartridge_title = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_title' );
                    $hartridge_text = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_text' );
                    $hartridge_image = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_image' );
                    if ( $hartridge_title || $hartridge_text || $hartridge_image ) :
                        ?>
                        <div class="hartridge-about flex flex-row gap-8 md:flex-row md:items-center">
                            <div class="hartridge-about-text w-2/3">
                                <?php if ( $hartridge_title ) : ?>
                                    <h2 class="hartridge-about-title mb-4"><?php echo esc_html( $hartridge_title ); ?></h2>
                                <?php endif; ?>
                                <?php if ( $hartridge_text ) : ?>
                                    <div class="hartridge-about-content">
                                        <?php echo wp_kses_post( $hartridge_text ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="hartridge-about-image w-1/3">
                                <?php
                                if ( $hartridge_image ) {
                                    echo wp_get_attachment_image( $hartridge_image, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => '' ) );
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
            </section>
            <section class="w-full fondo-plomo">
                <section class="container nuestros-productos nuestros-productos-hartridge">
                    <h2 class="text-center">Nuestros Productos</h2>
                    <p class="text-center">Hartridge cuenta con una amplia variedad de bancos de pruebas, accesorios y sofware, dirigidos para laboratorio diésel.</p>
                    <?php
                    $hartridge_products = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_products' );
                    if ( ! empty( $hartridge_products ) ) :
                        ?>
                        <div class="hartridge-products flex flex-row gap-6">
                            <?php foreach ( $hartridge_products as $product ) : ?>
                                <?php
                                $image_id = isset( $product['image'] ) ? $product['image'] : 0;
                                $link = isset( $product['link'] ) ? $product['link'] : '';
                                ?>
                                <?php if ( $image_id ) : ?>
                                    <a class="hartridge-product" href="<?php echo esc_url( $link ); ?>" <?php echo $link ? 'target="_blank" rel="noopener"' : ''; ?>>
                                        <?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => '' ) ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </section>
            </section>
            <section class="w-full">
                <?php
                $banner_1 = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_banner_1' );
                if ( $banner_1 ) :
                    echo wp_get_attachment_image( $banner_1, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => '' ) );
                endif;
                ?>
            </section>
            <section class="w-full fondo-plomo">
                <section class="container" id="equipos-hartridge">
                    <h2 class="text-center">¿Necesitas algún equipo HARTRIDGE?</h2>
                    <?php
                    // Buscar productos con categoría hartridge
                    $hartridge_productos_args = array(
                        'post_type' => 'productos',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorias-de-producto',
                                'field' => 'slug',
                                'terms' => 'hartridge',
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
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
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
            <section class="w-full">
                <?php
                $banner_2 = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_banner_2' );
                if ( $banner_2 ) :
                    echo wp_get_attachment_image( $banner_2, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => '' ) );
                endif;
                ?>
            </section>
            <section class="w-full">
                <section class="container" id="novedades-hartridge">
                    <h2><?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_hartridge_novedades_title' ) ); ?></h2>
                    <section class="novedades-grid" id="novedades-hartridge-items">
                        <?php
                        $novedades_items = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_news' );
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
            <section class="w-full fondo-verde">
                <section class="container">
                    <h2 class="text-center text-white">
                        <?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_hartridge_videos_title' ) ); ?>
                    </h2>
                </section>
            </section>
            <section class="w-full">
                <section class="container">
                    <?php 
                    $videos_items = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_videos' );
                    if ( ! empty( $videos_items ) ) :
                        ?>
                        <div class="videos-grid">
                            <?php foreach ( $videos_items as $item ) : ?>
                                <?php
                                  $video_url = isset( $item['url'] ) ? $item['url'] : '';
                                ?>
                                <?php if ( $video_url ) : ?>
                                    <div class="video-item">
                                        <iframe width="350" height="200" src="<?php echo esc_url( $video_url ); ?>" title="Video de Hartridge" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </section>
            </section>
            <section class="w-full fondo-plomo">
                <section class="container">
                    <div class="hartridge-demo-section">
                        <div class="hartridge-demo-left">
                            <h2 class="hartridge-demo-title">
                                <?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_hartridge_demo_title' ) ); ?>
                            </h2>
                            
                            <?php
                            $demo_phone = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_demo_phone' );
                            $demo_phone_link = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_demo_link_phone' );
                            if ( $demo_phone ) :
                                ?>
                                <div class="hartridge-demo-contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <?php if ( $demo_phone_link ) : ?>
                                            <a href="<?php echo esc_url( $demo_phone_link ); ?>" class="hartridge-demo-contact-value"><?php echo esc_html( $demo_phone ); ?></a>
                                        <?php else : ?>
                                            <p class="hartridge-demo-contact-value"><?php echo esc_html( $demo_phone ); ?></p>
                                        <?php endif; ?>
                                        <p class="hartridge-demo-contact-label">Celular</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php
                            $demo_email = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_demo_email' );
                            if ( $demo_email ) :
                                ?>
                                <div class="hartridge-demo-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <p class="hartridge-demo-contact-value"><?php echo esc_html( $demo_email ); ?></p>
                                        <p class="hartridge-demo-contact-label">Correo electrónico</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php
                            $demo_address = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_demo_address' );
                            if ( $demo_address ) :
                                ?>
                                <div class="hartridge-demo-contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <p class="hartridge-demo-contact-value"><?php echo esc_html( $demo_address ); ?></p>
                                        <p class="hartridge-demo-contact-label">Dirección</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="hartridge-demo-right">
                            <h3 class="hartridge-demo-form-title">
                                <?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_hartridge_form_title' ) ); ?>
                            </h3>
                            <div id="crmWebToEntityForm">
                                <div id="form-container">
                                    <div class="hartridge-form-title">CONTÁCTANOS</div>
                                    <form id="zohoContactForm" class="flex flex-col gap-3">
                                        <input type="hidden" name="xnQsjsdp" value="0fae662cc62565f1629fb79a440f5449583f8959ff6a0d53b992dd1b437a9c39">
                                        <input type="hidden" name="xmIwtLD" value="39fae2cb362aab76075e3f1d1396c2d4532f5eba900f34fd63d509d9334b570d22e3c88616f72630cf9a500f168bfb99">
                                        <input type="hidden" name="actionType" value="Q3VzdG9tTW9kdWxlNg==">
                                        <input type="hidden" name="COBJ6CF3" value="principal">
                                        <input type="hidden" name="aG9uZXlwb3Q" value="">

                                        <div class="mb-3 position-relative">
                                            <input type="text" class="form-control hartridge-form-control" id="NAME" name="NAME" placeholder="Nombres y Apellidos">
                                        </div>

                                        <div class="row g-3 mb-3 flex gap-2 items-center">
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
                    </div>
                </section>
            </section>            
        </section>
        <section class="w-full hartridge-map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15606.773360171788!2d-77.033909!3d-12.064608000000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c954ef5b57bb%3A0xc5d449156b33dc2c!2sHDI%20Diesel%20Turbo%20%26%20Autoparts!5e0!3m2!1ses!2sus!4v1771966709996!5m2!1ses!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                            
        </section>
		<?php
	endwhile;
endif;

get_footer('hartridge');
