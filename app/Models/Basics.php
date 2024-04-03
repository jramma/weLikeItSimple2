<?php

/**
 * Cutom post types
 */

namespace App\Models;

use App\Base\Base;
use App\Blocks\BasicsBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Basics extends Base
{
    const OBJECT_NAME = 'basics';

    public function register()
    {
        register_extended_post_type(
            'basics',
            [
                'has_archive' => true,
                'rewrite' => ['slug' => 'basics'],
                'supports' => ['title', 'thumbnail', 'page-attributes', 'editor', 'excerpt'],
                'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg fill="none" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M9.952 2.004c2.087.001 4.143.162 6.084 1.046 1.887.86 3.188 2.22 3.812 4.224.203.654.238 1.266-.117 1.86-.282.47-.304.937-.058 1.416.425.83.28 1.629-.06 2.447-1.089 2.62-3.147 4.01-5.825 4.54-.663.132-1.4-.014-2.087-.128a22.6 22.6 0 0 0-3.75-.293c-2.966.001-5.595-2.034-6.449-4.886-.112-.373-.373-.707-.597-1.037-.146-.216-.365-.38-.527-.587-.475-.608-.523-.964-.026-1.574.53-.651.847-1.366 1.082-2.165.376-1.273 1.158-2.3 2.245-3.058C5.322 2.66 7.12 1.95 9.163 2.003c.262.007.526.001.789.001Zm8.347 7.736c.15-.36.257-.695.423-.998.215-.39.21-.758.074-1.174-.434-1.337-1.194-2.442-2.44-3.088-.898-.465-1.866-.915-2.85-1.065-1.578-.242-3.196-.305-4.797-.305-1.656 0-3.121.683-4.452 1.645-.828.6-1.477 1.374-1.75 2.354-.262.946-.596 1.824-1.24 2.57-.02.024.021.101.021.102 1.666-.11 3.32-.235 4.977-.325 1.75-.094 3.496-.164 5.25.056.919.115 1.865.023 2.799.015.667-.006 1.336-.066 2-.031.662.035 1.319.159 1.985.244Zm-16.665.357c.34.648.717 1.15.879 1.715.696 2.419 2.972 4.242 5.494 4.233a25.98 25.98 0 0 1 4.099.322c2.399.373 4.294-.581 5.743-2.44.863-1.109 1.342-2.344.545-3.728-.027-.046-.08-.077-.234-.217-.698.048-1.518.044-2.317.175-1.122.183-2.225.483-3.342.704-1.647.326-3.327.546-4.945.004-1.927-.646-3.91-.58-5.921-.768Z" fill="currentColor"/><path d="M13.011 7.43c-.299-.033-.422-.022-.527-.062-1.06-.402-2.048-.275-3.013.32-.684.422-1.489.446-2.214.238-1.136-.327-2.23-.383-3.353.01.874-.75 1.89-.783 2.946-.628.431.063.865.164 1.296.153.368-.009.778-.072 1.093-.25 1.256-.705 2.452-.6 3.772.218ZM16.213 5.821c-.67-.558-1.374-.648-2.148-.31-.581.254-1.167.138-1.701-.109-.833-.385-1.682-.658-2.613-.652.797-.402 1.592-.303 2.363.012.728.297 1.426.395 2.207.15.845-.266 1.46.061 1.892.909ZM16.508 12.376c-1.192.074-2.384.15-3.576.22a2.01 2.01 0 0 1-.524-.026c-.977-.205-1.953-.346-2.95-.043.578-.494 1.263-.612 1.962-.602 1.34.02 2.68.082 4.02.136.368.015.734.061 1.101.094l-.033.221ZM11.564 15.54c-.869-.204-1.734-.422-2.607-.606-.567-.12-1.142-.252-1.717-.269-.851-.025-1.585-.311-2.257-.858.2.045.397.106.6.13.633.074 1.266.166 1.902.193 1.493.063 2.787.712 4.131 1.218l-.053.192Z" fill="currentColor"/></svg>'),
                'show_in_rest' => true,
                'rest_base' => 'basics',
            ],
            [
                'singular' => 'Basics',
                'plural'   => 'Basics',
                'slug'     => 'basics',
            ]
        );
        // register_extended_taxonomy('basics_cat', 'basics', [], [
        //     'singular' => 'Basics',
        //     'plural'   => 'Basics',
        //     'slug'     => 'basics-cat',
        // ]);
    }

    public function boot()
    {
        $this->basics_options_page();
    }

    public static function allowed_blocks()
    {
        $prefix = 'acf/';
        return [
            'core/html',
            'core/image',
            // Custom blocks
            $prefix . BasicsBlock::OBJECT_NAME,
        ];
    }

    /*
     *
     * Registrar options page de basics
     *
     */
    public static function basics_options_page()
    {
        \add_action(
            'acf/init',
            function () {

                \acf_add_options_page(
                    array(
                        'page_title' => "🗂 " . __("Opcions", "basics"),
                        'menu_slug' => 'pagina-basics',
                        'menu_title' => "🗂 " . __("Opcions", "basics"),
                        'parent_slug' => 'edit.php?post_type=basics',
                    )
                );

                $fields = new FieldsBuilder('options_basics');
                $fields
                    ->addTab('hero', [
                        'label' => __('Capçelera', 'basics'),
                    ])
                    ->setLocation('options_page', '==', 'pagina-basics');

                return \acf_add_local_field_group($fields->build());
            }
        );
    }
}

new Basics();
