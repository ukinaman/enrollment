<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentStat extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id','term_id','isPaid'];
}
