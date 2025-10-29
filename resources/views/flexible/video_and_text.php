<section class="video_and_text_wrapper">
    <div class="container">
        <?php $body_text = esc_html(get_sub_field('body_text')); ?>

        <div class="video_and_text">
            <?php if (!empty($body_text)): ?>
            <div class="content">
                <p><?php echo $body_text; ?></p>
            </div>
            <?php endif; ?>

            <div class="video_wrapper">
                <div class="video">
                    <?php if (get_sub_field('show_play_button')): ?>
                    <div class="youtube_play"></div>
                    <?php endif; ?>

                    <a href="<?php echo esc_attr(get_sub_field('video_link')); ?>" class="image fancybox-youtube"
                        data-autoplay="true" data-vbtype="video" aria-label="Video">
                        <?php $image = get_sub_field('image'); ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
