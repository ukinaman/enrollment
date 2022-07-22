<?php

namespace App\View\Components;

use App\Models\Enrollment;
use Illuminate\View\Component;

class ToAcomodateEnrollees extends Component
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
        $enrollees = Enrollment::where('assessed','=',0)->with('student')->orderBy('created_at', 'DESC')->get();
        return view('components.to-acomodate-enrollees', compact('enrollees'));
    }
}
