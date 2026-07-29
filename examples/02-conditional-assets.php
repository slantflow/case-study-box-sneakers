<?php
/**
 * Conditional asset loading.
 */

defined('ABSPATH') || exit;

function box_enqueue_assets(): void
{
    wp_enqueue_style(
        'box-main',
        box_asset('css/app.css'),
        [],
        null
    );

    if (is_product()) {

        wp_enqueue_style(
            'box-product',
            box_asset('css/product.css'),
            [],
            null
        );

        wp_enqueue_script(
            'box-product',
            box_asset('js/product.js'),
            [],
            null,
            true
        );

    }
}

add_action(
    'wp_enqueue_scripts',
    'box_enqueue_assets'
);
