<div class="container ihhce links-section">
    <?php if (get_sub_field('section_heading')): ?>
    <?php $anchor_link = get_sub_field('show_in_anchor_link'); ?>
    <h2 id="section-heading-<?php echo get_the_ID(); ?>" class="section-heading" <?= $anchor_link ? 'data-anchor="true"' : '';  ?>><?php the_sub_field(
    'section_heading',
); ?></h2>
    <?php endif; ?>

    <?php
    $show_images = get_sub_field('show_images_above_links');
    $hover_background_color = get_sub_field('hover_background_color');

    $block_id = 'links-section-' . uniqid();
    ?>
    <style>
    #<?php echo $block_id; ?>.link-list li a:hover,
    #<?php echo $block_id; ?>.link-list li a:focus {
        background-color: <?php echo esc_attr($hover_background_color); ?>;
    }
    </style>

    <?php if (have_rows('link_item')): ?>
    <ul id="<?php echo $block_id; ?>" class="list-unstyled link-list"
        aria-labelledby="section-heading-<?php echo get_the_ID(); ?>">
        <?php while (have_rows('link_item')):

            the_row();
            $id = get_row_index();
            ?>
        <?php \App\render_link_section_li($show_images); ?>
        <?php
        endwhile; ?>
    </ul>
    <?php endif; ?>
</div>
