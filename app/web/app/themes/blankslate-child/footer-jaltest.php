	</div><!-- .site-main -->

<?php
$directions = carbon_get_theme_option( 'crb_distribution' );
$telefonos = carbon_get_theme_option( 'crb_footer_contacts' );
?>

	<footer id="site-footer" class="site-footer fondo-negro footer-hartridge">
		<div class="container">
            <div class="flex flex-row md:flex-col justify-between mb-4 gap-6 md:gap-8">
                <div class="col w-full md:w-auto">
                    <?php
                        $footer_logo = carbon_get_post_meta( get_the_ID(), 'crb_footer_logo_jaltest' );
                        if ( $footer_logo ) {
                            echo wp_get_attachment_image( $footer_logo, 'full', false, array( 'class' => 'footer-logo' ) );
                        }
                    ?>
                    <?php
                    $footer_text = carbon_get_post_meta( get_the_ID(), 'crb_footer_text' );
                    if ( $footer_text ) {
                        echo '<p class="footer-text-hartridge">' . wp_kses_post( $footer_text ) . '</p>';
                    }
                    ?>
                </div>
                <div class="col w-full md:w-auto">                    
                    <p class="footer-title">Enlaces de interés</p>
                    <?php wp_nav_menu( array( 'menu' => 'jaltest' ) ); ?>
                </div>
                <div class="col w-full md:w-auto">
                    <p class="footer-title">Contáctanos</p>

                    <?php
                    $footer_phone = carbon_get_post_meta( get_the_ID(), 'crb_footer_phone' );
                    $footer_phone_link = carbon_get_post_meta( get_the_ID(), 'crb_footer_phone_link' );
                    if ( $footer_phone ) :
                        ?>
                        <p class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            <?php if ( $footer_phone_link ) : ?>
                                <a href="<?php echo esc_url( $footer_phone_link ); ?>"><?php echo esc_html( $footer_phone ); ?></a>
                            <?php else : ?>
                                <?php echo esc_html( $footer_phone ); ?>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>

                    <?php
                    $footer_email = carbon_get_post_meta( get_the_ID(), 'crb_footer_email' );
                    if ( $footer_email ) :
                        ?>
                        <p class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <?php echo esc_html( $footer_email ); ?>
                        </p>
                    <?php endif; ?>

                    <?php
                    $footer_address = carbon_get_post_meta( get_the_ID(), 'crb_footer_address' );
                    $footer_address_link = carbon_get_post_meta( get_the_ID(), 'crb_footer_address_link' );
                    if ( $footer_address ) :
                        ?>
                        <p class="footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php if ( $footer_address_link ) : ?>
                                <a href="<?php echo esc_url( $footer_address_link ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $footer_address ); ?></a>
                            <?php else : ?>
                                <?php echo esc_html( $footer_address ); ?>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>

                    <?php
                    $footer_social_media = carbon_get_post_meta( get_the_ID(), 'crb_footer_social_media' );
                    if ( ! empty( $footer_social_media ) ) :
                        ?>
                        <div class="footer-social-media">
                            <?php foreach ( $footer_social_media as $social ) : ?>
                                <?php if ( ! empty( $social['link'] ) && ! empty( $social['icon'] ) ) : ?>
                                    <a href="<?php echo esc_url( $social['link'] ); ?>" target="_blank" rel="noopener" class="footer-social-icon">
                                        <i class="<?php echo esc_attr( $social['icon'] ); ?>"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="col w-full md:w-auto">
                    <?php
                    $footer_hdi_logo = carbon_get_post_meta( get_the_ID(), 'crb_hdi_logo_footer' );
                    if ( $footer_hdi_logo ) {
                        echo wp_get_attachment_image( $footer_hdi_logo, 'full', false, array( 'class' => 'footer-logo' ) );
                    }
                    ?>                   
                </div>
            </div>
            <div class="flex flex-row justify-center items-center mb-4 derechos-reservados">
                <div class="col"><?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_jaltest_footer_copyright' ) ); ?></div>
            </div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
