<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downpayment extends Model
{
    use HasFactory;
 
    protected $fillable = ['course_id', 'amount'];

    public function course()
    {
      return $this->belongsTo(Course::class);
    }

    public function getCourse($course)
    {
      $course = $this->course()->where('id','=',$course)->first();
      return $course->title.' '.'('.$course->accronym.')';
    }
}
