<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use App\Models\SemestralFee;
use Illuminate\Http\Request;

class EnrolleeAssessmentController extends Controller
{
    public function index()
    {
        $course = 0;
        $year = 0;
        $sem = 0;

        $enrollees = Enrollment::where('assessed','=',1)->paginate(10);
        return view('backend.accounting.enrollees.index', compact('enrollees', 'course', 'year','sem'));
    }

    public function show($id)
    {
        $enrollee = Enrollment::where('id','=',$id)->with('course')->first();
        $sem_fees = SemestralFee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$enrollee->course_id)->with(['fees' => function ($query) use($enrollee) {
            $query->where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$enrollee->course_id);
        }])->get();
        return view('backend.accounting.enrollees.show', compact('sem_fees', 'enrollee'));
    }
}
