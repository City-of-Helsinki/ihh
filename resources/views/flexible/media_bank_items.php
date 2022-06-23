<div class="container">
    <?php if( get_sub_field('section_heading')) : ?>
    <h2 id="section-heading-<?php echo get_the_ID(); ?>" class="section-heading"><?php the_sub_field('section_heading'); ?></h2>
    <?php endif ?>

    <?php if( have_rows('items') ) : ?>
        <ul class="list-unstyled media-bank-items media-posts-container" aria-labelledby="section-heading-<?php echo get_the_ID(); ?>">

            <?php while( have_rows('items') ) : the_row(); $id = get_row_index(); ?>
                <?php $media = get_sub_field('media_item'); ?>

                <li class="media-bank-item media-grid-container">
                    <?php if($media_file_link = \App\Controllers\App::get_media_category_link($media) ) :
                        echo $media_file_link;
                    endif ?>

                    <div class="media-container">
                        <div class="image-wrap" <?php echo \App\Controllers\App::get_media_category_thumbnail($media); ?>></div>
                        <div class="title <?php echo \App\Controllers\App::get_media_category_bg($media); ?>">
                            <?php echo \App\Controllers\App::get_media_category_icon($media); ?>
                            <p><?php echo get_the_title($media); ?></p>
                        </div>
                    </div>
                    <?php if($media_file_link = \App\Controllers\App::get_media_category_link($media) ) : ?>
                        </a>
                    <?php endif ?>
                </li>

            <?php endwhile ?>

        </ul>
    <?php endif ?>
</div>