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
    public $role;
    public function __construct($role)
    {
      $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      if($this->role == 'Accounting')
      {
        $enrollees = Enrollment::where('assessed','=',1)->with('student')->orderBy('created_at', 'DESC')->get();
      } else {
        $enrollees = Enrollment::where('assessed','=',0)->with('student')->orderBy('created_at', 'DESC')->get();
      }
      
      return view('components.to-acomodate-enrollees', compact('enrollees'));
    }
}
