<?php

namespace App\View\Components;

use App\Models\Enrollment;
use App\Models\StudentPayment;
use Illuminate\View\Component;

class StudentPaymentComponent extends Component
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
      $enrollee = Enrollment::where('id','=',$this->enrolleeId)->first();
      $student_payments = StudentPayment::where('enrollment_id','=',$this->enrolleeId)->get();
      return view('components.student-payment-component', compact('enrollee', 'student_payments'));
    }
}
