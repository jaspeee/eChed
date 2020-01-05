<?php

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
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // DB::table('users')->truncate();

        $this->call([ 
            Institution_typesTblSeeder::class,
            StatusesTblSeeder::class,
            User_typesTblSeeder::class,
            FormsTblSeeder::class,
        ]);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
