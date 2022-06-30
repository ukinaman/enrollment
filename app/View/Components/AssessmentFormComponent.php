<?php

namespace App\View\Components;

use App\Models\Year;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\View\Component;

class AssessmentFormComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $courses = Course::all();
        $years = Year::all();
        $semesters = Semester::all();
        return view('components.assessment-form-component', compact('courses', 'years', 'semesters'));
    }
}
