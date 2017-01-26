<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WOAT
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php echo get_menu(); ?>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/portfolio', get_post_format() );

			get_template_part( 'template-parts/bio', get_post_format() );

			the_post_navigation(array(
				'prev_text'	=> '<span class="arrow"></span><span>PREVIOUS</span>%title',
				'next_text'	=> '<span class="arrow"></span><span>NEXT</span>%title'
			));

		endwhile; // End of the loop.
		?>
	</section><!-- #coms -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
