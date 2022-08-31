<?php

namespace App\Models;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentPayment extends Model
{
    use HasFactory;

  protected $fillable = ['enrollment_id','term','payment_method','or_number','amount','balance'];

  public function enrollee()
  {
    return $this->belongsTo(Enrollment::class, 'enrollment_id');
  }

  // Get student payment count
  public function getStdPayCount()
  {
    $count = $this->count();
    return $count;
  }

  // Get enrollee information
  public function getEnrolleeInfo($enrollment_id)
  {
    $enrollee = $this->enrollee()->where('id','=',$enrollment_id)->first();
    return $enrollee;
  }

  // Get enrollee student information
  public function getStudentInfo($enrollment_id)
  {
    $std_id = $this->getEnrolleeInfo($enrollment_id)->pluck('student_id')->first();
    $student = Student::where('id','=',$std_id)->first();

    return $student;
  }

  // Get enrollee bill
  public function getEnrolleeBill($enrollment_id)
  {
    $enrollee = $this->enrollee()->where('id','=',$enrollment_id)->first();
    $bill_total = $enrollee->enrolleeOverallTotalWithDiscount($enrollment_id);

    return $bill_total;
  }

  // Get Balance
  public function getEnrolleeBalance($enrollment_id, $payment)
  {
    $enrollee = Enrollment::where('id','=',$enrollment_id)->first();
    $enrollee_payable = $enrollee->getBalance($enrollee->id);
    $enrollee_payment = $payment;

    $balance = $enrollee_payable - $enrollee_payment;

    return $balance;
  }

  // Get OR Number
  public function paymentORnumber($id)
  {
    $or_number = $this->where('id','=',$id)->pluck('or_number')->first();

    return $or_number;
  }

  // is Latest payment
  public function isLatestPayment($enrollment_id, $payment)
  {
    $std_payment = $this->where('enrollment_id','=',$enrollment_id)->orderBy('created_at', 'DESC')->first();
    return $std_payment->id == $payment ? true : false;
  }

  // return true if downpayment is paid
  public function downpaymentIsPaid($enrollment_id)
  {
    $paid = $this->where([['enrollment_id','=',$enrollment_id], ['term','LIKE',"%Downpayment%"]])->first();
    return $paid ? true : false;
  }
}
