<?php

namespace App\Http\Controllers;

use App\Models\YearLevel;
use App\Models\Course;
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
            'course_duration' => 'required'
        ]);

        $course = Course::create([
            'title' => $request->title,
            'accronym' => $request->accronym,
            'description' => $request->description
        ]);

        for($i = 0; $i < $request->course_duration; $i++)
        {
            YearLevel::create([
                'course_id' => $course->id,
                'level' => $i+1
            ]);
        }

        return redirect()->route('courses.index');
    }
}
