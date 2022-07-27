<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\SemestralFee;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
  public function index($id)
  {
    $enrollee = Enrollment::where('id','=',$id)->with('course')->first();
    $sem_fees = SemestralFee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$enrollee->course_id)->with(['fees' => function ($query) use($enrollee) {
        $query->where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$enrollee->course_id);
    }])->get();
    return view('backend.accounting.payment.index', compact('enrollee', 'sem_fees'));
  }
}
