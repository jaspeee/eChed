<?php

use Illuminate\Database\Seeder;

class Program_levelsTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('program_levels')->insert([
            'program_level' => '30',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //2
        DB::table('program_levels')->insert([
            'program_level' => '40',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //3
        DB::table('program_levels')->insert([
            'program_level' => '50',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //4
        DB::table('program_levels')->insert([
            'program_level' => '60',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //5
        DB::table('program_levels')->insert([
            'program_level' => '70',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //6
        DB::table('program_levels')->insert([
            'program_level' => '80',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //7
        DB::table('program_levels')->insert([
            'program_level' => '90',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
