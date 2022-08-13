<?php

namespace App\View\Components;

use App\Models\Enrollment;
use Illuminate\View\Component;

class StudentsTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $enrollments = Enrollment::with('student')->orderBy('created_at', 'DESC')->paginate(10);
        return view('components.students-table', compact('enrollments'));
    }
}
