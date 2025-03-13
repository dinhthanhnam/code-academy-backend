<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'tech',
            'email' => 'tech@example.com',
            'password' => Hash::make('tech1234'),
            'role' => 'technician',
        ]);
        User::factory()->create([
            'name' => 'lecturer',
            'email' => 'lecturer@example.com',
            'password' => Hash::make('lecturer1234'),
            'role' => 'lecturer',
        ]);

        $this->call(LecturerSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(CourseSeeder::class);
    }
}
