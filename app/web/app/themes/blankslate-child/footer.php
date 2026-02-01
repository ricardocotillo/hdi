	</div><!-- .site-main -->

<?php
$directions = carbon_get_theme_option( 'crb_distribution' );
$telefonos = carbon_get_theme_option( 'crb_footer_contacts' );
?>

	<footer id="site-footer" class="site-footer">
		<div class="container">
            <div class="flex flex-row md:flex-col justify-between mb-4 gap-6 md:gap-8">
                <div class="col w-full md:w-auto">
                    <?php foreach($directions as $key => $direction) : ?>
                    <p class="footer-title">
                        <?php if($key > 0 ): ?>
                            _____<br>
                        <?php endif ?>
                        <?php echo esc_html( $direction['label'] ); ?>
                    </p>
                    <p class="address">
                        <?php if($direction['url']) : ?>
                            <a class="address" href="<?php echo esc_url( $direction['url'] ); ?>" target="_blank" rel="noopener">
                        <?php endif; ?>
                        <i aria-hidden="true" class="fas fa-map-marker-alt"></i> <?php echo esc_html( $direction['address'] ); ?>
                        <?php if($direction['url']) : ?>
                            </a>
                        <?php endif; ?>
                    </p>
                    <?php endforeach; ?>
                    <!-- <p><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Calle Telares #203 - Ate</p>
                    <div class="hr"></div>
                    <p class="footer-title">_____<br>Oficina</p>
                    <p><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Calle Rene Descartes #146 - Ate</p>                     -->
                </div>
                <div class="col w-full md:w-auto">                    
                    <p class="footer-title">Productos</p>
                    <?php wp_nav_menu( array( 'menu' => 'productos' ) ); ?>
                </div>
                <div class="col w-full md:w-auto">
                    <p class="footer-title">Servicios</p>
                    <?php wp_nav_menu( array( 'menu' => 'Servicios' ) ); ?>
                    <p class="footer-title">Legal</p>
                    <?php wp_nav_menu( array( 'menu' => 'legal' ) ); ?>
                </div>
                <div class="col w-full md:w-auto">
                    <?php
                    $logo_id = carbon_get_theme_option( 'crb_footer_logo' );
                    if ( $logo_id ) {
                        echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'footer-logo' ) );
                    }
                    ?>
                    <?php foreach($telefonos as $key => $telefono) : ?>
                        <p class="footer-title">
                            <?php if($telefono['link']) : ?>
                                <a class="address" href="<?php echo esc_url( $telefono['link'] ); ?>" target="_blank" rel="noopener">
                                    <?php endif; ?>
                                    <i aria-hidden="true" class="fas fa-phone-alt"></i> <?php echo esc_html( $telefono['phone'] ); ?>
                                    <?php echo esc_html( $telefono['label'] ); ?>
                                    <?php if($telefono['link']) : ?>
                                </a>
                            <?php endif; ?>
                        </p>
                    <?php endforeach; ?>                    
                </div>
            </div>
            <div class="flex flex-row justify-center items-center mb-4 derechos-reservados">
                <div class="col"><?php echo esc_html( carbon_get_theme_option( 'crb_copyright' ) ); ?></div>
            </div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
