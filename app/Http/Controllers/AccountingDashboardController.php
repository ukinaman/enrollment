<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Student;
use App\Models\Discount;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\Downpayment;
use App\Models\SemestralFee;
use Illuminate\Http\Request;
use App\Models\ModeOfPayment;
use App\Models\StudentPayment;
use App\Models\StudentDiscount;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountingDashboardController extends Controller
{
  public function selectTransaction()
  {
    return view('backend.accounting.dashboard.selection');
  }

  public function index(){
    $courses = Course::all();
    $years = Year::all();
    $semesters = Semester::all();
    $mop = ModeOfPayment::all();
    return view('backend.accounting.dashboard.index', compact('courses', 'years', 'semesters', 'mop'));
  }

  public function existing()
  {
    return view('backend.accounting.dashboard.students');
  }

  public function existingEnrollPage($id)
  {
    $student = Student::where('id','=',$id)->first();
    $courses = Course::all();
    $years = Year::all();
    $semesters = Semester::all();
    $mop = ModeOfPayment::all();

    if($student->hasBalance($id))
    {
      return redirect()->back()->with('hasbalance', 'This student has unpaid balance from the last semester');
    } else {
      return view('backend.accounting.dashboard.existing', compact('student','courses', 'years', 'semesters', 'mop'));
    }

  }

  public function existingStudentStore(Request $request, $id)
  {
    $request->validate([
      'course_id' => 'required',
      'year_id' => 'required',
      'sem_id' => 'required',
      'units' => 'required',
      'rle' => 'required',
      'mode' => 'required',
    ]);

    $discount = Discount::where('mop_id','=',$request->mode)->first();
    $student = Student::where('id','=',$id)->first();
    
    $enrollment = Enrollment::create([
      'student_id' => $id,
      'course_id' => $request->course_id,
      'year_id' => $request->year_id,
      'sem_id' => $request->sem_id,
      'units' => $request->units,
      'rle' => $request->rle,
      'mop_id' => $request->mode,
      'discount' => $discount ? $discount->percentage : 0
    ]);

    $tuition = $enrollment->getEnrolleeTuition($enrollment->id);
    $enrollment_amount = $enrollment->enrolleeOverallTotalWithDiscount($enrollment->id);

    if($request->mode == 1)
    {      
      $percentage = $discount->percentage;
      $discount_total = ($tuition * $percentage) / 100;
      $total = $enrollment_amount - $discount_total;
      $student->update([
        'balance' => $total
      ]);
    } else if($request->mode == 2) {
      $student->update([
        'balance' => $enrollment_amount
      ]);
    }

    if($request->mode == 1)
    {
      StudentDiscount::create([
        'student_id' => $id,
        'enrollment_id' => $enrollment->id,
        'discount_id' => $discount->id
      ]);
    }

    return redirect()->route('enrollee.show', $enrollment->id);
  }

  public function store(Request $request)
  {

    $request->validate([
      'firstname' => 'required',
      'middlename' => 'required',
      'lastname' => 'required',
      'birthplace' => 'required',
      'age' => 'required|integer',
      'birthday' => 'required',
      'gender' => 'required',
      'email' => 'required|unique:students,email',
      'contact_no' => 'required',
      'course_id' => 'required',
      'year_id' => 'required',
      'sem_id' => 'required',
      'units' => 'required',
      'rle' => 'required',
      'mode' => 'required',
    ]);

    $discount = Discount::where('mop_id','=',$request->mode)->first();

    $student = Student::create([
      'firstname' => $request->firstname,
      'middlename' => $request->middlename,
      'lastname' => $request->lastname,
      'birthplace' => $request->birthplace,
      'age' => $request->age,
      'birthday' => $request->birthday,
      'gender' => $request->gender,
      'email' => $request->email,
      'contact_no' => $request->contact_no
    ]);

    $enrollment = Enrollment::create([
      'student_id' => $student->id,
      'course_id' => $request->course_id,
      'year_id' => $request->year_id,
      'sem_id' => $request->sem_id,
      'units' => $request->units,
      'rle' => $request->rle,
      'mop_id' => $request->mode,
      'discount' => $discount ? $discount->percentage : 0
    ]);

    $tuition = $enrollment->getEnrolleeTuition($enrollment->id);
    $enrollment_amount = $enrollment->enrolleeOverallTotalWithDiscount($enrollment->id);

    if($request->mode == 1)
    {      
      $percentage = $discount->percentage;
      $discount_total = ($tuition * $percentage) / 100;
      $total = $enrollment_amount - $discount_total;
      $student->update([
        'balance' => $total
      ]);
    } else if($request->mode == 2) {
      $student->update([
        'balance' => $enrollment_amount
      ]);
    }

    if($request->mode == 1)
    {
      StudentDiscount::create([
        'student_id' => $student->id,
        'enrollment_id' => $enrollment->id,
        'discount_id' => $discount->id
      ]);
    }

    return redirect()->route('enrollee.show', $enrollment->id);
  }

  public function download($id)
  {
    $payment = StudentPayment::where('id','=',$id)->first();
    $enrollee = Enrollment::where('id','=',$payment->enrollment_id)->first();
    $school_year = $enrollee->getCurrentAcademicYear();
    $course_name = Course::where('id','=',$enrollee->course_id)->pluck('title')->first();
    $year_name = Year::where('id','=',$enrollee->year_id)->pluck('title')->first();
    $sem_name = Semester::where('id','=',$enrollee->sem_id)->pluck('title')->first();
    $or_number = $payment->or_number;
    $year_sem = $year_name.'-'.$sem_name;

    $sem_fees = SemestralFee::with(['fees' => function($query) use($enrollee){
      $query->where([['course_id','=',$enrollee->course_id], ['year_id','=',$enrollee->year_id], ['sem_id','=',$enrollee->sem_id]]);
    }])->get();

    $pdf = Pdf::loadView('backend.pdf.reciept', compact('enrollee','course_name', 'school_year', 'year_sem', 'payment', 'or_number', 'sem_fees'))->setOptions(['defaultFont' => 'sans-serif', 'dpi' => 150])->setPaper('a4', 'portrait');
    return $pdf->download('reciept.pdf');

    // return view('backend.pdf.reciept', compact('enrollee','course_name', 'school_year', 'year_sem', 'payment', 'or_number', 'sem_fees'));
  }
}
