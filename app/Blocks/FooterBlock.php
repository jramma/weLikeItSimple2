<?php

namespace App\Blocks;

use App\Models\Page;
use App\Models\Post;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FooterBlock extends Block
{

    const OBJECT_NAME = 'footer-block';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Footer Block';

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
    public $description = 'A simple Footer Block block.';

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
        $basicsBlock = new FieldsBuilder('footer_block');

        $basicsBlock
            ->addText('title')
            ->addWysiwyg(
                'text_footer',
                [
                    'media_upload' => 0,
                    'toolbar' => 'title',
                    'delay' => 1,
                ]
            )
            ->addText('social_title')
            ->addRepeater('repeater_social', [
                'label' => 'Repeater Social',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'select_icon',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
            ])
            ->addSelect('select_icon', [
                'label' => 'Social Icon',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => [
                    'instagram' => 'Instagram',
                    'behance' => 'Behance',
                    'twitter' => 'Twitter',
                ],
                'default_value' => [],
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'return_format' => 'value',
                'placeholder' => '',
            ])
            ->addUrl('url_social', [
                'label' => 'URL social media',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
            ])
            ->endRepeater();


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
