<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Semester;
use App\Models\SemestralFee;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        $course = 0;
        $year = 0;
        $sem = 0;
        return view('backend.accounting.assessment.index', compact('course', 'year','sem' ));
    }

    public function show(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'year' => 'required',
            'sem' => 'required'
        ]);
        
        $course = $request->course;
        $year = $request->year;
        $sem = $request->sem;

        $sem_fees = SemestralFee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$course)->with(['fees' => function ($query) use($course) {
            $query->where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$course);
        }])->get();

        // dd($course, $year, $sem);

        return view('backend.accounting.assessment.show', compact('sem_fees', 'course', 'year', 'sem'));
    }
}
