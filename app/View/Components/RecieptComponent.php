<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecieptComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $paymentId;
    public function __construct($paymentId)
    {
      $this->paymentId = $paymentId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      return view('components.reciept-component');
    }
}
