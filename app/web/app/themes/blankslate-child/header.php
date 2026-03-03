<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<!-- LiveReload para desarrollo -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/livereload.js"></script>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="menu-lateral-overlay" class="menu-lateral-overlay"></div>
	<div id="menu-lateral">
        <div class="menu-lateral-close">
            <button id="menu-lateral-close-btn" aria-label="Cerrar menú">&times;</button>
        </div>
        <?php wp_nav_menu( array( 'menu' => 'productos', 'container' => false ) ); ?>
    </div>
	
	<header id="site-header" class="site-header">
		<div id="message-top">
			<div class="container flex flex-row md:flex-col justify-between">
				<div class="message">
					<?php echo esc_html( carbon_get_theme_option( 'crb_header_title' ) ); ?>
				</div>
				<div class="contact-info">
					<?php 
						$emails = carbon_get_theme_option( 'crb_header_email' );
						foreach ( $emails as $email ) :
					?>
						<a href="mailto:<?php echo esc_attr( $email['link'] ); ?>"><i aria-hidden="true" class="fas fa-globe"></i><?php echo esc_html( $email['text'] ); ?></a>
					<?php endforeach; ?>
					<?php 
						$phones = carbon_get_theme_option( 'crb_header_phone' );
						foreach ( $phones as $phone ) :
					?>
						<a href="mailto:<?php echo esc_attr( $phone['link'] ); ?>"><i aria-hidden="true" class="fas fa-phone-alt"></i><?php echo esc_html( $phone['phone'] ); ?></a>
					<?php endforeach; ?>
					<?php 
						$addresses = carbon_get_theme_option( 'crb_header_address' );
						foreach ( $addresses as $address ) :
					?>
						<a href="mailto:<?php echo esc_attr( $address['link'] ); ?>"><i aria-hidden="true" class="fas fa-map-marker-alt"></i><?php echo esc_html( $address['address'] ); ?></a>
					<?php endforeach; ?>										
				</div>
			</div>
		</div>
		<div class="header-sticky">
			<div class="container flex justify-between">
				<div class="sticky-left">
					<div id="site-logo" class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
							<?php
							$logo_id = carbon_get_theme_option( 'crb_header_logo' );
							if ( $logo_id ) {
								echo wp_get_attachment_image( $logo_id, '', false, array( 'class' => 'header-logo' ) );
							} else {
								bloginfo( 'name' );
							}
							?>
						</a>
					</div>
					<div class="menu-search">
						<div class="menu-products" id="menu-products-toggle">
							<i aria-hidden="true" class="fas fa-align-justify"></i>
							<span>Productos</span>
						</div>
					</div> 
				</div>
				<div class="sticky-right">
					<div class="social flex items-center justify-end">
						<?php 
							$whatsapps = carbon_get_theme_option( 'crb_header_whatsapp' );
							foreach ( $whatsapps as $whatsapp ) :
						?>
							<a href="<?php echo esc_url( $whatsapp['link'] ); ?>" target="_blank" rel="noopener" class="whatsapp-button">
								<i aria-hidden="true" class="fab fa-whatsapp"></i>
								<?php echo esc_attr( $whatsapp['text'] ); ?>
							</a>
						<?php endforeach; ?>
						<?php
							$social_media = carbon_get_theme_option( 'crb_social_media' );
							foreach ( $social_media as $social ) :
						?>
							<a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener" class="social-icon flex items-center justify-center">
								<i aria-hidden="true" class="<?php echo esc_attr( $social['icon'] ); ?>"></i>
							</a>
						<?php endforeach; ?>
					</div>
					<nav id="menu-principal-container" class="flex justify-end">
						<?php wp_nav_menu( array( 'menu' => 'principal' ) ); ?>
					</nav>
					<div class="mobile-menu-container justify-end">
						<div id="menu-mobile-button" class="menu-mobile">
						<i class="fas fa-bars"></i>
					</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="main" class="site-main">
