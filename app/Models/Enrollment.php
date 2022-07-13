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
        return $this->belongsTo(Sem::class, 'sem_id');
    }

    public function mop()
    {
        return $this->belongsTo(ModeOfPayment::class, 'mop_id');
    }
}
