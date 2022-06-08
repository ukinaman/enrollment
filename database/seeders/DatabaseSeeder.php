<?php

namespace Database\Seeders;

use App\Models\Year;
use App\Models\Semester;
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
        for($i = 1; $i < 5; $i++)
        {
            Year::create([
                'level' => $i
            ]);
        }

        for($i = 1; $i < 3; $i++)
        {
            Semester::create([
                'sem' => $i
            ]);
        }
    }
}
