<?php
/**
 * Template Name: Empresa
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
            <section class="w-full empresa-content">
				<section class="container">
                    <div class="flex flex-wrap">
                        <div class="w-1/2 flex flex-col p-10">
                            <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_company_text' ) ); ?>
                        </div>
                        <div class="w-1/2 p-4">
                            <?php 
                                $company_image = carbon_get_post_meta( get_the_ID(), 'crb_page_company_image' );
                                if ( $company_image ) {
                                    echo wp_get_attachment_image( $company_image, 'full', false, array( 'class' => 'w-full h-auto' ) );
                                }
                            ?>
                        </div>
                    </div>
                </section>
                <section class="w-full mision-vision">
                    <div class="container flex flex-wrap">
                        <div class="w-1/2 p-4">
                            <div class="flex flex-wrap">
                                <div class="w-1/4 flex items-center justify-start mission-vision-image">
                                    <?php $mission_image = carbon_get_post_meta( get_the_ID(), 'crb_page_mission_image' );
                                    if ( $mission_image ) {
                                        echo wp_get_attachment_image( $mission_image, 'full', false, array( 'class' => 'w-full h-auto', 'style' => 'max-width: 130px;' ) );
                                    } ?>
                                </div>
                                <div class="w-3/4 flex flex-col justify-center">
                                    <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_mission_text' ) ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 p-4">
                            <div class="flex flex-wrap">
                                <div class="w-1/4 flex items-center justify-start mission-vision-image">
                                    <?php $vision_image = carbon_get_post_meta( get_the_ID(), 'crb_page_vision_image' );
                                    if ( $vision_image ) {
                                        echo wp_get_attachment_image( $vision_image, 'full', false, array( 'class' => 'w-full h-auto', 'style' => 'max-width: 130px;' ) );
                                    } ?>
                                </div>
                                <div class="w-3/4 flex flex-col justify-center">
                                    <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_vision_text' ) ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="container">
                    <div class="w-full p-4 flex flex-col justify-center items-center text-center">
                        <?php echo wp_kses_post( (string) carbon_get_post_meta( get_the_ID(), 'crb_page_policy_sig_text' ) ); ?>
                        <?php 
                            $policy_link = carbon_get_post_meta( get_the_ID(), 'crb_page_policy_sig_pdf' ) ? wp_get_attachment_url( carbon_get_post_meta( get_the_ID(), 'crb_page_policy_sig_pdf' ) ) : '';
                            $policy_button_text = carbon_get_post_meta( get_the_ID(), 'crb_page_button_text' );
                            if ($policy_button_text ) {
                                echo '<a href="' . esc_url( $policy_link ) . '" target="_blank" rel="noopener noreferrer" class="btn-descarga-aqui">' . esc_html( $policy_button_text ) . '</a>';
                            }
                        ?>
                    </div>
                </section>
                <section class="container">
                    <h2>
                        <?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_page_video_title' ) ); ?>
                    </h2>
                    <?php
                    $video_url = carbon_get_post_meta( get_the_ID(), 'crb_page_video_url' );
                    if ( $video_url ) {
                        $video_src = '';
                        if ( str_contains( $video_url, '/embed/' ) ) {
                            $video_src = $video_url;
                        } else {
                            // Extract YouTube video ID from URL
                            preg_match( '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $matches );
                            if ( isset( $matches[1] ) ) {
                                $video_src = 'https://www.youtube.com/embed/' . $matches[1];
                            }
                        }
                        if ( $video_src ) {
                            echo '<iframe width="100%" height="500" src="' . esc_url( $video_src ) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                    }
                    ?>
                </section>
                <section class="container">
                    <h2>
                        <?php echo esc_html( carbon_get_post_meta( get_the_ID(), 'crb_page_values_title' ) ); ?>
                    </h2>
                    <section>
                        <div class="flex flex-start values-list">
                            <?php 
                            $values = carbon_get_post_meta( get_the_ID(), 'crb_page_values_list' );
                            if ( $values ) {
                                foreach ( $values as $value ) {
                                    echo '<div class="w-1/3 p-4 text-center">';
                                    if ( isset( $value['icon'] ) && $value['icon'] ) {
                                        echo wp_get_attachment_image( $value['icon'], 'full', false, array( 'class' => 'w-full h-auto', 'style' => 'max-width: 100px; margin: 0 auto 20px;' ) );
                                    }
                                    if ( isset( $value['text'] ) && $value['text'] ) {
                                        echo '<p>' . wp_kses_post( (string) $value['text'] ) . '</p>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                    </section>
                </section>
			</section>
		<?php
		
		//get_template_part( 'entry' );
		//comments_template();
	endwhile;
endif;

get_footer();
