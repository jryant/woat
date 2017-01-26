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
      heads_pos[i] = Math.floor($(obj).offset().top); // debug: when viewport width changes, recalculate
    });

		// for (var i = 0; i < heads.length; i++) {
		// 	console.log(i+": "+heads[i]+" -> "+heads_pos[i]);
		// }

		$(window).scroll(function(){
			var scroll = $(window).scrollTop();
      $(heads_pos).each(function(i){
      	if(scroll >= heads_pos[i]){
        	$("#menu ul.sections li.active").removeClass("active");
        	$("#menu ul.sections li."+heads[i]).addClass("active");
					if(scroll >= heads_pos[1]-300 && scroll < heads_pos[1]){ // approaching Services
						$("#menu ul.sections li.active").removeClass("active");
					}
					if(scroll >= heads_pos[3]-200 && scroll < heads_pos[3]){
						$("#menu ul.sections li.active").removeClass("active");
					}
      	}
				if(scroll >= heads_pos[1]-300 && scroll < heads_pos[3]-200){
					$("#menu").addClass("white");
				} else {
					$("#menu").removeClass("white");
				}
				if($(window).width()<=736 && scroll < heads_pos[0]){ // Deactivate "About" on mobile load
					$("#menu ul.sections li.active").removeClass("active");
				}
    	});
    });

		$('#menu').scrollToFixed({
			marginTop: 0,
			zIndex: 1
		});

		if($(window).width()>736){
			$("#menu .sections, #menu .extra").css("visibility", "visible");
		}

		$("#menu .sm .menu").click(function(){ // debug: hide again with delay after click?
			if($("#menu .sections").css("visibility")=="visible"){
				$("#menu .sections, #menu .extra").css("visibility", "hidden");
			} else {
				$("#menu .sections, #menu .extra").css("visibility", "visible");
			}
		});

		$("a.open-modal").click(function(){
			$(this).modal({
				fadeDuration: 250,
				showClose: false
			});
		});

		function getRandomIntInclusive(min, max) {
		  min = Math.ceil(min);
		  max = Math.floor(max);
		  return Math.floor(Math.random() * (max - min + 1)) + min;
		}

		if(getRandomIntInclusive(0,1)==1 && $(window).width()<736){
			$("#masthead").css("background-position-x","right");
		};

		$(window).scroll(function(){
			var picY = Math.floor($("#about").offset().top); // debug?
			var scroll2 = $(window).scrollTop();
			var opacity_perc = scroll2/picY;
			// console.log(scroll2+" / "+picY+" = "+opacity_perc);
			$("#about aside.pic img").css("opacity",opacity_perc);
		});

		// $("#logos").bxSlider({
		// 	minSlides: 4,
		//   maxSlides: 10,
		//   slideWidth: 200,
		//   slideMargin: 20,
		// 	ticker: true,
  	// 	speed: 100000,
		// 	randomStart: true,
		// 	// startSlide: 10,
		// 	preloadImages: "all"
		// });
		// var box = $('#box').data("plugin_tinycarousel");
		// console.log(box);

		var home_url = "<?php echo esc_url( home_url( '/' ) ); ?>";
		console.log("home_url = "+home_url);
		if($("body").hasClass("home") === false){
			$("#menu-item-5 a").attr("href", home_url+"#about");
			$("#menu-item-7 a").attr("href", home_url+"#services");
			$("#menu-item-8 a").addClass("open-modal");
		}

	});
</script>

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:400,700" rel="stylesheet">

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'woat' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/blank.png" alt="logo"></a></div>
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
