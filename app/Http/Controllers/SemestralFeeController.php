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
        $courses = Course::all();
        return view('backend.accounting.semestral-fee.index', compact('sem_fees', 'courses'));
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

    public function show($id)
    {
        $sem_fees = SemestralFee::with(['fees' => function($query) use($id){
          $query->where('exclusiveTo','=',$id);
        }])->get();
        return view('backend.accounting.semestral-fee.show', compact('sem_fees'));
    }
}
