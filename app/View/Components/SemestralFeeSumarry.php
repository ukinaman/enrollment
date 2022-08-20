<?php

namespace App\View\Components;

use App\Models\SemestralFee;
use Illuminate\View\Component;

class SemestralFeeSumarry extends Component
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
      $course = $this->course;
      $year =  $this->year;
      $sem = $this->sem;
      
      $sem_fees = SemestralFee::with(['fees' => function($query) use($course, $year, $sem){
        $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
      }])->get();
        return view('components.semestral-fee-sumarry', compact('sem_fees'));
    }
}
