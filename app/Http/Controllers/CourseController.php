<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Subject;
use App\Models\YearLevel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('backend.registrar.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('backend.registrar.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'accronym' => 'required|string|max:5',
            'description' => 'required',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'accronym' => $request->accronym,
            'description' => $request->description
        ]);

        return redirect()->route('courses.index');
    }

    public function show($id)
    {
      $data = Course::where('id','=',$id)->first();

      $course = $data->id;
      $year = 0;
      $sem = 0;

      return view('backend.registrar.courses.show', compact('course', 'year', 'sem'));
    }

    public function getSubject(Request $request)
    {
      $subjects = Subject::where([['course_id','=',$request->course],['year_id','=',$request->year],['sem_id','=',$request->sem]])->get();

      $course = $request->course;
      $year = $request->year;
      $sem = $request->sem;

      return view('backend.registrar.subject.show', compact('subjects', 'course', 'year', 'sem'));
    }
}
