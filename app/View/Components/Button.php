<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Button extends Component
{
    /**
     * The button title.
     *
     * @var string
     */
    public $title;

    /**
     * The button link.
     *
     * @var string
     */
    public $link;

    /**
     * The button target.
     */
    public $target;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($title = null, $link = null, $target = null)
    {
        $this->title = $title;
        $this->link = $link;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.button');
    }
}
