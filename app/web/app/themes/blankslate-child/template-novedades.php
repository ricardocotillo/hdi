<?php
/**
 * Template Name: Novedades
 * Description: Template para mostrar post publicados
 * Template Post Type: page
 */

get_header();

// Query all published newcatalogo posts
$args = array(
	'post_type'      => 'post',
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
		<div class="container flex flex-row news-container">
			<section class="news-list flex flex-col">
				<?php 
					while ( $catalogo_query->have_posts() ) :
						$catalogo_query->the_post(); 
				?>
					<article class="news-entry flex flex-row">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="news-image">
								<figure class="news-image">
									<a href="<?php echo get_permalink(); ?>" rel="noopener noreferrer">
										<!-- <img src="https://placehold.co/336x280" alt="<?php echo esc_attr( get_the_title() ); ?>" class=""> -->
										<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto', 'alt' => get_the_title() ) ); ?>
									</a>
								</figure>
							</div>
						<?php endif; ?>
						<div class="news-content">						
							<h2>
								<a href="<?php echo get_permalink(); ?>" rel="noopener noreferrer"><?php the_title(); ?></a>
							</h2>
							<?php if ( has_excerpt() ) : ?>
								<div><?php echo get_the_excerpt(); ?></div>
							<?php endif; ?>
							<a href="<?php echo get_permalink(); ?>" class="btn-news-ver-mas" rel="noopener noreferrer">Ver más</a>
						</div>
					</article>
				<?php endwhile; ?>
			</section>
			<div class="news-side-bar">
				<h2 class="font-bold mb-4">Post Recientes</h2>
				<?php 
					while ( $catalogo_query->have_posts() ) :
						$catalogo_query->the_post(); 
				?>
					<article class="news-entry flex flex-col">						
							<h1><a href="<?php echo get_permalink(); ?>" rel="noopener noreferrer"><?php the_title(); ?></a></h1>
							<p class="text-sm text-gray-600"><?php echo get_the_date( get_option( 'date_format' ) ); ?></p>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</main>
	<?php wp_reset_postdata(); ?>
<?php endif;

get_footer();
