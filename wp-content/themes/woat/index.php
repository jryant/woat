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
			wp_reset_postdata();
			get_search_form();
		?>
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

		global $post;
    $tmp_post = $post;
		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
    $args = array (
        'post_type'   => 'post',
        'post_status' => 'publish',
        'paged' => $paged,
    );
  	$wp_query= null;
    $wp_query = new WP_Query();
    $wp_query->query( $args );

		if ( $wp_query->have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			if (function_exists("pagination")) {
    		pagination($additional_loop->max_num_pages);
			} else {
				the_posts_navigation();
			}

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
