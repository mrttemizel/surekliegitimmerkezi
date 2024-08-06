<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['HUKUK EĞİTİMLERİ','BİLİRKİŞİLİK EĞİTİMLERİ','BİLGİSAYAR DESTEKLİ CAD YAZILIM PROGRAMLARI','YABANCI DİL EĞİTİM PROGRAMLARI','MESLEKİ VE KİŞİSEL GELİŞİM EĞİTİMLERİ','KURUMLARA & OTELERE & FİRMALARA PAKET EĞİTİMLER '];
        foreach($categories as $category){
            $englishCategory = strtr($category, [
                'Ç' => 'C', 'Ğ' => 'G', 'İ' => 'I', 'Ş' => 'S', 'Ö' => 'O', 'Ü' => 'U',
                'ç' => 'c', 'ğ' => 'g', 'ı' => 'i', 'ş' => 's', 'ö' => 'o', 'ü' => 'u'
            ]);

            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($englishCategory),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
