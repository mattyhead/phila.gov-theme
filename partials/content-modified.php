<?php
/**
 * The template part for displaying when content was last modified.
 *
 *
 * @package phila-gov
 */
     wp_reset_postdata();
?>
<div class="row">
  <div class="small-24 columns">
    <hr>
    <p>This content was last updated on <time id="last-updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date(); ?></time>
    <?php
    /* A link pointing to the category in which this content lives */
    $current_category = get_the_category();

    if ( !$current_category == '' ) :
      $department_page_args = array(
        'post_type' => 'department_page',
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $current_category[0]->slug,
          ),
        ),
        'post_parent' => 0,
        'posts_per_page' => 1,
      );
        $get_department_link = new WP_Query( $department_page_args );
      if ( $get_department_link->have_posts() ) :
      	while ( $get_department_link->have_posts() ) :
      		$get_department_link->the_post();
          $current_cat_slug = $current_category[0]->slug;
          if ( $current_cat_slug == 'uncategorized' ) {
            //do nothing
          }else{
            echo 'by <a href="' . get_the_permalink() . '">';
            echo get_the_title() .'  </a>';
          }
        endwhile;
      endif;
    endif;

    /* Restore original Post Data */
    wp_reset_postdata();

    ?>
    </p>
    </div>
</div>
