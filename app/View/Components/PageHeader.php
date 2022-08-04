<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $buttonType; 
    public $buttonTitle;
    public $routeName;
    public $enrollee;
    
    public function __construct($title, $buttonType, $buttonTitle, $routeName, $enrollee)
    {
        $this->title = $title;
        $this->buttonType = $buttonType;
        $this->buttonTitle = $buttonTitle;
        $this->routeName = $routeName;
        $this->enrollee = $enrollee;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-header');
    }
}
