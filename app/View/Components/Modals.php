<?php

namespace App\View\Components;

use App\Models\Discount;
use Illuminate\View\Component;

class Modals extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $enrollee;
    public function __construct($enrollee)
    {
      $this->enrollee = $enrollee;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $discounts = Discount::all();
      return view('components.modals', compact('discounts'));
    }
}
