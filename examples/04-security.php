<?php
/**
 * Security hardening.
 */

defined('ABSPATH') || exit;

if (! defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

remove_action(
    'wp_head',
    'rsd_link'
);

remove_action(
    'wp_head',
    'wlwmanifest_link'
);
