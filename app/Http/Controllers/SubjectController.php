<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Semester;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Imports\SubjectsImport;

class SubjectController extends Controller
{
    public function index()
    {
        // $course = Course::find($id)->first();
        $subjects = Subject::with('course','year','semester')->get();
        return view('backend.registrar.subject.index', compact('subjects'));
    }

    public function create()
    {
        $course = Course::find()->first();
        return view('backend.registrar.subject.create', compact('course'));
    }

    public function getUploadView()
    {
        return view('backend.registrar.subject.upload');
    }

    public function uploadSubjects(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path1 = $request->file->storeAs('document',$filename);
            $path=storage_path('app').'/'.$path1;  
            (new SubjectsImport)->import($path);
            return redirect()->route('subject.index')->with('success', 'Subjects Imported Successfully');
        }
        dd('error');
    }
}
