<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\SemestralFee;
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
        $subjects = $this->getCourseSubjects()->except($unabled_subjects);
        return $subjects;
    }

    
    public function getTotalUnits($enrollment_id)
    {
        $unabled_subjects = $this->unabledSubjects()->where('enrollment_id','=',$enrollment_id)->pluck('subject_id')->toArray();
        $subjects = $this->getCourseSubjects()->except($unabled_subjects);
        $total_units = $subjects->sum('units');
        
        return $total_units;
    }

    public function geTotalUnitsExcludeRLE($enrollment_id)
    {
        $enrollee = $this->where('id','=',$enrollment_id)->first();
        $units = Subject::where([['course_id','=',$enrollee->course_id],['year_id','=',$enrollee->year_id],['sem_id','=',$enrollee->sem_id],['code','not like','%RLE%']])->get();
        $total_units = $units->sum('units');

        return $total_units;
    }

    public function getTotalHours($enrollment_id)
    {
        $unabled_subjects = $this->unabledSubjects()->where('enrollment_id','=',$enrollment_id)->pluck('subject_id')->toArray();
        $subjects = $this->getCourseSubjects()->except($unabled_subjects);
        $total_hours = $subjects->sum('lab');

        return $total_hours;
    }

    //Get student discount
    public function getDiscount($enrollment_id)
    {
      $discount = $this->where('id','=',$enrollment_id)->pluck('discount')->first();
      return $discount;
    }


}
