<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemestralFee extends Model
{
    use HasFactory;

    protected $fillable = ['name','total_amount', 'exclusiveTo'];

    public function fees()
    {
        return $this->hasMany(Fee::class, 'sem_fee_id');
    }

    public function amount($val)
    {
        switch($val){
            case("Tuition"):
                return number_format($this->total_amount)."/unit";
            break;
            
            case("RLE"):
                return number_format($this->total_amount)."/hour";
            break;

            default:
                return number_format($this->total_amount);
        }
    }

    // Get fees
    public function getFees($course_id)
    {
      
    }
    
    // Get student tuition total
    //tf = Tuition Fees
    public function getStudentTuition($enrolee_id, $fee_id)
    {
      $fee = Fee::where('id','=',$fee_id)->first();
      $student_tf = $fee->enrolleeTotalAmount($enrolee_id, "Tuition");
      return $student_tf;
    }

    // Get student school fee total
    // scf = School Fees
    public function getStudentSchoolFee($enrolee_id, $fee)
    {
      $enrollee = Enrollment::where('id','=',$enrolee_id)->pluck('course_id')->first();
      $student_scf = Fee::where([['sem_fee_id','=',$fee], ['exclusiveTo','=',0]])
                    ->orWhere([['sem_fee_id','=',$fee], ['exclusiveTo','=',$enrollee]])
                    ->sum('amount');
      return $student_scf;
    }

    // Get student special fee total
    // sf = Special Fees
    public function getStudentSpecialFee($enrolee_id, $fee)
    {
      $enrollee = Enrollment::where('id','=',$enrolee_id)->pluck('course_id')->first();
      $student_sf = Fee::where([['sem_fee_id','=',$fee], ['exclusiveTo','=',$enrollee]])
                    ->sum('amount');
      return $student_sf;
    }

    // Get student RLE total (if Nurse)
    public function getStudentRLE($enrolee_id, $fee)
    {
      $enrolee = Fee::where('sem_fee_id','=',$fee)->first();
      $total_amount = $enrolee->getRLE($enrolee_id);
      return $total_amount;
    }

    public function getTotalDiscount($enrollee_id, $fee_id)
    {
      $discount = Enrollment::where('id','=',$enrollee_id)->pluck('discount')->first();
      $tuitionAmount = $this->getStudentTuition($enrollee_id, $fee_id);
      $discountAmount = ($tuitionAmount * $discount) / 100;

      return $fee_id != 1 ? 0 : $discountAmount;
    }

    // Get student total without discount
    public function getEnrolleeSumary($sem_fee_id, $course_id, $fee, $enrollee_id)
    {
      $total_amount = 0;

      if($sem_fee_id == 1)
      {
        $enrolee = Fee::where('sem_fee_id','=',1)->first();
        // $discountAmount = $this->getTotalDiscount($enrollee_id, $fee);
        $total_amount = $enrolee->enrolleeTotalAmount($enrollee_id, $fee);
        
      }
      elseif($sem_fee_id == 2) 
      {
        $total_amount = $this->getStudentSchoolFee($enrollee_id, 2);
      }
      elseif($sem_fee_id == 3)
      {
        $total_amount = Fee::where('sem_fee_id','=',3)->sum('amount');
      }
      elseif($sem_fee_id == 4)
      {
        $enrolee = Fee::where('sem_fee_id','=',4)->first();
        $total_amount = $enrolee->enrolleeTotalAmount($enrollee_id, $fee);
      }
      return $total_amount;
    }

    //Get student total with discount
    public function getEnrolleeSummaryWithDiscount($sem_fee_id, $course_id, $fee, $enrollee_id)
    {
      $total_amount = 0;

      if($sem_fee_id == 1)
      {
        $enrolee = Fee::where('sem_fee_id','=',1)->first();
        $discountAmount = $this->getTotalDiscount($enrollee_id, $enrolee->sem_fee_id);
        $total_amount = $enrolee->enrolleeTotalAmount($enrollee_id, $fee) - $discountAmount;
        
      }
      elseif($sem_fee_id == 2) 
      {
        $total_amount = $this->getStudentSchoolFee($enrollee_id, 2);
      }
      elseif($sem_fee_id == 3)
      {
        $total_amount = Fee::where('sem_fee_id','=',3)->sum('amount');
      }
      elseif($sem_fee_id == 4)
      {
        $enrolee = Fee::where('sem_fee_id','=',4)->first();
        $total_amount = $enrolee->enrolleeTotalAmount($enrollee_id, $fee);
      }
      return $total_amount;
    }

    
}
