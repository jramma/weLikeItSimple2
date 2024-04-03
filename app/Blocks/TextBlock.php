<?php

namespace App\Blocks;

use App\Models\Page;
use App\Models\Post;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TextBlock extends Block
{

    const OBJECT_NAME = 'text-block';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Text Block';

    /**
     * The block slug.
     *
     * @var string
     */
    public $slug = self::OBJECT_NAME;

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple text Block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'text';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'editor-ul';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [
        Page::OBJECT_NAME,
        Post::OBJECT_NAME,
    ];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'edit';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [

    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [

    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return $this->modifyFields();
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $basicsBlock = new FieldsBuilder('text_block');

        $basicsBlock
            ->addText('title')
            ->addWysiwyg(
                'text',
                [
                    'media_upload' => 0,
                    'toolbar' => 'title',
                    'delay' => 1,
                ]
            )
           ;

        return $basicsBlock->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function modifyFields()
    {
        $fields = get_fields();

        if ($fields) {
            // $fields['text'] = preg_replace('#<p(.*?)>(.*?)</p>#is', '$2<br/>', $fields['text']);
            // $fields['text'] = strip_tags($fields['text'], '<br>');
            return $fields;
        }
        return [];

        // return get_field('items') ?: $this->example['items'];
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
