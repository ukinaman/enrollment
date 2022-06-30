<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemestralFee extends Model
{
    use HasFactory;

    protected $fillable = ['name','total_amount'];

    public function fees()
    {
        return $this->hasMany(Fee::class, 'sem_fee_id');
    }

    public function amount($val)
    {
        switch($val){
            case("Tuition"):
                return number_format($this->total_amount)."/unit";
            break;
            
            case("RLE"):
                return number_format($this->total_amount)."/hour";
            break;

            default:
                return number_format($this->total_amount);
        }
    }
}
