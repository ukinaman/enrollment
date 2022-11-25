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
    public $route;
    public $course_id;
    public $year_id; 
    public $sem_id;
    public $model;

    public function __construct($route, $course, $year, $sem, $model)
    {
        $this->route = $route;
        $this->course_id = $course;
        $this->year_id = $year;
        $this->sem_id = $sem;
        $this->model = $model;
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
