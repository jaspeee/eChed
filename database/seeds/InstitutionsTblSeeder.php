<?php

use Illuminate\Database\Seeder;

class InstitutionsTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('institutions')->insert([
            'code' => '1000',
            'institution_name' => 'Commission on Higher Education',
            'abbreviation' => 'CHED',
            'institution_types_id' => '3',
            'statuses_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        
        DB::table('institutions')->insert([
          'code' => '11155',
          'institution_name' => 'ACES Polytechnic College',
          'abbreviation' => 'ACES-PC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     //1 = SUC
     //2 = NON SUC
     
     DB::table('institutions')->insert([
          'code' => '11122',
          'institution_name' => 'ACES Tagum College',
          'abbreviation' => 'ACES-TC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11171',
          'institution_name' => 'ACLC College of Tagum',
          'abbreviation' => 'ACLC-TAGUM',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11162',
          'institution_name' => 'ACQ College of Ministries',
          'abbreviation' => 'ACQCM',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11001',
          'institution_name' => 'Agro-Industrial Foundation College of the Philippines',
          'abbreviation' => 'AIFCP',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11002',
          'institution_name' => 'AMA Computer College-Davao',
          'abbreviation' => 'AMA-DAVAO',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11004',
          'institution_name' => 'Arriesgado College Foundation Incorporated',
          'abbreviation' => 'ACFI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11175',
          'institution_name' => 'Asian International School of Aeronautics and Technology',
          'abbreviation' => 'AISAT',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11114',
          'institution_name' => 'Assumption College of Davao',
          'abbreviation' => 'ACD',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11006',
          'institution_name' => 'Assumption College of Nabunturan',
          'abbreviation' => 'ACN',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11007',
          'institution_name' => 'Ateneo de Davao University',
          'abbreviation' => 'ADDU',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11008',
          'institution_name' => 'Brokenshire College',
          'abbreviation' => 'BC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11181',
          'institution_name' => 'CARD-MRI Development Institute',
          'abbreviation' => 'CARD-MRI-DI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11136',
          'institution_name' => 'Christian Colleges of Southeast Asia',
          'abbreviation' => 'CCSA',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11173',
          'institution_name' => 'Compostela Valley State College - Compostela (Main)',
          'abbreviation' => 'CVSC-MAIN',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11176',
          'institution_name' => 'Compostela Valley State College - Maragusan Branch',
          'abbreviation' => 'CVSC-MAR',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11177',
          'institution_name' => 'Compostela Valley State College - Montevista Branch',
          'abbreviation' => 'CVSC-MON',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11178',
          'institution_name' => 'Compostela Valley State College - New Bataan Branch',
          'abbreviation' => 'CVSC-NB',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11012',
          'institution_name' => 'Cor Jesu College',
          'abbreviation' => 'CJC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11014',
          'institution_name' => 'Davao Central College',
          'abbreviation' => 'DCC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11015',
          'institution_name' => 'Davao Del Norte State College',
          'abbreviation' => 'DDNSC',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11016',
          'institution_name' => 'Davao Doctors College',
          'abbreviation' => 'DDC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11018',
          'institution_name' => 'Davao Medical School Foundation College',
          'abbreviation' => 'DMSFC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11021c',
          'institution_name' => 'Davao Oriental State College of Science and Technology - Banaybanay Extension',
          'abbreviation' => 'DOSCST-BANAY',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11021a',
          'institution_name' => 'Davao Oriental State College of Science and Technology - Cateel Extension',
          'abbreviation' => 'DOSCST-CAT',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11021',
          'institution_name' => 'Davao Oriental State College of Science and Technology - Mati City (Main)',
          'abbreviation' => 'DOSCST-MATI',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11021b',
          'institution_name' => 'Davao Oriental State College of Science and Technology - San Isidro Extension',
          'abbreviation' => 'DOSCST-SI',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11158',
          'institution_name' => 'Davao Vision Colleges, Inc.',
          'abbreviation' => 'DVCI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11137',
          'institution_name' => 'Davao Winchester Colleges, Inc.',
          'abbreviation' => 'DWCI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11019',
          'institution_name' => 'DMMA College of Southern Philippines',
          'abbreviation' => 'DMMA-SP',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11165',
          'institution_name' => 'Evangelical Mission College',
          'abbreviation' => 'EMC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11026',
          'institution_name' => 'Evelyn E. Fabie College',
          'abbreviation' => 'EEFC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11154',
          'institution_name' => 'Gabriel Taborin College of Davao Foundation',
          'abbreviation' => 'GTCDF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11030',
          'institution_name' => 'General Baptist Bible College',
          'abbreviation' => 'GBBC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11156',
          'institution_name' => 'Governor Generoso College of Arts, Sciences and Technology',
          'abbreviation' => 'GGCAST',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11126',
          'institution_name' => 'Holy Child College of Davao',
          'abbreviation' => 'HCCD',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11033',
          'institution_name' => 'Holy Cross College of Calinan',
          'abbreviation' => 'HCCC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11144',
          'institution_name' => 'Holy Cross College of Sasa',
          'abbreviation' => 'HCCS',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11035',
          'institution_name' => 'Holy Cross of Davao College',
          'abbreviation' => 'HCDC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11174',
          'institution_name' => 'Institute of International Culinary and Hospitality Entrepreneurship',
          'abbreviation' => 'IICHE',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11115',
          'institution_name' => 'Interface Computer College',
          'abbreviation' => 'ICC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11100',
          'institution_name' => 'Joji Ilagan Career Center Foundation',
          'abbreviation' => 'JICCF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11179',
          'institution_name' => 'Joji Ilagan International Management School',
          'abbreviation' => 'JIIMS',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11131',
          'institution_name' => 'Jose Maria College',
          'abbreviation' => 'JMC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11142',
          'institution_name' => 'Kapalong College Of Agriculture, Sciences And Technology',
          'abbreviation' => 'KCAST',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11164',
          'institution_name' => 'Koinonia Theological Seminary Foundation',
          'abbreviation' => 'KTSF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11169',
          'institution_name' => 'Kolehiyo Ng Pantukan',
          'abbreviation' => 'KP',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11146',
          'institution_name' => 'Laak Institute Foundation',
          'abbreviation' => 'LIF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11138',
          'institution_name' => 'Legacy College Of Compostela',
          'abbreviation' => 'LCC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11039',
          'institution_name' => 'Liceo De Davao',
          'abbreviation' => 'LDD',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11183',
          'institution_name' => 'Lyceum of the Philippines-Davao',
          'abbreviation' => 'LPD',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11180',
          'institution_name' => 'Malayan Colleges Mindanao',
          'abbreviation' => 'MCM',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11184',
          'institution_name' => 'Maryknoll College of Panabo, Inc.',
          'abbreviation' => 'MCPI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11128',
          'institution_name' => 'Mati Doctors College',
          'abbreviation' => 'MDC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11041',
          'institution_name' => 'Mati Polytechnic College',
          'abbreviation' => 'MPC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11042',
          'institution_name' => 'MATS College of Technology',
          'abbreviation' => 'MATSCT',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11125',
          'institution_name' => 'Mindanao Kokosai Daigaku',
          'abbreviation' => 'MKD',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11044',
          'institution_name' => 'Mindanao Medical Foundation College',
          'abbreviation' => 'MMFC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11161',
          'institution_name' => 'Monkayo College of Arts, Sciences and Technology',
          'abbreviation' => 'MCAST',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11168',
          'institution_name' => 'Mt. Apo Science Foundation College',
          'abbreviation' => 'MASFC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11049',
          'institution_name' => 'NDC Tagum Foundation',
          'abbreviation' => 'NDCTF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11050',
          'institution_name' => 'North Davao Colleges',
          'abbreviation' => 'NDC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11170',
          'institution_name' => 'Northlink Technological College',
          'abbreviation' => 'NTC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11124',
          'institution_name' => 'Philippine College of Technology',
          'abbreviation' => 'PCT',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11055',
          'institution_name' => 'Philippine Womens College of Davao',
          'abbreviation' => 'PWC-DAV',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11056',
          'institution_name' => 'Polytechnic College Of Davao Del Sur',
          'abbreviation' => 'PCDDS',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11058',
          'institution_name' => 'Queen Of Apostles College Seminary',
          'abbreviation' => 'QACS',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11063',
          'institution_name' => 'Saint Francis Xavier College Seminary',
          'abbreviation' => 'SFXCS',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11066',
          'institution_name' => 'Saint Peters College of Toril',
          'abbreviation' => 'SPCT',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11185',
          'institution_name' => 'Samal Island City College',
          'abbreviation' => 'SICC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11167',
          'institution_name' => 'Samson Polytechnic College of Davao',
          'abbreviation' => 'SPCD',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11070',
          'institution_name' => 'San Pedro College',
          'abbreviation' => 'SPC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11075',
          'institution_name' => 'Serapion C. Basalo Memorial Colleges',
          'abbreviation' => 'SCBMC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11078',
          'institution_name' => 'South Philippine Adventist College',
          'abbreviation' => 'SPAC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11076',
          'institution_name' => 'Southeastern College Of Padada',
          'abbreviation' => 'SCP',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11098',
          'institution_name' => 'Southern Philippines Agri-Business, Marine and Aquatic School of Technology -Digos',
          'abbreviation' => 'SPABMAST-DIGOS',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11077',
          'institution_name' => 'Southern Philippines Agri-Business, Marine and Aquatic School of Technology -Malita (Main)',
          'abbreviation' => 'SPABMAST-MAIN',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11129',
          'institution_name' => 'Southern Philippines Baptist Theological Seminary, Inc.',
          'abbreviation' => 'SPBTSI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11101',
          'institution_name' => 'St. Francis Xavier Regional Major Seminary of Mindanao, Inc.',
          'abbreviation' => 'SFXRMSMI',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11123',
          'institution_name' => 'St. John Paul II College Of Davao',
          'abbreviation' => 'SJPII',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11140',
          'institution_name' => 'St. MaryS College Baganga',
          'abbreviation' => 'SM-BAG',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11034',
          'institution_name' => 'St. MaryS College Of Bansalan',
          'abbreviation' => 'SM-BAN',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11064',
          'institution_name' => 'St. MaryS College Of Tagum',
          'abbreviation' => 'SM-TAG',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11160',
          'institution_name' => 'St. Thomas More College Of Law And Business',
          'abbreviation' => 'STMCLB',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11186',
          'institution_name' => 'STI College Tagum',
          'abbreviation' => 'STI-TAGUM',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11130',
          'institution_name' => 'STI College Davao',
          'abbreviation' => 'STI-DAVAO',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11182',
          'institution_name' => 'Sto. Tomas College of Agriculture, Sciences and Technology',
          'abbreviation' => 'STCAST',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11172',
          'institution_name' => 'Tagum City College Of Science And Technology Foundation',
          'abbreviation' => 'TCCSTF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11153',
          'institution_name' => 'Tagum Doctors College',
          'abbreviation' => 'TDC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11085',
          'institution_name' => 'Tecarro College Foundation',
          'abbreviation' => 'TCF',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11062',
          'institution_name' => 'The Rizal Memorial Colleges',
          'abbreviation' => 'TRMC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11088',
          'institution_name' => 'UM Bansalan College',
          'abbreviation' => 'UM-BAN',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11089',
          'institution_name' => 'UM Digos College',
          'abbreviation' => 'UM-DIG',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11091',
          'institution_name' => 'UM Panabo College',
          'abbreviation' => 'UM-PAN',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11120',
          'institution_name' => 'UM Peñaplata College',
          'abbreviation' => 'UM-PEN',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11092',
          'institution_name' => 'UM Tagum College',
          'abbreviation' => 'UM-TAG',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11093',
          'institution_name' => 'University of Mindanao',
          'abbreviation' => 'UM-MAIN',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11096',
          'institution_name' => 'University of Southeastern Philippines - Tagum/Mabini',
          'abbreviation' => 'USEP-TAG',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11099',
          'institution_name' => 'University of Southeastern Philippines-Mintal Campus',
          'abbreviation' => 'USEP-MIN',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11094',
          'institution_name' => 'University of Southeastern Philippines-Obrero (Main)',
          'abbreviation' => 'USEP-MAIN',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11095',
          'institution_name' => 'University of the Immaculate Conception',
          'abbreviation' => 'UIC',
          'institution_types_id' => '2',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);
     
     DB::table('institutions')->insert([
          'code' => '11107',
          'institution_name' => 'University of the Philippines-Mindanao',
          'abbreviation' => 'UP-MIN',
          'institution_types_id' => '1',
          'statuses_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
     ]);




    }
}
