<?php
/**
 * The content of a single post
 * @package phila-gov
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('pure-g'); ?>>
	<header class="entry-header pure-u-1">
		<?php the_title( '<h1 class="entry-title container">', '</h1>' ); ?>

	</header><!-- .entry-header -->
    <div class="container">
        <div class="entry-content pure-u-1 pure-u-md-3-4">
            <div>
                <?php the_content(); ?>
                <?php
                    //wp_link_pages( array(
                    //	'before' => '<div class="page-links">' . __( 'Pages:', 'phila-gov' ),
                    //	'after'  => '</div>',
                    //) );
                ?>
               </div><!-- .entry-content -->
            </div>
    <?php       
        get_sidebar('topics'); 
    ?>
    </div><!-- .container -->
</article><!-- #post-## -->
