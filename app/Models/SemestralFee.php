<?php

namespace App\Models;

use App\Models\Downpayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemestralFee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'exclusiveTo'];

    public function fees()
    {
      return $this->hasMany(Fee::class, 'sem_fee_id');
    }

  // Data Logic
  // GET Total Units if nursing excluded RLE units
  public function getUnits($course, $year, $sem)
  {
    $subject_units = Subject::where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem],['code','not like','%RLE%']])->sum('units');
    return $subject_units;
  }
  // GET Total RLE Units of nursing
  public function getRLEHours($course, $year, $sem)
  {
    $rle_units = Subject::where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem],['code','like','%RLE%']])->sum('lab');
    return $rle_units;
  }
  // GET Total Tuition
  public function getTotalTuition($fee, $course, $year, $sem)
  {
    $units = $this->getUnits($course, $year, $sem);
    $tuition = $this->where('id','=',$fee)->with(['fees' => function($query) use($course, $year, $sem){
      $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
    }])->first();
    $total_tuition = $tuition->fees->sum('amount') * $units;
    return $total_tuition;
  }
  // GET Total School Fees
  public function getTotalSchoolFee($fee, $course, $year, $sem)
  {
    $school_fees = $this->where('id','=',$fee)->with(['fees' => function($query) use($course, $year, $sem){
      $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
    }])->first();
    $total_school_fees = $school_fees->fees->sum('amount');
    return $total_school_fees;
  }
  // GET Total Special Fees
  public function getTotalSpecialFee($fee, $course, $year, $sem)
  {
    $special_fee = $this->where('id','=',$fee)->with(['fees' => function($query) use($course, $year, $sem){
      $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
    }])->first();
    $total_special_fee = $special_fee->fees->sum('amount');

    return $total_special_fee;
  }
  // GET Total RLE
  public function getTotalRLE($fee, $course, $year, $sem)
  {
    $hours = $this->getRLEHours($course, $year, $sem);
    $rle_fee = $this->where('id','=',$fee)->with(['fees' => function($query) use($course, $year, $sem){
      $query->where([['course_id','=',$course], ['year_id','=',$year], ['sem_id','=',$sem]]);
    }])->first();
    $totla_rle = $rle_fee->fees->sum('amount') * $hours;

    return $totla_rle;
  }

  // SET Values
  public function total($fee, $course, $year, $sem)
  {
    $tuition = $this->where('id','=',1)->first();
    $school_fee= $this->where('id','=',2)->first();
    $special_fee = $this->where('id','=',3)->first();
    $rle = $this->where('id','=',4)->first();

    switch ($fee) {
      case $tuition->id:
        return number_format($this->getTotalTuition($tuition->id, $course, $year, $sem), 2);
        break;
      case $school_fee->id:
        return number_format($this->getTotalSchoolFee($school_fee->id, $course, $year, $sem), 2);
        break;
      case $special_fee->id:
        return number_format($this->getTotalSpecialFee($special_fee->id, $course, $year, $sem), 2);
        break;
      case $rle->id:
        return number_format($this->getTotalRLE($rle->id, $course, $year, $sem), 2);
        break;
      default:
        return 0.00;
    }
  }
  // GET Overall Total
  public function getOverallTotal($course, $year, $sem)
  {
    $tuition = $this->where('id','=',1)->first();
    $school_fee= $this->where('id','=',2)->first();
    $special_fee = $this->where('id','=',3)->first();
    $rle = $this->where('id','=',4)->first();

    $tf = $this->getTotalTuition($tuition->id, $course, $year, $sem);
    $scf = $this->getTotalSchoolFee($school_fee->id, $course, $year, $sem);
    $sf = $this->getTotalSpecialFee($special_fee->id, $course, $year, $sem);
    $rle = $this->getTotalRLE($rle->id, $course, $year, $sem);

    $overall_total = $tf + $scf + $sf + $rle;

    return $overall_total;
  }

  // SET Fullpayment Discount
  public function getDiscountPercentage()
  {
    $discount = 5;
    return $discount;
  }
  // GET total discount
  public function getTotalDiscount($discount, $fee, $course, $year, $sem)
  {
    $total_tuition = $this->getTotalTuition($fee, $course, $year, $sem);
    $discounted_tuition = ($total_tuition * $discount) / 100;

    return $discounted_tuition;
  }
  //GET discounted tuition
  public function getDiscountedTuition($discount, $fee, $course, $year, $sem)
  {
    $discount_amount = $this->getTotalDiscount($discount, $fee, $course, $year, $sem);
    $total_tuition = $this->getTotalTuition($fee, $course, $year, $sem);

    $discounted_tuition = $total_tuition - $discount_amount;

    return $discounted_tuition;
  }

    // SET Values for Sumarry
    public function overallAmount($discount, $fee, $course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $school_fee= $this->where('id','=',2)->first();
      $special_fee = $this->where('id','=',3)->first();
      $rle = $this->where('id','=',4)->first();
  
      switch ($fee) {
        case $tuition->id:
          return number_format($this->getDiscountedTuition($discount, $tuition->id, $course, $year, $sem), 2);
          break;
        case $school_fee->id:
          return number_format($this->getTotalSchoolFee($school_fee->id, $course, $year, $sem), 2);
          break;
        case $special_fee->id:
          return number_format($this->getTotalSpecialFee($special_fee->id, $course, $year, $sem), 2);
          break;
        case $rle->id:
          return number_format($this->getTotalRLE($rle->id, $course, $year, $sem), 2);
          break;
        default:
          return 0.00;
      }
    }

    // GET overall Total
    public function getOverAllTotalWithDiscount($discount, $fee, $course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $school_fee= $this->where('id','=',2)->first();
      $special_fee = $this->where('id','=',3)->first();
      $rle = $this->where('id','=',4)->first();

      $tf = $this->getDiscountedTuition($discount, $tuition->id, $course, $year, $sem);
      $scf = $this->getTotalSchoolFee($school_fee->id, $course, $year, $sem);
      $sf = $this->getTotalSpecialFee($special_fee->id, $course, $year, $sem);
      $rle = $this->getTotalRLE($rle->id, $course, $year, $sem);

      $overall_total_discounted = $tf + $scf + $sf + $rle;

      return $overall_total_discounted;
    }

    // GET tuition downpayment
    public function getTuitionDownpayment($fee, $course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $school_fee= $this->where('id','=',2)->first();
      $special_fee = $this->where('id','=',3)->first();

      $scf = $this->getTotalSchoolFee($school_fee->id, $course, $year, $sem);
      $sf = $this->getTotalSpecialFee($special_fee->id, $course, $year, $sem);

      $course_downpayment = Downpayment::where('course_id','=',$course)->pluck('amount')->first();
      $scf_sf = $scf + $sf;

      $tuition_downpayment = 0;

      if ($scf_sf < $course_downpayment)
      {
        $tuition_downpayment = $course_downpayment - $scf_sf;
      }
      else
      {
        $tuition_downpayment = $scf_sf - $course_downpayment;
      }

      return $tuition_downpayment;
    }

    // GET Total downpayment
    public function getTotalDownpayment($fee, $course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $school_fee= $this->where('id','=',2)->first();
      $special_fee = $this->where('id','=',3)->first();

      $tf_downpayment = $this->getTuitionDownpayment($tuition->id, $course, $year, $sem);
      $scf = $this->getTotalSchoolFee($school_fee->id, $course, $year, $sem);
      $sf = $this->getTotalSpecialFee($special_fee->id, $course, $year, $sem);

      $total_downpayment = $tf_downpayment + $scf + $sf;

      if($this->isLessThan5K($tuition->id, $course, $year, $sem))
      {
        $scf_sf = $scf + $sf;
        $total_downpayment =  $scf_sf - $tf_downpayment;
      }

      return $total_downpayment;
    }

    //SET values for downpayment
    public function downpaymentSumarry($fee, $course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $school_fee= $this->where('id','=',2)->first();
      $special_fee = $this->where('id','=',3)->first();
      $rle = $this->where('id','=',4)->first();
  
      switch ($fee) {
        case $tuition->id:
          if($this->isLessThan5K($fee, $course, $year, $sem))
          {
            return '('.number_format($this->getTuitionDownpayment($tuition->id, $course, $year, $sem), 2).')';
          }
          return number_format($this->getTuitionDownpayment($tuition->id, $course, $year, $sem), 2);
          break;
        case $school_fee->id:
          return number_format($this->getTotalSchoolFee($school_fee->id, $course, $year, $sem), 2);
          break;
        case $special_fee->id:
          return number_format($this->getTotalSpecialFee($special_fee->id, $course, $year, $sem), 2);
          break;
        case $rle->id:
          return '-';
          break;
        default:
          return 0.00;
      }
    }
    // SET overall downpayment sumarry
    public function getDownpaymentOverallTotal($fee, $course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $school_fee= $this->where('id','=',2)->first();
      $special_fee = $this->where('id','=',3)->first();
      $rle = $this->where('id','=',4)->first();

      $total_tuition_less_downpayment = $this->getTotalTuition($tuition->id, $course, $year, $sem) - $this->getTuitionDownpayment($tuition->id, $course, $year, $sem);

      $total_tuition_add_downpayment = $this->getTotalTuition($tuition->id, $course, $year, $sem) + $this->getTuitionDownpayment($tuition->id, $course, $year, $sem);

      switch ($fee) {
        case $tuition->id:
          if($this->isLessThan5K($fee, $course, $year, $sem))
          {
            return number_format($total_tuition_add_downpayment, 2);
          }
          return number_format($total_tuition_less_downpayment, 2);
          break;
        case $school_fee->id:
          return '-';
          break;
        case $special_fee->id:
          return '-';
          break;
        case $rle->id:
          return number_format($this->getTotalRLE($rle->id, $course, $year, $sem), 2);
          break;
        default:
          return 0.00;
      }
    }
    // GET overall downpayment sumrry
    public function getDownpaymentOverallAmount($course, $year, $sem)
    {
      $tuition = $this->where('id','=',1)->first();
      $rle = $this->where('id','=',4)->first();

      $total_tuition_less_downpayment = $this->getTotalTuition($tuition->id, $course, $year, $sem) - $this->getTuitionDownpayment($tuition->id, $course, $year, $sem);

      if($this->isLessThan5K($tuition->id, $course, $year, $sem))
      {
        $total_tuition_less_downpayment = $this->getTotalTuition($tuition->id, $course, $year, $sem) + $this->getTuitionDownpayment($tuition->id, $course, $year, $sem);
      }

      $rle = $this->getTotalRLE($rle->id, $course, $year, $sem);

      $total_amount = $rle + $total_tuition_less_downpayment;

      return $total_amount;
    }
    // GET per-term amount
    public function getPerTermAmount($course, $year, $sem)
    {
      $per_term_amount = $this->getDownpaymentOverallAmount($course, $year, $sem) / 3;

      return $per_term_amount;
    }
    // Check tuition amount if less than 5000
    public function isLessThan5K($fee, $course, $year, $sem)
    {
      $tuition = $this->getTotalTuition($fee, $course, $year, $sem);
      
      if($tuition <= 5000)
      {
        return true;
      }
      else{
        return false;
      }
    }
}
