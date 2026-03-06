<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
			<div class="container text-center news-detail">
				<h1><?php the_title(); ?></h1>
				<div class="content text-justify">
					<?php the_content(); ?>
				</div>
		</div>
		<?php
	endwhile;
endif;

get_footer();
