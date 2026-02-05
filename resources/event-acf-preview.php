<?php

/**
 * Force ACF to load values from the autosave revision during preview,
 * even if templates pass the parent event ID to get_field().
 *
 */
add_filter('acf/pre_load_post_id', function ($post_id) {

    if (!is_preview()) {
        return $post_id;
    }

    // If the preview URL contains preview_id, force ACF to load from it
    if (!empty($_GET['preview_id']) && is_numeric($_GET['preview_id'])) {
        $preview_id = (int) $_GET['preview_id'];

        // Make sure preview_id is a revision whose parent is an event
        $parent_id = wp_is_post_revision($preview_id);
        if ($parent_id && get_post_type((int) $parent_id) === 'event') {
            return $preview_id;
        }
    }

    // Fallback: original logic (handles cases without preview_id)
    if (!is_numeric($post_id)) {
        return $post_id; // e.g. "options"
    }

    $pid = (int) $post_id;

    // If ACF is already asking for a revision, allow it ONLY if parent is event
    $parent_id = wp_is_post_revision($pid);
    if ($parent_id) {
        if (get_post_type((int) $parent_id) === 'event') {
            return $pid;
        }
        return $post_id;
    }

    // Only process events
    if (get_post_type($pid) !== 'event') {
        return $post_id;
    }

    // User specific autosave lookup
    $autosave = wp_get_post_autosave($pid, get_current_user_id());
    if ($autosave && !empty($autosave->ID)) {
        return (int) $autosave->ID;
    }

    return $post_id;
}, 10, 1);

/**
 * AJAX: Create autosave for ACF fields preview (events only).
 * => Writes ACF meta to the autosave revision.
 */
add_action('wp_ajax_create_preview_autosave', function () {

    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'Not logged in'], 401);
    }

    check_ajax_referer('event_preview_autosave', 'nonce');

    $parent_id = isset($_POST['post_ID']) ? (int) $_POST['post_ID'] : 0;
    if (!$parent_id) {
        wp_send_json_error(['message' => 'Missing post_ID'], 400);
    }

    if (get_post_type($parent_id) !== 'event') {
        wp_send_json_error(['message' => 'Not an event'], 400);
    }

    if (!current_user_can('edit_post', $parent_id)) {
        wp_send_json_error(['message' => 'Forbidden'], 403);
    }

    // Include autosave-related helpers
    if (!function_exists('wp_create_post_autosave')) {
        require_once ABSPATH . 'wp-admin/includes/post.php';
    }

    $autosave_id = wp_create_post_autosave($parent_id);

    if (is_wp_error($autosave_id) || empty($autosave_id)) {
        wp_send_json_error(['message' => 'Autosave failed'], 500);
    }

    // Save ACF fields into the autosave revision meta
    if (function_exists('acf_save_post') && !empty($_POST['acf']) && is_array($_POST['acf'])) {
        static $running = false;
        if (!$running) {
            $running = true;

            $orig_post_id = $parent_id;
            $_POST['post_ID'] = (int) $autosave_id;
            acf_save_post((int) $autosave_id);
            $_POST['post_ID'] = $orig_post_id;

            $running = false;
        }
    }

    // Generate preview URL
    $base = get_permalink($parent_id);

    $preview_url = add_query_arg([
        'preview_id' => (int) $autosave_id,
        'preview_nonce' => wp_create_nonce('post_preview_' . (int) $autosave_id),
        'preview' => 'true',
    ], $base);

    wp_send_json_success([
        'autosave_id' => (int) $autosave_id,
        'preview_url' => $preview_url,
    ]);
});

/**
 * Enqueue JS for autosave during preview on event edit screen.
 */
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true))
        return;

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || $screen->post_type !== 'event')
        return;

    // Register script
    wp_enqueue_script(
        'event-preview-autosave',
        get_stylesheet_directory_uri() . '/assets/scripts/event-preview-autosave.js',
        ['jquery'],
        '1.0.0',
        true
    );

    // Pass urls and nonce to JS via EventPreviewAutosave object
    wp_localize_script('event-preview-autosave', 'EventPreviewAutosave', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('event_preview_autosave'),
    ]);
});