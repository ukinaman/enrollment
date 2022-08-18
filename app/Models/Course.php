<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','accronym','description'];

    // Relationship Declaration
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function enrollee()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function downpayment()
    {
      return $this->hasOne(Downpayment::class);
    }

    // Data Logic
    public function getAllYear()
    {
      $years = Year::all();
      return $years;
    }

    public function getAllSemester()
    {
      $semesters = Semester::all();
      return $semesters;
    }

    public function getAllSemFees()
    {
      $semFees = SemestralFee::all();
      return $semFees;
    }

    public function totalUnits($year, $sem)
    {
        $subjects = $this->subjects()->where([['year_id','=',$year],['sem_id','=',$sem]])->get();
        $total_units = $subjects->sum('units');
        return $total_units;
    }

    public function geTotalUnitsExcludeRLE($course, $year,$sem)
    {
        $units = Subject::where([['course_id','=',$course],['year_id','=',$year],['sem_id','=',$sem],['code','not like','%RLE%']])->get();
        $total_units = $units->sum('units');

        return $total_units;
    }

    public function totalUnitsOfEnrollee($enrollment_id)
    {
        $enrollee = $this->enrollee()->where('id','=',$enrollment_id)->first();
        $subjects = $enrollee->getSubjects($enrollment_id);
        $total_units = $subjects->sum('units');
        return $total_units;
    }

    public function totalHours($year, $sem)
    {
        $subjects = $this->subjects()->where([['year_id','=',$year],['sem_id','=',$sem]])->get();
        $total_hours = $subjects->sum('lab');
        return $total_hours;
    }

    public function getSubjects($year, $sem)
    {
        $subjects = $this->subjects()->where([['year_id','=',$year],['sem_id','=',$sem]])->get();
        return $subjects;
    }
}
