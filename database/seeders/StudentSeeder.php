<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'student1', 'email' => 'student1@hvnh.edu.vn', 'password' => 'student1', 'regular_class_id' => 1],
            ['name' => 'student2', 'email' => 'student2@hvnh.edu.vn', 'password' => 'student2', 'regular_class_id' => 2],
            ['name' => 'student3', 'email' => 'student3@hvnh.edu.vn', 'password' => 'student3', 'regular_class_id' => 3],
            ['name' => 'student4', 'email' => 'student4@hvnh.edu.vn', 'password' => 'student4', 'regular_class_id' => 4],
            ['name' => 'student5', 'email' => 'student5@hvnh.edu.vn', 'password' => 'student5', 'regular_class_id' => 5],
            ['name' => 'student6', 'email' => 'student6@hvnh.edu.vn', 'password' => 'student6', 'regular_class_id' => 6],
            ['name' => 'student7', 'email' => 'student7@hvnh.edu.vn', 'password' => 'student7', 'regular_class_id' => 7],
            ['name' => 'student8', 'email' => 'student8@hvnh.edu.vn', 'password' => 'student8', 'regular_class_id' => 8],
            ['name' => 'student9', 'email' => 'student9@hvnh.edu.vn', 'password' => 'student9', 'regular_class_id' => 9],
        ];
        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make($student['password']),
                'regular_class_id' => $student['regular_class_id'],
            ]);
        }
    }
}
