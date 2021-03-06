<?php
/**
 * The template used for displaying  department websites
 *
 * @package phila-gov
 */

global $post;
$children = get_posts( array(
  'post_parent' => $post->ID,
  'orderby' => 'menu_order',
  'order' => 'ASC',
  'post_type' => 'department_page',
  'post_status' => 'publish'
));

$ancestors = get_post_ancestors($post);

//if there are grandchildren, don't redirect those.
if ( $children && count( $ancestors ) == 1 ) {
	$firstchild = $children[0];
  wp_redirect(get_permalink($firstchild->ID));
	exit;
}
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row department'); ?>>

  <header class="entry-header on-site small-24 columns">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header>
  <?php
  //get department homepage alerts
  call_user_func( array( 'Phila_Gov_Department_Sites', 'department_homepage_alert' ) );
  ?>
  <?php
  	/*
  	Our navigation menu. We use categories to drive functionality.
  	This checks to make sure a category exisits for the given page,
  	if it does, we render our menu w/ markup.
  	*/
  		get_department_menu();
  ?>

  <?php
	if (function_exists('rwmb_meta')) {
			$external_site = rwmb_meta( 'phila_dept_url', $args = array('type' => 'url'));
	if (!$external_site == ''){

		get_template_part( 'templates/single', 'off-site' );

 	} else {
  //loop for our regularly scheduled content
	   while ( have_posts() ) : the_post();

      get_template_part( 'templates/single', 'on-site-content' );

	    endwhile;
		}
	}
  ?>
</article><!-- #post-## -->
<?php get_template_part( 'partials/content', 'modified' ) ?>

<?php get_footer(); ?>
