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
        $subjects = Year::with(['subjects' => function ($query) use($id) {
            $query->where('course_id','=',$id);
        }])->get();
        // dd($subjects);
        return view('backend.registrar.courses.show', compact('subjects'));
    }
}
