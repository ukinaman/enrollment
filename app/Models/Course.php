<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','accronym','description'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function totalUnits($year, $sem)
    {
        $subjects = $this->subjects()->where([['year_id','=',$year],['sem_id','=',$sem]])->get();
        $total_units = $subjects->sum('units');
        return $total_units;
    }
}
