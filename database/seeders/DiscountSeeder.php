<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::create([
            'name' => "Full Payment",
            'percentage' => 5,
            'mop_id' => 1
        ]);
    }
}
