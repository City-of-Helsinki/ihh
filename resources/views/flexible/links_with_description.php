<div class="container">
    <?php if( get_sub_field('section_heading')) : ?>
    <h2 id="section-heading-<?php echo get_the_ID(); ?>" class="section-heading"><?php the_sub_field('section_heading'); ?></h2>
    <?php endif ?>

    <?php if( have_rows('link_item') ) : ?>
        <ul class="list-unstyled link-list" aria-labelledby="section-heading-<?php echo get_the_ID(); ?>">
            <?php while( have_rows('link_item') ) : the_row(); $id = get_row_index(); ?>
                <li class="list-item">
                    <h3 class="item-heading"><?php the_sub_field('heading'); ?></h3>
                    <p class="item-description"><?php the_sub_field('description'); ?></p>
                    <?php if(get_sub_field('cta_url')) : ?>
                    <a href="<?php the_sub_field('cta_url'); ?>" class="external-link"><?php the_sub_field('cta_text'); ?></a>
                    <?php endif ?>
                </li>
            <?php endwhile ?>
        </ul>
    <?php endif ?>
</div>