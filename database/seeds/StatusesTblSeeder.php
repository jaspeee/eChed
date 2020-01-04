<?php

use Illuminate\Database\Seeder;

class StatusesTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('statuses')->insert([
            'status' => 'Inactive',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('statuses')->insert([
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('statuses')->insert([
            'status' => 'Approve',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('statuses')->insert([
            'status' => 'Disapprove',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
