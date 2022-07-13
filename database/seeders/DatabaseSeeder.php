<?php

namespace Database\Seeders;

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
        $this->call([
            YearSeeder::class,
            SemesterSeeder::class,
            SemFeeSeeder::class,
            ModeOfPaymentSeeder::class,
            TermSeeder::class,
            DiscountSeeder::class
        ]);
    }
}
