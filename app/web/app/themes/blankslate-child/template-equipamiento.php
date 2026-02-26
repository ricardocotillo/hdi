<?php
/**
 * Template Name: Equipamiento
 * Template Post Type: page
 */
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
        <?php endif; ?>
        <section class="w-full equipamiento-content">
            <section class="container text-center">
                <?php the_content(); ?>
            </section>
			<section class="container">
				<?php
				$gallery_images = carbon_get_post_meta( get_the_ID(), 'crb_page_equipment_gallery' );
				$equipment_content = carbon_get_post_meta( get_the_ID(), 'crb_page_equipment_content' );
				if ( $gallery_images ) :
					?>
					<div class="equipment-gallery flex gap-5">
						<?php foreach ( $gallery_images as $key => $image_item ) : $content_item = $equipment_content[ $key ] ?? null; ?>
							<?php if ( isset( $image_item['image'] ) && $image_item['image'] ) : ?>
								<div class="gallery-item">
									<?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'gallery-image' ) ); ?>

									<div class="equipment-content-item">
										<?php if ( ! empty( $content_item['image'] ) ) : ?>
											<div class="equipment-content-image">
												<?php echo wp_get_attachment_image( $content_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
											</div>
										<?php endif; ?>
										<?php if ( ! empty( $content_item['content'] ) ) : ?>
											<div class="equipment-content-text">
												<?php echo wp_kses_post( (string) $content_item['content'] ); ?>
											</div>
										<?php endif; ?>
									</div>									
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<?php
				endif;
				?>
			</section>
        </section>
		<?php
	endwhile;
endif;

get_footer();
