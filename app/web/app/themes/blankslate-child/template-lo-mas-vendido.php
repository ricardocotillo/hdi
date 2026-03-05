<?php
/**
 * Template Name: Lo Mas Vendido
 */

get_header();

$header_image = carbon_get_post_meta( get_queried_object_id(), 'crb_page_header_image' );

$productos_query = new WP_Query( array(
	'post_type'      => 'productos',
	'posts_per_page' => 12,
	'paged'          => 1,
	'orderby'        => 'date',
	'order'          => 'DESC',
) );
?>

<?php if ( $header_image ) : ?>
	<header class="w-full">
		<?php echo wp_get_attachment_image( $header_image, 'full', false, array( 'class' => 'page-header-image w-full h-auto', 'alt' => get_the_title() ) ); ?>
	</header>
<?php endif; ?>

<div class="taxonomy-container bg-white">
	<section class="w-full">
		<div class="container text-center">
			<h2 id="productos-mas-vendidos">Nuestras Marcas</h2>
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

	<div class="taxonomy-wrapper-container bg-white">
		<div class="container mx-auto taxonomy-wrapper flex gap-5">
			<main class="productos-main">
				<div id="productos-grid" class="productos-grid">
					<?php if ( $productos_query->have_posts() ) : ?>
						<?php while ( $productos_query->have_posts() ) : $productos_query->the_post(); ?>
							<article class="producto-item">
								<div class="producto-image">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium' ); ?>
									<?php endif; ?>
								</div>
								<h3 class="producto-title"><?php the_title(); ?></h3>
								<a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver mas</a>
							</article>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php else : ?>
						<p class="no-productos">No hay productos.</p>
					<?php endif; ?>
				</div>
			</main>
		</div>

		<?php if ( $productos_query->found_posts > 12 ) : ?>
			<div class="ver-mas-container">
				<button id="load-more-btn" class="btn-ver-mas-productos" data-paged="2" data-term-id="" data-taxonomy="">
					Ver mas
				</button>
			</div>
		<?php endif; ?>
	</div>

	<div class="w-full container mx-auto">
		<section class="container">
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
									<?php
								endforeach;
							endif;
							?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		</section>
	</div>
</div>

<?php get_footer(); ?>
