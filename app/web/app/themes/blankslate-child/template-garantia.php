<?php
/**
 * Template Name: Política de Garantía
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" class="site-main">
			<div class="container py-12">
				<div class="max-w-4xl mx-auto" id="garantia-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article>

		<?php
	endwhile;
endif;

get_footer();
