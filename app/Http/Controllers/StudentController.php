<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Student;
use App\Models\Discount;
use App\Models\Semester;
use App\Models\Enrollment;
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
        $mode_of_payment = ModeOfPayment::all();
        return view('student.enroll', compact('courses', 'years', 'semesters', 'mode_of_payment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'year_id' => 'required',
            'sem_id' => 'required',
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
            'mop' => 'required'
        ]);

        $discount = Discount::where('mop_id','=',$request->mop)->first();

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
        
        $enrollment = Enrollment::create([
          'student_id' => $student->id,
          'course_id' => $request->course_id,
          'year_id' => $request->year_id,
          'sem_id' => $request->sem_id,
          'mop_id' => $request->mop,
          'discount' =>  $discount ? $discount->percentage : 0
        ]);

        return redirect()->route('student.assessment', ['id' => $enrollment->id, 'year' => $enrollment->year_id, 'sem' => $enrollment->sem_id]);
    }

    public function assessment($id, $year, $sem)
    {
        $student = Student::where('id','=',$id)->first();
        $enrollment = Enrollment::find($id);
        // dd($enrollment);
        $course = Course::where('id','=',$enrollment->course_id)->with(['subjects' => function ($query) use($sem, $year) {
            $query->where([['sem_id','=',$sem], ['year_id','=',$year]]);
        }])->first();
        return view('student.assesment', compact('student', 'course', 'enrollment'));
    }
}
