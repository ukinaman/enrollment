<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Course::create([
        'title' => 'Bachelor of Science in Nursing',
        'accronym' => 'BSN',
      ]);

      Course::create([
        'title' => 'Bachelor of Elementary Education',
        'accronym' => 'BEED',
      ]);

      Course::create([
        'title' => 'Bachelor of Science in Psychology',
        'accronym' => 'BSP',
      ]);
    }
}
