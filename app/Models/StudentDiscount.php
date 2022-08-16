<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    // $total = $this->discount()->sum('percentage');
    // dd($total);
    $total = $this->where('enrollment_id','=',$enrollment_id)->with(['discount', function($query) {
      $query->sum('percentage');
    }])->get();
    return $total;
  }
}
