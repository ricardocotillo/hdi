<?php
/**
 * Template Name: Listado de Catálogos
 * Description: Template para mostrar el listado de catálogos publicados
 * Template Post Type: page
 */

get_header();

// Query all published newcatalogo posts
$args = array(
	'post_type'      => 'newcatalogo',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

$catalogo_query = new WP_Query( $args );

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
		<?php
		
		//get_template_part( 'entry' );
		//comments_template();
	endwhile;
endif;

// Display published newcatalogo posts
if ( $catalogo_query->have_posts() ) : 
?>
	<main class="w-full">
		<section class="catalogos-list">
			<?php 
				while ( $catalogo_query->have_posts() ) :
					$catalogo_query->the_post();
						$dateCatalogo = carbon_get_post_meta( get_the_ID(), 'crb_catalogo_fecha' );
						$dateCatalogo = date_i18n( get_option( 'date_format' ), strtotime( $dateCatalogo ) );
						$idUrlCatalogo = carbon_get_post_meta( get_the_ID(), 'crb_catalogo_pdf' );
						$urlCatalogo = wp_get_attachment_url( $idUrlCatalogo ); 
			?>
				<article class="catalogo-entry">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="catalogo-image">
							<a href="<?php echo esc_url( $urlCatalogo ); ?>" target="_blank" rel="noopener noreferrer">
								<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-auto', 'alt' => get_the_title() ) ); ?>
							</a>
						</figure>
					<?php endif; ?>
					<div class="catalogo-content flex flex-col justify-center">
						<time datetime="<?php echo esc_attr( carbon_get_post_meta( get_the_ID(), 'crb_catalogo_fecha' ) ); ?>" class="block text-sm text-gray-600 mb-2"><a href="<?php echo esc_url( $urlCatalogo ); ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-circle" aria-hidden="true"></i> <?php echo esc_html( $dateCatalogo ); ?></a></time>
					<h2 class="font-bold mb-4"><a href="<?php echo esc_url( $urlCatalogo ); ?>" target="_blank" rel="noopener noreferrer"><?php the_title(); ?></a></h2>
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</section>
	</main>
	<?php wp_reset_postdata(); ?>
<?php endif;

get_footer();
