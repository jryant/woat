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
			<span class="submit">Subscribe</span>
		</form>
		<div class="success">
			<p>Thank you for subscribing!</p>
		</div>
	</div>

	<section id="contact" style="display:none;">
		<div>
			<header>
				<?php
				$args = array( 'page_id' => 66 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					echo wpautop(get_the_content());
				endwhile;
				wp_reset_postdata();
				?>
			</header>
			<?php echo do_shortcode("[ninja_form id=1]") ?>
			<!-- <form>
				<label for="contact_Name">Name</label>
				<input type="text" name="contact_name" placeholder="Name">
				<label for="contact_Email">Email address</label>
				<input type="text" name="contact_email" placeholder="Email">
				<label for="contact_body">Message</label>
				<textarea name="contact_body" rows="8" cols="80"></textarea>
				<label for="contact_captcha" class="green">How many letters in the word "Whale"?</label>
				<input type="text" name="contact_captcha" class="green">
				<span class="submit">Submit</span>
			</form> -->
		</div>
	</section>

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
