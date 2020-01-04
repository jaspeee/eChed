<?php

use Illuminate\Database\Seeder;

class User_typesTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'type' => 'Encoder',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_types')->insert([
            'type' => 'Validator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_types')->insert([
            'type' => 'Verifier',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_types')->insert([
            'type' => 'Officer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
