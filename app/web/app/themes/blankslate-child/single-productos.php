<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		
		// Get product data from Jet Engine metafields
		$sku = get_post_meta( get_the_ID(), 'sku', true );
		$cod_fabricante = get_post_meta( get_the_ID(), 'cod-fabricante', true );
		$modelo = get_post_meta( get_the_ID(), 'modelo', true );
		$origen = get_post_meta( get_the_ID(), 'origen', true );
		$descripcion_corta = get_post_meta( get_the_ID(), 'descripcion-corta', true );
		$descripcion = get_post_meta( get_the_ID(), 'descripcion', true );
		$caracteristicas = get_post_meta( get_the_ID(), 'caracteristicas', true );
		$detalles = get_post_meta( get_the_ID(), 'detalles', true );
		$galeria = get_post_meta( get_the_ID(), 'galeria', true );
		
		// Get taxonomies
		$fabricantes = get_the_terms( get_the_ID(), 'fabricantes' );
		$marcas = get_the_terms( get_the_ID(), 'marcas' );
		$categorias = get_the_terms( get_the_ID(), 'categorias-de-producto' );
		
		$fabricante_name = ( $fabricantes && ! is_wp_error( $fabricantes ) ) ? $fabricantes[0]->name : '';
		$marca_name = ( $marcas && ! is_wp_error( $marcas ) ) ? $marcas[0]->name : '';
		$marca_id = ( $marcas && ! is_wp_error( $marcas ) ) ? $marcas[0]->term_id : '';
		$categoria_id = ( $categorias && ! is_wp_error( $categorias ) ) ? $categorias[0]->term_id : '';
		
		$permalink = get_permalink();
		$title = get_the_title();
		$share_url = esc_url_raw( $permalink );
		$share_title = rawurlencode( $title );
		$facebook_share = add_query_arg( 'u', $share_url, 'https://www.facebook.com/sharer/sharer.php' );
		$linkedin_share = add_query_arg( 'url', $share_url, 'https://www.linkedin.com/sharing/share-offsite/' );
		$whatsapp_share = add_query_arg( 'text', $title . ' ' . $permalink, 'https://api.whatsapp.com/send' );
		$email_share = 'mailto:?subject=' . $share_title . '&body=' . rawurlencode( $permalink );
		
		// Process gallery images - include featured image first
		$gallery_ids = array();
		$featured_image_id = get_post_thumbnail_id( get_the_ID() );
		
		// Add featured image first if it exists
		if ( $featured_image_id ) {
			$gallery_ids[] = $featured_image_id;
		}
		
		// Add gallery images from metafield
		if ( $galeria ) {
			$galeria_array = is_array( $galeria ) ? $galeria : array_filter( array_map( 'trim', explode( ',', $galeria ) ) );
			foreach ( $galeria_array as $img_id ) {
				// Avoid duplicates if featured image is also in gallery
				if ( ! in_array( $img_id, $gallery_ids, true ) ) {
					$gallery_ids[] = $img_id;
				}
			}
		}
		?>
		
		<div class="container product-detail-container">
			
			<!-- Product Header Section: Gallery (Left) + Details (Right) -->
			<div class="product-header-section">
				<div class="product-header-inner">
					
					<!-- Gallery Section (Left) -->
					<div class="product-gallery-section">
						<?php if ( ! empty( $gallery_ids ) ) : ?>
							<!-- Main Gallery Carousel -->
							<div class="product-gallery-main-wrapper">
								<div class="owl-carousel owl-theme product-gallery-carousel">
									<?php
									foreach ( $gallery_ids as $img_id ) {
										$img_url = wp_get_attachment_image_url( $img_id, 'large' );
										if ( $img_url ) : ?>
											<div class="product-gallery-item">
												<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="product-gallery-image">
											</div>
										<?php endif;
									}
									?>
								</div>
							</div>
							
							<!-- Thumbnails Gallery -->
							<?php if ( count( $gallery_ids ) > 1 ) : ?>
								<div class="product-thumbnails-wrapper">
									<?php
									foreach ( $gallery_ids as $img_id ) {
										$thumb_url = wp_get_attachment_image_url( $img_id, 'medium' );
										if ( $thumb_url ) : ?>
											<div class="product-thumbnail-item">
												<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="product-thumbnail-image">
											</div>
										<?php endif;
									}
									?>
								</div>
							<?php endif; ?>
						<?php else : ?>
							<div class="product-no-image">
								<p class="no-image-text">No hay imágenes disponibles</p>
							</div>
						<?php endif; ?>
					</div>
					
					<!-- Product Details Section (Right) - 50% -->
					<div class="product-details-section">
						
						<!-- Title -->
						<h1 class="product-title"><?php the_title(); ?></h1>
						
						<!-- SKU -->
						<?php if ( $sku ) : ?>
							<div class="product-sku">
								<span class="sku-label">SKU:</span> <span class="sku-value"><?php echo esc_html( $sku ); ?></span>
							</div>
						<?php endif; ?>
						
						<!-- Quote Button -->
						<?php
						$boton_cotizar_text = carbon_get_theme_option( 'crb_producto_boton_cotizar' );
						if ( $boton_cotizar_text ) :
						?>
							<div class="product-quote-section">
								<a href="https://wa.me/51940818542" target="_blank" class="btn-cotizar-producto">
									<?php echo esc_html( $boton_cotizar_text ); ?>
								</a>
							</div>
						<?php endif; ?>
						
						<!-- Availability -->
						<div class="product-availability">
							<p class="availability-status in-stock">Disponible</p>
                            <p class="delivery-payment-title">Despacho y métodos de pagos</p>
						</div>
						
						<!-- Shipping & Payment Info -->
						<div class="product-delivery-payment flex flex-row">
							<div class="delivery-info">
								<?php
								$icono_delivery_id = carbon_get_theme_option( 'crb_producto_icono_delivery' );
								$icono_delivery_url = $icono_delivery_id ? wp_get_attachment_image_url( $icono_delivery_id, 'thumbnail' ) : '';
								?>
								<h4>
									<?php if ( $icono_delivery_url ) : ?>
										<img src="<?php echo esc_url( $icono_delivery_url ); ?>" alt="Delivery">
									<?php else : ?>
										<i class="fas fa-shipping-fast"></i>
									<?php endif; ?>
									EXPRESS
                                    <br>24 A 48 HORAS
								</h4>
							</div>
							
							<div class="payment-info">
								<?php
								$icono_factura_id = carbon_get_theme_option( 'crb_producto_icono_factura' );
								$icono_factura_url = $icono_factura_id ? wp_get_attachment_image_url( $icono_factura_id, 'thumbnail' ) : '';
								?>
								<h4>
									<?php if ( $icono_factura_url ) : ?>
										<img src="<?php echo esc_url( $icono_factura_url ); ?>" alt="Factura">
									<?php else : ?>
										<i class="fas fa-receipt"></i>
									<?php endif; ?>
									COMPRA CON
                                    <br>BOLETA O FACTURA
								</h4>
							</div>					</div>
											<!-- Share Links -->
						<div class="product-share-section">
							<h3>Compartir</h3>
							<div class="share-links share-links-product">
                                <a class="share share-whatsapp" href="<?php echo esc_url( $whatsapp_share ); ?>" target="_blank" rel="noopener noreferrer" title="Compartir en WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
								<a class="share share-facebook" href="<?php echo esc_url( $facebook_share ); ?>" target="_blank" rel="noopener noreferrer" title="Compartir en Facebook">
									<i class="fab fa-facebook"></i>
								</a>
								<a class="share share-email" href="<?php echo esc_url( $email_share ); ?>" target="_blank" rel="noopener noreferrer" title="Compartir por Email">
									<i class="fas fa-envelope"></i>
								</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			<!-- Description & Specifications Section -->
			<div class="product-content-section">
				
				<!-- Tabs/Navigation -->
				<div class="product-tabs">
					<div class="tabs-wrapper">
						<button class="tab-button active" data-tab="description">
							Descripción
						</button>
						<button class="tab-button" data-tab="detalles">
							Detalles del producto
						</button>
					</div>
				</div>
				
				<!-- Tab: Descripción -->
				<div class="tab-content active" id="tab-description">
					<!-- Specifications Table -->
					<div class="specs-table-wrapper">
						<table class="specs-table">
							<tbody>
								<?php if ( $fabricante_name ) : ?>
									<tr>
										<td class="specs-label">Fabricantes</td>
										<td class="specs-value"><?php echo esc_html( $fabricante_name ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $origen ) : ?>
									<tr>
										<td class="specs-label">Origen</td>
										<td class="specs-value"><?php echo esc_html( $origen ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $marca_name ) : ?>
									<tr>
										<td class="specs-label">Marcas</td>
										<td class="specs-value"><?php echo esc_html( $marca_name ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $modelo ) : ?>
									<tr>
										<td class="specs-label">Modelo</td>
										<td class="specs-value"><?php echo esc_html( $modelo ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $sku ) : ?>
									<tr>
										<td class="specs-label">Códigos OEM</td>
										<td class="specs-value"><?php echo esc_html( $sku ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $cod_fabricante ) : ?>
									<tr>
										<td class="specs-label">Códigos de fabricante</td>
										<td class="specs-value"><?php echo esc_html( $cod_fabricante ); ?></td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>

					<?php if ( $caracteristicas ) : ?>
						<div class="product-characteristics">
							<h3>Características</h3>
							<?php echo wp_kses_post( $caracteristicas ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $detalles ) : ?>
						<div class="product-details">
							<h3>Detalles Técnicos</h3>
							<?php echo wp_kses_post( $detalles ); ?>
						</div>
					<?php endif; ?>
				</div>
				
				<!-- Tab: Detalles del producto (Additional Details) -->
				<div class="tab-content" id="tab-detalles">
					<!-- Specifications Table -->
					<div class="specs-table-wrapper">
						<table class="specs-table">
							<tbody>
								<?php if ( $fabricante_name ) : ?>
									<tr>
										<td class="specs-label">Fabricantes</td>
										<td class="specs-value"><?php echo esc_html( $fabricante_name ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $origen ) : ?>
									<tr>
										<td class="specs-label">Origen</td>
										<td class="specs-value"><?php echo esc_html( $origen ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $marca_name ) : ?>
									<tr>
										<td class="specs-label">Marcas</td>
										<td class="specs-value"><?php echo esc_html( $marca_name ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $modelo ) : ?>
									<tr>
										<td class="specs-label">Modelo</td>
										<td class="specs-value"><?php echo esc_html( $modelo ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $sku ) : ?>
									<tr>
										<td class="specs-label">Códigos OEM</td>
										<td class="specs-value"><?php echo esc_html( $sku ); ?></td>
									</tr>
								<?php endif; ?>
								
								<?php if ( $cod_fabricante ) : ?>
									<tr>
										<td class="specs-label">Códigos de fabricante</td>
										<td class="specs-value"><?php echo esc_html( $cod_fabricante ); ?></td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>

					<?php if ( $caracteristicas ) : ?>
						<div class="product-characteristics">
							<h3>Características</h3>
							<?php echo wp_kses_post( $caracteristicas ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $detalles ) : ?>
						<div class="product-details">
							<h3>Detalles Técnicos</h3>
							<?php echo wp_kses_post( $detalles ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			
			<!-- Related Products Section -->
			<?php
			if ( $categoria_id ) {
				$related_args = array(
					'post_type' => 'productos',
					'posts_per_page' => 8,
					'post__not_in' => array( get_the_ID() ),
					'tax_query' => array(
						array(
							'taxonomy' => 'categorias-de-producto',
							'field' => 'term_id',
							'terms' => $categoria_id,
						),
					),
				);
				$related_query = new WP_Query( $related_args );
				
				if ( $related_query->have_posts() ) :
					?>
					<div class="related-products-section">
						<h2>Productos Similares</h2>
						<div class="owl-carousel owl-theme related-products-carousel">
							<?php
							while ( $related_query->have_posts() ) :
								$related_query->the_post();
								?>
								<article class="producto-item">
									<div class="producto-image">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'medium' ); ?>
										<?php endif; ?>
									</div>
									<h3 class="producto-title"><?php the_title(); ?></h3>
									<a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver más</a>
								</article>
								<?php
							endwhile;
							?>
						</div>
					</div>
					<?php
					wp_reset_postdata();
				endif;
			}
			?>
		</div>
		
		<?php
	endwhile;
endif;
?>

<!-- Image Modal -->
<div id="imageModal" class="image-modal">
	<span class="modal-close">&times;</span>
	<img class="modal-content" id="modalImage" alt="">
	<div class="modal-caption" id="modalCaption"></div>
</div>

<?php
get_footer();

