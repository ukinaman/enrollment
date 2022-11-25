<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','year_id','sem_id','code','name','units','lab'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function unabled()
    {
        return $this->hasOne(UnabledSubject::class, 'subject_id');
    }

    public function getTotalUnits($course, $year, $sem)
    {
        $units = $this->where([['course_id','=',$course],['year_id','=',$year],['sem_id','=',$sem]])->get();
        $total_units = $units->sum('units');

        return $total_units;
    }

    public function getTotalNoHours($course, $year, $sem)
    {
        $hours = $this->where([['course_id','=',$course],['year_id','=',$year],['sem_id','=',$sem]])->get();
        $total_hours = $hours->sum('lab');

        return $total_hours;
    }
}
