<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
  use HasFactory;
  
  protected $fillable = ['sem_fee_id','course_id','year_id','sem_id','name','amount'];

  public function semestralFee()
  {
      return $this->belongsTo(SemestralFee::class, 'sem_fee_id');
  }


}
