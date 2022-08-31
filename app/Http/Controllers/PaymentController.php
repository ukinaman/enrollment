<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\StudentPayment;

class PaymentController extends Controller
{
  public function pay(Request $request, $id){
    
    $enrollee = Enrollment::where('id','=',$id)->first();

    $std_payment = new StudentPayment();

    $balance = $std_payment->getEnrolleeBalance($enrollee->id, $request->amount);

    $std_payment->create([
      'enrollment_id' => $enrollee->id,
      'term' => $request->term,
      'payment_method' => $request->payment_method,
      'or_number' => $enrollee->getORNumber(),
      'amount' => $request->amount,
      'balance' => $balance
    ]);

    return redirect()->back()->with('success', 'Payment successfull!');
  }
}
