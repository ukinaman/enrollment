<?php

namespace App\View\Components;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\View\Component;

class CourseSubjects extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;

    public function __construct($enrollmentId)
    {
        $this->id = $enrollmentId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $enrollment = Enrollment::find($this->id);
        $course = Course::find($enrollment->course_id);
        return view('components.course-subjects', compact('enrollment', 'course'));
    }
}
