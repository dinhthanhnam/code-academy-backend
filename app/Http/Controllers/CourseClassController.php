<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseClassResource;
use App\Http\Resources\ExerciseResource;
use App\Http\Resources\UserResource;
use App\Models\CourseClass;
use Exception;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CourseClassController extends Controller
{
    // Lấy thông tin lớp học
    public function course_class_detail(Request $request, string $slug)
    {
        try {
            // Get the authenticated user
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'success' => false
                ], Response::HTTP_UNAUTHORIZED);
            }

            // Check if the course class exists in user's related course_classes
            $course_class = $user->course_class()
                ->where('slug', $slug)
                ->first();

            if (!$course_class) {
                return response()->json([
                    'message' => 'Không tìm thấy lớp hoặc bạn không có quyền truy cập',
                    'success' => false
                ], Response::HTTP_NOT_FOUND);
            }

            return new CourseClassResource($course_class);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function course_class_exercises(string $slug) {
        try {

            $course_class = CourseClass::where('slug', $slug)->first();

            if (!$course_class) {
                return response()->json([
                    'message' => 'Không tìm thấy lớp',
                    'success' => false
                ], Response::HTTP_NOT_FOUND);
            }

            // Sử dụng with() để eager load các quan hệ topics và language
            $exercises = $course_class->exercises()
                ->with(['topics', 'language'])
                ->paginate(8);

            return ExerciseResource::collection($exercises);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

// Lấy danh sách sinh viên
    public function course_class_students(string $slug) {
        try {
            $course_class = CourseClass::where('slug', $slug)->first();

            if (!$course_class) {
                return response()->json([
                    'message' => 'Không tìm thấy lớp',
                    'success' => false
                ], Response::HTTP_NOT_FOUND);
            }

            return UserResource::collection($course_class->students()->paginate(8));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
