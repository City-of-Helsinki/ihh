<?php
    $showParent = true;

    $parentID = $post->post_parent;

    $navigationAriaLabel = has_post_parent($post) ? 'aria-label="Subpages of ' . get_the_title($post->post_parent) . ' page"' : '';
?>


<?php if( has_post_parent($post) ): ?>
<nav class="navigation-boxes container" <?php echo $navigationAriaLabel; ?>>
    <ul class="list-unstyled row">
        <?php if( $showParent ) : ?>
        <li class="previous-article previous">
            <a href="<?php echo get_permalink($parentID); ?>">
                <div>{{ pll_e('Continue previous page') }}</div>
                <div class="link-heading">
                    {!! \App\ihh_inline_svg('icons/arrow-right') !!}
                    <?php echo get_the_title($parentID); ?></div>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>