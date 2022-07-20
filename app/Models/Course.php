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

    // Data Logic
    public function totalUnits($year, $sem)
    {
        $subjects = $this->subjects()->where([['year_id','=',$year],['sem_id','=',$sem],['code','not like','%RLE%']])->get();
        $total_units = $subjects->sum('units');
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
