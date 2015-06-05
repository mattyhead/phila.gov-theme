<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package phila-gov
 */
?>
    <?php
        if (is_front_page()){
            //nothing
        }elseif (is_post_type_archive('department_page')){
            //nothing
        }
        elseif (is_page()){ ?>
      <div class="row">
        <div class="small-24 columns">
          <div class="panel center">
            <?php echo 'Can\'t find what you are looking for? <a href="';
                  echo get_template_part( 'partials/content', 'feedback-url' );
                  echo '" target="_blank"> Let us know. <span class="accessible">Opens in new window</span></a>'; ?>
          </div>
        </div>
      </div>
      <?php

              }elseif(is_page_template('taxonomy-topics.php') ||      is_tax('topics')){  ?>
      <div class="row">
        <div class="small-24 columns">
          <div class="panel center">
              <?php
                  echo 'Can\'t find what you\'re looking for? We\'re still moving content. <a href="https://docs.google.com/forms/d/16i1gP0lSdquHUlAV26-9K04WkwHI1TAjuAhJGMU0nA0/viewform?entry.2063571544&entry.1408587938=';
                  echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" target="_blank">';
                  echo 'Let us know what you are trying to find. <span class="accessible">Opens in new window</span></a>'; ?>
          </div>
        </div>
      </div>
      <?php
              }elseif(is_single()){ ?>
      <div class="row">
        <div class="small-24 columns">
          <div class="panel center">
              <?php
                  echo 'Is this information incorrect? <a href="';
                  echo get_template_part( 'partials/content', 'feedback-url' );
                  echo '" target="_blank"> Let us know. <span class="accessible">Opens in new window</span></a>'; ?>
          </div>
        </div>
      </div>
      <?php } ?>

      </div><!-- #content -->
 </div><!-- #page -->

<footer data-swiftype-index='false' id="colophon" class="site-footer" role="contentinfo">
  <section class="fat">
    <div class="row">
      <div class="large-8 columns">
        <h1>Government</h1>
        <nav>
          <ul>
            <li><a href="http://alpha.phila.gov"><?php util_echo_website_url() ;?></a></li>
            <li><a href="/departments">Department Directory</a></li>
            <li><a href="http://www.phila.gov/mayor">Mayor's Office</a></li>
            <li><a href="http://iframe.publicstuff.com/#?client_id=242">Report an Issue / 311</a></li>
            <li><a href="http://cityofphiladelphia.wordpress.com/">News</a></li>
            <li><a href="http://www.phila.gov/phoneDir/">Phone Directory</a></li>
          </ul>
        </nav>
      </div>
      <div class="large-16 columns">
        <h1>Browse alpha.phila.gov</h1>
        <nav>
            <?php
            /* temp top-level topics list w/ descriptions */
               $args = array(
                    'orderby' => 'name',
                    'fields'=> 'all',
                    'parent' => 0,
                   'hide_empty'=> false
               );
              $terms = get_terms( 'topics', $args );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                     echo '<ul class="columns-2">';
                     foreach ( $terms as $term ) {
                         echo '<li><a href="/browse/' . $term->slug .  '">' . $term->name;
                     }
                     echo '</ul>';
                    }
                    ?>
              </nav>
        </div>
    </div>
  </section>
  <div class="row classic">
    <div class="site-info large-6 columns">
      <a href="<?php get_template_part( 'partials/content', 'feedback-url' ); ?>"><?php printf( __( 'Provide Feedback', 'phila-gov' )); ?></a>
          <?php //printf( __( 'Theme: %1$s by %2$s.', 'phila-gov' ), 'phila-gov', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
    </div><!-- .site-info -->
    <nav class="large-12 columns">
      <ul class="inline-list">
          <li><a href="/terms-of-use">Terms of use</a></li>
          <li><a href="http://www.phila.gov/privacy/pdfs/FinalCityOpenRecords.pdf">Right to know (pdf)</a></li>
          <li><a href="/privacypolicy">Privacy Policy</a></li>
      </ul>
    </nav>
  </div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
<script type="text/javascript">
  (function(w,d,t,u,n,s,e){w['SwiftypeObject']=n;w[n]=w[n]||function(){
  (w[n].q=w[n].q||[]).push(arguments);};s=d.createElement(t);
  e=d.getElementsByTagName(t)[0];s.async=1;s.src=u;e.parentNode.insertBefore(s,e);
  })(window,document,'script','//s.swiftypecdn.com/install/v2/st.js','_st');

  _st('install','<?php echo getenv("SWIFTYPE_ID") ?: "SET_SWIFTYPE_ID_ENV_VAR"; ?>','2.0.0');
</script>
<script>
  jQuery(document).foundation();
</script>
</body>
</html>
