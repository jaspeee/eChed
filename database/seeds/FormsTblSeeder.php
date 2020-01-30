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
            'form' => 'SUC-NF-FORM-A.xlsx',
            'description' => 'Institutional Profile',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-B.xlsx',
            'description' => 'Profile of Each Curricular Program in an SUC Campus',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-E1.xlsx',
            'description' => 'SUCs Faculty:Form E1 Elementary/Secondary/Tech Voc Levels',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-E2.xlsx',
            'description' => 'Profile of Each Tertiary Faculty in an SUC Campus',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-FORM-GH.xlsx',
            'description' => 'Allotments, Expenditures and Income',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-NF-Research-Extension-Forms.xlsx',
            'description' => 'Research (Tables B1-B5), Extension Form (Table C)',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'SUC-PRC-List-of-Graduates.xlsx',
            'description' => 'CHED-PRC Two-Way Link Form',
            'institution_types_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-e-Forms-A.xlsx',
            'description' => 'Dean Profile',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-e-Forms-B-C.xlsx',
            'description' => 'CHED E-Form B/C Curriculum Progam Profile / Enrolment  & Graduates',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-Form-E5-Faculty-Form.xlsx',
            'description' => 'CHED Form E5 - Faculty or Teaching Staff in Higher Education Programs',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forms')->insert([
            'form' => 'NONSUC-PRC-List-of-Graduates.xlsx',
            'description' => 'PRC: List of Graduates by Institutions, Program and Sex',
            'institution_types_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);




    }
}
