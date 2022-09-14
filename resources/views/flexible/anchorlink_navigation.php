<?php if( get_sub_field('show_anchorlinks') ) : ?>
<div class="anchorlink-container" style="background: <?php the_sub_field('background_color'); ?>">
    <nav class="container anchorlink-navigation" aria-label="<?php pll_e('Anchor links'); ?>"></nav>
</div>
<?php endif; ?>