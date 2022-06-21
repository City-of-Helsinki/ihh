<?php
    $color_selection = get_sub_field("background_color");
    // TODO use bootstrap css vars
    $colors = [
        'green' => '#92c8c2',
        'yellow' => '#f3e565',
        'red' => '#f7a091'
    ];
    $bg_color = $colors[0];
    if (array_key_exists($color_selection, $colors)) {
        $bg_color = $colors[$color_selection];
    }
    $bg_color_style = sprintf("style=background-color:%s;", $bg_color);

    $arrow_right = '<svg class="hds-arrow-right" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><rect width="24" height="24"></rect><polygon fill="currentColor" points="10.5 5.5 12 7 8 11 20.5 11 20.5 13 8 13 12 17 10.5 18.5 4 12" transform="matrix(-1 0 0 1 24.5 0)"></polygon></g></svg>';
?>

<div class="container">
    <div class="lift-100-wide lift-100-wide--<?php the_sub_field("side"); ?> w-100 h-100 my-5">
        <div class="row position-relative">
            <img class="lift-100-wide__bg-img h-100 col-lg-8 p-0" src="<?php the_sub_field("background_image");?>">
            <div class="lift-100-wide__card p-lg-4 p-sm-3 col-lg-6 d-flex flex-column justify-content-center" <?php echo $bg_color_style; ?> >
                <h3 class="lift-100-wide__title"><?php the_sub_field("title"); ?></h3>
                <p class="lift-100-wide__text"><?php the_sub_field("text_body"); ?></p>
                <div class="lift-100-wide__links">
                    <ul class="m-0 p-0">
                    <?php foreach (get_sub_field("links") as $row) {
                        $link = $row["link"];
                        $text = $row["link_text"];
                        printf('<li class="my-2"><a class="arrow" href="%s">%s</a></li>', $link, $text);
                    } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
