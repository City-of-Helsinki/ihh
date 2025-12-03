<div class="container ihhce">
    <?php if (get_sub_field('section_heading')): ?>
    <h2 id="section-heading-<?php echo get_the_ID(); ?>" class="section-heading"><?php the_sub_field(
    'section_heading',
); ?></h2>
    <?php endif; ?>

    <?php
    $show_images = get_sub_field('show_images_above_links');
    $link_type = get_sub_field('link_type');
    ?>

    <?php if (have_rows('link_item')): ?>
    <ul class="list-unstyled link-list" aria-labelledby="section-heading-<?php echo get_the_ID(); ?>">
        <?php while (have_rows('link_item')):

                the_row();
                $id = get_row_index();
                ?>
        <?php \App\render_link_section_li($show_images, $link_type); ?>
        <?php
            endwhile; ?>
    </ul>
    <?php endif; ?>
</div>
