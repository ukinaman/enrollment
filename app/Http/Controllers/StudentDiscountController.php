<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\StudentDiscount;

class StudentDiscountController extends Controller
{
    public function addDiscount(Request $request, $id)
    {
      $enrollee = Enrollment::find($id);
      $discountTotal = 0;

      foreach ($request->discount as $item => $key) {

        StudentDiscount::create([
          'student_id' => $enrollee->student_id,
          'enrollment_id' => $enrollee->id,
          'discount_id' => $request->discount[$item]
        ]);

        $discount = Discount::where('id','=',$request->discount[$item])->pluck('percentage')->first();

        $discountTotal += $discount;
      }

      $currentDiscount = $enrollee->discount;
      $newDiscount =  $currentDiscount + $discountTotal;

      $enrollee->update([
        'discount' => $newDiscount
      ]);

      return redirect()->back()->with('success', 'Data saved successfully!');
    }
}
