<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WOAT
 */

?>

<?php
	$has_featured_image = (get_the_post_thumbnail()!=NULL) ? true : false ;
	echo ($has_featured_image) ? '<div class="featured">' : '<div class="featured no-featured-image">' ;
	echo get_the_post_thumbnail()."</div>";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echo ($has_featured_image) ? '<div class="featured"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.get_the_post_thumbnail()."</a></div>" : "" ; ?>
	<?php echo ($has_featured_image) ? '<div class="post-content">' : '<div class="post-content no-featured-image">' ; ?>
		<header class="entry-header">

			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : /* ?>
			<div class="entry-meta">
				<?php woat_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php */
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if ( is_single() ) :
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'woat' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				else:
					the_excerpt();
					echo '<p><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">Continue reading <span class="meta-nav">&rarr;</span></a></p>';
				endif;

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'woat' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php // woat_entry_footer(); ?>
			<?php	echo get_the_category_list(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
