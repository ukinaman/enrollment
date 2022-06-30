<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = ['sem_fee_id','name','amount','exclusiveTo'];

    public function semestralFee()
    {
        return $this->belongsTo(SemestralFee::class, 'sem_fee_id');
    }

    public function grandTotal($course_id)
    {
        $total = Fee::where('exclusiveTo','=',0)->orWhere('exclusiveTo','=',$course_id)->get();
        $grand_total = $total->sum('amount');
        return $grand_total;
    }

    public function totalAmount($course_id, $year,$sem, $fee)
    {
        if($fee == "Tuition")
        {
            $course = Course::where('id','=',$course_id)->first();
            $units = $course->totalUnits($year, $sem);
    
            $tuition_amount = SemestralFee::where('id','=',1)->first();
            $total_amount = $tuition_amount->total_amount * $units;
        } else {
            $total_amount = $this->amount;
        }

        return $total_amount;
    }
}
