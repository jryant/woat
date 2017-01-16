<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WOAT
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_enqueue_script("jquery"); ?>

<?php wp_head(); ?>

<script type="text/javascript">
var $j = jQuery.noConflict();

	$j(document).ready(function($){
		$("#blog h1").each(function() {
			// var text = $(this).text();
			// console.log(text);
			// text = text.replace("***", "<span>");
			// text = text.replace("!!!", "</span>");
			// $(this).text(text);
		});

		$('#monies').slick({
			autoplay: false,
			arrows: true,
			dots: true
		});

		$("#primary-menu li.menu-item-type-custom a, #menu ul.sections li a, #menu ul.sm li.sub a").click(function(e){
			// debug: update location bar with hash
			e.preventDefault();
			var theurl = $(this).attr("href");
			console.log(theurl);
			if(theurl==="#follow-bar"){
				var new_offset = $(theurl).offset().top-310;
				$.scrollTo(new_offset, 500);
			} else {
				$.scrollTo($(theurl), 500);
			}
		});

		var heads = new Array();
		var heads_pos = new Array();
		$("#main section").each(function(i, obj){
			heads[i] = $(obj).attr("id");
      heads_pos[i] = Math.floor($(obj).offset().top);
    });

		$(window).scroll(function(){
			var scroll = $(window).scrollTop();
      $(heads_pos).each(function(i){
      	if(scroll >= heads_pos[i]){
        	$("#menu ul.sections li.active").removeClass("active");
        	$("#menu ul.sections li."+heads[i]).addClass("active");
					if(scroll >= heads_pos[1]-300 && scroll < heads_pos[1]){
						$("#menu ul.sections li.active").removeClass("active");
					}
					if(scroll >= heads_pos[3]-300 && scroll < heads_pos[4]+100){
						$("#menu ul.sections li.active").removeClass("active");
					}
      	}
				if(scroll >= heads_pos[1]-300 && scroll < heads_pos[3]-300){
					$("#menu").addClass("white");
				} else {
					$("#menu").removeClass("white");
				}
    	});
    });

		$('#menu').scrollToFixed({
			marginTop: 0,
			zIndex: 1
		});

		$("#menu .sm .menu").toggle(function(){
			$("#menu .sections, #menu .extra").css("visibility", "visible");
			// $("#menu .extra").slideDown(100);
		}, function(){
			$("#menu .sections, #menu .extra").css("visibility", "hidden");
			// $("#menu .extra").slideUp(300);
		});

		$("a.open-modal").modal({
			fadeDuration: 250
		});

	});
</script>

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:400,700" rel="stylesheet">

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'woat' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/whale-tale_logo_2017-RGB.png" alt="logo"></a></div>
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'woat' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
