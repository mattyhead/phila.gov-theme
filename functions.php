<?php
/**
 * phila-gov functions and definitions
 *
 * @package phila-gov
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'phila_gov_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function phila_gov_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on phila-gov, use a find and replace
	 * to change 'phila-gov' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'phila-gov', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'phila-gov' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'phila_gov_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // phila_gov_setup
add_action( 'after_setup_theme', 'phila_gov_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function phila_gov_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'phila-gov' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'phila_gov_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function phila_gov_scripts() {

    wp_enqueue_style( 'pure-base', '//yui.yahooapis.com/pure/0.5.0/pure-min.css', array(), '0.5.0' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
		wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css', array(), '2.0.0' );


    //DEV LINK
    wp_enqueue_style( 'phila-gov-style-dev', get_stylesheet_directory_uri() . '/phila.gov-styles/styles.css', array('pure-base'), '1.0' );

    //PROD LINK
    //wp_enqueue_style( 'phila-gov-style-prod', '//github.com/CityOfPhiladelphia/phila.gov-styles', array(), '1.0' );

    wp_enqueue_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js', array(), '2.8.3', true );

    wp_enqueue_script( 'modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js', array(), '2.8.3', false );

		wp_enqueue_script( 'phila-gov-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

		wp_enqueue_script( 'phila-gov-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'text-filtering', '//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js', array(), '1.1.1', true );

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri().'/js/scripts.js', array('jquery', 'text-filtering'), 1.0, true );

}
add_action( 'wp_enqueue_scripts', 'phila_gov_scripts');

function enqueue_scripts_styles_init() {
	//wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri().'/js/scripts.js', array('jquery', 'text-filtering'), 1.0 ); // jQuery will be included automatically
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl
}
add_action('init', 'enqueue_scripts_styles_init');

function ajax_action_stuff() {
	$post_id = $_POST['post_id']; // getting variables from ajax post
	// doing ajax stuff
	update_post_meta($post_id, 'post_key', 'meta_value');
	echo 'ajax submitted';
	die(); // stop executing script
}
add_action( 'wp_ajax_ajax_action', 'ajax_action_stuff' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'ajax_action_stuff' ); // ajax for not logged in users


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Add breadcrumb support
 *
 */
function the_breadcrumb() {
    global $post;
    global $output;
    $category = get_the_category();
    echo '<ul>';
    if (!is_front_page()) {

        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        util_echo_website_url();
        echo '</a></li>';
        if (is_category()) {
            echo '<li>';
            the_title();
            echo '</li>';
        }elseif (is_post_type_archive('department_page')){
            echo '<li>Departments</li>';
        }elseif (is_page_template('taxonomy-topics.php') || is_tax('topics')){
            //browse
            //echo '<li><a href="/browse">Browse</a></li>';
            if (function_exists('currentURL')){
                display_browse_breadcrumbs();
            }
        }
        elseif (is_single()) {
            if (is_singular('news_post')){
                echo '<li>';
                the_title();
                echo '</li>';
            }elseif (is_singular('department_page')) {
                    echo '<li>' . $category[0]->cat_name . '</li>';
                }else{
                //service/info pages
                $i = 0;
                $topic_terms = wp_get_object_terms( $post->ID,  'topics', array('orderby'=>'term_group') );
                $topic_parent = $topic_terms[0];
                    if ( ! empty( $topic_terms ) ) {
                        if ( ! is_wp_error( $topic_terms ) ) {
                                foreach( $topic_terms as $term ) {
                                    if ($i == 0) {
                                        echo '<li><a href=/browse/' . $term->slug . '>' . $term->name . '</a></li>';
                                    }elseif ($i == 1){
                                        echo '<li><a href=/browse/' . $topic_parent->slug . '/' .  $term->slug . '>' . $term->name . '</a></li>';
                                    }
                                    $i++;
                                }
                            }
                    }
            echo '<li>';
            the_title();
            echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                //$anc = array_reverse(get_post_ancestors( $post->ID ));
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> ' . $separator . $output;
                }
                echo $output;
                echo '<li><strong title="'.$title.'"> '.$title.'</strong></li>';
            } else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        }//end is_page
    }//end is front page
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}

/**
 * Mah utility functions
 */

//this is used throughout the theme and is meant to be updated once the major switch happens
function util_echo_website_url(){
    echo 'alpha.phila.gov';
}

//should there be an alert bar at the top of the site?
function alpha_alert(){
    return true;
}

function provide_feedback(){
    echo '<div class="button-with-icon"><a class="pure-button feedback" href="';
    get_template_part( 'content', 'feedback-url' );
    echo '" target="_blank"><span>Provide Feedback</span></a></div>';
}

function still_migrating_content(){
    echo '<p>Can\'t find what you\'re looking for? We\'re still moving content. </p>';
    echo '<p><a href="javascript:searchPhilaGov()">Search phila.gov</a> or <a href="https://docs.google.com/forms/d/16i1gP0lSdquHUlAV26-9K04WkwHI1TAjuAhJGMU0nA0/viewform?entry.2063571544&entry.1408587938=';
    echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    echo '">tell us what you\'re looking for.</a></p>';
}
