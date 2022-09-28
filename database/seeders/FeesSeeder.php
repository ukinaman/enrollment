<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;
use File;

class FeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json_data = File::get("database/json/fees.json");
      $fees = json_decode($json_data);

      foreach($fees as $fee)
      {
          Fee::create([
            'sem_fee_id' => $fee->sem_fee_id,
            'course_id' => $fee->course_id,
            'year_id' => $fee->year_id,
            'sem_id' => $fee->sem_id,
            'name' => $fee->name,
            'amount' => $fee->amount,
          ]);
      }   
    }
}
