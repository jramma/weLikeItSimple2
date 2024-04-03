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
 * Post Model.
 */
class Post extends Base
{
    const OBJECT_NAME = 'post';

    public function register()
    {
        // Pages already registered
    }

    public function boot()
    {
        // $this->register_fields();
    }

    public static function allowed_blocks()
    {
        $prefix = 'acf/';;
        return [
            'core/paragraph',
            'core/heading',
            'core/html',
            'core/image',
            'core/list',
            'core/quote',

            $prefix . BasicsBlock::OBJECT_NAME,
        ];
    }

    // public static function register_fields()
    // {
    // \add_action('acf/init', function () {
    //     $fields = new FieldsBuilder('post_data', [
    //         'title' => __('Camps específics - Noticies d\'Actualitat', 'basics'),
    //     ]);
    //     $fields
    //         ->addLink('custom_link', [
    //             'label' => __('Enllaç extern a la noticia', 'basics'),
    //             'return_format' => 'url',
    //         ])
    //         ->addTrueFalse('disable_authors', [
    //             'label' => __('Disable authors', 'basics'),
    //             'default_value' => false,
    //             'ui' => true,
    //         ]);

    //     // $fields->setLocation('page_type', '==', 'posts_page');
    //     $fields->setLocation('post_type', '==', 'post');

    //     return \acf_add_local_field_group($fields->build());
    // });
    // }
}

new Post();
