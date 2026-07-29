<?php
/**
 * Performance optimizations.
 */

defined('ABSPATH') || exit;

remove_action(
    'wp_head',
    'wp_generator'
);

add_filter(
    'emoji_svg_url',
    '__return_false'
);

add_filter(
    'use_block_editor_for_post',
    '__return_false'
);
