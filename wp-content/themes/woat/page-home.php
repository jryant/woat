<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WOAT
 */

get_header(); ?>

	<script type="text/javascript">
		var $j = jQuery.noConflict();
		$j(document).ready(function($){
			$(window).scroll(function(){ // debug: only on home page
				var picY = Math.floor($("#about").offset().top); // debug?
				var scroll2 = $(window).scrollTop();
				var opacity_perc = scroll2/picY;
				// console.log(scroll2+" / "+picY+" = "+opacity_perc);
				$("#about aside.pic img").css("opacity",opacity_perc);
			});
		});
	</script>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="menu">
				<ul class="sections">
					<li class="about"><a href="#about">About</a></li>
					<li class="services"><a href="#services">Services</a></li>
					<li class="blog"><a href="#blog">Blog</a></li>
					<li class="portfolio"><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>">Portfolio</a></li>
					<li class="contact"><a href="#contact">Contact</a></li>
				</ul>
				<ul class="sm">
					<li class="menu"><a href="#" class="toggle-button"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="fb extra"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li	class="tw extra"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="ig extra"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="li extra"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="sub extra"><a href="#follow-bar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
				</ul>
			</div>


			<!-- About section -->

			<?php
				$the_query = new WP_Query( array( 'page_id' => 15 ) );
				if ( $the_query->have_posts() ) {
				    while ( $the_query->have_posts() ) {
				        $the_query->the_post();
				    }
				} else { }
			?>
			<section id="about">
				<div>
					<aside class="pic"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/kyla-profile-pic.png" alt="Kyla Sims profile photo"></aside>
					<article>
						<?php echo wpautop(get_the_content()); ?>
					</article>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>


			<!-- Services section -->

			<?php	$services_arr = array(19,21,23,25) ?>
			<section id="services">
				<div>
					<header>Services</header>

					<?php foreach($services_arr as $service): ?>

						<?php
							$the_query = new WP_Query( array( 'page_id' => $service ) );
							if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) {
											$the_query->the_post();
											 $price = get_post_meta(get_the_id(), "services_price", true);
											 $unit = get_post_meta(get_the_id(), "services_unit", true);
									}
							} else { }
						?>
						<article class="s<?php echo get_the_id(); ?>">
							<aside class="desktop">
								Starting at
								<div><span class="dollar-sign">&#36;</span><span class="price"><?php echo $price ?></span>/<span class="unit"><?php echo $unit ?></span></div>
							</aside>
							<h1><?php echo get_the_title(); ?></h1>
							<?php echo wpautop(get_the_content()); ?>
							<aside class="mobile">
								<p>Starting at <span class="dollar-sign">&#36;</span><span class="price"><?php echo $price ?></span>/<span class="unit"><?php echo $unit ?></span></p>
							</aside>
						</article>
					<?php wp_reset_postdata(); ?>

					<?php endforeach; ?>

					<?php
						$the_query = new WP_Query( array( 'page_id' => 17 ) );
						if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
										$the_query->the_post();
								}
						} else { }
					?>
					<footer><?php echo wpautop(get_the_content()); ?></footer>
					<?php wp_reset_postdata(); ?>
				</div>
			</section>


			<!-- Blog section -->

			<section id="blog">
				<!-- <article> -->
				<div>
					<aside class="latest desktop">
						<?php
							$the_query = new WP_Query( array( 'orderby' => 'date', 'order' => 'ASC', 'post_limits' => 1 ) );
							// $the_query = new WP_Query( array( 'p' => 32 ) ); /* debug: change this back */
							if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) {
											$the_query->the_post();
									}
							} else {
								// do nothing
							}
							// echo wpautop(get_the_title());
							$blog_post = '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>';
							$blog_post .= '<h1><a href="'.get_the_permalink().'">'.get_the_title().'</a></h1>';
							$blog_post .= '<span class="meta">'.get_the_date().'<span class="sep">&nbsp;&bull;&nbsp;</span>';
							switch (get_comments_number()){
								case 0:
									$blog_post .= '0 comments';
									break;
								case 1:
									$blog_post .= '1 comment';
									break;
								default:
									$blog_post .= get_comments_number().' comments';
							}
							$blog_post .= '</span>';
							$blog_post .= '<p>'.get_the_excerpt().'... <a href="'.get_the_permalink().'">Continue reading &rarr;</a></p>';
							echo $blog_post;
						?>
					</aside>
					<article>
						<header>
							<a href="<?php echo site_url('/blog/'); ?>">The Blog</a>
						</header>
						<?php
							$the_query = new WP_Query( array( 'page_id' => 51 ) );
							if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) {
											$the_query->the_post();
									}
							} else { }

						echo wpautop(get_the_content());
						wp_reset_postdata(); ?>
					</article>
					<aside class="latest mobile">
						<?php echo $blog_post; ?>
					</aside>
				</div>
			</section>


			<!-- Testimonials section -->

			<section id="tests">
				<div>

					<div class="slider">
						<div class="logos"></div>
					</div>

					<div class="contain">
						<div id="monies">
						<?php
							$args = array( 'post_type' => 'testimonials' );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								$client_name = get_post_meta(get_the_id(), "testimonial_client", true);
								$client_position = get_post_meta(get_the_id(), "testimonial_client_position", true);
								echo '<div class="testimonial">'.wpautop(get_the_content());
								echo '<div class="client_name">'.$client_name.'</div>';
								echo '<div class="client_position">'.$client_position.'</div>';
								echo '</div>';
							endwhile;
							wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			</section>


			<!-- Follow bar section -->

			<section id="follow-bar">
				<div>
					<form>
						<span class="follow">
							<p class="follow-label">Follow Me</p>
							<ul class="sm">
								<li class="fb"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
								<li	class="tw"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
								<li class="ig"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
								<li class="li"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
							</ul>
						</span>
						<a href="#subscribe" class="open-modal"><span class="submit">Subscribe</span></a>
						<span class="sub_email"><input type="text" name="sub_email" placeholder="youremail@domain.com"></span>
						<!-- <input type="submit" value="Subscribe"> -->
					</form>
				</div>
			</section>


			<!-- Contact section -->

			<section id="contact">
				<div>
					<header>
						<?php
						$args = array( 'page_id' => 66 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							echo wpautop(get_the_content());
						endwhile;
						wp_reset_postdata();
						?>
					</header>
					<?php echo do_shortcode("[ninja_form id=1]") ?>
					<!-- <form>
						<label for="contact_Name">Name</label>
						<input type="text" name="contact_name" placeholder="Name">
						<label for="contact_Email">Email address</label>
						<input type="text" name="contact_email" placeholder="Email">
						<label for="contact_body">Message</label>
						<textarea name="contact_body" rows="8" cols="80"></textarea>
						<label for="contact_captcha" class="green">How many letters in the word "Whale"?</label>
						<input type="text" name="contact_captcha" class="green">
						<span class="submit">Submit</span>
					</form> -->
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
