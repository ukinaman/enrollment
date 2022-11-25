<?php

namespace Database\Seeders;

use App\Models\ModeOfPayment;
use Illuminate\Database\Seeder;

class ModeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mops = ['Full Payment', 'Down Payment'];

        foreach ($mops as $mop)
        {
            ModeOfPayment::create([
                'mode' => $mop
            ]);
        }
    }
}
