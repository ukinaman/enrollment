<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];

        foreach($years as $year)
        {
            Year::create([
                'year_level' => $year
            ]);
        }
    }
}
