<?php
    $section_heading = get_sub_field('section_heading');
?>

<div class="section-news-and-events py-5">
    <h2 class="section-heading d-flex direction-column-md container ihhce">
        <?php echo esc_html($section_heading); ?>
    </h2>

    <div class="section-news">
        <div class="container ihhce">
            <div class="posts-container mt-4" role="list" aria-labelledby="news-heading">
                <?php
                      $args = array(
                          'is_posts_page' => true,
                          'posts_per_page' => 3,
                          'post_type' => 'post'
                      );

                      $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', (new \WP_Query($args)));
                      if($query->have_posts() ) {
                          while($query->have_posts() ) {
                              $query->the_post();
                              echo \App\template('partials/content/grid');
                          }
                          wp_reset_postdata();
                      }
                  ?>
            </div>
        </div>
    </div>
</div>
