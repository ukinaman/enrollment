<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeOfPayment extends Model
{
    use HasFactory;

    protected $fillable = ['mode'];

    // Relationship Declaration
    public function enrollee()
    {
        return $this->hasMany(Enrollment::class, 'mop_id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'mop_id');
    }
}
