<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Downpayment;
use Illuminate\Http\Request;

class DownpaymentController extends Controller
{
  public function index()
  {
    $downpayments = Downpayment::all();
    return view('backend.accounting.downpayment.index', compact('downpayments'));
  }

  public function create()
  {
    $courses = Course::all();
    return view('backend.accounting.downpayment.create', compact('courses'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'course' => 'required',
      'amount' => 'numeric'
    ]);

    Downpayment::create([
      'course_id' => $request->course,
      'amount' => $request->amount
    ]);

    return redirect()->back()->with('success', 'Data saved successfully!');
  }

  public function edit($id)
  {
    $downpayment = Downpayment::find($id);
    $courses = Course::all();
    return view('backend.accounting.downpayment.edit', compact('downpayment','courses'));
  }

  public function update(Request $request, $id)
  { 
    $request->validate([
      'course' => 'required',
      'amount' => 'numeric'
    ]);

    Downpayment::where('id','=',$id)->update([
      'course_id' => $request->course,
      'amount' => $request->amount
    ]);

    return redirect()->route('downpayment.index')->with('udpaye', 'Data udpated successfully!');
  }

  public function delete($id)
  {
    $downpayment = Downpayment::find($id);
    $downpayment->delete();

    return redirect()->route('downpayment.index')->with('deleye', 'Data deleted successfully!');
  }
}
