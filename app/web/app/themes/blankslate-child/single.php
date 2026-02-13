<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<?php
		$permalink = get_permalink();
		$title = get_the_title();
		$share_url = esc_url_raw( $permalink );
		$share_title = rawurlencode( $title );
		$facebook_share = add_query_arg( 'u', $share_url, 'https://www.facebook.com/sharer/sharer.php' );
		$linkedin_share = add_query_arg( 'url', $share_url, 'https://www.linkedin.com/sharing/share-offsite/' );
		$whatsapp_share = add_query_arg( 'text', $title . ' ' . $permalink, 'https://api.whatsapp.com/send' );
		$email_share = 'mailto:?subject=' . $share_title . '&body=' . rawurlencode( $permalink );
		?>
		<div class="container text-center news-detail">
			<h1><?php the_title(); ?></h1>
			<div class="content text-justify">
				<?php the_content(); ?>
			</div>
			<div class="share-links flex flex-col items-start mt-8">
				<ul class="flex flex-row gap-5 items-start">
					<li><a class="share share-facebook" href="<?php echo esc_url( $facebook_share ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook"></i> Facebook</a></li>
					<li><a class="share share-linkedin" href="<?php echo esc_url( $linkedin_share ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fab fa-linkedin"></i> Linkedin</a></li>
					<li><a class="share share-whatsapp" href="<?php echo esc_url( $whatsapp_share ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
					<li><a class="share share-email" href="<?php echo esc_url( $email_share ); ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-envelope"></i> Email</a></li>
				</ul>
			</div>
		</div>
		<?php
	endwhile;
endif;

get_footer();
