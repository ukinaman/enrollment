<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = ['level','title'];

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
        return $this->hasMany(Enrollment::class, 'year_id');
    }

    public function getSchoolYear()
    {
      $current_year = \Carbon\Carbon::now()->format('Y');
      dd($current_year);
    }
}
