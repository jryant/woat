<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WOAT
 */

get_header();
get_menu();
?>

<?php if(!is_search() && !is_category()): ?>

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

<?php else: ?>

	<section id="search-term">
		<div>
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</div>
	</section>

<?php endif; ?>

<?php if(is_paged()): ?>

	<section id="page-no">
		<div>
			<?php
				global $wp_query;
				echo '<div class="number">Page '.$wp_query->query_vars['paged'].'</div>';
				// the_archive_title( '<h1 class="page-title">', '</h1>' );
				// the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</div>
	</section>

<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<!-- <header class="page-header"> -->
				<?php
					// the_archive_title( '<h1 class="page-title">', '</h1>' );
					// the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			<!-- </header> .page-header -->

			<?php
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
// get_sidebar();
get_footer();
