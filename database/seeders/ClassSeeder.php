<?php

namespace Database\Seeders;

use App\Models\RegularClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['class_code' => 'K24TCA', 'name' => 'K24 Tài chính A'],
            ['class_code' => 'K24TCB', 'name' => 'K24 Tài chính B'],
            ['class_code' => 'K24TCC', 'name' => 'K24 Tài chính C'],
            ['class_code' => 'K24TCD', 'name' => 'K24 Tài chính D'],
            ['class_code' => 'K24CNTTA', 'name' => 'K24 Công nghệ thông tin A'],
            ['class_code' => 'K24HTTTB', 'name' => 'K24 Hệ thống thông tin B'],
            ['class_code' => 'K24HTTTA', 'name' => 'K24 Hệ thống thông tin A'],
            ['class_code' => 'K23CNTTA', 'name' => 'K23 Công nghệ thông tin A'],
        ];

        foreach ($classes as $class) {
            RegularClass::create([
                'class_code' => $class['class_code'],
                'name' => $class['name'],
                'slug' => Str::slug($class['class_code']),
            ]);
        }
    }
}
