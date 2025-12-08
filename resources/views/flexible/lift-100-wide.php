<?php
$raw = get_sub_field('background_color');
$bg = ihh_color_normalize($raw);
// Fallback for invalid color values
$style = $bg ? ' style="background-color:' . esc_attr($bg) . ';"' : '';

$show_caption = get_sub_field('show_image_caption');
$caption = '';
if ($show_caption) {
    $caption = App\get_image_caption_by_url(get_sub_field('background_image'));
}

$overlay_class = get_sub_field('text_overlay') !== false ? 'overlay' : '';
$card_title = get_sub_field('title');
?>

<div class="container">
    <div class="lift-100-wide">
        <div class="lift-100-wide-wrapper <?php the_sub_field(
            'side',
        ); ?> <?php echo $overlay_class; ?> ihhce">
            <figure>
                <img alt="" src="<?php the_sub_field('background_image'); ?>">
                <?php if ($show_caption && $caption): ?>
                <figcaption><?php echo $caption; ?></figcaption>
                <?php endif; ?>
            </figure>
            <div class="card" <?php echo $style; ?>>
                <h3 class="title"><?php the_sub_field('title'); ?></h3>
                <?php the_sub_field('text_body'); ?>
                <div class="links">
                    <ul>
                        <?php while (have_rows('links')):
                            the_row();
                            $link = get_sub_field('link');
                            $text = get_sub_field('link_text');
                            $arialabel = '';
                            if (str_contains($text, 'more')):
                                $arialabel = 'aria-label="More about ' . $card_title . '"';
                            elseif (str_contains($text, 'lisää')):
                                $arialabel = 'aria-label="Lisää aiheesta ' . $card_title . '"';
                            endif;
                            printf(
                                '<li class="my-2"><a class="arrow" %s href="%s">%s</a></li>',
                                $arialabel,
                                $link,
                                $text,
                            );
                        endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>