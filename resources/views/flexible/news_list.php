<?php
    $section_heading = get_sub_field('section_heading');
    $news_background_color = get_sub_field('news_background_color');
    $news_page_link = get_permalink( function_exists('pll_get_post') ? pll_get_post( get_option('page_for_posts') ) : get_option('page_for_posts') );
    $news_style = $news_background_color ? 'style="background-color:' . esc_attr($news_background_color) . ';"' : '';
?>

<div class="section-news-and-events">
    <?php
        $args = array(
            'posts_per_page'            => 3,
            'post_type'                 => 'post',
            'is_news_and_events_query'  => true,
            'type'                      => 'post'
        );

        $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', new \WP_Query( $args ) );
        if($query->have_posts() ):
    ?>

    <div class="section-events" <?php echo $news_style; ?>>
        <div class="container ihhce">
            <h2 class="section-heading d-flex direction-column-md container ihhce">
                <?php echo $section_heading; ?>
            </h2>

            <div class="posts-container mt-4" role="list" aria-labelledby="events-heading">
                <?php
                        while($query->have_posts() ) {
                            $query->the_post();
                            echo \App\template('partials/content/grid');
                        }
                        wp_reset_postdata();
                    ?>
            </div>

            <div class="load-more-wrapper">
                <a href="<?php echo esc_url($news_page_link); ?>" class="btn ihh-cta">
                    <?php pll_e('Show more news') ?>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>