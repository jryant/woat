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
					the_post_thumbnail(); ?>
					<h1><?php echo get_the_title(); ?></h1>
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

					echo wpautop(get_the_content()); ?>
				</article>
			</section>


			<!-- Testimonials section -->

			<section id="tests">
				<ul id="logos">
					<?php
						$path = get_stylesheet_directory_uri()."/assets/logos/";
						echo $path;
						// $files = scandir($path);
						$files = array_diff(scandir($path), array('.', '..'));
						var_dump($files);
						foreach ($files as $file){
							echo "<li>";
							print_r($file);
							echo "</li>";
						}
					?>
				</ul>
			</section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
