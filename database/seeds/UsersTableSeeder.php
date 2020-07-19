<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'encoder123',
            'email' => 'sample1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'employee_profiles_id' => '1',
            'user_types_id' =>'1',
            'statuses_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'validator123',
            'email' => 'sample2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'employee_profiles_id' => '2',
            'user_types_id' =>'2',
            'statuses_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'verifier123',
            'email' => 'sample3@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'employee_profiles_id' => '3',
            'user_types_id' =>'3',
            'statuses_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'officer123',
            'email' => 'sample4@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'employee_profiles_id' => '4',
            'user_types_id' =>'4',
            'statuses_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
