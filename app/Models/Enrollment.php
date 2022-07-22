<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','course_id','year_id','sem_id','mop_id','assessed'];

    // Enrolled Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
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
    public function enrolledDate()
    {
        $date = \Carbon\Carbon::parse($this->created_at)->format('F d, Y');
        return $date;
    }
    
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

    // Get Subject icluding on the course
    public function getCourseSubjects()
    {
        $subjects = Subject::where([['course_id','=',$this->course_id],['year_id','=',$this->year_id],['sem_id','=',$this->sem_id]])->get();
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
}
