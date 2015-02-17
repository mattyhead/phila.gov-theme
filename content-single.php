<?php
/**
 * The content of a single post
 * @package phila-gov
 */
?>

<article id="post-<?php the_ID(); ?>">
	<div class="row">
		<header class="entry-header small-24 columns">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	</div>
	<div class="row">
        <div class="entry-content small-24 medium-18 columns">
          <?php the_content(); ?>
                <?php
                    //wp_link_pages( array(
                    //	'before' => '<div class="page-links">' . __( 'Pages:', 'phila-gov' ),
                    //	'after'  => '</div>',
                    //) );
                ?>
               </div><!-- .entry-content -->
    <?php
        get_sidebar('topics');
    ?>
	</div><!-- .row -->
</article><!-- #post-## -->
