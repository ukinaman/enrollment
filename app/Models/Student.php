<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'year_id',
        'sem_id',
        'firstname',
        'middlename',
        'lastname',
        'birthplace',
        'age',
        'birthday',
        'gender',
        'address',
        'citizenship',
        'marital_status',
        'email',
        'contact_no'
    ];

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

    public function current_year()
    {
        $year = Year::where('id','=',$this->year_id)->first();
        return $year->title;
    }

    public function current_sem()
    {
        $sem = Semester::where('id','=',$this->sem_id)->first();
        return $sem->title;
    }

    public function fullname()
    {
        return $this->firstname." ".$this->middlename." ".$this->lastname;
    }
}
