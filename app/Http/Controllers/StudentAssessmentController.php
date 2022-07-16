<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentAssessmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student')->paginate(10);
        // dd($enrollments);
        return view('backend.registrar.assessment.index', compact('enrollments'));
    }

    public function show($id)
    {
        return view('backend.registrar.assessment.show');
    }
}
