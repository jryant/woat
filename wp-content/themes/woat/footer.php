<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WOAT
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			Whale Of A Tale Content &copy; <?php echo date('Y'); ?>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( __( 'https://kgrantarts.com/', 'woat' ) ); ?>"><?php printf( esc_html__( 'Designed by %s', 'woat' ), 'Kelsey Grant' ); ?></a>
			<span class="sep"> &bull; </span>
			<a href="<?php echo esc_url( __( 'https://www.jasonryant.com/', 'woat' ) ); ?>"><?php printf( esc_html__( 'Developed by %s', 'woat' ), 'Jason Ryant' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
