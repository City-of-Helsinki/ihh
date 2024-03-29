
<?php
    $target_groups = App\get_target_groups();

    $section_heading = get_sub_field('section_heading');
    $page_for_posts = get_permalink(get_option('page_for_posts'));
    $subheading_size = 2;
    $listNews = get_sub_field('list_latests_news');
    $listEvents = get_sub_field('list_latests_events');
    $defaultNewsTG = get_sub_field('select_default_target_group_for_news');
    $defaultEventsTG = get_sub_field('select_default_target_group_for_events');
?>

<div class="section-news-and-events py-5 container">
    <?php if( $listNews || $listEvents ) : ?>
        <?php if( $section_heading ): ?>
            <h<?php echo $subheading_size; ?> class="section-heading d-flex direction-column-md" id="section-heading-<?php echo sanitize_title($section_heading); ?>">
                <?php echo $section_heading; ?>

                <a href="<?php echo $page_for_posts; ?>">
                    <?php echo \App\ihh_inline_svg('icons/arrow-right'); ?>
                    <?php
                        if($listNews && $listEvents){
                            echo pll_e('See all news and events');
                        } elseif($listNews && !$listEvents){
                            echo pll_e('See all news');
                        } elseif(!$listNews && $listEvents){
                            echo pll_e('See all events');
                        }
                    ?>
                </a>
            </h<?php echo $subheading_size; ?>>

            <?php $subheading_size = 3; ?>
        <?php endif; ?>

        <?php
        if($listEvents){
        $args = array(
            'posts_per_page' => 3,
            'post_type',
            'is_news_and_events_query' => true,
            'type' => 'event'
        );

        if($defaultEventsTG){
            $args['tax_query'][] = array(
                'taxonomy'     => 'target_group',
                'field'   => 'term_id',
                'terms' => $defaultEventsTG
            );
        }

        $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', new \WP_Query( $args ) );
        if($query->have_posts() ):
        ?>
        <div class="section-events">
            <h<?php echo $subheading_size; ?> id="events-heading" class="mb-2"><?php pll_e('Upcoming events'); ?></h<?php echo $subheading_size; ?>>

            <div class="filters d-flex flex-wrap">
                <ul class="list-unstyled list-group list-group-horizontal" aria-label="<?php pll_e('Filter events'); ?>">
                    <li><a href="<?php echo $page_for_posts; ?>?type=event" <?php if(!$defaultEventsTG) { echo "class='selected'"; echo " aria-current='true'"; }?>><?php pll_e('All events'); ?></a></li>

                    <?php foreach( $target_groups as $term ){ ?>
                        <li class="filter-item js-filter">
                            <a
                                href="<?php echo $page_for_posts; ?>?type=event&target_group=<?php echo $term->slug; ?>"
                                <?php if( $defaultEventsTG && $defaultEventsTG == $term->term_id ) {
                                    echo "class='selected'";
                                    echo "aria-current='true'";
                                }?>
                            >
                                <?php echo $term->name ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="posts-container mt-4" role="list" aria-labelledby="events-heading">
                <?php
                    while($query->have_posts() ) {
                        $query->the_post();
                        echo \App\template('partials/content/grid');
                    }
                    wp_reset_query();
                ?>
            </div>
        </div>
        <?php endif;
        }

        if($listNews){ ?>
        <div class="section-news">
            <h<?php echo $subheading_size; ?> id="news-heading" class="mb-2"><?php pll_e('Latest news'); ?></h<?php echo $subheading_size; ?>>

            <div class="filters d-flex flex-wrap">
                <ul class="list-unstyled list-group list-group-horizontal" aria-label="<?php pll_e('Filter news'); ?>">
                    <li class="js-filter"><a href="<?php echo $page_for_posts; ?>?type=news" <?php if( empty($defaultNewsTG)) {echo "class='selected'"; echo " aria-current='true'";}?>><?php pll_e('All news'); ?></a></li>

                    <?php foreach( $target_groups as $term ){ ?>
                        <li class="filter-item js-filter">
                            <a
                                href="<?php echo $page_for_posts; ?>?type=news&target_group=<?php echo $term->slug; ?>"
                                <?php if( !empty($defaultNewsTG) && $defaultNewsTG == $term->term_id) {
                                    echo "class='selected'";
                                    echo "aria-current='true'";
                                }?>
                            >
                            <?php echo $term->name ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="posts-container mt-4" role="list" aria-labelledby="news-heading">
                <?php
                    $args = array(
                        'is_posts_page' => true,
                        'posts_per_page' => 3,
                        'post_type' => 'post'
                    );

                    if($defaultNewsTG){
                        $args['tax_query'][] = array(
                            'taxonomy'     => 'target_group',
                            'field'   => 'term_id',
                            'terms' => $defaultNewsTG
                        );
                    }

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
    <?php
        }
    endif ?>
</div>
<?php
