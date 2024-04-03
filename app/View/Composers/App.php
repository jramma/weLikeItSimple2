<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'languages' => $this->languages(),
            'header_logo' => get_field('header_logo', 'option'),
            'footer_title' => get_field('footer_title', 'option'),
            'footer_text' => get_field('footer_text', 'option'),
            'footer_social_title' => get_field('footer_social_title', 'option'),
            'footer_repeater_social' => get_field('footer_repeater_social', 'option'),

        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    // Languages
    public function languages()
    {
        return apply_filters('wpml_active_languages', null, 'skip_missing=0');
    }
}
