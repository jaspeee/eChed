<?php

use Illuminate\Database\Seeder;

class CountsTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        for ($i=1; $i < 97; $i++) { 

            DB::table('counts')->insert([
                'institutions_id' => $i,
                'vcount' => '0',
                'fcount' => '0',
                'created_at' => now(),
                'updated_at' => now()
           ]);

       }

        
    }
}
