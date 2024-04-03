<?php

/**
 * Cutom post types
 */

namespace App\Base;

abstract class Base
{
    const OBJECT_NAME = 'base';

    public function __construct()
    {
        add_action('init', [$this, 'register']);
        $this->boot();
    }

    public function boot()
    {
    }

    public function register()
    {
    }

    public static function get_object_name()
    {
        return static::OBJECT_NAME;
    }
}
