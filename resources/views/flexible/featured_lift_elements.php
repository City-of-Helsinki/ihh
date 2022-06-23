<div class="container">
    <?php if( have_rows('lift') ) : ?>
        <?php while( have_rows('lift') ) : the_row(); $id = get_row_index(); ?>
            <div class="lift-element">
                <?php if( get_sub_field('image') ) : ?>
                    <div class="image-container aspect-ratio-1-96">
                        <img src="<?php the_sub_field('image'); ?>" alt="" class="image-fit" />
                    </div>
                <?php endif ?>

                <h2 class="item-heading"><?php the_sub_field('heading'); ?></h2>
                <p class="item-description"><?php the_sub_field('description'); ?></p>

                <?php if(get_sub_field('link_url')) : ?>
                    <a href="<?php the_sub_field('link_url'); ?>"><?php echo \App\ihh_inline_svg('icons/arrow-right') ?><?php the_sub_field('link_text'); ?></a>
                <?php endif ?>
            </div>
        <?php endwhile ?>
    <?php endif ?>
</div>