<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageWithDefault extends Component
{

    public $src;
    public $default;

    public function __construct($src = null, $default = 'default.png')
    {
        $this->src = $src;
        $this->default = $default;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-with-default');
    }
}
