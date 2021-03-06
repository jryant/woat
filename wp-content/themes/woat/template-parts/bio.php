<?php
/**
 * Template part for displaying Author's bio
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WOAT
 */

?>

<section id="bio">
	<div>
		<aside>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/kyla-author-pic.png">
		</aside>
		<div class="bio">
			<h1>Kyla Rose</h1>
			<!-- <p>My name is Kyla Rose and I am a potty mouth that helps people doing cool things (like you!) articulate their vision through content creation. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p> -->
			<?php
				$the_query = new WP_Query( array( 'page_id' => 89 ) );
				if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
								$the_query->the_post();
						}
				} else { }
				echo wpautop(get_the_content());
				wp_reset_postdata();
			?>
			<span class="follow">
				<ul class="sm">
					<li class="contact"><a href="#contact" class="open-modal"><span class="submit">Contact</span></a></li>
					<li class="fb"><a href="https://www.facebook.com/whaleofatalecontent/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li	class="tw"><a href="http://www.twitter.com/thewritewhale"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="ig"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="li"><a href="https://ca.linkedin.com/in/kylarosesims"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png"></a></li>
					<li class="subscribe"><a href="#subscribe" class="open-modal"><span class="submit">Subscribe</span></a></li>
				</ul>
			</span><!-- .follow -->
		</div><!-- .bio -->
	</div>
</section><!-- #bio -->
