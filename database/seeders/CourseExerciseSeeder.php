<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\CourseClass;
use Carbon\Carbon;

class CourseExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả course từ bảng courses
        $courses = Course::all();

        // Nếu không có course, thoát
        if ($courses->isEmpty()) {
            echo "Không có course nào để seed.\n";
            return;
        }

        // Danh sách bài tập và các course mà nó thuộc về
        $exerciseAssignments = [
            [
                'exercise_id' => 1, // "Tính tổng hai số"
                'course_ids' => [1, 2], // Thuộc course 1 và 2
                'week_number' => 1,
                'is_hard_deadline' => true,
                'is_active' => true,
                'deadline' => Carbon::create(2025, 4, 10, 23, 59, 59),
            ],
            [
                'exercise_id' => 2, // "Kiểm tra số chẵn"
                'course_ids' => [1], // Chỉ thuộc course 1
                'week_number' => 1,
                'is_hard_deadline' => false,
                'is_active' => true,
                'deadline' => Carbon::create(2025, 4, 12, 23, 59, 59),
            ],
            [
                'exercise_id' => 3, // "Tìm số lớn nhất"
                'course_ids' => [1, 3], // Thuộc course 1 và 3
                'week_number' => 2,
                'is_hard_deadline' => true,
                'is_active' => true,
                'deadline' => Carbon::create(2025, 4, 17, 23, 59, 59),
            ],
            [
                'exercise_id' => 4, // "Số Fibonacci"
                'course_ids' => [2], // Chỉ thuộc course 2
                'week_number' => 3,
                'is_hard_deadline' => false,
                'is_active' => true,
                'deadline' => Carbon::create(2025, 4, 24, 23, 59, 59),
            ],
            [
                'exercise_id' => 5, // "Sắp xếp mảng"
                'course_ids' => [2, 3], // Thuộc course 2 và 3
                'week_number' => 4,
                'is_hard_deadline' => true,
                'is_active' => true,
                'deadline' => Carbon::create(2025, 5, 1, 23, 59, 59),
            ],
            [
                'exercise_id' => 6, // "Kiểm tra số nguyên tố"
                'course_ids' => [2], // Chỉ thuộc course 2
                'week_number' => 5,
                'is_hard_deadline' => false,
                'is_active' => false,
                'deadline' => Carbon::create(2025, 5, 8, 23, 59, 59),
            ],
            [
                'exercise_id' => 7, // "Dãy con có tổng lớn nhất"
                'course_ids' => [3], // Chỉ thuộc course 3
                'week_number' => 6,
                'is_hard_deadline' => true,
                'is_active' => true,
                'deadline' => Carbon::create(2025, 5, 15, 23, 59, 59),
            ],
        ];

        foreach ($exerciseAssignments as $assignment) {
            // Lặp qua từng course_id mà bài tập thuộc về
            foreach ($assignment['course_ids'] as $courseId) {
                // Lấy tất cả course_class thuộc course_id
                $courseClasses = CourseClass::where('course_id', $courseId)->get();

                if ($courseClasses->isEmpty()) {
                    echo "Không có course_class nào cho course_id {$courseId}.\n";
                    continue;
                }

                // Gán bài tập cho từng course_class
                foreach ($courseClasses as $courseClass) {
                    DB::table('course_exercise')->insert([
                        'course_id' => $courseId,
                        'course_class_id' => $courseClass->id,
                        'exercise_id' => $assignment['exercise_id'],
                        'week_number' => $assignment['week_number'],
                        'is_hard_deadline' => $assignment['is_hard_deadline'],
                        'is_active' => $assignment['is_active'],
                        'deadline' => $assignment['deadline']->toDateTimeString(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}