<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('template_settings')->insert([
            [
                'id' => 1,
                'certificate_id' => '1',
                'certificate_value' => 'trfullname',
                'certificate_coord' => '125,95',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:17:50',
            ],
            [
                'id' => 2,
                'certificate_id' => '1',
                'certificate_value' => 'trclassnameeng',
                'certificate_coord' => '170,130',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:17:50',
            ],
            [
                'id' => 3,
                'certificate_id' => '1',
                'certificate_value' => 'trcreatedtime',
                'certificate_coord' => '95,130',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'certificate_id' => '1',
                'certificate_value' => 'trclassname',
                'certificate_coord' => '47,135',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:17:50',
            ],
            [
                'id' => 5,
                'certificate_id' => '2',
                'certificate_value' => 'kfullname',
                'certificate_coord' => '0',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'certificate_id' => '2',
                'certificate_value' => 'keducationtime',
                'certificate_coord' => '0',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 7,
                'certificate_id' => '2',
                'certificate_value' => 'kcreatedtime',
                'certificate_coord' => '0',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 8,
                'certificate_id' => '2',
                'certificate_value' => 'kclassname',
                'certificate_coord' => '0',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 9,
                'certificate_id' => '3',
                'certificate_value' => 'tfullname',
                'certificate_coord' => '130,105',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:19:38',
            ],
            [
                'id' => 10,
                'certificate_id' => '3',
                'certificate_value' => 'teducationtime',
                'certificate_coord' => '62,142',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:19:38',
            ],
            [
                'id' => 11,
                'certificate_id' => '3',
                'certificate_value' => 'tcreatedtime',
                'certificate_coord' => '95,130',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:19:38',
            ],
            [
                'id' => 12,
                'certificate_id' => '3',
                'certificate_value' => 'tclassname',
                'certificate_coord' => '90,143',
                'created_at' => null,
                'updated_at' => '2024-11-21 06:19:38',
            ],
        ]);
    }
}
