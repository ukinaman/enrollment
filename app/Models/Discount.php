<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['name','percentage','mop_id'];

    // Relationship Declaration
    public function mop()
    {
        return $this->belongsTo(ModeOfPayment::class, 'mop_id');
    }
}
