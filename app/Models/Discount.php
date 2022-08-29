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

    // Has Many Discount
    public function studentDiscounts()
    {
      return $this->hasMany(StudentDiscount::class, 'discount_id');
    }

    public function getTotalDiscount($discount_id)
    {
      $discounts = $this->where('id','=',$discount_id)->get();
      $percentage_total = $discounts->sum('percentage');
      // dd($percentage_total);
      return $percentage_total;
    }
}
