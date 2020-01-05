<?php

use Illuminate\Database\Seeder;

class FormsTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //SUC

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-A.xls',
            'description' => 'Institutional Profile',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-B.xls',
            'description' => 'Profile of Each Curricular Program in an SUC Campus',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-E1.xls',
            'description' => 'SUCs Faculty:Form E1 Elementary/Secondary/Tech Voc Levels',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-E2.xls',
            'description' => 'Profile of Each Tertiary Faculty in an SUC Campus',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-GH.xls',
            'description' => 'Allotments, Expenditures and Income',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-Research-Extension-Forms.xls',
            'description' => 'Research (Tables B1-B5), Extension Form (Table C)',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-PRC-List-of-Graduates.xls',
            'description' => 'CHED-PRC Two-Way Link Form',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-e-Forms-A.xls',
            'description' => 'Lorem Ipsum',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-e-Forms-B-C.xls',
            'description' => 'Lorem Ipsum',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-Form-E5-Faculty-Form.xls',
            'description' => 'Lorem Ipsum',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-PRC-List-of-Graduates.xls',
            'description' => 'Lorem Ipsum',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);




    }
}
