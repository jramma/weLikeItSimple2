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
                ->addRepeater('social_media', [
                    'label' => __('Social Media', 'basics'),
                    'layout' => 'block',
                    'button_label' => __('Add Social Media', 'basics'),
                ])
                ->addSelect('social_media', [
                    'label' => __('Social Media', 'basics'),
                    'choices' => [
                        'instagram' => __('Instagram', 'basics'),
                        'facebook' => __('Facebook', 'basics'),
                        'twitter' => __('Twitter', 'basics'),
                    ],
                    'wrapper' => [
                        'width' => '50',
                    ],
                ])
                ->addUrl('social_media_link', [
                    'label' => __('Social Media Link', 'basics'),
                    'wrapper' => [
                        'width' => '50',
                    ],
                ])
                ->endRepeater()
                ->addTab('footer', [
                    'label' => __('Footer', 'basics'),
                ])
                ->addRepeater('footer_logos', [
                    'label' => __('Logos', 'basics'),
                    'layout' => 'block',
                    'button_label' => __('Add Logo', 'basics'),
                ])
                ->addImage('logo', [
                    'label' => __('Logo', 'basics'),
                    'return_format' => 'id',
                ])
                ->endRepeater()
                ->addText('footer_contact_title', [
                    'label' => __('Footer Text', 'basics'),
                ])
                ->addWysiwyg('footer_contact_text', [
                    'label' => __('Footer Text', 'basics'),
                    'media_upload' => 0,
                    'toolbar' => 'basic',
                ])
                ->addText('footer_newsletter_title', [
                    'label' => __('Newsletter Title', 'basics'),
                ])
                ->addTextarea('footer_newsletter_text', [
                    'label' => __('Newsletter Text', 'basics'),
                    'new_lines' => 'br',
                ])
                ->addLink('footer_newsletter_button', [
                    'label' => __('Newsletter Button', 'basics'),
                ])
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
