<?php
get_header();

$search_term = get_search_query();
$fabricantes = get_terms( array(
	'taxonomy'   => 'fabricantes',
	'hide_empty' => true,
) );
$marcas = get_terms( array(
	'taxonomy'   => 'marcas',
	'hide_empty' => true,
) );

$search_productos_query = new WP_Query( array(
	'post_type'      => 'productos',
	's'              => $search_term,
	'posts_per_page' => 12,
	'paged'          => 1,
) );

$whatsapps = carbon_get_theme_option( 'crb_header_whatsapp' );
?>

<div class="container taxonomy-container">
	<div class="taxonomy-wrapper-container">
		<div class="taxonomy-wrapper flex gap-5">
			<aside class="filters-panel">
				<h3 class="filters-title">Seleccione vehículos</h3>

				<div class="filter-group">
					<label for="filter-fabricantes">Fabricantes</label>
					<select id="filter-fabricantes" class="filter-select" data-taxonomy="fabricantes">
						<option value="">Seleccionar...</option>
						<?php foreach ( $fabricantes as $fabricante ) : ?>
							<option value="<?php echo esc_attr( $fabricante->term_id ); ?>"><?php echo esc_html( $fabricante->name ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="filter-group">
					<label for="filter-marcas">Marcas</label>
					<select id="filter-marcas" class="filter-select" data-taxonomy="marcas">
						<option value="">Seleccionar...</option>
						<?php foreach ( $marcas as $marca ) : ?>
							<option value="<?php echo esc_attr( $marca->term_id ); ?>"><?php echo esc_html( $marca->name ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="filter-group">
					<label for="filter-oem">Código OEM</label>
					<input type="text" id="filter-oem" class="filter-input" placeholder="Buscar...">
				</div>

				<div class="filter-group">
					<label for="filter-fabricante-code">Códigos Fabricante</label>
					<input type="text" id="filter-fabricante-code" class="filter-input" placeholder="Buscar...">
				</div>

				<div class="filter-contact hide-mobile">
					<a href="<?php echo esc_url( $whatsapps[0]['link'] ); ?>" class="btn-contactanos"><i aria-hidden="true" class="fab fa-whatsapp"></i> Contáctanos</a>
				</div>
			</aside>

			<main class="productos-main">
				<div id="productos-grid" class="productos-grid">
					<?php if ( $search_productos_query->have_posts() ) : ?>
						<?php while ( $search_productos_query->have_posts() ) : $search_productos_query->the_post(); ?>
							<article class="producto-item">
								<div class="producto-image">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium' ); ?>
									<?php endif; ?>
								</div>
								<h3 class="producto-title"><?php the_title(); ?></h3>
								<a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver más</a>
							</article>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php else : ?>
						<p class="no-productos">No hay productos.</p>
					<?php endif; ?>
				</div>
			</main>
		</div>
	</div>

	<?php if ( $search_productos_query->found_posts > 12 ) : ?>
		<div class="ver-mas-container">
			<button id="load-more-btn" class="btn-ver-mas-productos" data-paged="2" data-term-id="" data-taxonomy="">
				Ver más
			</button>
		</div>
	<?php endif; ?>

	<div class="w-full">
		<div class="container">
			<div class="filter-contact filter-contact-mobile">
				<a href="<?php echo esc_url( $whatsapps[0]['link'] ); ?>" class="btn-contactanos"><i aria-hidden="true" class="fab fa-whatsapp"></i> Contáctanos</a>
			</div>
		</div>
	</div>

	<style>
	@media (max-width: 767px) {
		.hide-mobile {
			display: none !important;
		}
	}
	</style>

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

			<section class="w-full">
				<div class="container">
					<div class="owl-carousel owl-theme home-brands-carousel">
						<?php
						$brands_carousel = carbon_get_theme_option( 'crb_distribuidor_grid' );
						if ( ! empty( $brands_carousel ) ) :
							foreach ( $brands_carousel as $brand ) :
								$logo_url = ! empty( $brand['image'] ) ? wp_get_attachment_image_url( $brand['image'], 'medium' ) : '';
								?>
								<div class="brand-carousel-item text-center">
									<?php if ( $logo_url ) : ?>
										<img src="<?php echo esc_url( $logo_url ); ?>" alt="Brand Logo" class="h-24 mx-auto">
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<section class="home-parts-section bg-white">
				<div class="container text-center text-distribuidor-official">
					<?php
					$parts_title = carbon_get_theme_option( 'crb_distribuidor_official_text' );
					if ( ! empty( $parts_title ) ) :
						echo wp_kses_post( $parts_title );
						?>
						<div class="owl-carousel owl-theme home-parts-carousel">
							<?php
							$parts_gallery = carbon_get_post_meta( get_option( 'page_on_front' ), 'crb_home_parts_gallery' );
							if ( ! empty( $parts_gallery ) ) :
								foreach ( $parts_gallery as $part ) :
									$part_image = ! empty( $part['image'] ) ? wp_get_attachment_image_url( $part['image'], 'medium' ) : '';
									?>
									<div class="parts-item">
										<?php if ( $part_image ) : ?>
											<img src="<?php echo esc_url( $part_image ); ?>" alt="Parte/Pieza" class="parts-item-image">
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
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
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</section>
		</section>
	</div>
</div>

<?php get_footer();
