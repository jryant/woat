<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WOAT
 */

?>

<?php echo '<div class="featured">'.get_the_post_thumbnail()."</div>"; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echo '<div class="featured"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.get_the_post_thumbnail()."</a></div>"; ?>
	<div class="post-content">
		<header class="entry-header">

			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				$portfolio_company_name = get_post_meta(get_the_id(), "portfolio_company_name", true);
				echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span class="co">'.$portfolio_company_name.' &ndash; </span>'.get_the_title().'</a></h2>';
			endif;

			if ( 'portfolio' === get_post_type() ) : ?>
				<?php
					// woat_posted_on();

					$roles_obj  = get_the_terms( get_the_ID(), 'portfolio_roles' );
					if ( $roles_obj && ! is_wp_error( $roles_obj ) ) :
				    $roles_arr = array();
				    foreach ( $roles_obj as $role ) {
			        $roles_arr[] = $role->name;
				    }
				    $roles = join( ", ", $roles_arr );
					endif;

					$types_obj  = get_the_terms( get_the_ID(), 'portfolio_types' );
					if ( $types_obj && ! is_wp_error( $types_obj ) ) :
						$types_arr = array();
						foreach ( $types_obj as $type ) {
							$types_arr[] = $type->name;
						}
						$types = join( ", ", $types_arr );
					endif;

					$meta = '<div class="meta">';
					$meta .= get_the_date();
					$meta .= '<span class="sep">//</span>';
					$meta .= $roles;
					$meta .= '<span class="sep">//</span>';
					$meta .= $types;
					$meta .= '</div><!-- .entry-meta -->';
					echo $meta;
				?>
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'woat' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

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
