<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','course_id','year_id','sem_id','mop_id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function sem()
    {
        return $this->belongsTo(Semester::class, 'sem_id');
    }

    public function mop()
    {
        return $this->belongsTo(ModeOfPayment::class, 'mop_id');
    }

    // Data Logic
    // Get Mode of Payment
    public function getMop()
    {
        $mop = ModeOfPayment::where('id','=',$this->mop_id)->first();
        return $mop->mode;
    }

    // Get Course specific course
    public function getCourse($course_id)
    {
        $course = $this->course()->where('id','=',$this->course_id)->first();
        return $course_id == 'accronym' ? $course->accronym : $course->title;
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
}
