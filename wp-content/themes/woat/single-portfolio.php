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

			$prev_id = "";
			$prev_co = "";
			$next_id = "";
			$next_co = "";

			$prev_post = get_previous_post();
			if (!empty( $prev_post )):
				$prev_id = $prev_post->ID;
				$prev_co = get_post_meta($prev_id, "portfolio_company_name", true);
			endif;

			$next_post = get_next_post();
			if (!empty( $next_post )):
				$next_id = $next_post->ID;
				$next_co = get_post_meta($next_id, "portfolio_company_name", true);
			endif;

			the_post_navigation(array(
				'prev_text'	=> '<span class="arrow"></span><span>PREVIOUS</span>'.$prev_co,
				'next_text'	=> '<span class="arrow"></span><span>NEXT</span>'.$next_co
			));

		endwhile; // End of the loop.
		?>
	</section><!-- #coms -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
