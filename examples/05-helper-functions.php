<?php
/**
 * BOX Sneakers Helper Functions
 */

defined('ABSPATH') || exit;

/**
 * Build a versioned asset URL using file modification time.
 */
function box_asset(string $relative_path): string
{
    $path = get_template_directory() . '/assets/' . ltrim($relative_path, '/');

    if (! file_exists($path)) {
        return '';
    }

    return add_query_arg(
        'ver',
        filemtime($path),
        get_template_directory_uri() . '/assets/' . ltrim($relative_path, '/')
    );
}
