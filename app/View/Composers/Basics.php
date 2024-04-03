<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class Basics extends Composer
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

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
            // 'allBasics' => $this->allBasics(),
        ];
    }

    // All posts on Basics
    // public function allBasics()
    // {
    //     $the_query = new WP_Query(array(
    //         'post_type'            => 'basics',
    //         'posts_per_page'    => -1,
    //     ));

    //     return $the_query;
    // }
}
