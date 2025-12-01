<?php

$contacts = get_sub_field('selected_contacts');

/**
 * Helper method to normalize time strings.
 * e.g. "9", "9.5", "09:30", "9:3" => "09.00", "09.30", "09.30", "09.03"
 */
if (!function_exists('ihh_normalize_time')) {
    function ihh_normalize_time($t)
    {
        $t = trim((string) $t);
        if ($t === '') {
            return '';
        }
        $t = str_replace('.', ':', $t);
        if (preg_match('/^\d{1,2}$/', $t)) {
            // Only hour
            return sprintf('%02d.00', (int) $t);
        }
        if (preg_match('/^(\d{1,2}):(\d{1,2})$/', $t, $m)) {
            // h:mm OR hh:m
            return sprintf('%02d.%02d', (int) $m[1], (int) $m[2]);
        }
        return $t;
    }
}
?>

<div class="contact-blocks ihhce">
    <?php if ($contacts): ?>
    <ul class="ihhce">
        <?php foreach ($contacts as $contact): ?>
        <?php
        // Get contact data
        $contact_id = is_object($contact) ? $contact->ID : (int) $contact;
        $post = get_post($contact_id);
        setup_postdata($post);

        // Contact details
        $contact_details = get_field('contact_details', $contact_id) ?: [];
        $email = $contact_details['email'] ?? '';
        $phone = $contact_details['phone'] ?? '';
        $sanitized_phone = $phone ? preg_replace('/[^0-9+]/', '', $phone) : '';

        $desc = get_field('description__info', $contact_id);
        $has_desc = $desc && trim(strip_tags($desc)) !== '';

        $settings = get_field('contact_settings', $contact_id) ?: [];
        $head_bg = $settings['header_background_color'] ?? '';
        $cont_bg = $settings['content_background_color'] ?? '';

        // Opening hours (repeater)
        $hours = get_field('opening_hours', $contact_id);
        ?>
        <li class="ihhce">
            <div class="contact-header" <?php if ($head_bg) {
                echo 'style="background-color: ' . esc_attr($head_bg) . ';"';
            } ?>>
                <h2 class="contact-heading"><?php echo esc_html(get_the_title($contact_id)); ?></h2>
            </div>

            <div class="contact-content" <?php if ($cont_bg) {
                echo 'style="background-color: ' . esc_attr($cont_bg) . ';"';
            } ?>>
                <?php if ($has_desc): ?>
                <div class="contact-description">
                    <?php echo apply_filters('the_content', $desc); ?>
                </div>
                <?php endif; ?>

                <?php if ($email || $phone): ?>
                <div class="contact-details">
                    <?php if ($email): ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                            stroke="currentColor" className="size-6">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <?php echo esc_html($email); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ($phone): ?>
                    <a href="tel:<?php echo esc_attr($sanitized_phone); ?>">
                        <svg class="phone" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            strokeWidth={1.5} stroke="currentColor" className="size-6">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="contact-opening-hours">
                    <?php if ($hours && is_array($hours)): ?>
                    <h3><?php echo esc_html(pll__('Opening hours')); ?></h3>
                    <ul class="opening-hours">
                        <?php foreach ($hours as $row): ?>
                        <?php
                        $days = isset($row['days']) ? $row['days'] : '';
                        $open = !empty($row['is_open']);
                        $from = ihh_normalize_time($row['opening_time'] ?? '');
                        $to = ihh_normalize_time($row['closing_time'] ?? '');
                        ?>
                        <li class="opening-hours__row">
                            <span class="opening-hours__days"><?php echo esc_html($days); ?></span>
                            <?php if (!$open): ?>
                            <span class="opening-hours__status opening-hours__status--closed">
                                <?php echo esc_html(pll__('Closed')); ?>
                            </span>
                            <?php else: ?>
                            <span class="opening-hours__time">
                                <?php if ($from || $to) {
                                    echo esc_html(trim($from . ' – ' . $to, ' –'));
                                } ?>
                            </span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
    </ul>
    <?php endif; ?>
</div>