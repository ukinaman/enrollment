<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = ['1st Semester', '2nd Semester'];

        foreach ($semesters as $key => $sem)
        {
            Semester::create([
                'sem' => $key + 1,
                'title' => $sem
            ]);
        }
    }
}
