<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemestralFee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'exclusiveTo'];

    public function fees()
    {
        return $this->hasMany(Fee::class, 'sem_fee_id');
    }
}
