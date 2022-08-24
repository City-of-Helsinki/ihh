<?php

namespace App\Controllers\Partials;

trait MediaCategory{
    public static function get_media_categories($post_id = null) {
        if (!empty($post_id)){
            $post_id = (int)$post_id;
        }

        return get_field('select_media', $post_id);
    }

    public static function get_media_category_title($post_id){
        if (!empty($post_id)){
            $post_id = (int)$post_id;
        }

        return get_field('media_title', $post_id);
    }

    public static function get_media_category_thumbnail($media){
        if (empty($media))
            return false;

        $logoArray = get_field('media_image', $media);

        if(empty($logoArray))
            return false;
    

        return sprintf(' style="background-image: url(%s)"', $logoArray['url'], $logoArray['alt']);
    }

    public static function get_media_category_icon($media){
        if (empty($media))
            return false;

        $media_icon = get_field('media_icon', $media);        
        if (!$media_icon)
            return false;

        return sprintf('<i class="icon-%s"></i>', $media_icon);
    }

    public static function get_media_category_bg($media){
        if (empty($media))
            return false;

        $bg_color = get_field('media_category_color', $media);
        if (empty($bg_color))
            return false;

        return sprintf('background-%s', $bg_color);
    }

    public static function get_media_category_link($media){
        if (empty($media))
            return false;

        $media_file = get_field('media_file', $media);
        $media_file_link = $media_file['url'];
        $videourl = get_field('video_file', $media);

        if (empty($media_file_link) && empty($videourl))
            return false;

        if (!empty($media_file_link)){
            $url = $media_file_link;
        } else if (!empty($videourl)){
            $url = $videourl;
        }

        return sprintf('<a target="_blank" rel="noopener" href="%s">', $url);
        
    }

}