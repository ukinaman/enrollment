<?php

namespace App\View\Components;

use App\Models\Enrollment;
use App\Models\SemestralFee;
use Illuminate\View\Component;

class FullPaymentInvoice extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $enrolleeId;

    public function __construct($enrolleeId)
    {
      $this->enrolleeId = $enrolleeId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $enrollee = Enrollment::where('id','=',$this->enrolleeId)->with('course')->first();
      $sem_fees = SemestralFee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$enrollee->course_id)->with(['fees' => function ($query) use($enrollee) {
          $query->where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$enrollee->course_id);
      }])->get();
      return view('components.full-payment-invoice', compact('enrollee', 'sem_fees'));
    }
}
