<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [   'id' => 1,
                'name' => 'Murat TEMİZEL',
                'email' => 'murat.temizel@antalya.edu.tr',
                'password' => '$2y$10$AOClkj6hL0p..zy/KdWe9eN71KWdQqZuoVXkuwt4Y2hS4dQ9t9bWK',
                'status' => 0,
            ]
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
