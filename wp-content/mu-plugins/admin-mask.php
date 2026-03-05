<?php
/**
 * Plugin Name: Robust Admin Mask
 * Description: Completely hides wp-login.php and wp-admin from direct access.
 */

if (!defined('ABSPATH'))
    exit;

define('CUSTOM_ADMIN_SLUG', 'yonetim');
define('ADMIN_MASK_SECRET', 'prestige_v1_secure');

/**
 * Block direct GET access to wp-login.php (but allow POST for form submissions)
 */
add_action('init', function () {
    global $pagenow;

    if ($pagenow === 'wp-login.php') {
        // Allow if the secret token is present
        if (isset($_GET[ADMIN_MASK_SECRET])) {
            return;
        }
        // Allow POST requests (login form submissions)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return;
        }
        // Block everything else
        wp_die('Bu sayfa bulunamadı.', '404 Not Found', array('response' => 404));
    }
});

/**
 * Override WordPress login URL to use the custom slug
 */
add_filter('login_url', function ($login_url, $redirect, $force_reauth) {
    $custom_url = site_url('/' . CUSTOM_ADMIN_SLUG . '/');
    if (!empty($redirect)) {
        $custom_url = add_query_arg('redirect_to', urlencode($redirect), $custom_url);
    }
    if ($force_reauth) {
        $custom_url = add_query_arg('reauth', '1', $custom_url);
    }
    return $custom_url;
}, 10, 3);

/**
 * Override the login form action URL
 */
add_filter('site_url', function ($url, $path) {
    if ($path === 'wp-login.php' || strpos($path, 'wp-login.php') === 0) {
        return site_url('/' . CUSTOM_ADMIN_SLUG . '/');
    }
    return $url;
}, 10, 2);

/**
 * Redirect wp-admin access for non-logged-in users to custom login
 */
add_action('admin_init', function () {
    if (!is_user_logged_in()) {
        wp_redirect(site_url('/' . CUSTOM_ADMIN_SLUG . '/'));
        exit;
    }
});
