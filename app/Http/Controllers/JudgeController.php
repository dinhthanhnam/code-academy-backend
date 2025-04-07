<?php

namespace App\Http\Controllers;

use App\Models\CourseExercise;
use App\Models\Exercise;
use App\Models\Submission;
use HttpException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JudgeController extends Controller
{
    /**
     * @throws ConnectionException
     * @throws HttpException
     */
    public function submit(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'course_class_id' => 'required|integer',
            'exercise_id' => 'required|integer',
        ]);

        $courseClassId = $request->input('course_class_id');
        $exerciseId = $request->input('exercise_id');
        $sourceCode = $request->input('code');

        // Validate course exercise and related data
        $courseExercise = CourseExercise::where('course_class_id', $courseClassId)
            ->where('exercise_id', $exerciseId)
            ->first();

        if (!$courseExercise) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy bài tập'], 404);
        }

        if (!$courseExercise->is_active) {
            return response()->json(['success' => false, 'message' => 'Bài tập đã đóng'], 403);
        }

        $exercise = Exercise::find($exerciseId);
        if (!$exercise) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy bài tập'], 404);
        }

        $language = $exercise->language()->first();
        if (!$language) {
            return response()->json(['success' => false, 'message' => 'Ngôn ngữ không hợp lệ'], 400);
        }

        $testCases = json_decode($exercise->test_cases, true);
        if (empty($testCases)) {
            return response()->json(['success' => false, 'message' => 'Không có test case'], 400);
        }

        // Process each test case with single submissions
        $judgedResults = [];
        foreach ($testCases as $test) {
            $submissionData = [
                'source_code'    => $sourceCode,
                'language_id'    => $language->judge_language_id,
                'stdin'          => $test['stdin'],
                'expected_output'=> $test['expected_output'],
                'cpu_time_limit' => $exercise->time_limit,
                'memory_limit'   => $exercise->memory_limit * 1024,
            ];

            $response = Http::post(env('JUDGE_HOST') . '/submissions?base64_encoded=false&wait=true', $submissionData);

            if (!$response->successful()) {
                \Log::error('Judge0 single submission failed:', [$response->body()]);
                throw new HttpException(502, 'Không thể kết nối tới Judge0');
            }

            $judgedResults[] = $response->json();
        }

        \Log::info('Judge0 Single Submission Results:', [$judgedResults]);

        // Process results
        $allPassed = true;
        $totalTime = 0;
        $totalMemory = 0;
        $outputs = [];

        foreach ($judgedResults as $index => $res) {
            $outputs[] = [
                'test_case' => $testCases[$index],
                'stdout' => $res['stdout'] ?? null,
                'stderr' => $res['stderr'] ?? null,
                'status' => $res['status']['description'] ?? 'Unknown',
                'time' => $res['time'] ?? null,
                'memory' => $res['memory'] ?? null,
            ];

            $totalTime += $res['time'] ?? 0;
            $totalMemory += $res['memory'] ?? 0;

            if (($res['status']['id'] ?? 0) !== 3) { // 3 = Accepted
                $allPassed = false;
            }
        }

        // Save submission
        $submission = Submission::create([
            'user_id'         => \Auth::id(),
            'exercise_id'     => $exerciseId,
            'course_class_id' => $courseClassId,
            'source_code'     => $sourceCode,
            'language'        => $language->name,
            'status'          => $allPassed ? 'accepted' : 'failed',
            'execution_time'  => round($totalTime, 3),
            'memory_used'     => (int) $totalMemory,
            'output'          => json_encode($outputs),
        ]);

        return response()->json([
            'success' => true,
            'message' => $allPassed ? 'Nộp bài thành công, tất cả test đều đúng' : 'Nộp bài thành công, một số test bị sai',
            'submission_id' => $submission->id,
            'results' => $outputs,
        ]);
    }
}
