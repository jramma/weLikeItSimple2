<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;
/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    // Enqueue the main bundle
    bundle('app')->enqueue();

    // Prepare an array to hold your localized script data
    $script_data = array(
        'ajaxurl' => admin_url('admin-ajax.php')
    );
    // Check if WP_ENV is defined and add it to the script data
    if (env('WP_ENV') !== false) {
        $script_data['wp_env'] = env('WP_ENV'); // in .js you can use basics.wp_env
    }
    // Check if ICL_LANGUAGE_CODE is defined for multilingual support
    if (defined("ICL_LANGUAGE_CODE")) {
        $script_data['language'] = ICL_LANGUAGE_CODE; // in .js you can use basics.language
    }
    // Localize the script with your data
    bundle('app')->enqueue()->localize('basics', $script_data);
}, 100);


/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);
