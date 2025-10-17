<?php
    $raw  = get_sub_field('background_color');
    $bg   = ihh_color_normalize($raw);
    // Fallback for invalid color values
    $style = $bg ? ' style="background-color:' . esc_attr($bg) . ';"' : '';

    $show_caption = get_sub_field("show_image_caption");
    $caption = "";
    if($show_caption) $caption = App\get_image_caption_by_url(get_sub_field("background_image"));

    $side_by_side = get_sub_field("text_overlay") === FALSE;
    $side_by_side_content = $side_by_side ? 'side-by-side col-lg-5' : 'col-lg-6';
    $side_by_side_img = $side_by_side ? 'side-by-side col-lg-7' : 'col-lg-8';

    $arrow_right = '<svg class="hds-arrow-right" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><rect width="24" height="24"></rect><polygon fill="currentColor" points="10.5 5.5 12 7 8 11 20.5 11 20.5 13 8 13 12 17 10.5 18.5 4 12" transform="matrix(-1 0 0 1 24.5 0)"></polygon></g></svg>';

    $card_title = get_sub_field("title");
?>

<div class="container">
    <div class="lift-100-wide lift-100-wide--<?php the_sub_field("side"); ?> w-100 h-100 my-5">
        <div class="container">
            <div class="row position-relative ihhce">
                <figure>
                    <img class="lift-100-wide__bg-img h-100 <?php echo $side_by_side_img; ?> p-0" alt=""
                        src="<?php the_sub_field("background_image");?>">
                </figure>
                <div class="lift-100-wide__card p-lg-4 p-sm-3 <?php echo $side_by_side_content; ?> d-flex flex-column justify-content-center"
                    <?php echo $style; ?>>
                    <h3 class="lift-100-wide__title"><?php the_sub_field("title"); ?></h3>
                    <?php the_sub_field("text_body"); ?>
                    <div class="lift-100-wide__links">
                        <ul class="m-0 p-0">
                            <?php while( have_rows('links') ): the_row();
                            $link = get_sub_field("link");
                            $text = get_sub_field("link_text");
                            $arialabel = '';
                            if(str_contains($text, 'more')):
                                $arialabel = 'aria-label="More about '.  $card_title .'"';
                            elseif(str_contains($text, 'lisää')):
                                $arialabel = 'aria-label="Lisää aiheesta '.  $card_title .'"';
                            endif;
                            printf('<li class="my-2"><a class="arrow" %s href="%s">%s</a></li>', $arialabel, $link, $text);
                        endwhile; ?>
                        </ul>
                    </div>
                </div>
                <?php if($show_caption && $caption): ?>
                <figcaption><?php echo $caption; ?></figcaption>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
