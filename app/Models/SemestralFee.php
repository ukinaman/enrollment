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

    public function getEnrolleeSumary($sem_fee_id, $course_id, $fee, $enrollee_id)
    {
      $total_amount = 0;
      // dd($fee);
      if($sem_fee_id == 1)
      {
        $enrolee = Fee::where('sem_fee_id','=',1)->first();
        // $discountAmount = $this->getTotalDiscount($enrollee_id, $fee);
        $total_amount = $enrolee->enrolleeTotalAmount($enrollee_id, $fee);
        
      }
      elseif($sem_fee_id == 2) 
      {
        $total_amount = Fee::where('sem_fee_id','=',2)->sum('amount');
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

    public function getTotalDiscount($enrollee_id, $fee)
    {
      $enrollee = Fee::where('sem_fee_id','=',1)->first();
      $discount = Enrollment::where('id','=',$enrollee_id)->pluck('discount')->first();
      $tuitionAmount = $enrollee->enrolleeTotalAmount($enrollee_id, $fee);
      $discountAmount = ($tuitionAmount * $discount) / 100;

      return $fee == 'Tuition' ? $discountAmount : '' ;
    }

    //Get student discount total
    public function getEnrolleeSummaryWithDiscount($sem_fee_id, $course_id, $fee, $enrollee_id)
    {
      $total_amount = 0;
      // dd($fee);
      if($sem_fee_id == 1)
      {
        $enrolee = Fee::where('sem_fee_id','=',1)->first();
        $discountAmount = $this->getTotalDiscount($enrollee_id, $fee);
        $total_amount = $enrolee->enrolleeTotalAmount($enrollee_id, $fee) - $discountAmount;
        
      }
      elseif($sem_fee_id == 2) 
      {
        $total_amount = Fee::where('sem_fee_id','=',2)->sum('amount');
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
