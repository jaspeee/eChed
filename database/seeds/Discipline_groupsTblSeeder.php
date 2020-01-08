<?php

use Illuminate\Database\Seeder;

class Discipline_groupsTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('discipline_groups')->insert([
            'code' => '14',
            'major_discipline' => 'EDUCATION SCIENCE AND TEACHER TRAINING',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //2
        DB::table('discipline_groups')->insert([
            'code' => '18',
            'major_discipline' => 'FINE AND APPLIED ARTS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //3
        DB::table('discipline_groups')->insert([
            'code' => '22',
            'major_discipline' => 'HUMANITIES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //4
        DB::table('discipline_groups')->insert([
            'code' => '26',
            'major_discipline' => 'RELIGION AND THEOLOGY',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //5
        DB::table('discipline_groups')->insert([
            'code' => '30',
            'major_discipline' => 'SOCIAL AND BEHAVIORAL SCIENCES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //6
        DB::table('discipline_groups')->insert([
            'code' => '34',
            'major_discipline' => 'BUSINESS ADMINISTRATION AND RELATED',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //7
        DB::table('discipline_groups')->insert([
            'code' => '38',
            'major_discipline' => 'LAW AND JURISPRUDENCE',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //8
        DB::table('discipline_groups')->insert([
            'code' => '42',
            'major_discipline' => 'NATURAL SCIENCE',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //9
        DB::table('discipline_groups')->insert([
            'code' => '46',
            'major_discipline' => 'MATHEMATICS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //10
        DB::table('discipline_groups')->insert([
            'code' => '47',
            'major_discipline' => 'IT-RELATED DISCIPLINES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //11
        DB::table('discipline_groups')->insert([
            'code' => '50',
            'major_discipline' => 'MEDICAL AND ALLIED',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //12
        DB::table('discipline_groups')->insert([
            'code' => '52',
            'major_discipline' => 'TRADE, CRAFT AND INDUSTRIAL',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //13
        DB::table('discipline_groups')->insert([
            'code' => '54',
            'major_discipline' => 'ENGINEERING AND TECH',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //14
        DB::table('discipline_groups')->insert([
            'code' => '58',
            'major_discipline' => 'ARCHITECTURE AND TOWN PLANNING',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //15
        DB::table('discipline_groups')->insert([
            'code' => '62',
            'major_discipline' => 'AGRICULTURE, FORESTRY, FISHERIES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //16
        DB::table('discipline_groups')->insert([
            'code' => '66',
            'major_discipline' => 'HOME ECONOMICS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //17
        DB::table('discipline_groups')->insert([
            'code' => '78',
            'major_discipline' => 'SERVICE TRADES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //18
        DB::table('discipline_groups')->insert([
            'code' => '84',
            'major_discipline' => 'MASS COMMUNICATION AND DOCUMENTATION',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //19
        DB::table('discipline_groups')->insert([
            'code' => '89',
            'major_discipline' => 'OTHER DISCIPLINES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //20
        DB::table('discipline_groups')->insert([
            'code' => '00',
            'major_discipline' => 'GENERAL',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //21
        DB::table('discipline_groups')->insert([
            'code' => '90',
            'major_discipline' => 'MARITIME',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
