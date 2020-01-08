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
            'first_name' => 'sample1',
            'last_Name' => 'sample1',
            'position' => 'sample1',
            'division' => 'sample1',
            'institutions_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
       ]);

        DB::table('employee_profiles')->insert([
            'first_name' => 'sample2',
            'last_Name' => 'sample2',
            'position' => 'sample2',
            'division' => 'sample2',
            'institutions_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
       ]);

        DB::table('employee_profiles')->insert([
            'first_name' => 'sample3',
            'last_Name' => 'sample3',
            'position' => 'sample3',
            'division' => 'sample3',
            'institutions_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
       ]);

        DB::table('employee_profiles')->insert([
            'first_name' => 'sample4',
            'last_Name' => 'sample4',
            'position' => 'sample4',
            'division' => 'sample4',
            'institutions_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
       ]);

    }
}
