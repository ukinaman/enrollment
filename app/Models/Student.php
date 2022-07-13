<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
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

    // Relationship Declaration
    public function enrollment()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    // Data Logic
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
