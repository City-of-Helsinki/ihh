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
?>

<div class="container">
    <div class="lift-100-wide lift-100-wide--<?php the_sub_field("side"); ?> w-100 h-100">
        <!-- <div class="lift-100-wide__bg w-100" ></div> -->
        <img class="lift-100-wide__bg-img w-75 h-100 img-fluid" src="<?php the_sub_field("background_image");?>">
        <div class="lift-100-wide__card w-50 p-4 pb-5" <?php echo $bg_color_style; ?> >
            <h3 class="lift-100-wide__title"><?php the_sub_field("title"); ?></h3>
            <p class="lift-100-wide__text"><?php the_sub_field("text_body"); ?></p>
            <div class="lift-100-wide__links">
                <ul>
                <?php foreach (get_sub_field("links") as $row) {
                    $link = $row["link"];
                    $text = $row["link_text"];
                    echo "<li><a href=$link>Icon placeholder</a>$text</li>";
                } ?>
                </ul>
            </div>
        </div>
    </div>
</div>