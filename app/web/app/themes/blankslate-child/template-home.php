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

			<!-- Section 2: Vehicle Search -->
			<section class="home-search-section py-12 bg-white bg-gray-100">
				<div class="container">
					<h2 class="text-3xl font-bold text-center mb-8 text-white p-6 rounded-[10px] font-sans search-title">Buscador por tipo de vehículo</h2>
					
					<div class="search-form bg-gray-50 p-8 rounded-lg max-w-6xl mx-auto">
						<form method="GET" action="<?php echo esc_url( home_url() ); ?>" class="flex flex-col gap-6">
							
							<!-- Filters Row: All in one row -->
							<div class="flex flex-row gap-4">
								<!-- Fabricante Select -->
								<div class="flex-1">
									<label for="fabricante" class="block text-sm font-semibold mb-2">Fabricante</label>
									<select name="fabricante" id="fabricante" class="w-full px-4 py-2 border border-gray-300 rounded bg-white">
										<option value="">Seleccionar Fabricante</option>
										<?php
										global $wpdb;
										$manufacturers = $wpdb->get_results(
											"SELECT t.term_id, t.name, t.slug FROM {$wpdb->terms} t
											INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
											WHERE tt.taxonomy = 'fabricantes'
											ORDER BY t.name ASC"
										);
										if ( ! empty( $manufacturers ) ) :
											foreach ( $manufacturers as $manufacturer ) :
												?>
												<option value="<?php echo esc_attr( $manufacturer->slug ); ?>">
													<?php echo esc_html( $manufacturer->name ); ?>
												</option>
												<?php
											endforeach;
										else :
											echo '<option value="">No hay fabricantes disponibles</option>';
										endif;
										?>
									</select>
								</div>

								<!-- Marca Select -->
								<div class="flex-1">
									<label for="marca" class="block text-sm font-semibold mb-2">Marca</label>
									<select name="marca" id="marca" class="w-full px-4 py-2 border border-gray-300 rounded bg-white">
										<option value="">Seleccionar Marca</option>
										<?php
										$brands = $wpdb->get_results(
											"SELECT t.term_id, t.name, t.slug FROM {$wpdb->terms} t
											INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
											WHERE tt.taxonomy = 'marcas'
											ORDER BY t.name ASC"
										);
										if ( ! empty( $brands ) ) :
											foreach ( $brands as $brand ) :
												?>
												<option value="<?php echo esc_attr( $brand->slug ); ?>">
													<?php echo esc_html( $brand->name ); ?>
												</option>
												<?php
											endforeach;
										else :
											echo '<option value="">No hay marcas disponibles</option>';
										endif;
										?>
									</select>
								</div>

								<!-- OEM Code -->
								<div class="flex-1">
									<label for="oem-code" class="block text-sm font-semibold mb-2">Código OEM</label>
									<input type="text" name="oem_code" id="oem-code" placeholder="Ej: ABC123456" class="w-full px-4 py-2 border border-gray-300 rounded">
								</div>

								<!-- Manufacturer Code -->
								<div class="flex-1">
									<label for="manufacturer-code" class="block text-sm font-semibold mb-2">Código Fabricante</label>
									<input type="text" name="manufacturer_code" id="manufacturer-code" placeholder="Ej: MFG789" class="w-full px-4 py-2 border border-gray-300 rounded">
								</div>
							</div>

							<!-- Submit Button -->
							<div class="flex justify-center">
								<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded font-semibold transition">
									Buscar
								</button>
							</div>
						</form>
					</div>

					<!-- Description Text -->
					<div class="mt-8 max-w-4xl mx-auto text-center">
						<?php
						$search_description = carbon_get_post_meta( get_the_ID(), 'crb_home_search_description' );
						if ( ! empty( $search_description ) ) :
							echo wp_kses_post( $search_description );
						endif;
						?>
					</div>
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
							<div class="w-1/2">
								<img src="<?php echo esc_url( $equipment_image_url ); ?>" alt="<?php echo esc_attr( $equipment_title ); ?>" class="w-full">
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<!-- Section 7: News/Novedades -->
			<section class="home-news-section py-12 bg-gray-50">
				<div class="container">
					<?php
					$news_title = carbon_get_post_meta( get_the_ID(), 'crb_home_news_title' );
					$news_limit = carbon_get_post_meta( get_the_ID(), 'crb_home_news_limit' );
					$news_limit = ! empty( $news_limit ) ? intval( $news_limit ) : 6;
					?>

                    <div class="title-home-novedades">
                        <?php echo wp_kses_post( $news_title ); ?>
                    </div>


                <div class="flex gap-6">
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
									<div class="news-card-image-wrapper">
										<?php the_post_thumbnail( 'full', array( 'class' => 'w-full' ) ); ?>
									</div>
									<?php endif; ?>

									<div class="p-4">
										<div class="text-sm text-gray-500 mb-2">
											<?php echo get_the_date( 'd/m/Y' ); ?>
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
                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $tip1, 'full' ) ); ?>" alt="Consejo 1" class="w-full h-auto">
								<div id="form-inicio">

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
                            </div>
                        <?php endif; ?>

                        <?php if ( $tip2 ) : ?>
                            <div class="w-1/4">
                                <a href="<?php echo esc_url( $link_tip2 ); ?>" >
                                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $tip2, 'full' ) ); ?>" alt="Consejo 2" class="w-full h-stretch">
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
