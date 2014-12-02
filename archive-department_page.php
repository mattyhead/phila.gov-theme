<?php
/**
 * Archive for Department List
 * 
 * @package phila-gov
 */

get_header(); ?>

	<div id="primary" class="content-area browse">
		<main id="main" class="site-main" role="main">
            <div class="pure-g">
                <div class="container">
                    <header class="pure-u-1">
                        <h1>Department List</h1>
                    </header>
                </div>
            </div>
            <div class="pure-g">
                <div class="container">
                    <section class="pure-u-1-3 topic">    
                        
                       <?php get_topics(); ?>
                    
                    </section>
          
                    <div class="pure-u-2-3">
                       
                    <?php get_template_part( 'content', 'finder' ); ?>
                        <ul class="list"><!-- ul for sortable listness -->
                            <?php if ( have_posts() ) : ?>
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php get_template_part( 'content', 'list' ); ?>

                                <?php endwhile; ?>
                                <?php else : ?>

                            <?php endif; ?>
                        </ul>
                    </div>
			     
                   </div> <!-- #servinfo-list-container -->
                </div>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
