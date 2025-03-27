<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function lecturer_course_classes(Request $request): JsonResponse
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'Cút ra ngoài!'
            ], 401);
        }

        $user = $request->user();

        $course_classes = $user->course_class()->get();

        $regular_class = $user->regular_class;

        $formatted_course_classes = $course_classes->map(function ($course) {
            return [
                'id' => $course->slug . rand(10, 99),
                'name' => $course->name,
                'type' => 'course_class', // Đánh dấu là loại course_class
                'path' => "/" . $course->slug,
            ];
        });

        // Format regular_class (nếu có)
        $formatted_regular_class = $regular_class ? [[
            'id' => $regular_class->id . rand(10, 99),
            'name' => $regular_class->name,
            'type' => 'regular_class',
            'path' => "/regular/" . $regular_class->id,
        ]] : [];

        // Gộp dữ liệu từ cả hai nguồn
        $formatted_classes = array_merge($formatted_course_classes->toArray(), $formatted_regular_class);

        return response()->json([
            'success' => true,
            'message' => 'Lấy dữ liệu thành công!',
            'formatted_classes' => $formatted_classes
        ]);
    }
}
