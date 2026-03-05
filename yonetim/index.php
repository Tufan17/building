<?php
/**
 * Custom Admin Entry Point
 * This file serves as the hidden login gateway.
 * Access via: /build.com/yonetim/
 */

// Set the secret token so the MU plugin allows access
$_GET['prestige_v1_secure'] = '1';

// Load wp-login.php from the parent directory
require_once dirname(__DIR__) . '/wp-login.php';
