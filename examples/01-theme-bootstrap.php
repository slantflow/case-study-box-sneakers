<?php
/**
 * BOX Sneakers Theme Bootstrap
 *
 * Simplified example extracted from the production theme.
 */

defined('ABSPATH') || exit;

$modules = [
    'setup',
    'assets',
    'helpers',
    'performance',
    'security',
    'woocommerce',
];

foreach ($modules as $module) {

    $file = get_template_directory() . "/inc/{$module}.php";

    if (file_exists($file)) {
        require_once $file;
    }

}
