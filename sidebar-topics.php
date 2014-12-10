<?php 

/*
 * 
 *  Related Topics Sidebar
 *
 */
 
 ?>  
<div id="secondary" class="widget-area pure-u-1 pure-u-md-1-4 related" role="complementary">
    <div class="s-box">
      <?php  
     //get all the terms
        $custom_terms = get_the_terms($post->ID, 'topics');
        $currentID = get_the_ID();

        if( $custom_terms){
            // tax_query params
           // $tax_query = array();

            // loop through topics and build a tax query
            foreach( $custom_terms as $custom_term ) {
                $terms[] = $custom_term->slug;   
            
            }
            
            $tax_query = array('relation' => 'OR',
                    array (
                        'taxonomy' => 'topics',
                        'field' => 'slug',
                        'terms' => $terms
                    )
            );
            // put all the WP_Query args together
            $args = array( 'post_type' => array(
                                'post',
                                'service_post'
                                ),
                            //'topics' => $custom_terms,
                            'posts_per_page' => 5,
                            'tax_query' => $tax_query,
                            //'post__not_in' => array($currentID)
            );
            $loop = new WP_Query($args);

            if( $loop->have_posts() ) {
               ?> <h3>Related Content</h3>
                
                <ul>
                    <?php
                while( $loop->have_posts() ) : $loop->the_post(); ?>
                    <li>  
                        <?php the_title( sprintf( '<a href="%s" rel="bookmark" class="item">', esc_url( get_permalink() ) ), '</a>' );
                    ?>
                    </li> 
                <?php 

                endwhile;

            }

            wp_reset_query();

        }
    ?>
    </div><!-- .s-box -->
</div><!-- #secondary -->
