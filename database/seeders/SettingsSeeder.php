<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'id' => 1,
                'email' => 'info@antalya.edu.tr',
            ]
        ];

        foreach ($settings as $setting) {
            Settings::create($setting);
        }
    }
}
