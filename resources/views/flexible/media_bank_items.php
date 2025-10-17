<?php
    $media_items = get_sub_field('items');
?>

<div class="container ihhce">
    <?php if( get_sub_field('section_heading')) : ?>
    <h2 id="section-heading-<?php echo get_the_ID(); ?>" class="section-heading">
        <?php the_sub_field('section_heading'); ?></h2>
    <?php endif ?>

    <?php if( $media_items ): ?>
    <ul class="list-unstyled media-bank-items media-posts-container"
        aria-labelledby="section-heading-<?php echo get_the_ID(); ?>">

        <?php foreach( $media_items as $post): setup_postdata($post); ?>
        <li class="media-bank-item media-grid-container">
            <?php if($media_file_link = \App\Controllers\App::get_media_category_link($post) ) :
                        echo $media_file_link;
                    endif ?>

            <div class="media-container">
                <div class="image-wrap" <?php echo \App\Controllers\App::get_media_category_thumbnail($post); ?>></div>
                <div class="title <?php echo \App\Controllers\App::get_media_category_bg($post); ?>">
                    <?php echo \App\Controllers\App::get_media_category_icon($post); ?>
                    <p><?php echo get_the_title($post); ?></p>
                </div>
            </div>
            <?php if($media_file_link = \App\Controllers\App::get_media_category_link($post) ) : ?>
            </a>
            <?php endif ?>
        </li>

        <?php
            wp_reset_postdata();
        endforeach; ?>

    </ul>
    <?php endif ?>
</div>