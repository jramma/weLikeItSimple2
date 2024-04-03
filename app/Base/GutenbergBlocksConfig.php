<?php

/**
 * GutenbergBlocksConfig class file.
 *
 * @package App\Providers
 */

namespace App\Base;

use function App\getRegisteredModels;

class GutenbergBlocksConfig extends Base
{

    public function boot()
    {
        $this->match_blocks_with_post_types();
        $this->remove_buttons_from_wysiwyg_toolbar();
    }

    /**
     * Allowed blocks
     */
    public function match_blocks_with_post_types()
    {

        $registeredModels = getRegisteredModels();
        $allowed_blocks_method = 'allowed_blocks';

        foreach ($registeredModels as $key => $model) {

            if (method_exists($model, $allowed_blocks_method)) {
                \add_filter(
                    'allowed_block_types_all',
                    function ($block_types, $block_editor_context) use ($model) {
                        $allowed_blocks_method = 'allowed_blocks';
                        $post = $block_editor_context->post;
                        if ($post) {
                            $templateName = get_page_template_slug($post->ID);
                            if ($post->post_type == ($model)::get_object_name()) {
                                return (!is_array($block_types))
                                    ? (new $model)->{$allowed_blocks_method}($templateName)
                                    : array_merge(
                                        (new $model)->{$allowed_blocks_method}($templateName),
                                        $block_types
                                    );
                            }
                        }
                        return $block_types;
                    },
                    99,
                    2
                );
            }
        }
    }

    public function remove_buttons_from_wysiwyg_toolbar()
    {
        add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {

            $toolbars['simple'] = array();
            $toolbars['simple'][1] = array('bold', 'italic', 'underline', 'link');

            $toolbars['title'] = array();
            $toolbars['title'][1] = array('bold');

            // return $toolbars - IMPORTANT!
            return $toolbars;
        });
    }
}
