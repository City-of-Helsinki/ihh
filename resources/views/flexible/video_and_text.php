<?php
$body_text = get_sub_field('body_text');
$image = get_sub_field('image');
$video_link = get_sub_field('video_link');
$show_button = get_sub_field('show_play_button');

$layout = get_sub_field('layout');
$layout_class = $layout ? 'image-left' : 'image-right';
?>

<section class="video_and_text_wrapper ihhce">
    <div class="container">

        <div class="video_and_text <?php echo $layout_class; ?>">

            <?php if (!empty($body_text)): ?>
              <?php $anchor_link = get_sub_field('show_in_anchor_link'); ?>
            <div class="content" <?= $anchor_link ? 'data-anchor="true"' : '';  ?>>
                <?php echo apply_filters('the_content', $body_text); ?>
            </div>
            <?php endif; ?>

            <div class="video_wrapper">
                <div class="video">
                    <?php if ($show_button): ?>
                    <div class="youtube_play"></div>
                    <?php endif; ?>

                    <a href="<?php echo esc_attr(
                        $video_link,
                    ); ?>" class="image fancybox-youtube" data-autoplay="true" data-vbtype="video" aria-label="Video">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr(
    $image['alt'],
); ?>">
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
