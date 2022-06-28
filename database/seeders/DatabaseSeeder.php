<?php

namespace Database\Seeders;

use App\Models\Year;
use App\Models\Semester;
use App\Models\ModeOfPayment;
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
        $semesters = ['1st Semester', '2nd Semester'];


        foreach ($years as $key => $year)
        {
            Year::create([
                'level' => $key + 1,
                'title' => $year
            ]);
        }

        foreach ($semesters as $key => $sem)
        {
            Semester::create([
                'sem' => $key + 1,
                'title' => $sem
            ]);
        }

        $mops = ['Full Payment', 'Down Payment'];

        foreach ($mops as $mop)
        {
            ModeOfPayment::create([
                'mode' => $mop
            ]);
        }
    }
}
