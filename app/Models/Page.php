<?php

/**
 * Post class file.
 *
 * @package App\Models
 */

namespace App\Models;

use App\Base\Base;
use App\Blocks\BasicsBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Page Model.
 */
class Page extends Base
{
    const OBJECT_NAME = 'page';

    public function register()
    {
        // Pages already registered
    }

    /**
     * Page Type
     *
     * @var string
     */
    public static $object_name = 'page';

    public function boot()
    {
        // $this->register_fields();
    }


    /**
     * Gutenberg blocks allowed in this page type.
     *
     *  / \
     * / ! \ If it's a block registered using Advaced Custom Field's registration
     *       method (acf_register_block_type()) its post_types setting must
     *       contain also the name of this post type.
     *
     * @return  array  List of Gutenberg blocks allowed for this post type
     */
    public static function allowed_blocks($template = null)
    {
        $prefix = 'acf/';

        // Get id of front page
        $front_page_id = get_option('page_on_front');
        $id = get_the_ID();

        if ($front_page_id == $id) {
            $template = 'front-page';
        }

        $blocksAvailableToAllPages = [
            'core/html',
            'core/image',
            'core/heading',
            'core/paragraph',
            'core/list',
            'core/numbered-list',
            'core/quote',
            'core/table',

            $prefix . BasicsBlock::OBJECT_NAME,
        ];

        switch ($template) {
            case "template-basics.blade.php":
                return array_merge(
                    // $blocksAvailableToAllPages,
                    [
                        'core/html',
                        $prefix . BasicsBlock::OBJECT_NAME,
                    ]
                );
                break;

            default:
                return $blocksAvailableToAllPages;
        }
    }

    // public static function register_fields()
    // {

    //     /* Template basics
    //      *
    //      * https://github.com/Log1x/acf-builder-cheatsheet
    //      *
    //      */
    //     \add_action('acf/init', function () {
    //         $basicsTemplate = new FieldsBuilder('template_basics_data', [
    //             'title' => __('Basics data', 'mantle')
    //         ]);

    //         $basicsTemplate
    //             ->addTab('main_info', [
    //                 'label' => __('Main info', 'basics'),
    //             ])
    //             ->setLocation('page_template', '==', 'template-basics.blade.php');


    //         return \acf_add_local_field_group($basicsTemplate->build());
    //     });
    // }
}

new Page();
