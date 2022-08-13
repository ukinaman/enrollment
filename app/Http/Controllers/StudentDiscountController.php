<?php

namespace App\Http\Controllers;

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
        $discountTotal += $request->discount[$item];
      }

      $currentDiscount = $enrollee->discount;
      $newDiscount =  $currentDiscount + $discountTotal;

      $enrollee->update([
        'discount' => $newDiscount
      ]);

      return redirect()->back()->with('success', 'Data saved successfully!');
    }
}
