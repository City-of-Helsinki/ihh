
<?php
    $target_groups = App\get_target_groups();

    $section_heading = get_sub_field('section_heading');
    $page_for_posts = get_permalink(get_option('page_for_posts'));
    $subheading_size = 2;
?>

<div class="section-news-and-events py-5 container">
    <?php if( get_sub_field('list_latests_news_and_events') ) : ?>
        <?php if( $section_heading ): ?>
            <h<?php echo $subheading_size; ?> class="section-heading d-flex direction-column-md" id="section-heading-<?php echo get_the_ID(); ?>">
                <?php echo $section_heading; ?>

                <a href="<?php echo $page_for_posts; ?>">
                    <?php echo \App\ihh_inline_svg('icons/arrow-right'); ?>
                    <?php echo pll_e('See all news and events'); ?>
                </a>
            </h<?php echo $subheading_size; ?>>

            <?php $subheading_size = 3; ?>
        <?php endif; ?>

        <?php
        $args = array(
            'posts_per_page' => 3,
            'post_type',
            'is_news_and_events_query' => true,
            'type' => 'event'
        );

        $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', new \WP_Query( $args ) );
        if($query->have_posts() ): ?>
        <div class="section-events">
            <h<?php echo $subheading_size; ?> id="events-heading" class="mb-2"><?php pll_e('Upcoming events'); ?></h<?php echo $subheading_size; ?>>

            <div class="filters d-flex flex-wrap">
                <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="events-heading">
                    <li><a href="<?php echo $page_for_posts; ?>?type=event&target_group=all" class="selected"><?php pll_e('All events'); ?></a></li>

                    <?php foreach( $target_groups as $term ){ ?>
                        <li class="filter-item js-filter">
                            <a href="<?php echo $page_for_posts; ?>?type=event&target_group=<?php echo $term->slug; ?>"><?php echo $term->name ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="posts-container mt-4">
                <?php
                    while($query->have_posts() ) {
                        $query->the_post();
                        echo \App\template('partials/content/grid');
                    }
                    wp_reset_query();
                ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="section-news">
            <h<?php echo $subheading_size; ?> id="news-heading" class="mb-2"><?php pll_e('Latest news'); ?></h<?php echo $subheading_size; ?>>

            <div class="filters d-flex flex-wrap">
                <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="news-heading">
                    <li class="js-filter"><a href="<?php $page_for_posts; ?>?type=news&≈=all" class="selected"><?php pll_e('All news'); ?></a></li>

                    <?php foreach( $target_groups as $term ){ ?>
                        <li class="filter-item js-filter">
                            <a href="<?php echo $page_for_posts; ?>?type=news&target_group=<?php echo $term->slug; ?>"><?php echo $term->name ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="posts-container mt-4">
                <?php
                    $args = array(
                        'is_posts_page' => true,
                        'posts_per_page' => 3,

                    );
                    $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', (new \WP_Query($args)));

                    if($query->have_posts() ) {
                        while($query->have_posts() ) {
                            $query->the_post();
                            echo \App\template('partials/content/grid');
                        }
                        wp_reset_query();
                    }
                ?>
            </div>
        </div>
    <?php endif ?>
</div>
<?php 
