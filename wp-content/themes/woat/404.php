<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WOAT
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'woat' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'woat' ); ?></p>

					<?php
						get_search_form();

						// the_widget( 'WP_Widget_Recent_Posts' );

						// Only show the widget if site has multiple categories.
						if ( woat_categorized_blog() ) :
					?>

					<div class="categories">
						<h2>Blog Topics</h2>
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

					<!-- <div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Topics', 'woat' ); ?></h2>
						<ul>
						<?php
						echo wp_list_categories( array(
							'title_li' => '',
							'hide_empty' => 0,
							// 'order' => 'ASC',
							'orderby' => 'slug',
							'exclude' => '1')
						);
						?>
						</ul>
					</div><!-- .widget -->

					<?php
						endif;

						/* translators: %1$s: smiley */
						// $archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'woat' ), convert_smilies( ':)' ) ) . '</p>';
						// the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						// the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
