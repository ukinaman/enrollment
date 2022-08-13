<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\UnabledSubject;

class StudentAssessmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student')->orderBy('created_at', 'DESC')->paginate(10);
        // dd($enrollments);
        return view('backend.registrar.assessment.index', compact('enrollments'));
    }

    public function show($id)
    {
        $enrollment = Enrollment::find($id);
        return view('backend.registrar.assessment.show', compact('enrollment'));
    }

    /**
     * This function gets the subjects that is unabled to take
     * by the student for the current semester he/she is enrolling
     * 
     * enrollment_id
     * subject_id
     */
    public function store(Request $request, $id)
    {
        
        if($request->unabled_subject){
            foreach ($request->unabled_subject as $item => $key) {
                UnabledSubject::create([
                    'enrollment_id' => $id,
                    'subject_id' => $request->unabled_subject[$item],
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ]);
            }
    
            Enrollment::find($id)->update([
                'assessed' => 1
            ]);
        }

        Enrollment::find($id)->update([
            'assessed' => 1
        ]);

        return redirect()->route('registrar.assessment.index')->with('success', 'Data saved successfully!');
    }
}
