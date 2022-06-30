<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = ['sem_fee_id','name','amount','exclusiveTo'];

    public function semestralFee()
    {
        return $this->belongsTo(SemestralFee::class, 'sem_fee_id');
    }
}
