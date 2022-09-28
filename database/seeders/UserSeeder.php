<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create(['name' => 'Accounting']);
      Role::create(['name' => 'Registrar']);
      
      $accounting = User::create([
        'name' => 'KayC Quinay',
        'email' => 'accounting@canossa.com',
        'password' => Hash::make('accountingpassword')
      ]);
      $accounting->assignRole('Accounting');

      $registrar = User::create([
        'name' => 'Registrar',
        'email' => 'registrar@canossa.com',
        'password' => Hash::make('registrarpassword')
      ]);
      $registrar->assignRole('Registrar');
    }
}
