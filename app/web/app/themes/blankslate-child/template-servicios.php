<?php
/**
 * Template Name: Servicios
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
            <section class="w-full servicios-content">
                <section class="container container-servicios">
                    <div class="flex servicios-row servicios-row-1">
                        <div class="gallery-container w-1/2">
                            <div class="servicios-gallery">
                                <?php
                                    $laboratory_image = carbon_get_post_meta( get_the_ID(), 'crb_page_laboratory_gallery' );
                                    if ( $laboratory_image ) :
                                        ?>
                                        <div class="owl-carousel owl-theme servicios-carousel">
                                            <?php
                                            foreach ( $laboratory_image as $image_item ) {
                                                if ( isset( $image_item['image'] ) ) {
                                                    ?>
                                                    <div class="servicios-gallery-item">
                                                        <?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    endif;
                                ?>
                            </div>  
                        </div>

                        <div class="flex flex-col p-10 w-1/2 servicios-text servicios-text-1">
                            <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_laboratory_text' ) ); ?>
                        </div>
                    </div>
                </section>
                <section class="w-full services-campo container-servicios">
                    <section class="container">

                        <div class="flex servicios-row servicios-row-2">

                            <div class="flex flex-col p-10 w-1/2 text-right servicios-text servicios-text-2">
                                <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_field_services_text' ) ); ?>
                            </div>                    

                            <div class="gallery-container w-1/2">
                                <div class="servicios-gallery">
                                    <?php
                                        $field_services_image = carbon_get_post_meta( get_the_ID(), 'crb_page_field_services_gallery' );
                                        if ( $field_services_image ) :
                                            ?>
                                            <div class="owl-carousel owl-theme servicios-carousel">
                                                <?php
                                                foreach ( $field_services_image as $image_item ) {
                                                    if ( isset( $image_item['image'] ) ) {
                                                        ?>
                                                        <div class="servicios-gallery-item">
                                                            <?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        <?php
                                        endif;
                                    ?>
                                </div>  
                            </div>

                        </div>

                    </section>
                </section>
                <section class="container container-servicios">
                    <div class="flex servicios-row servicios-row-3">
                        <div class="gallery-container w-1/2">
                            <div class="servicios-gallery">
                                <?php
                                    $laboratory_image = carbon_get_post_meta( get_the_ID(), 'crb_page_field_red_services_gallery' );
                                    if ( $laboratory_image ) :
                                        ?>
                                        <div class="owl-carousel owl-theme servicios-carousel">
                                            <?php
                                            foreach ( $laboratory_image as $image_item ) {
                                                if ( isset( $image_item['image'] ) ) {
                                                    ?>
                                                    <div class="servicios-gallery-item">
                                                        <?php echo wp_get_attachment_image( $image_item['image'], 'full', false, array( 'class' => 'w-full h-auto' ) ); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    endif;
                                ?>
                            </div>  
                        </div>

                        <div class="flex flex-col p-10 w-1/2 servicios-text servicios-text-3">
                            <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_field_red_services_text' ) ); ?>
                        </div>
                    </div>
                </section>                
			</section>
		<?php
		
		//get_template_part( 'entry' );
		//comments_template();
	endwhile;
endif;

get_footer();
