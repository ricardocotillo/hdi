<?php
get_header();

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
			<section class="container">
				<?php the_content(); ?>
			</section>
		<?php endif; ?>
		<?php
		
		//get_template_part( 'entry' );
		//comments_template();
	endwhile;
endif;

get_footer();
