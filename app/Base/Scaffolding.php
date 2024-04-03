<?php

namespace App\Base;

use StoutLogic\AcfBuilder\FieldBuilder;

class Scaffolding extends Base
{

    function boot()
    {

        /**
         * Cutom options pages
         */
        add_action('acf/init', function () {
            // Theme Settings
            $parent = acf_add_options_page(array(
                'page_title'  => __('Theme Settings', 'basics'),
                'menu_title'  => __('Theme Settings', 'basics'),
                'menu_slug' => 'theme-settings',
                'redirect'    => true,
                'icon_url' => 'dashicons-admin-settings',
                'position' => '41',
            ));

            // Header & Footer
            acf_add_options_sub_page(array(
                'page_title'  => '🖥 ' . __('Header & Footer', 'basics'),
                'menu_title'  => '🖥 ' . __('Header & Footer', 'basics'),
                'menu_slug' => 'header-footer',
                'parent_slug' => $parent['menu_slug'],
            ));

            $header = new \StoutLogic\AcfBuilder\FieldsBuilder('header-footer', [
                'title' => __('Header & Footer', 'basics'),
            ]);
            $header
                ->addTab('header', [
                    'label' => __('Header', 'basics'),
                ])
                ->addImage('header_logo', [
                    'label' => 'Img logo',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ])
                ->addTab('footer', [
                    'label' => __('Footer', 'basics'),
                ])
                ->addText('footer_title')
                ->addWysiwyg(
                    'footer_text',
                    [
                        'media_upload' => 0,
                        'toolbar' => 'title',
                        'delay' => 1,
                    ]
                )
                ->addText('footer_social_title')
                ->addRepeater('footer_repeater_social', [
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
                ->endRepeater()
                ->setLocation('options_page', '==', 'header-footer');

            \acf_add_local_field_group($header->build());

            // Privacy policy
            acf_add_options_sub_page(array(
                'page_title'  => '🔒 ' . __('Privacy', 'basics'),
                'menu_title'  => '🔒 ' . __('Privacy', 'basics'),
                'menu_slug' => 'privacy',
                'parent_slug' => $parent['menu_slug'],
            ));

            $privacy = new \StoutLogic\AcfBuilder\FieldsBuilder('privacy', [
                'title' => __('Privacy', 'basics'),
            ]);
            $privacy
                ->addEmail('email_contact', [
                    'label' => __('Contact Email', 'basics'),
                    'description' => __('This email will be used to send the contact form.', 'basics'),
                ])
                ->addTab('first_layers', [
                    'label' => __('First layers', 'basics'),
                ])
                ->addWysiwyg('contact_first_privacy_layer', [
                    'label' => __('Contact', 'basics'),
                    'media_upload' => 0,
                    'toolbar' => 'basic',
                ])
                ->addWysiwyg('newsletter_first_privacy_layer', [
                    'label' => __('Newsletter', 'basics'),
                    'media_upload' => 0,
                    'toolbar' => 'basic',
                ])
                ->setLocation('options_page', '==', 'privacy');

            \acf_add_local_field_group($privacy->build());

            // Page 404
            acf_add_options_sub_page(array(
                'page_title'  => '❌ ' . __('Page 404', 'basics'),
                'menu_title'  => '❌ ' . __('Page 404', 'basics'),
                'menu_slug' => 'page-404',
                'parent_slug' => $parent['menu_slug'],
            ));
        });
    }
}
