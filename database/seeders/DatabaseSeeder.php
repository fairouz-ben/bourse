<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(Relex_services::class);
        $this->call(Objectives::class);
        $this->call(Grades::class);
        $this->call(PaysSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
