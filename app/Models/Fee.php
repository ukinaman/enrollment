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
        $course = Course::where('id','=',$course_id)->first();
        $rle = SemestralFee::where('id','=',4)->first();

        if($fee == "Tuition")
        {
            $units = $course->geTotalUnitsExcludeRLE($course_id, $year,$sem);
            $tuition_amount = SemestralFee::where('id','=',1)->first();
            $total_amount = $tuition_amount->total_amount * $units;
        }
        elseif($this->sem_fee_id == $rle->id)
        { 
            $hours = $course->totalHours($year, $sem);
            $rle_data = $this->where('sem_fee_id','=',$rle->id)->first();
            $total_amount = $rle_data->amount * $hours;
        }
        else
        {
            $total_amount = $this->amount;
        }
        return $total_amount;
    }

    public function geTotalUnits($course, $year,$sem)
    {
        $units = Subject::where([['course_id','=',$course],['year_id','=',$year],['sem_id','=',$sem],['code','not like','%RLE%']])->get();
        $total_units = $units->sum('units');

        return $total_units;
    }

    public function geTotalLab($course, $year,$sem)
    {
        $lab = Subject::where([['course_id','=',$course],['year_id','=',$year],['sem_id','=',$sem]])->get();
        $total_lab = $lab->sum('lab');

        return $total_lab;
    }

    public function getCourse($course)
    {
        $course_id = Course::where('id','=',$course)->first();

        return $course_id->accronym;
    }
    
    public function enrolleeTotalAmount($id, $fee)
    {
        $enrollee = Enrollment::where('id','=',$id)->first();
        $rle = SemestralFee::where('id','=',4)->first();

        if($fee == "Tuition")
        {
            $units = $enrollee->geTotalUnitsExcludeRLE($id);
            $tuition_amount = SemestralFee::where('id','=',1)->first();
            $total_amount = $tuition_amount->total_amount * $units;
        }
        elseif($this->sem_fee_id == $rle->id)
        { 
            $hours = $enrollee->getTotalHours($id);
            $rle_data = $this->where('sem_fee_id','=',$rle->id)->first();
            $total_amount = $rle_data->amount * $hours;
        }
        else
        {
            $total_amount = $this->amount;
        }
        return $total_amount;
    }

    public function getSchoolFeeTotal($sem_fee_id, $course_id)
    {
      $school_fees_total = $this->where('sem_fee_id','=',2)->sum('amount');
      dd($school_fees_total);
    }

    public function getSpecialFeeTotal($sem_fee_id, $course_id)
    {
      $special_fees_total = $this->where('sem_fee_id','=',3)->sum('amount');
      dd($special_fees_total);
    }

    public function getEnrolleeSumary($sem_fee_id, $course_id, $fee, $enrollee_id)
    {
      $total_amount = 0;
      if($sem_fee_id == 1)
      {
        $total_amount = $this->enrolleeTotalAmount($enrollee_id, $fee);
        
      }
      elseif($sem_fee_id == 2) 
      {
        $total_amount = $this->where('sem_fee_id','=',2)->sum('amount');
      }
      elseif($sem_fee_id == 3)
      {
        $total_amount = $this->where('sem_fee_id','=',3)->sum('amount');
      }
      elseif($sem_fee_id == 4)
      {
        $total_amount = $this->enrolleeTotalAmount($enrollee_id, $fee);
      }
      return $total_amount;
    }
}
