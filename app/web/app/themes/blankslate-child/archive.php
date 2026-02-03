<?php
get_header();

if ( is_singular() ) {
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'entry' );
			comments_template();
		endwhile;
	endif;
} else {
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'entry-summary' );
		endwhile;
	endif;
}

if ( ! is_singular() ) {
	get_template_part( 'nav', 'below' );
}

get_footer();
