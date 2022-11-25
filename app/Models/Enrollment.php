<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\SemestralFee;
use App\Models\StudentPayment;
use App\Models\UnabledSubject;
use App\Models\StudentDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','course_id','year_id','sem_id','mop_id','discount','assessed'];

    // Enrolled Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Has Many Discount
    public function discounts()
    {
      return $this->hasMany(StudentDiscount::class, 'enrollment_id');
    }

    // Course Enrolled by the student
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    // Enrolled in year
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }
    // Enrolled in semester
    public function sem()
    {
        return $this->belongsTo(Semester::class, 'sem_id');
    }
    // Mode of payment of enrollee
    public function mop()
    {
        return $this->belongsTo(ModeOfPayment::class, 'mop_id');
    }
    // Unable to take subjects of enrollee for the semester
    public function unabledSubjects()
    {
        return $this->hasMany(UnabledSubject::class, 'enrollment_id');
    }
    // Student Payments
    public function payments()
    {
      return $this->hasMany(StudentPayment::class, 'enrollment_id');
    }

    // Data Logic
    public function getCurrentAcademicYear()
    {
      $year_now = Carbon::now()->format('Y');
      $year_next = Carbon::now()->addYear()->format('Y');
      $academic_year = $year_now.'-'.$year_next;

      return $academic_year;
    }

    public function enrolledDate()
    {
        $date = \Carbon\Carbon::parse($this->created_at)->format('F d, Y');
        return $date;
    }
    /**
     * GET full name
     * 1 = Firstname Middlename Lastname
     * 2 = Lastname Firstname Middlename
     */
    public function getFullName($enrollment_id, $type)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->with('student')->first();
      $middle_initial = substr($enrollee->student->middlename, 0, 1);

      if($type == 1)
      {
        $fullname = $enrollee->student->firstname.' '.$middle_initial.'.'.' '.$enrollee->student->lastname;
      }
      else if($type == 2)
      {
        $fullname = $enrollee->student->lastname.','.' '.$enrollee->student->firstname.','.' '.$middle_initial.'.';
      }

      return $fullname;
    }
    
    // Get Mode of Payment
    public function getMop()
    {
        $mop = ModeOfPayment::where('id','=',$this->mop_id)->first();
        return $mop->mode;
    }

    // Get Mode of payment by param
    public function isFullOfPayment($mop)
    {
      return $mop == 1 ? true : false;
    }

    // Get Course specific course
    public function getCourse($course_id, $type)
    {
      $data = $this->course()->where('id','=',$course_id)->first();
      if($type == 'acc')
      {
        $course = $data->accronym;
      }
      else if($type == 'full')
      {
        $course = $data->title;
      }

      return $course;
    }

    // Get current year
    public function getYear($year_id)
    {
        $year = $this->year()->where('id','=',$year_id)->first();
        return $year->title;
    }

    // Get semester
    public function getSemester($sem_id)
    {
        $semester = $this->sem()->where('id','=',$sem_id)->first();
        return $semester->title;
    }

    // Get Subject icluding on the course
    public function getCourseSubjects($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();
      $subjects = Subject::where([['course_id','=',$enrollee->course_id],['year_id','=',$enrollee->year_id],['sem_id','=',$enrollee->sem_id]])->get();
      return $subjects;
    }

    // Get subjects excluding the unable to take subjects
    // This is for the iregular student that has a problem on their units
    public function getSubjects($enrollment_id)
    {
        $unabled_subjects = $this->unabledSubjects()->where('enrollment_id','=',$enrollment_id)->pluck('subject_id')->toArray();
        $subjects = $this->getCourseSubjects($enrollment_id)->except($unabled_subjects);
        return $subjects;
    }

    
    public function getTotalUnits($enrollment_id)
    {
        $unabled_subjects = $this->unabledSubjects()->where('enrollment_id','=',$enrollment_id)->pluck('subject_id')->toArray();
        $subjects = $this->getCourseSubjects($enrollment_id)->except($unabled_subjects);
        $total_units = $subjects->sum('units') - $this->getTotalRLEUnits($enrollment_id);
        
        return $total_units;
    }

    public function geTotalUnitsExcludeRLE($enrollment_id)
    {
        $enrollee = $this->where('id','=',$enrollment_id)->first();
        $units = Subject::where([['course_id','=',$enrollee->course_id],['year_id','=',$enrollee->year_id],['sem_id','=',$enrollee->sem_id],['code','not like','%RLE%']])->get();
        $total_units = $units->sum('units');

        return $total_units;
    }

    public function getTotalRLEUnits($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();
      $rle_units = Subject::where([['course_id','=',$enrollee->course_id],['year_id','=',$enrollee->year_id],['sem_id','=',$enrollee->sem_id],['code','like','%RLE%']])->sum('units');

      return $rle_units;
    }

    public function getTotalHours($enrollment_id)
    {
        $unabled_subjects = $this->unabledSubjects()->where('enrollment_id','=',$enrollment_id)->pluck('subject_id')->toArray();
        $subjects = $this->getCourseSubjects($enrollment_id)->except($unabled_subjects);
        $total_hours = $subjects->sum('lab');

        return $total_hours;
    }

    //Get student discount percentage
    public function getEnrolleeDiscountPercentage($enrollment_id)
    {
      $std_discount = StudentDiscount::where('enrollment_id','=',$enrollment_id)->first();

      if($std_discount)
      {
        $percentage = $std_discount->getPercentage($enrollment_id);
      } else {
        return 0;
      }

      return $percentage;
    }

    // GET student total discount
    public function getEnrolleeDiscountTotal($enrollment_id)
    {
      $percentage = $this->getEnrolleeDiscountPercentage($enrollment_id);
      $tuition = $this->getEnrolleeTuition($enrollment_id);
      $discount_total = ($tuition * $percentage) / 100;
      // dd($discount_total);
      return $discount_total;
    }

    //GET Tuition total minus total discount
    public function getEnrolleeTuitionTotal($enrollment_id)
    {
      $tuition = $this->getEnrolleeTuition($enrollment_id);
      $discount = $this->getEnrolleeDiscountTotal($enrollment_id);

      $total_tuition = $tuition - $discount;

      return $total_tuition;
    }

    //GET Enrollee Tuition
    public function getEnrolleeTuition($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();
      $sem_fee = SemestralFee::where('id','=',1)->first();

      $units = $this->getTotalUnits($enrollment_id);
      $tuition = $sem_fee->where('id','=',$sem_fee->id)->with(['fees' => function($query) use($enrollee){
        $query->where([['course_id','=',$enrollee->course_id], ['year_id','=',$enrollee->year_id], ['sem_id','=',$enrollee->sem_id]]);
      }])->first();
      $enrollee_tuition = $tuition->fees->sum('amount') * $units;

      return $enrollee_tuition;
    }
    // GET Enrollee School fee
    public function getEnrolleeSchoolFee($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();
      $sem_fee = SemestralFee::where('id','=',2)->first();

      $enrolle_school_fee = $sem_fee->getTotalSchoolFee($sem_fee->id, $enrollee->course_id, $enrollee->year_id, $enrollee->sem_id);

      return $enrolle_school_fee;
    }
    //GET Enrollee Special Fee
    public function getEnrolleeSpecialFee($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();
      $sem_fee = SemestralFee::where('id','=',3)->first();

      $enrolle_special_fee = $sem_fee->getTotalSpecialFee($sem_fee->id, $enrollee->course_id, $enrollee->year_id, $enrollee->sem_id);

      return $enrolle_special_fee;
    }
    //GET Enrollee RLE
    public function getEnrolleeRLE($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();
      $sem_fee = SemestralFee::where('id','=',4)->first();

      $enrolle_special_fee = $sem_fee->getTotalRLE($sem_fee->id, $enrollee->course_id, $enrollee->year_id, $enrollee->sem_id);

      return $enrolle_special_fee;
    }
    // SET Values without discount
    public function enrolleeFeesAmount($fee, $enrollment_id)
    {
      $tuition = SemestralFee::where('id','=',1)->first();
      $school_fee= SemestralFee::where('id','=',2)->first();
      $special_fee = SemestralFee::where('id','=',3)->first();
      $rle = SemestralFee::where('id','=',4)->first();

      switch ($fee) {
        case $tuition->id:
          return number_format($this->getEnrolleeTuition($enrollment_id), 2);
          break;
        case $school_fee->id:
          return number_format($this->getEnrolleeSchoolFee($enrollment_id), 2);
          break;
        case $special_fee->id:
          return number_format($this->getEnrolleeSpecialFee($enrollment_id), 2);
          break;
        case $rle->id:
          return number_format($this->getEnrolleeRLE($enrollment_id), 2);
          break;
        default:
          return 0.00;
      }
    }
    // GET Enrollee overall total without discount
    public function enrolleeOverallTotal($enrollment_id)
    {
      $tf = $this->getEnrolleeTuition($enrollment_id);
      $scf = $this->getEnrolleeSchoolFee($enrollment_id);
      $sf = $this->getEnrolleeSpecialFee($enrollment_id);
      $rle = $this->getEnrolleeRLE($enrollment_id);

      $overall_total = $tf + $scf + $sf + $rle;

      return $overall_total;
    }

    // SET Values with discount
    public function enrolleeFeesAmountWithDiscount($fee, $enrollment_id)
    {
      $tuition = SemestralFee::where('id','=',1)->first();
      $school_fee= SemestralFee::where('id','=',2)->first();
      $special_fee = SemestralFee::where('id','=',3)->first();
      $rle = SemestralFee::where('id','=',4)->first();
      
      switch ($fee) {
        case $tuition->id:
          return number_format($this->getEnrolleeTuitionTotal($enrollment_id), 2);
          break;
        case $school_fee->id:
          return number_format($this->getEnrolleeSchoolFee($enrollment_id), 2);
          break;
        case $special_fee->id:
          return number_format($this->getEnrolleeSpecialFee($enrollment_id), 2);
          break;
        case $rle->id:
          return number_format($this->getEnrolleeRLE($enrollment_id), 2);
          break;
        default:
          return 0.00;
      }
    }
    // GET Enrollee overall total with discount
    public function enrolleeOverallTotalWithDiscount($enrollment_id)
    {
      $tf = $this->getEnrolleeTuitionTotal($enrollment_id);
      $scf = $this->getEnrolleeSchoolFee($enrollment_id);
      $sf = $this->getEnrolleeSpecialFee($enrollment_id);
      $rle = $this->getEnrolleeRLE($enrollment_id);
      
      $overall_total = $tf + $scf + $sf + $rle;
      
      return $overall_total;
    }

    // GET Enrollee tuition downpayment
    public function getEnrolleeTuitionDownpayment($enrollment_id)
    {
      $tuition = SemestralFee::where('id','=',1)->first();
      $school_fee= SemestralFee::where('id','=',2)->first();
      $special_fee = SemestralFee::where('id','=',3)->first();

      $enrollee = $this->where('id','=',$enrollment_id)->first();

      $scf = $this->getEnrolleeSchoolFee($enrollment_id);
      $sf = $this->getEnrolleeSpecialFee($enrollment_id);

      $course_downpayment = Downpayment::where('course_id','=',$enrollee->course_id)->pluck('amount')->first();
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

    //SET values for downpayment
    public function enrolleeDownpaymentSumarry($fee, $enrollment_id)
    {
      $sem_fee = SemestralFee::all();
      $tuition = $sem_fee->where('id','=',1)->first();
      $school_fee= $sem_fee->where('id','=',2)->first();
      $special_fee = $sem_fee->where('id','=',3)->first();
      $rle = $sem_fee->where('id','=',4)->first();

      $enrollee = $this->where('id','=',$enrollment_id)->first();
  
      switch ($fee) {
        case $tuition->id:
          if($this->isLessThan5K($enrollment_id))
          {
            return '('.number_format($this->getEnrolleeTuitionDownpayment($enrollment_id), 2).')';
          }
          return number_format($this->getEnrolleeTuitionDownpayment($enrollment_id), 2);
          break;
        case $school_fee->id:
          return number_format($this->getEnrolleeSchoolFee($enrollment_id), 2);
          break;
        case $special_fee->id:
          return number_format($this->getEnrolleeSpecialFee($enrollment_id), 2);
          break;
        case $rle->id:
          return '-';
          break;
        default:
          return 0.00;
      }
    }

    // Check tuition amount if less than 5000
    public function isLessThan5K($enrollment_id)
    {
      $enrollee = $this->where('id','=',$enrollment_id)->first();

      $tuition = $this->getEnrolleeTuitionTotal($enrollment_id);
      
      if($tuition <= 5000)
      {
        return true;
      }
      else{
        return false;
      }
    }

    // SET overall enrollee downpayment sumarry
    public function getEnrolleeDownpaymentOverallTotal($fee, $enrollment_id)
    {
      $sem_fee = SemestralFee::all();
      $tuition = $sem_fee->where('id','=',1)->first();
      $school_fee= $sem_fee->where('id','=',2)->first();
      $special_fee = $sem_fee->where('id','=',3)->first();
      $rle = $sem_fee->where('id','=',4)->first();

      $total_tuition_less_downpayment = $this->getEnrolleeTuitionTotal($enrollment_id) - $this->getEnrolleeTuitionDownpayment($enrollment_id);

      $total_tuition_add_downpayment = $this->getEnrolleeTuitionTotal($enrollment_id) + $this->getEnrolleeTuitionDownpayment($enrollment_id);

      switch ($fee) {
        case $tuition->id:
          if($this->isLessThan5K($enrollment_id))
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
          return number_format($this->getEnrolleeRLE($enrollment_id), 2);
          break;
        default:
          return 0.00;
      }
    }

    // GET Total downpayment
    public function getEnrolleeTotalDownpayment($enrollment_id)
    {
      $sem_fee = SemestralFee::all();
      $tuition = $sem_fee->where('id','=',1)->first();
      $school_fee= $sem_fee->where('id','=',2)->first();
      $special_fee = $sem_fee->where('id','=',3)->first();

      $tf_downpayment = $this->getEnrolleeTuitionDownpayment($enrollment_id);
      $scf = $this->getEnrolleeSchoolFee($enrollment_id);
      $sf = $this->getEnrolleeSpecialFee($enrollment_id);

      $total_downpayment = $tf_downpayment + $scf + $sf;

      if($this->isLessThan5K($enrollment_id))
      {
        $scf_sf = $scf + $sf;
        $total_downpayment =  $scf_sf - $tf_downpayment;
      }
      return $total_downpayment;
    }

    // Enrollee Installment/Downpayment Total Amount
    public function getEnrolleeDownpaymentOverallAmount($enrollment_id)
    {
      $sem_fee = SemestralFee::all();
      $tuition = $sem_fee->where('id','=',1)->first();
      $rle = $sem_fee->where('id','=',4)->first();

      $total_tuition_less_downpayment = $this->getEnrolleeTuitionTotal($enrollment_id) - $this->getEnrolleeTuitionDownpayment($enrollment_id);

      if($this->isLessThan5K($enrollment_id))
      {
        $total_tuition_less_downpayment = $this->getEnrolleeTuitionTotal($enrollment_id) + $this->getEnrolleeTuitionDownpayment($enrollment_id);
      }

      $rle = $this->getEnrolleeRLE($enrollment_id);

      $total_amount = $rle + $total_tuition_less_downpayment;

      return $total_amount;
    }

    // Enrollee Get Per Term Amount
    public function getPerTermAmount($enrollment_id)
    {
      $per_term_amount = $this->getEnrolleeDownpaymentOverallAmount($enrollment_id) / 3;

      return $per_term_amount;
    }

    // Generate OR Number
    public function getORNumber()
    {
      $count = StudentPayment::max('id') + 1;
      $random = str_pad($count, 6, "0", STR_PAD_LEFT);
      return $random;
    }

    // Get Balance
    public function getBalance($enrollment_id)
    {
      $payment = StudentPayment::where('enrollment_id','=',$enrollment_id)->orderBy('created_at', 'DESC')->first();

      $balance = $this->enrolleeOverallTotalWithDiscount($enrollment_id);

      return !$payment ? $balance : $payment->balance;
    }

    // return true if downpayment is paid
    public function downpaymentIsPaid($enrollment_id)
    {
      $paid = StudentPayment::where([['enrollment_id','=',$enrollment_id], ['term','LIKE',"%Downpayment%"]])->first();
      return $paid ? true : false;
    }

    // return true if enrolle is paid
    public function isPaid($enrollment_id)
    {
      $balance = $this->getBalance($enrollment_id);

      return $balance == 0 ? true : false;
    }
}