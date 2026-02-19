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
			<section class="home-services-section py-12 bg-blue-600">
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
								<img src="<?php echo esc_url( $services_image_url ); ?>" alt="<?php echo esc_attr( $services_title ); ?>" class="w-full object-cover">
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

					<h2 class="text-3xl font-bold text-center mb-8"><?php echo esc_html( $news_title ); ?></h2>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
								<article class="news-card bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="h-48 overflow-hidden">
											<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-full object-cover' ) ); ?>
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

										<p class="text-gray-600 mb-4">
											<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
										</p>

										<a href="<?php the_permalink(); ?>" class="text-blue-600 hover:text-blue-700 font-semibold">
											Leer más →
										</a>
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
			<section class="home-parts-section py-12 bg-white">
				<div class="container">
					<h2 class="text-3xl font-bold text-center mb-8">Partes y Piezas</h2>

					<div class="owl-carousel owl-theme home-parts-carousel">
						<?php
						$parts_gallery = carbon_get_post_meta( get_the_ID(), 'crb_home_parts_gallery' );
						if ( ! empty( $parts_gallery ) ) :
							foreach ( $parts_gallery as $part ) :
								$part_image = ! empty( $part['image'] ) ? wp_get_attachment_image_url( $part['image'], 'medium' ) : '';
								?>
								<div class="parts-item">
									<?php if ( $part_image ) : ?>
										<img src="<?php echo esc_url( $part_image ); ?>" alt="Parte/Pieza" class="w-full h-auto rounded-lg">
									<?php endif; ?>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
			</section>

			<!-- Section 9: Tips/Consejos -->
			<section class="home-tips-section py-12 bg-gray-50">
				<div class="container">
					<?php
					$tips_title = carbon_get_post_meta( get_the_ID(), 'crb_home_tips_title' );
					?>

					<h2 class="text-3xl font-bold text-center mb-8"><?php echo esc_html( $tips_title ); ?></h2>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
						<?php
						$tips_gallery = carbon_get_post_meta( get_the_ID(), 'crb_home_tips_gallery' );
						if ( ! empty( $tips_gallery ) ) :
							foreach ( $tips_gallery as $tip ) :
								$tip_image = ! empty( $tip['image'] ) ? wp_get_attachment_image_url( $tip['image'], 'medium' ) : '';
								$tip_link = ! empty( $tip['link'] ) ? $tip['link'] : '#';
								?>
								<a href="<?php echo esc_url( $tip_link ); ?>" class="tip-card block bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
									<?php if ( $tip_image ) : ?>
										<div class="h-40 overflow-hidden">
											<img src="<?php echo esc_url( $tip_image ); ?>" alt="Consejo" class="w-full h-full object-cover">
										</div>
									<?php endif; ?>
									<div class="p-4 text-center">
										<p class="text-gray-700 font-semibold">Ver Consejo →</p>
									</div>
								</a>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
			</section>

		</article>

		<?php
	endwhile;
endif;

get_footer();
?>
