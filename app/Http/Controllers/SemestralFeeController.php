<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Course;
use App\Models\SemestralFee;
use Illuminate\Http\Request;

class SemestralFeeController extends Controller
{
    public function index()
    {
        $sem_fees = SemestralFee::with('fees')->get();
        return view('backend.accounting.semestral-fee.index', compact('sem_fees'));
    }

    public function create()
    {
        $sem_fees = SemestralFee::all();
        $courses = Course::all();
        return view('backend.accounting.semestral-fee.create', compact('sem_fees', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sem_fee_id' => 'required',
            'exclusiveTo' => 'required',
            'amount' => 'numeric'
        ]);

        Fee::create([
            'name' => $request->name,
            'sem_fee_id' => $request->sem_fee_id,
            'exclusiveTo' => $request->exclusiveTo,
            'amount' => $request->amount,
        ]);

        $semfee = SemestralFee::find($request->sem_fee_id);
        $semfee->total_amount += $request->amount;
        $semfee->update();

        return redirect()->route('semfee.index')->with('success', 'Data saved successfully!');
    }

    public function edit($id)
    {
        $sem_fees = SemestralFee::all();
        $courses = Course::all();
        $fee = Fee::find($id);

        return view('backend.accounting.semestral-fee.edit', compact('sem_fees', 'courses', 'fee'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'sem_fee_id' => 'required',
            'exclusiveTo' => 'required',
            'amount' => 'numeric'
        ]);

        $fee = Fee::find($id);
        $semfee = SemestralFee::find($fee->sem_fee_id);

        $semfee->total_amount -= $fee->amount;
        $semfee->update();

        $fee->update([
            'name' => $request->name,
            'sem_fee_id' => $request->sem_fee_id,
            'exclusiveTo' => $request->exclusiveTo,
            'amount' => $request->amount,
        ]);

        $semfee->total_amount += $request->amount;
        $semfee->update();

        return redirect()->route('semfee.index')->with('success', 'Data updated successfully!');
    }

    public function show($val)
    {
        // $sem_fees = SemestralFee::where('exclusiveTo','=',0)->get();
        // $sem_fees = SemestralFee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$val)->with(['fees' => function ($query) use($val) {
        //     $query->where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$val);
        // }])->get();

        $fees = Fee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$val)->get();
        
        // dd($fees);

        foreach($fees as $fee)
        {
            dd($fee->totalTuition($val, 1, 1));
        }

        // $course = Course::where('id','=',$val)->first();
        // dd($course->totalUnits(1,1));
        return view('backend.accounting.assessment.index', compact('sem_fees', 'courses'));
    }
}
