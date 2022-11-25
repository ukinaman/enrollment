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

        if($request->discount[$item] == 1)
        {
          $enrollee->update([
            'mop_id' => $request->discount[$item]
          ]);
        }

        $discountTotal += $discount;
      }

      $currentDiscount = $enrollee->discount;
      $newDiscount =  $currentDiscount + $discountTotal;

      $enrollee->update([
        'discount' => $newDiscount
      ]);

      return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function deleteDiscount(Request $request, $id)
    {
      $enrollee = Enrollment::find($id);

      foreach ($request->discount as $item => $key) {

        $discount = StudentDiscount::where('id','=',$request->discount[$item])->first();

        if($discount->discount_id == 1)
        {
          $enrollee->update([
            'mop_id' => 2
          ]);
        }

        $discount->delete();

      }

      return redirect()->back()->with('delete', 'Discount removed successfully!');
    }
}
