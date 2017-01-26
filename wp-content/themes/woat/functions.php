<?php
/**
 * WOAT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WOAT
 */

if ( ! function_exists( 'woat_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function woat_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WOAT, use a find and replace
	 * to change 'woat' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'woat', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'woat' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'woat_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'woat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woat_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'woat_content_width', 640 );
}
add_action( 'after_setup_theme', 'woat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woat_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'woat' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'woat' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'woat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function woat_scripts() {
	wp_enqueue_style( 'woat-style', get_stylesheet_uri() );

	wp_enqueue_script( 'woat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'woat-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'woat_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';







// function wpdocs_five_posts_on_homepage( $query ) {
//     if ( $query->is_home() && $query->is_main_query() ) {
//         $query->set( 'page_id', 15 );
//     }
// }
// add_action( 'pre_get_posts', 'wpdocs_five_posts_on_homepage' );

function enqueue_css_js() {
    wp_enqueue_style( 'slick_css', get_stylesheet_directory_uri().'/css/slick.css' );
		wp_enqueue_style( 'slick_css_theme', get_stylesheet_directory_uri().'/css/slick-theme.css' );
		wp_enqueue_style( 'modal', get_stylesheet_directory_uri().'/css/jquery.modal.min.css' );
		// wp_enqueue_style( 'bxslider', get_stylesheet_directory_uri().'/css/jquery.bxslider.css' );

    wp_enqueue_script( 'slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'scrollToFixed', get_template_directory_uri() . '/js/jquery-scrolltofixed-min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'modal', get_template_directory_uri() . '/js/jquery.modal.min.js', array(), '1.0.0', true );
		// wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_css_js' );



function display_logos(){
	$abspath = get_stylesheet_directory()."/assets/logos";
	$relpath = get_stylesheet_directory_uri()."/assets/logos/";
	$files = array_diff(scandir($abspath), array('.', '..'));
	foreach ($files as $file){
		echo "<li>";
		echo '<img src="'.$relpath.$file.'">';
		echo "</li>";
	}
}



function cpt_testimonials() {

	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'woat' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'woat' ),
		'menu_name'           => __( 'Testimonials', 'woat' ),
		'parent_item_colon'   => __( 'Testimonial', 'woat' ),
		'all_items'           => __( 'All Testimonials', 'woat' ),
		'view_item'           => __( 'View Testimonials', 'woat' ),
		'add_new_item'        => __( 'Add New Testimonial', 'woat' ),
		'add_new'             => __( 'Add New', 'woat' ),
		'edit_item'           => __( 'Edit Testimonial', 'woat' ),
		'update_item'         => __( 'Update Testimonial', 'woat' ),
		'search_items'        => __( 'Search Testimonial', 'woat' ),
		'not_found'           => __( 'Not Found', 'woat' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'woat' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'testimonials', 'woat' ),
		'description'         => __( 'Client testimonials', 'woat' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'revisions', 'custom-fields', ),
		// 'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		// 'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	);

	register_post_type( 'testimonials', $args );
}
add_action( 'init', 'cpt_testimonials', 0 );


function cpt_portfolio() {

	$labels = array(
		'name'                => _x( 'Portfolio', 'Post Type General Name', 'woat' ),
		'singular_name'       => _x( 'Portfolio Item', 'Post Type Singular Name', 'woat' ),
		'menu_name'           => __( 'Portfolio', 'woat' ),
		'parent_item_colon'   => __( 'Portfolio', 'woat' ),
		'all_items'           => __( 'All Portfolio Items', 'woat' ),
		'view_item'           => __( 'View Portfolio Items', 'woat' ),
		'add_new_item'        => __( 'Add New Portfolio Item', 'woat' ),
		'add_new'             => __( 'Add New', 'woat' ),
		'edit_item'           => __( 'Edit Portfolio Item', 'woat' ),
		'update_item'         => __( 'Update Portfolio Item', 'woat' ),
		'search_items'        => __( 'Search Portfolio', 'woat' ),
		'not_found'           => __( 'Not Found', 'woat' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'woat' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'portfolio', 'woat' ),
		'description'         => __( 'Portfolio items', 'woat' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'revisions', 'custom-fields', ),
		// 'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'portfolio_services', 'portfolio_products' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	);

	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'cpt_portfolio', 0 );

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
  // Add new "Locations" taxonomy to Posts
  register_taxonomy('portfolio_roles', 'portfolio', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => false,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Roles', 'taxonomy general name' ),
      'singular_name' => _x( 'Role', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Roles' ),
      'all_items' => __( 'All Roles' ),
      'parent_item' => __( 'Parent Role' ),
      'parent_item_colon' => __( 'Parent Role:' ),
      'edit_item' => __( 'Edit Role' ),
      'update_item' => __( 'Update Role' ),
      'add_new_item' => __( 'Add New Role' ),
      'new_item_name' => __( 'New Role Name' ),
      'menu_name' => __( 'Roles' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'roles', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));

	register_taxonomy('portfolio_types', 'portfolio', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Types', 'taxonomy general name' ),
			'singular_name' => _x( 'Type', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Type' ),
			'all_items' => __( 'All Types' ),
			'parent_item' => __( 'Parent Type' ),
			'parent_item_colon' => __( 'Parent Type:' ),
			'edit_item' => __( 'Edit Type' ),
			'update_item' => __( 'Update Type' ),
			'add_new_item' => __( 'Add New Type' ),
			'new_item_name' => __( 'New Type Name' ),
			'menu_name' => __( 'Types' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'type', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
		),
	));


}
add_action( 'init', 'add_custom_taxonomies', 0 );



// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
add_filter('get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( 'Topic: ', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
});



function get_menu(){
	echo '
			<div class="menu-container">
				<div id="menu">
					<ul class="sm">
						<li class="menu"><a href="#"><img src="'.get_stylesheet_directory_uri().'/assets/blank.png"></a></li>
						<li class="fb extra"><a href="#"><img src="'.get_stylesheet_directory_uri().'/assets/blank.png"></a></li>
						<li	class="tw extra"><a href="#"><img src="'.get_stylesheet_directory_uri().'/assets/blank.png"></a></li>
						<li class="ig extra"><a href="#"><img src="'.get_stylesheet_directory_uri().'/assets/blank.png"></a></li>
						<li class="li extra"><a href="#"><img src="'.get_stylesheet_directory_uri().'/assets/blank.png"></a></li>
						<li class="sub extra"><a href="#subscribe" class="open-modal"><img src="'.get_stylesheet_directory_uri().'/assets/blank.png"></a></li>
					</ul>
				</div>
			</div>
	';
}
