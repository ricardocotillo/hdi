<?php
/**
 * Template Name: Hartridge
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
            <section class="w-full items-hartridge-content">
                <section class="container">
                    <?php
                    $equipment_items = carbon_get_post_meta( get_the_ID(), 'crb_page_equipment_items' );
                    if ( ! empty( $equipment_items ) ) :
                        ?>
                        <section class="hartridge-items flex gap-10">
                            <?php foreach ( $equipment_items as $item ) : ?>
                                <div class="hartridge-item w-1/3 flex flex-col items-center bg-white text-center p-6">
                                    <?php
                                    $logo_id = isset( $item['logo'] ) ? $item['logo'] : 0;
                                    if ( $logo_id ) :
                                        echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'hartridge-item-logo mb-4', 'alt' => '' ) );
                                    endif;
                                    ?>
                                    <?php if ( ! empty( $item['title'] ) ) : ?>
                                        <h3 class="hartridge-item-title mb-3"><?php echo esc_html( $item['title'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $item['content'] ) ) : ?>
                                        <div class="hartridge-item-content">
                                            <?php echo wp_kses_post( $item['content'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    <?php endif; ?>
                </section>
            </section>
            <section class="w-full que-es-hartridge">
                <section class="container">
                    <?php
                    $hartridge_title = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_title' );
                    $hartridge_text = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_text' );
                    $hartridge_image = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_image' );
                    if ( $hartridge_title || $hartridge_text || $hartridge_image ) :
                        ?>
                        <div class="hartridge-about flex flex-row gap-8 md:flex-row md:items-center">
                            <div class="hartridge-about-text w-2/3">
                                <?php if ( $hartridge_title ) : ?>
                                    <h2 class="hartridge-about-title mb-4"><?php echo esc_html( $hartridge_title ); ?></h2>
                                <?php endif; ?>
                                <?php if ( $hartridge_text ) : ?>
                                    <div class="hartridge-about-content">
                                        <?php echo wp_kses_post( $hartridge_text ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="hartridge-about-image w-1/3">
                                <?php
                                if ( $hartridge_image ) {
                                    echo wp_get_attachment_image( $hartridge_image, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => '' ) );
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
            </section>
            <section class="w-full">
                <section class="container nuestros-productos">
                    <h2 class="text-center">Nuestros Productos</h2>
                    <p class="text-center">Hartridge cuenta con una amplia variedad de bancos de pruebas, accesorios y sofware, dirigidos para laboratorio diésel.</p>
                    <?php
                    $hartridge_products = carbon_get_post_meta( get_the_ID(), 'crb_hartridge_products' );
                    if ( ! empty( $hartridge_products ) ) :
                        ?>
                        <div class="hartridge-products flex flex-row gap-6">
                            <?php foreach ( $hartridge_products as $product ) : ?>
                                <?php
                                $image_id = isset( $product['image'] ) ? $product['image'] : 0;
                                $link = isset( $product['link'] ) ? $product['link'] : '';
                                ?>
                                <?php if ( $image_id ) : ?>
                                    <a class="hartridge-product" href="<?php echo esc_url( $link ); ?>" <?php echo $link ? 'target="_blank" rel="noopener"' : ''; ?>>
                                        <?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'w-full h-auto', 'alt' => '' ) ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </section>
            </section>
        </section>
		<?php
	endwhile;
endif;

get_footer();
