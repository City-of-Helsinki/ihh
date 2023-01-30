<?php if( get_sub_field('show_anchorlinks') ) : ?>
<div class="anchorlink-container <?php the_sub_field('anchorlinks_position'); ?>"
    <?php if( !empty(get_sub_field('background_color')) ){
        echo 'style="background: ' . get_sub_field('background_color') . '"';
    } ?>
>
    <nav class="container anchorlink-navigation" aria-label="<?php pll_e('Anchor links'); ?>"></nav>
</div>
<?php endif; ?>