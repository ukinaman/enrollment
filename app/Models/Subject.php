<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','year_id','sem_id','name','units'];

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
}
