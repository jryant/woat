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

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="menu">
				<ul class="sections">
					<li class="about active"><a href="#about">About</a></li>
					<li class="services"><a href="#services">Services</a></li>
					<li class="blog"><a href="#blog">Blog</a></li>
					<li class="portfolio"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/portfolio/">Portfolio</a></li>
					<li class="contact"><a href="#contact">Contact</a></li>
				</ul>
				<ul class="sm">
					<li class="menu"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="fb"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li	class="tw"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="ig"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="li"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="sub"><a href="#follow-bar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
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
				<aside class="pic"></aside>
				<article>
					<?php echo wpautop(get_the_content()); ?>
				</article>
			</section>
			<?php wp_reset_postdata(); ?>


			<!-- Services section -->

			<?php	$services_arr = array(19,21,23,25) ?>
			<section id="services">
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
						<aside>
							Starting at
							<div><span class="dollar-sign">&#36;</span><span class="price"><?php echo $price ?></span>/<span class="unit"><?php echo $unit ?></span></div>
						</aside>
						<h1><?php echo get_the_title(); ?></h1>
						<?php echo wpautop(get_the_content()); ?>
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
			</section>


			<!-- Blog section -->

			<section id="blog">
				<aside class="latest">
					<?php
						$the_query = new WP_Query( array( 'orderby' => 'date', 'order' => 'DESC', 'post_limits' => 1 ) );
						if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
										$the_query->the_post();
								}
						} else { }

					// echo wpautop(get_the_title());
					echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>'; ?>
					<h1><?php echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>' ?></h1>
					<span class="meta"><?php echo get_the_date(); ?><span class="sep">&nbsp;&bull;&nbsp;</span><?php echo comments_number("No comments", "1 comment", "% comments"); ?></span>
					<p><?php echo get_the_excerpt().'... <a href="'.get_the_permalink().'">Continue reading &rarr;</a>' ?></p>
				</aside>
				<article>
					<header>
						The Blog
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
			</section>


			<!-- Testimonials section -->

			<section id="tests">
				<ul id="logos">
					<?php	display_logos(); ?>
				</ul>
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
			</section>


			<!-- Follow bar section -->

			<section id="follow-bar">
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
					<span class="submit">Subscribe</span>
					<span class="sub_email"><input type="text" name="sub_email" placeholder="youremail@domain.com"></span>
					<!-- <input type="submit" value="Subscribe"> -->
				</form>
			</section>


			<!-- Contact section -->

			<section id="contact">
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
				<form>
					<label for="contact_Name">Name</label>
					<input type="text" name="contact_name" placeholder="Name">
					<label for="contact_Email">Email address</label>
					<input type="text" name="contact_email" placeholder="Email">
					<label for="contact_body">Message</label>
					<textarea name="contact_body" rows="8" cols="80"></textarea>
					<label for="contact_captcha" class="green">How many letters in the word "Whale"?</label>
					<input type="text" name="contact_captcha" class="green">
					<span class="submit">Submit</span>
				</form>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
