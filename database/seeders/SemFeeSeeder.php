<?php

namespace Database\Seeders;

use App\Models\SemestralFee;
use Illuminate\Database\Seeder;

class SemFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_data = File::get("database/json/semfees.json");
        $fees = json_decode($json_data);

        foreach($fees as $fee)
        {
            SemestralFee::create([
                'name' => $fee->name,
                'total_amount' => $fee->total_amount,
                'exclusiveTo' => $fee->exclusiveTo
            ]);
        }   
    }
}
