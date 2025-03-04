<style>
    .link-button-container .link-button-link-area {
        display: block;
        margin-bottom: 1rem;
    }
    .link-button-container .link-button-link .inline-svg {
        display: none !important;
    }
    .link-button-container .link-button-link .dashicons {
        display: block;
        margin-top: .5rem;
    }
    .link-button-container .link-button-link {
        display: block;
        color: #000 !important;
        text-decoration: none;
        font-weight: 600;
        font-size: 2rem;
        padding: 4rem 3rem;
    }
    .link-button-container .link-button-link:hover,
    .link-button-container .link-button-link:active,
    .link-button-container .link-button-link:focus {
        text-decoration: underline;
    }
</style>
<div class="container link-button-container">
    <?php
        while( have_rows('link_button_links') ) {
            the_row();
            $id = get_row_index();
            $link_button_bg = get_sub_field( 'link_button_background' );
            $link_button_link = get_sub_field( 'link_button_link' );
    ?>

        <div class="link-button-link-area" <?php if ( ! empty( $link_button_bg ) ) { echo 'style="background: ' . esc_html( $link_button_bg ) . '"'; } ?>>
            <?php if ( ! empty( $link_button_link ) ) { ?>
                <a href="<?php echo esc_html( $link_button_link['url'] ); ?>" class="link-button-link"><?php echo esc_html( $link_button_link['title'] ); ?><span class="dashicons dashicons-arrow-right-alt"></span></a>
            <?php } ?>
        </div>
    <?php } ?>
</div>