<?php

namespace App\Models;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function current_year($year)
    {
        $year = Year::where('id','=',$year)->first();
        return $year->title;
    }

    public function current_sem($sem)
    {
        $sem = Semester::where('id','=',$sem)->first();
        return $sem->title;
    }

    public function fullname()
    {
        return $this->firstname." ".$this->middlename." ".$this->lastname;
    }

    // Gets specific data of enrollment based on year and sem
    public function getEnrollmentData($id, $sem, $year)
    {
        $enrollment = Enrollment::where([['student_id','=',$id],['sem_id','=',$sem],['year_id','=',$year]])->first();
        return $enrollment;
    }
}