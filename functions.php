<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'basics'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (!function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'basics'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'basics'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters', 'models', 'base'])
    ->each(function ($file) {
        if (!locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'basics'), $file)
            );
        }
    });

// TODO: Test this
/**
 * Register and define the settings
 */
// add_action('admin_init', 'prfx_admin_init');
// function prfx_admin_init()
// {

//     // register our setting
//     $args = array(
//         'type' => 'string',
//         'sanitize_callback' => 'sanitize_text_field',
//         'default' => NULL,
//     );
//     register_setting(
//         'reading', // option group "reading", default WP group
//         'my_basics_archive_page', // option name
//         $args
//     );

//     // add our new setting
//     add_settings_field(
//         'my_basics_archive_page', // ID
//         __('Basics Archive Page', 'textdomain'), // Title
//         'prfx_setting_callback_function', // Callback
//         'reading', // page
//         'default', // section
//         array('label_for' => 'my_basics_archive_page')
//     );
// }

// /**
//  * Custom field callback
//  */
// function prfx_setting_callback_function($args)
// {
//     // get saved project page ID
//     $project_page_id = get_option('my_basics_archive_page');

//     // get all pages
//     $args = array(
//         'posts_per_page'   => -1,
//         'orderby'          => 'name',
//         'order'            => 'ASC',
//         'post_type'        => 'page',
//     );
//     $items = get_posts($args);

//     echo '<select id="my_basics_archive_page" name="my_basics_archive_page">';
//     // empty option as default
//     echo '<option value="0">' . __('— Select —', 'wordpress') . '</option>';

//     // foreach page we create an option element, with the post-ID as value
//     foreach ($items as $item) {

//         // add selected to the option if value is the same as $project_page_id
//         $selected = ($project_page_id == $item->ID) ? 'selected="selected"' : '';

//         echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
//     }

//     echo '</select>';
// }

// /**
//  * Add custom state to post/page list
//  */
// add_filter('display_post_states', 'prfx_add_custom_post_states');

// function prfx_add_custom_post_states($states)
// {
//     global $post;

//     // get saved project page ID
//     $project_page_id = get_option('my_basics_archive_page');

//     // add our custom state after the post title only,
//     // if post-type is "page",
//     // "$post->ID" matches the "$project_page_id",
//     // and "$project_page_id" is not "0"
//     if ('page' == get_post_type($post->ID) && $post->ID == $project_page_id && $project_page_id != '0') {
//         $states[] = __('Basics Archive Page', 'textdomain');
//     }

//     return $states;
// }
/*
* Adding SVG as images in Wordpress
*
* Wp v4.7.1 and higher
*/
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'fix_svg');
