<?php

use Illuminate\Database\Seeder;

class Institution_typesTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institution_types')->insert([
            'type' => 'SUC',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('institution_types')->insert([
            'type' => 'NON-SUC',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('institution_types')->insert([
            'type' => 'GOV',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
