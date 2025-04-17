<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Friend;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $friends;
    public function __construct()
    {
        $this->friends = Friend::where('user_id', auth()->id())->get();
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.app.sidebar');

    }
}
