<?php
/**
 * Template Name: Home
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" class="site-main">

			<!-- Section 1: Image Carousel with Links -->
			<section class="home-image-carousel-section py-0 bg-gray-50 w-full">
				<div class="owl-carousel owl-theme home-image-carousel w-full">
					<?php
					$carousel_items = carbon_get_post_meta( get_the_ID(), 'crb_home_image_carousel' );
					if ( ! empty( $carousel_items ) ) :
						foreach ( $carousel_items as $item ) :
							$image_url = ! empty( $item['image'] ) ? wp_get_attachment_image_url( $item['image'], 'full' ) : '';
							$link = ! empty( $item['link'] ) ? $item['link'] : '#';
							?>
							<div class="home-carousel-item">
								<a href="<?php echo esc_url( $link ); ?>">
									<?php if ( $image_url ) : ?>
										<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title(); ?>" class="w-full h-auto">
									<?php endif; ?>
								</a>
							</div>
							<?php
						endforeach;
					endif;
					?>
				</div>
			</section>

			<!-- Section 3: Brands Carousel -->
			<section class="home-brands-carousel-section py-8 bg-gray-100">
				<div class="container">
					<?php
					$brands_description = carbon_get_post_meta( get_the_ID(), 'crb_home_brands_description' );
					if ( ! empty( $brands_description ) ) :
						?>
						<div class="brands-description">
							<?php echo wp_kses_post( $brands_description ); ?>
						</div>
						<?php
					endif;
					?>
					
					<div class="owl-carousel owl-theme home-brands-carousel">
						<?php
						$brands_carousel = carbon_get_post_meta( get_the_ID(), 'crb_home_brands_carousel' );
						if ( ! empty( $brands_carousel ) ) :
							foreach ( $brands_carousel as $brand ) :
								$logo_url = ! empty( $brand['image'] ) ? wp_get_attachment_image_url( $brand['image'], 'medium' ) : '';
								$link = ! empty( $brand['link'] ) ? $brand['link'] : '#';
								?>
								<div class="brand-carousel-item text-center">
									<?php if ( $logo_url ) : ?>
									<img src="<?php echo esc_url( $logo_url ); ?>" alt="Brand Logo" class="brand-logo-image mx-auto">
									<?php endif; ?>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
			</section>

			<!-- Section 4: Our Services -->
			<section class="home-services-section py-12">
				<div class="w-full text-white">
					<?php
					$services_title = carbon_get_post_meta( get_the_ID(), 'crb_home_services_title' );
					$services_image = carbon_get_post_meta( get_the_ID(), 'crb_home_services_image' );
					$services_text = carbon_get_post_meta( get_the_ID(), 'crb_home_services_text' );
					$services_image_url = ! empty( $services_image ) ? wp_get_attachment_image_url( $services_image, 'large' ) : '';
					?>

					<div class="flex flex-row gap-8 items-center">
						<?php if ( $services_image_url ) : ?>
							<div class="w-2/3">
								<img src="<?php echo esc_url( $services_image_url ); ?>" alt="<?php echo esc_attr( $services_title ); ?>" class="w-full h-auto">
							</div>
						<?php endif; ?>

						<div class="w-1/3 text-white">
							<h2 class="text-3xl font-bold mb-8 text-white"><?php echo esc_html( $services_title ); ?></h2>
							<?php echo wp_kses_post( $services_text ); ?>
						</div>
					</div>
				</div>
			</section>

			<!-- Section 5: Best Sellers -->
			<section class="home-bestsellers-section py-12 bg-gray-50">
				<div class="container">
					<?php
					$bestsellers_title = carbon_get_post_meta( get_the_ID(), 'crb_home_bestsellers_title' );
					$bestsellers_limit = carbon_get_post_meta( get_the_ID(), 'crb_home_bestsellers_limit' );
					$bestsellers_limit = ! empty( $bestsellers_limit ) ? intval( $bestsellers_limit ) : 8;
					?>

					<h2 class="text-3xl font-bold text-center mb-8"><?php echo esc_html( $bestsellers_title ); ?></h2>

					<div class="owl-carousel owl-theme home-products-carousel">
						<?php
						$bestsellers = new WP_Query( array(
							'post_type' => 'productos',
							'posts_per_page' => $bestsellers_limit,
							'orderby' => 'date',
							'order' => 'DESC',
						) );
                        ?>
                        <?php    
						if ( $bestsellers->have_posts() ) :
							while ( $bestsellers->have_posts() ) :
								$bestsellers->the_post();
								?>
								<div class="product-card rounded-lg shadow hover:shadow-lg transition">
									<a href="<?php the_permalink(); ?>" class="block mb-4">
										<?php
										if ( has_post_thumbnail() ) :
											the_post_thumbnail( 'medium', array( 'class' => 'w-full h-auto rounded' ) );
										endif;
										?>
									</a>
									<h6 class="mb-2">
										<a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600">
											<?php the_title(); ?>
										</a>
									</h6>
                                    <a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver más</a>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>

                    <a href="/productos-mas-vendidos" class="btn-ver-mas-home">Ver más</a>
				</div>
			</section>

			<!-- Section 6: Find Best Equipment -->
			<section class="home-equipment-section">
				<div class="w-full">
					<?php
					$equipment_title = carbon_get_post_meta( get_the_ID(), 'crb_home_equipment_title' );
					$equipment_background = carbon_get_post_meta( get_the_ID(), 'crb_home_equipment_background' );
					$equipment_image = carbon_get_post_meta( get_the_ID(), 'crb_home_equipment_image' );
					$equipment_text = carbon_get_post_meta( get_the_ID(), 'crb_home_equipment_text' );
					$equipment_image_url = ! empty( $equipment_image ) ? wp_get_attachment_image_url( $equipment_image, 'full' ) : '';
					$equipment_background_url = ! empty( $equipment_background ) ? wp_get_attachment_image_url( $equipment_background, 'full' ) : '';
					?>

					

					<div class="flex flex-row">
						<div class="equipment-image-wrapper">
                            <img src="<?php echo esc_url( $equipment_background_url ); ?>" alt="<?php echo esc_attr( $equipment_title ); ?>" class="w-full">
							<div class="equipment-overlay">
                                <h2 class="text-3xl font-bold mb-8 text-left texto-blanco"><?php echo esc_html( $equipment_title ); ?></h2>
                                <?php echo wp_kses_post( $equipment_text ); ?>
                            </div>
						</div>

						<?php if ( $equipment_image_url ) : ?>
							<div class="w-1/2 brands-overlay" style="background-image: url('<?php echo esc_url( $equipment_image_url ); ?>'); background-size: cover; background-position: center;"></div>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<!-- Section 7: News/Novedades -->
			<section class="home-news-section py-12">
				<div class="container">
					<?php
					$news_title = carbon_get_post_meta( get_the_ID(), 'crb_home_news_title' );
					$news_limit = carbon_get_post_meta( get_the_ID(), 'crb_home_news_limit' );
					$news_limit = ! empty( $news_limit ) ? intval( $news_limit ) : 6;
					?>

                    <div class="title-home-novedades">
                        <?php echo wp_kses_post( $news_title ); ?>
                    </div>


                <div class="flex gap-2">
					<?php
					$news = new WP_Query( array(
						'post_type' => 'post',
						'posts_per_page' => $news_limit,
						'orderby' => 'date',
						'order' => 'DESC',
					) );

					if ( $news->have_posts() ) :
						while ( $news->have_posts() ) :
							$news->the_post();
							?>
							<article class="news-card w-1/3 bg-white overflow-hidden shadow hover:shadow-lg">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>" class="news-card-image-wrapper">
										<?php the_post_thumbnail( 'full', array( 'class' => 'w-full' ) ); ?>
									</a>
									<?php endif; ?>

									<div class="p-4">
										<div class="text-sm text-gray-500 mb-2">
											<svg class="e-font-icon-svg e-fas-circle" aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg>
											<a href="<?php the_permalink(); ?>" class="text-blue-primary"><?php echo get_the_date( 'F j, Y' ); ?></a>
										</div>

										<h3 class="text-xl font-semibold mb-3">
											<a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600">
												<?php the_title(); ?>
											</a>
										</h3>



									</div>
								</article>
								<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>
			</section>

			<!-- Section 8: Parts and Pieces -->
			<section class="home-parts-section bg-white">
				<div class="container">
					<?php 
                    $parts_title = carbon_get_post_meta( get_the_ID(), 'crb_home_parts_title' );
                    if ( ! empty( $parts_title ) ) :
                        ?>
                            <?php echo wp_kses_post( $parts_title ); ?>   

					<div class="owl-carousel owl-theme home-parts-carousel">
						<?php
						$parts_gallery = carbon_get_post_meta( get_the_ID(), 'crb_home_parts_gallery' );
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
				</div>
                    <?php endif; ?>
			</section>
            
            <section class="consejo-container w-full">
                <div class="container">
                    <?php 
                    $tip1 = carbon_get_post_meta( get_the_ID(), 'image_consejo_1' );
                    $tip2 = carbon_get_post_meta( get_the_ID(), 'image_consejo_2' );
                    $tip3 = carbon_get_post_meta( get_the_ID(), 'image_consejo_3' );
                    $link_tip2 = carbon_get_post_meta( get_the_ID(), 'image_consejo_2_link' );
                    ?>
                    <div class="flex">
                        <?php if ( $tip1 ) : ?>
                            <div class="w-3/4 form-inicio-container">
                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $tip1, 'full' ) ); ?>" alt="Consejo 1" class="w-full imagen-consejos">
								<div id="form-inicio">

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
													<input type="text" class="form-control hartridge-form-control" id="NAME" required name="NAME" placeholder="Nombres y Apellidos">
												</div>

												<div class="row g-3 mb-3 flex flex-col md:flex-row gap-2 md:items-center">
													<div class="col-md-6 position-relative">
														<input type="text" class="form-control hartridge-form-control" id="COBJ6CF2" required name="COBJ6CF2" placeholder="Teléfono">
													</div>
													<div class="col-md-6 position-relative">
														<input type="text" class="form-control hartridge-form-control" id="Email" required name="Email" placeholder="Correo electrónico">
													</div>
												</div>

												<div class="mb-4">
													<textarea class="form-control hartridge-form-control" id="COBJ6CF1" required name="COBJ6CF1" rows="3" placeholder="Comentarios"></textarea>
												</div>

												<div class="clearfix">
													<button type="submit" class="btn btn-send">Enviar</button>
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
										const form = document.querySelector('#zohoContactForm');
										form.addEventListener('submit', handleAjaxSubmit);
										async function handleAjaxSubmit(e) {
											e.preventDefault();
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
                        <?php endif; ?>

                        <?php if ( $tip2 ) : ?>
                            <div class="w-1/4">
                                <a href="<?php echo esc_url( $link_tip2 ); ?>" >
                                    <img  src="<?php echo esc_url( wp_get_attachment_image_url( $tip2, 'full' ) ); ?>" alt="Consejo 2" class="w-full imagen-consejos">
								</a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex gap-6 imagen-suscribete">
                        <?php if ( $tip3 ) : ?>
                            <div class="w-full">
                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $tip3, 'full' ) ); ?>" alt="Consejo 3" class="w-full h-auto">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <section class="w-full grayscale-map">
                <iframe src="https://www.google.com/maps?ll=-12.064608,-77.033909&z=16&t=m&hl=es-ES&gl=US&mapclient=embed&cid=14255099076876164140&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>                
		</article>

		<?php
	endwhile;
endif;

get_footer();
?>
