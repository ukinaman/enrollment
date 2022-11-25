<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Semester;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Imports\SubjectsImport;

class SubjectController extends Controller
{
    public function index()
    {
        $course = 0;
        $year = 0;
        $sem = 0;
        return view('backend.registrar.subject.index', compact('course', 'year', 'sem'));
    }

    public function create()
    {
        $course = Course::find()->first();
        return view('backend.registrar.subject.create', compact('course'));
    }

    public function show(Request $request)
    {
        $subjects = Subject::where([['course_id','=',$request->course],['year_id','=',$request->year],['sem_id','=',$request->sem]])->get();

        $course = $request->course;
        $year = $request->year;
        $sem = $request->sem;

        return view('backend.registrar.subject.show', compact('subjects', 'course', 'year', 'sem'));
    }

    public function getUploadView()
    {
        return view('backend.registrar.subject.upload');
    }

    // public function uploadSubjects(Request $request)
    // {
    //     if($request->hasFile('file')){
    //         $file = $request->file('file');
    //         $filename = $file->getClientOriginalName();
    //         $path1 = $request->file->storeAs('document',$filename);
    //         $path=storage_path('app').'/'.$path1;  
    //         (new SubjectsImport)->import($path);
    //         return redirect()->route('subject.index')->with('success', 'Subjects Imported Successfully');
    //     }
    //     dd('error');
    // }
}
