<?php

namespace App\View\Components;

use App\Models\Enrollment;
use App\Models\SemestralFee;
use Illuminate\View\Component;

class EnrolleeSemestralFeeSummary extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $course;
    public $year;
    public $sem;
    public $enrollee;

    public function __construct($course, $year, $sem, $enrollee)
    {
      $this->course = $course;
      $this->year = $year;
      $this->sem = $sem;
      $this->enrollee = $enrollee;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $course = $this->course;
      $year =  $this->year;
      $sem = $this->sem;
      
      $enrollment = Enrollment::where('id','=',$this->enrollee)->first();
      $sem_fees = SemestralFee::with(['fees' => function($query) use($course, $year, $sem){
        $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
      }])->get();
      
      return view('components.enrollee-semestral-fee-summary', compact('sem_fees', 'enrollment'));
    }
}
