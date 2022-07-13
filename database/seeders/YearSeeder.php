<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
            foreach ($years as $key => $year)
            {
                Year::create([
                    'level' => $key + 1,
                    'title' => $year
                ]);
            }
    }
}
