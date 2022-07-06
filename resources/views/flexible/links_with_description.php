<div class="container">
    <?php if( get_sub_field('section_heading')) : ?>
    <h2 id="section-heading-<?php echo get_the_ID(); ?>" class="section-heading"><?php the_sub_field('section_heading'); ?></h2>
    <?php endif ?>

    <?php $show_images = get_sub_field('show_images_above_links');?>

    <?php if( have_rows('link_item') ) : ?>
        <ul class="list-unstyled link-list" aria-labelledby="section-heading-<?php echo get_the_ID(); ?>">
            <?php while( have_rows('link_item') ) : the_row(); $id = get_row_index(); ?>
                <li class="list-item">
                    <?php if( $show_images ) : ?>
                    <div class="image-container aspect-ratio-1-96">
                        <?php if( get_sub_field('image') ) : ?>
                            <img src="<?php the_sub_field('image'); ?>" alt="" class="image-fit" />
                        <?php endif ?>
                    </div>
                    <?php endif ?>
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