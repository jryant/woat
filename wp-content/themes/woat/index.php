<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WOAT
 */

get_header();
get_menu();
?>

<section id="blog_intro">
	<div>
		<?php
			$the_query = new WP_Query( array( 'page_id' => 51 ) );
			if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
							$the_query->the_post();
					}
			} else { }

		echo wpautop(get_the_content());
		wp_reset_postdata(); ?>
		<div class="categories">
			<h2>Topics</h2>
			<ul>
				<?php echo wp_list_categories( array(
					'title_li' => '',
					'hide_empty' => 0,
					// 'order' => 'ASC',
					'orderby' => 'slug',
					'exclude' => '1'
				)); ?>
			</ul>
		</div>
	</div>
</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
