<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Student;
use App\Models\Discount;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\Downpayment;
use Illuminate\Http\Request;
use App\Models\ModeOfPayment;
use App\Models\StudentDiscount;
use App\Models\StudentAccountAssesment;

class StudentController extends Controller
{
    public function index()
    {
        $enrollees = Enrollment::with('student', 'course')->get();
        return view('backend.registrar.students.index', compact('enrollees'));
    }

    public function create()
    {
        $courses = Course::all();
        $years = Year::all();
        $semesters = Semester::all();
        return view('student.pick-course', compact('courses', 'years', 'semesters'));
    }

    public function storeCourse(Request $request)
    {
      $request->validate([
          'course' => 'required',
          'year' => 'required',
          'sem' => 'required',
      ]);

      $enrollment = Enrollment::create([
        'course_id' => $request->course,
        'year_id' => $request->year,
        'sem_id' => $request->sem,
        'discount' => 0
      ]);

      return redirect()->route('student.register.create', [
        'enrollment_id' => $enrollment->id,
      ])->with('success', 'Data saved successfuly!');
    }

    public function createResgister($enrollment_id)
    {
      return view('student.register', compact('enrollment_id'));
    }

    public function storeStudent(Request $request, $enrollment_id)
    {
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'birthplace' => 'required',
            'age' => 'required|integer',
            'birthday' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'citizenship' => 'required',
            'marital_status' => 'required',
            'email' => 'required|unique:students,email',
            'contact_no' => 'required',
        ]);

        $student = Student::create([
          'firstname' => $request->firstname,
          'middlename' => $request->middlename,
          'lastname' => $request->lastname,
          'birthplace' => $request->birthplace,
          'age' => $request->age,
          'birthday' => $request->birthday,
          'gender' => $request->gender,
          'address' => $request->address,
          'citizenship' => $request->citizenship,
          'marital_status' => $request->marital_status,
          'email' => $request->email,
          'contact_no' => $request->contact_no
        ]);

        $enrollment = Enrollment::where('id','=',$enrollment_id)->update([
          'student_id' => $student->id,
          'discount' => 0
        ]);

        return redirect()->route('student.mop.create', ['enrollment_id' => $enrollment_id]);
    }

    public function createMop($enrollment_id)
    {
      $enrollee = Enrollment::find($enrollment_id)->with('course')->first();
      $mop = ModeOfPayment::all();
      $downpayment = Downpayment::where('course_id','=',$enrollee->course_id)->first();
      return view('student.mop', compact('enrollment_id', 'mop', 'downpayment', 'enrollee'));
    }

    public function storeMop(Request $request, $enrollment_id)
    {
      $discount = Discount::where('mop_id','=',$request->mode)->first();
      $enrollee = Enrollment::where('id','=',$enrollment_id)->first();

      $enrollee->update([
        'mop_id' => $request->mode,
        'discount' => $discount ? $discount->percentage : 0
      ]);
      
      if($request->mode == 1)
      {
        StudentDiscount::create([
          'student_id' => $enrollee->student_id,
          'enrollment_id' => $enrollee->id,
          'discount_id' => $discount->id
        ]);
      }

      return redirect()->route('student.assessment', ['enrollment_id' => $enrollment_id, 'table' => 'subjects'])->with('success', 'Your enrollment is being processed.');
    }

    public function assessment($enrollment_id, $table)
    {
      $enrollment = Enrollment::find($enrollment_id);
      $student = Student::where('id','=',$enrollment->student_id)->first();
      $sem = $enrollment->sem_id;
      $year = $enrollment->year_id;
      $course = Course::where('id','=',$enrollment->course_id)->with(['subjects' => function ($query) use($sem, $year) {
          $query->where([['sem_id','=',$sem], ['year_id','=',$year]]);
      }])->first();

      if($table == 'subjects')
      {
        return view('student.subjects', compact('student', 'course', 'enrollment', 'table'));
      }
      else if($table == 'semestral-fee')
      {
        return view('student.semestralfees', compact('student', 'course', 'enrollment', 'table'));
      }
      
    }
}
