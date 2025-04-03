<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseClassResource;
use App\Http\Resources\ExerciseResource;
use App\Http\Resources\UserResource;
use App\Models\CourseClass;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CourseClassController extends Controller
{
    // Lấy thông tin lớp học
    public function course_class_detail(Request $request) {
        try {
            $validated = $request->validate([
                'slug' => 'required|exists:course_classes,slug'
            ]);

            $course_class = CourseClass::where('slug', $validated['slug'])->first();

            if (!$course_class) {
                return response()->json([
                    'message' => 'Không tìm thấy lớp',
                    'success' => false
                ], Response::HTTP_NOT_FOUND);
            }

            return new CourseClassResource($course_class);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function course_class_exercises(Request $request) {
        try {
            $validated = $request->validate([
                'slug' => 'required|exists:course_classes,slug'
            ]);

            $course_class = CourseClass::where('slug', $validated['slug'])->first();

            if (!$course_class) {
                return response()->json([
                    'message' => 'Không tìm thấy lớp',
                    'success' => false
                ], Response::HTTP_NOT_FOUND);
            }

            return ExerciseResource::collection($course_class->exercises()->paginate(8));
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

// Lấy danh sách sinh viên
    public function course_class_students(Request $request) {
        try {
            $validated = $request->validate([
                'slug' => 'required|exists:course_classes,slug'
            ]);

            $course_class = CourseClass::where('slug', $validated['slug'])->first();

            if (!$course_class) {
                return response()->json([
                    'message' => 'Không tìm thấy lớp',
                    'success' => false
                ], Response::HTTP_NOT_FOUND);
            }

            return UserResource::collection($course_class->students()->paginate(8));
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
