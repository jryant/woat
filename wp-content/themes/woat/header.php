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

$redirect = null;

if (strpos($_SERVER['REQUEST_URI'], 'portfolio') !== FALSE && !is_user_logged_in() && $_SERVER['REQUEST_URI'] !== site_url('/portfolio/') ){
	// echo $_SERVER['REQUEST_URI']."
	// ";
	// echo '<h1>not allowed</h1>';
	// $request_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	// $port_url = site_url('/portfolio/?r=123123');
	// echo $port_url;
	// header("Location: $port_url");
	// header("Location: http://localhost:8888/else/woat/portfolio/");
 // 	die();

	// $redirect = '<meta http-equiv="refresh" content="0; url='.$port_url.'" />';

} elseif (strpos($_SERVER['REQUEST_URI'], 'portfolio') !== FALSE && is_user_logged_in()) {
	// echo $_SERVER['REQUEST_URI']."
	// ";
 // 	echo '<h1>ALLOWED</h1>';
 // 	die();
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php // echo $redirect; ?>
<?php // if($redirect !== null): die(); endif; ?>

<?php wp_enqueue_script("jquery"); ?>

<?php wp_head(); ?>

<script type="text/javascript">
var $j = jQuery.noConflict();

	$j(document).ready(function($){

		$("#subscribe form .submit").on("click", function(){
			// e.preventDefault();
			var email = $("#subscribe form input[type='text']").val();
			console.log(email);

			// $groupsApi = (new MailerLiteApi\MailerLite("f7808fae03657e871f6e70fbd6ff4970"))->groups();
			//
			// $subscriber = [
			//     'email' => email,
			//     'fields' => [
			//         'name' => 'John',
			//         'last_name' => 'Doe',
			//         'company' => 'John Doe Co.'
			//     ]
			// ];
			//
			// $response = $groupsApi->addSubscriber(5560834, $subscriber); // Change GROUP_ID with ID of group you want to add subscriber to
		});


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
			e.preventDefault();
			var theurl = $(this).attr("href");
			console.log(theurl);
			if(theurl==="#follow-bar"){
				var new_offset = $(theurl).offset().top-310;
				$.scrollTo(new_offset, 500);
				window.location = theurl;
			} else if(theurl.indexOf("portfolio") >= 0){
				window.location = theurl;
			} else {
				$.scrollTo($(theurl), 500);
				window.location = theurl;
			}
		});

		$("#menu ul.sm li:not(.sub)").click(function(e){
			var theurl = $(this).children("a").attr("href");
			// console.log("manual redirect to "+theurl);
			window.location = theurl;
		});

		var heads = new Array();
		var heads_pos = new Array();
		$("#main section").each(function(i, obj){
			heads[i] = $(obj).attr("id");
      heads_pos[i] = Math.floor($(obj).offset().top); // debug: when viewport width changes, recalculate
    });

		var has_primary = false;
		var primary_pos;
		if($("body").hasClass("archive")){
			primary_pos = Math.floor($("#primary").offset().top);
			has_primary = true;
			// console.log("has class, pos = "+primary_pos);
		} else if ($("body").hasClass("single")){
			primary_pos = Math.floor($("#primary article").offset().top);
			has_primary = true;
			// console.log("has class, pos = "+primary_pos);
		} else {
			// console.log("does not have class");
		}

		// for (var i = 0; i < heads.length; i++) {
		// 	console.log(i+": "+heads[i]+" -> "+heads_pos[i]);
		// }

		$(window).scroll(function(){ // debug: specific page detection
			var scroll = $(window).scrollTop();
			// console.log("scroll = "+scroll);
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

				if(scroll >= heads_pos[0] && scroll < heads_pos[1]){
					$("#mobile_menu").removeClass("white");
				} else if(scroll >= heads_pos[3]){
					$("#mobile_menu").removeClass("white");
				} else {
					$("#mobile_menu").addClass("white");
				}

				if($(window).width()<=736 && scroll < heads_pos[0]){ // Deactivate "About" on mobile load
					$("#menu ul.sections li.active").removeClass("active");
				}

    	});

			if(has_primary){
				if(scroll >= primary_pos){
					$("#mobile_menu").removeClass("white");
					// console.log(scroll + " > " + primary_pos);
				} else {
					$("#mobile_menu").addClass("white");
					// console.log(scroll + " < " + primary_pos);
				}
			}

    });

		$('#menu').scrollToFixed({
			marginTop: 20,
			zIndex: 9
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

		$("a.open-modal, li.open-modal a, #menu-item-119 a").click(function(){
			$(this).modal({
				fadeDuration: 250,
				showClose: true
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

		// $(window).scroll(function(){ // moved to home page
		// 	var picY = Math.floor($("#about").offset().top); // debug?
		// 	var scroll2 = $(window).scrollTop();
		// 	var opacity_perc = scroll2/picY;
		// 	// console.log(scroll2+" / "+picY+" = "+opacity_perc);
		// 	$("#about aside.pic img").css("opacity",opacity_perc);
		// });

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

		var vw = $(document).width();
		vw = vw*0.45;

		$("#slideout_menu").show();
		var slideout = new Slideout({
			'panel': document.getElementById('page'),
			'menu': document.getElementById('mobile_menu'),
			'padding': vw,
			// 'tolerance': 70,
			'side': 'right'
		});

		$('#mobile_menu').scrollToFixed({
			marginTop: 10,
			zIndex: 11
		});

		var n = 0;
		$('#mobile_menu').on('click', function(e) {
			// console.log("click! "+e);
			slideout.toggle();
			$(this).css( "top", function( index ) {
				if(n%2<1){
					n++;
	  			return $(window).scrollTop() + 10;
				} else {
					n++;
					return 10;
				}
			});
		});

		$("#slideout_menu ul#panel-menu li a").on('click', function(e) {
			e.preventDefault();
			slideout.close();
			var theurl = $(this).attr("href");
			console.log(theurl);
			setTimeout(function(){
				if(theurl==="#follow-bar"){
					var new_offset = $(theurl).offset().top-310;
					$.scrollTo(new_offset, 500);
				} else if(theurl.indexOf("portfolio") >= 0){
					window.location = theurl;
				} else {
					$.scrollTo($(theurl), 500);
				}
		  }, 500);
		});

	});

</script>

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:400,700" rel="stylesheet">

</head>

<body <?php body_class(); ?>>

<main id="slideout_menu">
	<?php
		if ( is_front_page() ) :
			wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'panel-menu' ) );
		else:
			wp_nav_menu( array( 'menu_id' => '27'));
		endif;
	?>
</main>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'woat' ); ?></a>

	<div id="mobile_menu" class="white">
	</div>

	<header id="masthead" class="site-header" role="banner">
		<?php // debug: remove for launch
			// global $template;
			// print_r($template);
		?>
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

		<?php if ( is_front_page() ) : ?>

			<nav id="site-navigation" class="main-navigation home" role="navigation">
				<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'woat' ); ?></button> -->
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

		<?php else : ?>

			<nav id="site-navigation" class="main-navigation not-home" role="navigation">
				<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'woat' ); ?></button> -->
				<?php wp_nav_menu( array( 'menu_id' => '27')) ?>
			</nav><!-- #site-navigation -->

		<?php endif; ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
