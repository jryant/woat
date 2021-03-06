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

			get_template_part( 'template-parts/content', get_post_format() );

			get_template_part( 'template-parts/bio', get_post_format() );

			the_post_navigation(array(
				'prev_text'	=> '<span class="arrow"></span><span>PREVIOUS</span>%title',
				'next_text'	=> '<span class="arrow"></span><span>NEXT</span>%title'
			));

			// related_posts();

			$meta = '<div class="meta">'.get_the_date().'<span class="sep">&nbsp;&bull;&nbsp;</span>';
			switch (get_comments_number()){
				case 0:
					$meta .= '0 comments';
					break;
				case 1:
					$meta .= '1 comment';
					break;
				default:
					$meta .= get_comments_number().' comments';
			}
			// $blog_post .= '</section>';
			echo '<section id="meta"><div>'; ?>

				<div class="note">
					<aside>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/kyla-comment-pic.png">
					</aside>
					<!-- <p>If you are a jerk in the comments I will delete you.</p> -->
					<?php
						$the_query = new WP_Query( array( 'page_id' => 93 ) );
						if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
										$the_query->the_post();
								}
						} else { }

						echo '<h1>'.get_the_title().'</h1>';
						echo wpautop(get_the_content());
						wp_reset_postdata();
					?>

				</div><!-- .bio -->

				<?php echo $meta; ?>

			</div></section>

			<section id="coms">

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</section><!-- #coms -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
