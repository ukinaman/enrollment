<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('backend.registrar.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('backend.registrar.courses.create');
    }
}
