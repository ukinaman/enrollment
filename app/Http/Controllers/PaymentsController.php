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
    return view('backend.accounting.payment.index', compact('enrollee'));
  }
}
