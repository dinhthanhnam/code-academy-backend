<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            [
                'title' => 'Tính tổng hai số',
                'description' => 'Nhập hai số nguyên và tính tổng của chúng.',
                'level' => 'basic',
                'example_input' => '3 5',
                'example_output' => '8',
                'test_cases' => json_encode([
                    ['stdin' => '10 20', 'expected_output' => '30'],
                    ['stdin' => '-5 7', 'expected_output' => '2'],
                    ['stdin' => '0 0', 'expected_output' => '0']
                ]),
                'is_free' => true,
                'time_limit' => 1,
                'memory_limit' => 128
            ],
            [
                'title' => 'Kiểm tra số chẵn',
                'description' => 'Nhập một số nguyên, trả về 1 nếu là số chẵn, 0 nếu là số lẻ.',
                'level' => 'basic',
                'example_input' => '7',
                'example_output' => '0',
                'test_cases' => json_encode([
                    ['stdin' => '4', 'expected_output' => '1'],
                    ['stdin' => '-3', 'expected_output' => '0'],
                    ['stdin' => '0', 'expected_output' => '1']
                ]),
                'is_free' => true,
                'time_limit' => 1,
                'memory_limit' => 128
            ],
            [
                'title' => 'Tìm số lớn nhất',
                'description' => 'Nhập ba số nguyên và trả về số lớn nhất.',
                'level' => 'basic',
                'example_input' => '3 8 2',
                'example_output' => '8',
                'test_cases' => json_encode([
                    ['stdin' => '10 5 7', 'expected_output' => '10'],
                    ['stdin' => '-1 -5 -3', 'expected_output' => '-1'],
                    ['stdin' => '4 4 4', 'expected_output' => '4']
                ]),
                'is_free' => true,
                'time_limit' => 1,
                'memory_limit' => 128
            ],
            
            [
                'title' => 'Số Fibonacci',
                'description' => 'Nhập một số nguyên n và trả về số Fibonacci thứ n (bắt đầu từ n = 1, F(1) = 1, F(2) = 1).',
                'level' => 'intermediate',
                'example_input' => '10',
                'example_output' => '55',
                'test_cases' => json_encode([
                    ['stdin' => '5', 'expected_output' => '5'],
                    ['stdin' => '1', 'expected_output' => '1'],
                    ['stdin' => '7', 'expected_output' => '13']
                ]),
                'is_free' => false,
                'time_limit' => 2,
                'memory_limit' => 256
            ],
            [
                'title' => 'Sắp xếp mảng',
                'description' => 'Nhập một mảng số nguyên (dòng đầu là số phần tử n, dòng sau là n số) và trả về mảng đã sắp xếp tăng dần (các số cách nhau bởi dấu cách).',
                'level' => 'intermediate',
                'example_input' => "5\n5 3 8 2 1",
                'example_output' => '1 2 3 5 8',
                'test_cases' => json_encode([
                    ['stdin' => "3\n10 1 5", 'expected_output' => '1 5 10'],
                    ['stdin' => "4\n-1 0 2 -5", 'expected_output' => '-5 -1 0 2'],
                    ['stdin' => "2\n7 7", 'expected_output' => '7 7']
                ]),
                'is_free' => false,
                'time_limit' => 2,
                'memory_limit' => 256
            ],
            [
                'title' => 'Kiểm tra số nguyên tố',
                'description' => 'Nhập một số nguyên, trả về 1 nếu là số nguyên tố, 0 nếu không phải.',
                'level' => 'intermediate',
                'example_input' => '17',
                'example_output' => '1',
                'test_cases' => json_encode([
                    ['stdin' => '4', 'expected_output' => '0'],
                    ['stdin' => '23', 'expected_output' => '1'],
                    ['stdin' => '1', 'expected_output' => '0']
                ]),
                'is_free' => false,
                'time_limit' => 2,
                'memory_limit' => 256
            ],
            
            [
                'title' => 'Dãy con có tổng lớn nhất',
                'description' => 'Nhập một mảng số nguyên (dòng đầu là số phần tử n, dòng sau là n số) và trả về tổng lớn nhất của một dãy con liên tiếp.',
                'level' => 'advanced',
                'example_input' => "9\n-2 1 -3 4 -1 2 1 -5 4",
                'example_output' => '6',
                'test_cases' => json_encode([
                    ['stdin' => "5\n-1 -2 -3 -4 -5", 'expected_output' => '-1'],
                    ['stdin' => "3\n10 -5 7", 'expected_output' => '12'],
                    ['stdin' => "4\n1 2 3 4", 'expected_output' => '10']
                ]),
                'is_free' => false,
                'time_limit' => 3,
                'memory_limit' => 512
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}

