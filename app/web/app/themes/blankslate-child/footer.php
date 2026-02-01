	</div><!-- .site-main -->

	<footer id="site-footer" class="site-footer">
		<div class="container">
            <div class="flex flex-row justify-between mb-4">
                <div class="col">
                    <p class="footer-title">Distribución - Ventas</p>
                    <p><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Av. Paseo de la República #662</p>
                    <div class="hr"></div>
                    <p class="footer-title">_____<br>Laboratorio</p>
                    <p><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Calle Telares #203 - Ate</p>
                    <div class="hr"></div>
                    <p class="footer-title">_____<br>Oficina</p>
                    <p><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Calle Rene Descartes #146 - Ate</p>                    
                </div>
                <div class="col">                    
                    <p class="footer-title">Productos</p>
                    <?php wp_nav_menu( array( 'menu' => 'productos' ) ); ?>
                </div>
                <div class="col">
                    <p class="footer-title">Servicios</p>
                    <?php wp_nav_menu( array( 'menu' => 'Servicios' ) ); ?>
                    <p class="footer-title">Legal</p>
                    <?php wp_nav_menu( array( 'menu' => 'legal' ) ); ?>
                </div>
                <div class="col">44</div>
            </div>
            <div class="flex flex-row justify-center items-center mb-4 derechos-reservados">
                <div class="col">HDI - Todos los derechos reservados</div>
            </div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
