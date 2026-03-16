<?php
/**
 * Template Name: Servicios
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
            <section class="w-full servicios-content">
                <section class="container container-servicios">
                    <div class="flex servicios-row servicios-row-1">
                        <div class="gallery-container w-1/2">
                            <div class="servicios-gallery">
                                <?php
                                    $laboratory_image = carbon_get_post_meta( get_the_ID(), 'crb_page_laboratory_gallery' );
                                    if ( $laboratory_image ) :
                                        ?>
                                        <div class="owl-carousel owl-theme servicios-carousel">
                                            <?php
                                            foreach ( $laboratory_image as $image_item ) {
                                                if ( isset( $image_item['image'] ) ) {
                                                    ?>
                                                    <div class="servicios-gallery-item">
                                                        <?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    endif;
                                ?>
                            </div>  
                        </div>

                        <div class="flex flex-col p-10 w-1/2 servicios-text servicios-text-1">
                            <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_laboratory_text' ) ); ?>
                            <a href="#cotizar" class="btn-cotizar"><?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_page_laboratory_button_text' ) ); ?></a>
                        </div>
                    </div>
                </section>
                <section class="w-full services-campo container-servicios">
                    <section class="container">

                        <div class="flex servicios-row servicios-row-2">

                            <div class="flex flex-col p-10 w-1/2 text-right servicios-text servicios-text-2">
                                <p><?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_field_services_text' ) ); ?></p>
                                <a href="#cotizar" class="btn-cotizar" style="margin-left: auto;"><?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_page_field_services_button_text' ) ); ?></a>
                            </div>                    

                            <div class="gallery-container w-1/2">
                                <div class="servicios-gallery">
                                    <?php
                                        $field_services_image = carbon_get_post_meta( get_the_ID(), 'crb_page_field_services_gallery' );
                                        if ( $field_services_image ) :
                                            ?>
                                            <div class="owl-carousel owl-theme servicios-carousel">
                                                <?php
                                                foreach ( $field_services_image as $image_item ) {
                                                    if ( isset( $image_item['image'] ) ) {
                                                        ?>
                                                        <div class="servicios-gallery-item">
                                                            <?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        <?php
                                        endif;
                                    ?>
                                </div>  
                            </div>

                        </div>

                    </section>
                </section>
                <section class="container container-servicios">
                    <div class="flex servicios-row servicios-row-3">
                        <div class="gallery-container w-1/2">
                            <div class="servicios-gallery">
                                <?php
                                    $laboratory_image = carbon_get_post_meta( get_the_ID(), 'crb_page_field_red_services_gallery' );
                                    if ( $laboratory_image ) :
                                        ?>
                                        <div class="owl-carousel owl-theme servicios-carousel">
                                            <?php
                                            foreach ( $laboratory_image as $image_item ) {
                                                if ( isset( $image_item['image'] ) ) {
                                                    ?>
                                                    <div class="servicios-gallery-item">
                                                        <?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    endif;
                                ?>
                            </div>  
                        </div>

                        <div class="flex flex-col p-10 w-1/2 servicios-text servicios-text-3">
                            <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_field_red_services_text' ) ); ?>
                            <a href="#cotizar" class="btn-cotizar"><?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_page_field_red_services_button_text' ) ); ?></a>
                        </div>
                    </div>
                </section>
                <section class="w-full services-campo footer-services-campo">
                    <div class="footer-servicios-container">
                        <div class="form-servicios-container" id="cotizar">
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                            <style>
                                #crmWebToEntityForm {
                                    max-width: 650px;
                                    margin: 30px auto;
                                    padding: 45px;
                                    border-radius: 15px;
                                    box-shadow: 0px 5px 25px rgba(0,0,0,0.1);
                                    background-color: #fff;
                                    font-family: 'Segoe UI', Arial, sans-serif;
                                }

                                .form_header_title { font-size: 24px; font-weight: 700; margin-bottom: 5px; color: #000; }
                                .form_header_subtitle { font-size: 18px; color: #555; margin-bottom: 25px; }

                                .form-control, .form-select {
                                    background-color: #ffffff !important;
                                    border: 1px solid #ced4da !important;
                                    border-radius: 4px !important;
                                    padding: 10px 15px;
                                    font-size: 15px;
                                }

                                .btn-cotizar {
                                    background-color: #0071b1 !important;
                                    border: none;
                                    border-radius: 4px;
                                    padding: 12px 40px;
                                    font-weight: bold;
                                    color: white;
                                    cursor: pointer;
                                }

                                /* GLOBO DE ERROR NARANJA */
                                .error-tooltip-custom {
                                    position: absolute;
                                    z-index: 1000;
                                    display: flex;
                                    align-items: center;
                                    background: white;
                                    border: 1px solid #ccc;
                                    padding: 7px 12px;
                                    border-radius: 4px;
                                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                                    margin-top: 5px;
                                    white-space: nowrap;
                                }

                                .error-tooltip-custom::before {
                                    content: '';
                                    position: absolute;
                                    top: -8px;
                                    left: 15px;
                                    border-left: 8px solid transparent;
                                    border-right: 8px solid transparent;
                                    border-bottom: 8px solid white;
                                }

                                .error-icon {
                                    background-color: #ff9800;
                                    color: white;
                                    font-weight: bold;
                                    width: 18px;
                                    height: 18px;
                                    border-radius: 3px;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    margin-right: 10px;
                                    font-size: 12px;
                                }

                                .is-invalid-custom { border: 1px solid #dc3545 !important; }

                                #form-container { display: block; }
                                #success-container { display: none; text-align: center; padding: 40px 20px; }
                            </style>

                            <div id="crmWebToEntityForm">
                                <div id="form-container">
                                    <div class="form_header_title text-center">¿Problemas con tu sistema de inyección diésel?</div>
                                    <div class="form_header_subtitle text-center">Consúltale a los especialistas</div>

                                    <form id="zohoCotizacionAjax">
                                        <input type="hidden" name="xnQsjsdp" value="a7a9e578d8c890507271c541b89da04f33d9ed56fe97797b598a00799ecc1d8f">
                                        <input type="hidden" name="xmIwtLD" value="8b07c2aec83d42fc47d16312a06aeaf9448849aa6839e22b389aba099644f88db266df3840bc52a433a768148cbc9219">
                                        <input type="hidden" name="actionType" value="Q3VzdG9tTW9kdWxlNw==">
                                        <input type="hidden" name="returnURL" value="null">

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6 position-relative">
                                                <select class="form-select" id="COBJ7CF3" name="COBJ7CF3">
                                                    <option value="-None-">Seleccionar</option>
                                                    <option value="Laboratorio">Laboratorio</option>
                                                    <option value="Servicio de campo">Servicio de campo</option>
                                                    <option value="Red de servicios">Red de servicios</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 position-relative">
                                                <input type="text" class="form-control" id="NAME" name="NAME" placeholder="Nombres y Apellidos">
                                            </div>
                                        </div>

                                        <div class="mb-3 row position-relative">
                                            <div class="col-12" style="padding-right: 4px;">
                                                <input type="text" class="form-control" id="COBJ7CF1" name="COBJ7CF1" placeholder="RUC/DNI">
                                            </div>
                                        </div>

                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6 position-relative">
                                                <input type="text" class="form-control" id="COBJ7CF2" name="COBJ7CF2" placeholder="Teléfono">
                                            </div>
                                            <div class="col-md-6 position-relative">
                                                <input type="text" class="form-control" id="Email" name="Email" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-6 position-relative mb-3 mb-md-0">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="pol_seg">
                                                    <label class="form-check-label" for="pol_seg">Políticas de seguridad</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 position-relative">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="term_cond">
                                                    <label class="form-check-label" for="term_cond">Términos y condiciones</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-start">
                                            <button type="button" class="btn btn-cotizar" onclick="submitAjax()">Cotizar</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div id="success-container">
                                    <div class="mb-3">
                                        <span style="font-size: 60px; color: #28a745;">✔</span>
                                    </div>
                                    <h3 class="fw-bold">Solicitud enviada</h3>
                                    <p>Gracias por contactarnos. Un especialista revisará tu caso y te responderá a la brevedad.</p>
                                    <button class="btn btn-outline-primary mt-3" onclick="resetForm()">Volver a cotizar</button>
                                </div>
                            </div>

                                <script>
                                    async function submitAjax() {
                                        const form = document.getElementById('zohoCotizacionAjax');
                                        
                                        const fields = [
                                            { id: 'COBJ7CF3', msg: 'Selecciona una opción', isSelect: true },
                                            { id: 'NAME', msg: 'Completa este campo' },
                                            { id: 'COBJ7CF1', msg: 'Completa este campo' },
                                            { id: 'COBJ7CF2', msg: 'Completa este campo' },
                                            { id: 'Email', msg: 'Email inválido', isEmail: true },
                                            { id: 'pol_seg', msg: 'Debes aceptar las políticas', isCheck: true },
                                            { id: 'term_cond', msg: 'Debes aceptar los términos', isCheck: true }
                                        ];

                                        // Limpiar errores previos
                                        document.querySelectorAll('.error-tooltip-custom').forEach(el => el.remove());
                                        document.querySelectorAll('.form-control, .form-select, .form-check-input').forEach(el => el.classList.remove('is-invalid-custom'));

                                        for (let field of fields) {
                                            const input = document.getElementById(field.id);
                                            let isError = false;

                                            if (field.isCheck) {
                                                if (!input.checked) isError = true;
                                            } else if (field.isSelect) {
                                                if (input.value === "-None-") isError = true;
                                            } else if (field.isEmail) {
                                                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim())) isError = true;
                                            } else {
                                                if (input.value.trim() === "") isError = true;
                                            }

                                            if (isError) {
                                                showBalloonError(input, field.msg);
                                                return; // Detiene la ejecución
                                            }
                                        }

                                        const btn = document.querySelector('.btn-cotizar');
                                        btn.disabled = true;
                                        btn.innerText = "Enviando...";

                                        const formData = new FormData(form);

                                        try {
                                            await fetch('https://crm.zoho.com/crm/WebForm', {
                                                method: 'POST',
                                                mode: 'no-cors', 
                                                body: formData
                                            });

                                            document.getElementById('form-container').style.display = 'none';
                                            document.getElementById('success-container').style.display = 'block';

                                        } catch (error) {
                                            alert('Hubo un error al procesar tu solicitud. Por favor, intenta de nuevo.');
                                            btn.disabled = false;
                                            btn.innerText = "Cotizar";
                                        }
                                    }

                                    function showBalloonError(input, msg) {
                                        const tooltip = document.createElement('div');
                                        tooltip.className = 'error-tooltip-custom';
                                        tooltip.innerHTML = `<div class="error-icon">!</div><span>${msg}</span>`;
                                        
                                        input.parentElement.appendChild(tooltip);
                                        input.classList.add('is-invalid-custom');
                                        input.focus();

                                        const eventType = input.type === 'checkbox' || input.tagName === 'SELECT' ? 'change' : 'input';
                                        input.addEventListener(eventType, () => {
                                            tooltip.remove();
                                            input.classList.remove('is-invalid-custom');
                                        }, { once: true });
                                    }

                                    function resetForm() {
                                        document.getElementById('zohoCotizacionAjax').reset();
                                        document.getElementById('form-container').style.display = 'block';
                                        document.getElementById('success-container').style.display = 'none';
                                        const btn = document.querySelector('.btn-cotizar');
                                        btn.disabled = false;
                                        btn.innerText = "Cotizar";
                                    }
                                </script>
                        </div>
                        <p class="text-center text-servicios-form poppins-light">Especialistas en evaluación, diagnóstico, mantenimiento<br> y reparación de <span class="texto-azul">Sistemas de Inyección Diésel</span></p>
                    </div>
                </section>                
			</section>
		<?php
		
		//get_template_part( 'entry' );
		//comments_template();
	endwhile;
endif;

get_footer();
