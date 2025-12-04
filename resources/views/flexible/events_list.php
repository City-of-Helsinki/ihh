<?php
$section_heading = get_sub_field('section_heading');
$events_background_color = get_sub_field('events_background_color');
$events_button_color = get_sub_field('events_button_color');
$events_page_link = get_sub_field('events_page_link');
$events_style = $events_background_color
    ? 'style="background-color:' . esc_attr($events_background_color) . ';"'
    : '';
$button_style = $events_button_color
    ? 'style="background-color:' . esc_attr($events_button_color) . ';"'
    : '';
?>

<div class="section-news-and-events">
    <?php
    $args = [
        'posts_per_page' => 3,
        'post_type',
        'is_news_and_events_query' => true,
        'type' => 'event',
    ];

    $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', new \WP_Query($args));
    if ($query->have_posts()): ?>

    <div class="section-events" <?php echo $events_style; ?>>
        <div class="container ihhce">
            <h2 class="section-heading d-flex direction-column-md container ihhce">
                <?php echo $section_heading; ?>
            </h2>

            <div class="posts-container mt-4" role="list" aria-labelledby="events-heading">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    echo \App\template('partials/content/grid');
                }
                wp_reset_postdata();
                ?>
            </div>

            <div class="load-more-wrapper">
                <a href="<?php echo esc_url(
                    $events_page_link,
                ); ?>" class="btn ihh-cta"  <?php echo $button_style; ?>>
                    <?php pll_e('Show more events'); ?>
                </a>
            </div>
        </div>
    </div>
    <?php endif;
    ?>
</div>
