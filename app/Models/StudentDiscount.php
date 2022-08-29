<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDiscount extends Model
{
  use HasFactory;

  protected $fillable = ['student_id','enrollment_id','discount_id'];

  public function student()
  {
    return $this->belongsTo(Student::class, 'student_id');
  }

  public function enrollment()
  {
    return $this->belongsTo(Enrollment::class, 'enrollment_id');
  }

  public function discount()
  {
    return $this->belongsTo(Discount::class, 'discount_id');
  }

  public function getPercentage($enrollment_id)
  {
    $percentage_total = 0;
    $std_discounts = $this->where('enrollment_id','=',$enrollment_id)->get();

    foreach($std_discounts as $std_discount){
      $discount_percentage = Discount::where('id','=',$std_discount->discount_id)->pluck('percentage')->first();
      $percentage_total += $discount_percentage;
    }
    
    return $percentage_total;
  }
}
;