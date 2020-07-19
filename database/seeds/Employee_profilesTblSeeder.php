<?php

use Illuminate\Database\Seeder;

class Employee_profilesTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_profiles')->insert([
            'first_name' => 'Nikola',
            'last_Name' => 'Zamora',
            'position' => 'encoder',
            'division' => 'records',
            'institutions_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
       ]);

        DB::table('employee_profiles')->insert([
            'first_name' => 'Stefania',
            'last_Name' => 'Sheldon',
            'position' => 'validator',
            'division' => 'records',
            'institutions_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
       ]);

        DB::table('employee_profiles')->insert([
            'first_name' => 'Wallace',
            'last_Name' => 'Calvert',
            'position' => 'verifier',
            'division' => 'records',
            'institutions_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
       ]);

        DB::table('employee_profiles')->insert([
            'first_name' => 'Daryl ',
            'last_Name' => 'Contreras',
            'position' => 'officer',
            'division' => 'records',
            'institutions_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
       ]);

    }
}
