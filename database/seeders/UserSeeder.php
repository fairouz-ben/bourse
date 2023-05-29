<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'nom_ar' => 'الرئيسي',
            'prenom_ar' => 'المسؤول',
            'nom_fr' => 'super',
            'prenom_fr' => 'admin',
            'date_nais' => fake()->date(),
            'email' => 'relexbourse@univ-alger.dz',
            'relex_service_id' => '1',
            'is_admin'=>'1',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            
            'created_at'=>now(),
         ]);
    }
}
