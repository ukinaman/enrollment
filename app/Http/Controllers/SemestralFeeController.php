<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Year;
use App\Models\Course;
use App\Models\Semester;
use App\Models\SemestralFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SemestralFeeController extends Controller
{
    public function index()
    {
        $sem_fees = SemestralFee::with('fees')->get();
        $courses = Course::all();
        return view('backend.accounting.semestral-fee.index', compact('sem_fees', 'courses'));
    }

    public function create($course, $year, $sem)
    {
        $paramCourse = $course;
        $courses = Course::all();
        $years = Year::All();
        $semesters = Semester::all();
        $sem_fees = SemestralFee::all();
        return view('backend.accounting.semestral-fee.create', compact('courses', 'years','semesters','sem_fees', 'paramCourse'));
    }

    public function store(Request $request)
    {
        $request->validate([
          'sem_fee_id' => 'required',
          'course' => 'required',
          'year' => 'required',
          'sem' => 'required',
          'name' => 'required',
          'amount' => 'numeric'
        ]);

        Fee::create([
            'name' => $request->name,
            'sem_fee_id' => $request->sem_fee_id,
            'course_id' => $request->course,
            'year_id' => $request->year,
            'sem_id' => $request->sem,
            'amount' => $request->amount,
        ]);

        $course = Course::where('id','=',$request->get('course'))->first();
        $year = Year::where('id','=',$request->get('year'))->first();
        $semester = Semester::where('id','=',$request->get('sem'))->first();
        
        Session::put('data', [
          'course' => $course->id, 
          'year' => $year->id, 
          'semester' => $semester->id,
          'course_name' => $course->accronym,
          'year_name' => $year->title,
          'semester_name' => $semester->title
        ]);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function edit($id)
    {
        $sem_fees = SemestralFee::all();
        $courses = Course::all();
        $fee = Fee::find($id);

        return view('backend.accounting.semestral-fee.edit', compact('sem_fees', 'courses', 'fee'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'sem_fee_id' => 'required',
            'exclusiveTo' => 'required',
            'amount' => 'numeric'
        ]);

        $fee = Fee::find($id);
        $semfee = SemestralFee::find($fee->sem_fee_id);

        $semfee->total_amount -= $fee->amount;
        $semfee->update();

        $fee->update([
            'name' => $request->name,
            'sem_fee_id' => $request->sem_fee_id,
            'exclusiveTo' => $request->exclusiveTo,
            'amount' => $request->amount,
        ]);

        $semfee->total_amount += $request->amount;
        $semfee->update();

        return redirect()->route('semfee.index')->with('success', 'Data updated successfully!');
    }

    public function show($id)
    {
        $course = $id;
        return view('backend.accounting.semestral-fee.show', compact('course'));
    }

    public function fees(Request $request)
    {
      $course = $request->course;
      $year = $request->year;
      $sem = $request->sem;

      $courses = Course::all();
      $years = Year::all();
      $semesters = Semester::all();

      $sem_fees = SemestralFee::with(['fees' => function($query) use($course, $year, $sem){
        $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
      }])->get();
      return view('backend.accounting.semestral-fee.table', compact('sem_fees','courses', 'years','semesters','course','year','sem'));
    }
}
