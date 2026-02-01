<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
    <link rel='stylesheet' id='google-fonts-1-css' href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=auto&#038;ver=6.9' media='all' />

	<!-- LiveReload para desarrollo -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/livereload.js"></script>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
	<header id="site-header" class="site-header">
		<div class="header-container">
			<div class="header-content">
				<!-- Logo -->
				<div class="site-logo">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					?>
				</div>

				<!-- Site Title and Description -->
				<div class="site-branding">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div>

				<!-- Primary Navigation -->
				<nav id="primary-navigation" class="primary-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'nav-menu',
						'fallback_cb'    => 'wp_page_menu',
					) );
					?>
				</nav>
			</div>
		</div>
	</header>

	<div id="main" class="site-main">
