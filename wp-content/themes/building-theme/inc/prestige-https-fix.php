<?php
/**
 * Plugin Name: Prestige Core Options
 */

/**
 * Fix mixed content to enforce HTTPS on media
 */
function prestige_fix_mixed_content($url) {
    if (is_ssl() || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
        $url = str_replace('http://', 'https://', $url);
    }
    return $url;
}
add_filter('wp_get_attachment_url', 'prestige_fix_mixed_content');
add_filter('theme_mod_header_logo', 'prestige_fix_mixed_content');
add_filter('the_content', 'prestige_fix_mixed_content');
