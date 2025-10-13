<?php
    $show_navigation = get_field("show_nextprev_navigation", $post->ID);
    if( $show_navigation === false ) return;

    // Argument array
    $pages_args = array(
        'parent' => $post->post_parent,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    );

    // Get pages
    $pagesList = get_pages($pages_args);
    $pages = wp_list_pluck( $pagesList, 'ID' );
    $current = array_search(get_the_ID(), $pages);

    $showNext = true;
    $showPrevious = true;

    // Set previous and next page ids by using $pages array
    // Show or hide previous / next links depending on if current page is first or last item of an array
    $prevID = ($current - 1) < 0 ? $showPrevious = false : $pages[$current - 1];
    $nextID = ($current + 1)  > (count($pages) - 1) ? $showNext = false : $pages[$current + 1];

    $showPrevious = ($prevID == $nextID || $prevID < 0)  ? false : $showPrevious;

    $navigationAriaLabel = has_post_parent($post) ? 'aria-label="Subpages of ' . get_the_title($post->post_parent) . ' page"' : '';
?>


<?php if( has_post_parent($post) && count($pages) > 1 ): ?>
<nav class="navigation-boxes container" <?php echo $navigationAriaLabel; ?>>
    <ul class="list-unstyled row">
        <?php if( $showPrevious ) : ?>
        <li class="previous-article previous">
            <a href="<?php echo get_permalink($prevID); ?>">
                <div class="link-heading">
                    {!! \App\ihh_inline_svg('icons/arrow-right') !!}
                    <?php echo get_the_title($prevID); ?>
                </div>
            </a>
        </li>
        <?php endif; ?>

        <?php if( $showNext ) : ?>
        <li class="next-article next">
            <a href="<?php echo get_permalink($nextID); ?>">
                <div class="link-heading next">
                    <?php echo get_the_title($nextID); ?>
                    {!! \App\ihh_inline_svg('icons/arrow-right') !!}
                </div>
            </a>
        </li>
        <?php endif; ?>

    </ul>
</nav>
<?php endif; ?>
