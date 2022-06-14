<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Student;
use App\Models\Semester;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('course')->get();
        return view('backend.registrar.students.index', compact('students'));
    }

    public function create()
    {
        $courses = Course::all();
        $years = Year::all();
        $semesters = Semester::all();
        return view('student.enroll', compact('courses', 'years', 'semesters'));
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
        ]);

        $student = Student::create([
            'course_id' => $request->course_id,
            'year_id' => $request->year_id,
            'sem_id' => $request->sem_id,
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

        return redirect()->route('student.assessment', $student->id);
    }

    public function assessment($id)
    {
        $student = Student::where('id','=',$id)->first();
        $sem = $student->sem_id;
        $year = $student->year_id;
        $course = Course::where('id','=',$student->course_id)->with(['subjects' => function ($query) use($sem, $year) {
            $query->where([['sem_id','=',$sem], ['year_id','=',$year]]);
        }])->first();
        return view('student.assesment', compact('student', 'course'));
    }
}
