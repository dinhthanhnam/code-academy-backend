<?php

namespace App\Http\Controllers;

use App\Models\CourseExercise;
use App\Models\Exercise;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JudgeController extends Controller
{
    /**
     * @throws ConnectionException
     */
    public function submit(Request $request)
    {
        // Validate request từ FE
        $request->validate([
            'code' => 'required|string',
            'course_class_id' => 'required|integer',
            'exercise_id' => 'required|integer',
        ]);

        $courseClassId = $request->input('course_class_id');
        $exerciseId = $request->input('exercise_id');
        $sourceCode = $request->input('code');

        // Kiểm tra bài tập trong lớp học
        $courseExercise = CourseExercise::where('course_class_id', $courseClassId)
            ->where('exercise_id', $exerciseId)
            ->first();

        if (!$courseExercise) {
            return response()->json(['message' => 'Không tìm thấy bài tập', 'success' => false], 404);
        }

        if (!$courseExercise->is_active) {
            return response()->json(['message' => 'Bài tập đã đóng', 'success' => false], 403);
        }

//        if ($courseExercise->deadline && now()->greaterThan($courseExercise->deadline)) {
//            return response()->json(['message' => 'Đã quá hạn nộp bài', 'success' => false], 403);
//        }

        // Lấy thông tin bài tập
        $exercise = Exercise::find($exerciseId);
        if (!$exercise) {
            return response()->json(['message' => 'Không tìm thấy bài tập', 'success' => false], 404);
        }

        // Parse test cases từ JSON
        $testCases = json_decode($exercise->test_cases, true);

        // Gửi từng test case đến Judge0
        $results = [];
        foreach ($testCases as $test) {
            $response = Http::post('http://localhost:2358/submissions?base64_encoded=false&wait=true', [
                'source_code' => $sourceCode,
                'language_id' => $exercise->language()->first()->judge_language_id,
                'stdin' => $test['stdin'],
                'expected_output' => $test['expected_output'],
            ]);

            $result = $response->json();
            $results[] = [
                'stdin' => $test['stdin'],
                'expected_output' => $test['expected_output'],
                'stdout' => $result['stdout'] ?? null,
                'stderr' => $result['stderr'] ?? null,
                'status' => $result['status']['description'] ?? 'Error',
            ];
        }

        // Trả về kết quả
        return response()->json([
            'results' => $results,
            'time_limit' => $exercise->time_limit,
            'memory_limit' => $exercise->memory_limit,
        ]);
    }
}
