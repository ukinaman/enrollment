<?php

namespace App\View\Components;

use App\Models\Discount;
use App\Models\Enrollment;
use Illuminate\View\Component;
use App\Models\StudentDiscount;

class ManageDiscountForm extends Component
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
      $enrollee_discounts = StudentDiscount::where('enrollment_id','=',$this->enrollee)->with('discount')->get();
      $enrollment = Enrollment::where('id','=',$this->enrollee)->first();
      return view('components.manage-discount-form', compact('discounts', 'enrollee_discounts', 'enrollment'));
    }
}
