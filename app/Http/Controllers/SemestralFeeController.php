<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Year;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\SemestralFee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $year = !empty(Session::get('data')['year']) ? Session::get('data')['year'] : 0;
        $sem = !empty(Session::get('data')['semester']) ? Session::get('data')['semester'] : 0;

        $courses = Course::all();
        $years = Year::all();
        $semesters = Semester::all();
        $sem_fees = SemestralFee::all();

        $course_accronym = Course::where('id','=',$course)->pluck('accronym')->first();
        $year_title = Year::where('id','=',$year)->pluck('title')->first();
        $semester_title = Semester::where('id','=',$sem)->pluck('title')->first();

        Session::put('data', [
          'course' => $course, 
          'year' => $year, 
          'semester' => $sem,
          'course_name' => $course_accronym,
          'year_name' => $year_title,
          'semester_name' => $semester_title
        ]);

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

        // return view('backend.accounting.semestral-fee.create')->with('success', 'Data saved successfully!');
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
            'amount' => 'numeric'
        ]);

        $fee = Fee::find($id);

        $fee->update([
            'name' => $request->name,
            'sem_fee_id' => $request->sem_fee_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('semfee.show.fees', ['course' => $fee->course_id, 'year' => $fee->year_id, 'sem' => $fee->sem_id])->with('success', 'Data updated successfully!');
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

      $course_name = $courses->where('id','=',$course)->pluck('title')->first();
      $year_name = $years->where('id','=',$year)->pluck('title')->first();
      $sem_name = $semesters->where('id','=',$sem)->pluck('title')->first();

      Session::put('data', [
        'course_name' => $course_name,
        'year_name' => $year_name,
        'semester_name' => $sem_name
      ]);

      return view('backend.accounting.semestral-fee.table', compact('sem_fees','courses', 'years','semesters','course','year','sem'));
    }

    public function goToFees($course, $year, $sem)
    {
      $courses = Course::all();
      $years = Year::all();
      $semesters = Semester::all();

      $sem_fees = SemestralFee::with(['fees' => function($query) use($course, $year, $sem){
        $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
      }])->get();

      $course = $course;
      $year = $year;
      $sem = $sem;

      $course_name = $courses->where('id','=',$course)->pluck('title')->first();
      $year_name = $years->where('id','=',$year)->pluck('title')->first();
      $sem_name = $semesters->where('id','=',$sem)->pluck('title')->first();

      Session::put('data', [
        'course_name' => $course_name,
        'year_name' => $year_name,
        'semester_name' => $sem_name
      ]);

      return view('backend.accounting.semestral-fee.table', compact('sem_fees','courses', 'years','semesters','course','year','sem'));
    }

    public function delete($id)
    {
      $fee = Fee::find($id);
      $fee->delete();

      return redirect()->route('semfee.show.fees', ['course' => $fee->course_id, 'year' => $fee->year_id, 'sem' => $fee->sem_id])->with('success', 'Data updated successfully!');
    }

    public function print($course, $year, $sem)
    {
      return view('backend.accounting.semestral-fee.print', compact('course', 'year', 'sem'));
    }

    public function download(Request $request, $course, $year, $sem)
    {
      $subjects = Subject::where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]])->get();
      $sem_fees = SemestralFee::with(['fees' => function($query) use($course, $year, $sem){
        $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
      }])->get();

      $school_year = $request->school_year;
      $course_name = Course::where('id','=',$course)->pluck('title')->first();
      $course_accronym = Course::where('id','=',$course)->pluck('accronym')->first();
      $year_name = Year::where('id','=',$year)->pluck('title')->first();
      $sem_name = Semester::where('id','=',$sem)->pluck('title')->first();

      $year_sem = $year_name.'-'.$sem_name;

      $filename = $course_accronym.'-'.$year_sem.'-'.$school_year.'-'.'assessment.pdf';

      // $pdf = Pdf::loadView('backend.pdf.semfee', compact('course', 'year', 'sem', 'subjects', 'sem_fees', 'school_year', 'course_name', 'year_sem'))->setOptions(['defaultFont' => 'sans-serif', 'dpi' => 150])->setPaper('a4', 'portrait');
      // return $pdf->download($filename);

      // return view('backend.pdf.semfee', compact('course', 'year', 'sem', 'subjects', 'sem_fees', 'school_year', 'course_name', 'year_sem'));
    }
}
