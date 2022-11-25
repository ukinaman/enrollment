<?php

namespace App\View\Components;

use App\Models\SemestralFee;
use Illuminate\View\Component;

class FullPaymentSumarry extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $course;
    public $year;
    public $sem;

    public function __construct($course, $year, $sem)
    {
      $this->course = $course;
      $this->year = $year;
      $this->sem = $sem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $sem_fees = SemestralFee::all();
      return view('components.full-payment-sumarry', compact('sem_fees'));
    }
}
