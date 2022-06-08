<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','accronym','description'];

    public function year_levels()
    {
        return $this->hasMany(YearLevels::class);
    }
}
