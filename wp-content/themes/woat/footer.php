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

	<div id="subscribe" style="display:none;">
		<h1>Subscribe</h1>
		<p>Subscribe to my newsletter and be the first to know about new posts.
		<br>No spammy stuff, I promise &mdash; just awesome content.</p>
		<form>
			<span class="sub_email"><input type="text" name="sub_email" placeholder="youremail@domain.com"></span>
			<a href="#" class="open-modal"><span class="submit">Subscribe</span></a>
		</form>
	</div>

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
