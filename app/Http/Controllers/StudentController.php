<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function personal_course_classes(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'Cút ra ngoài!'
            ], 401); // Thêm status code 401 cho không xác thực
        }

        // Giả định course_class() là quan hệ hasMany hoặc belongsToMany
        $courses = $request->user()->course_class()->get();

        // Nếu cần định dạng lại dữ liệu
        $formattedCourses = $courses->map(function ($course) {
            return [
                'id' => Hash::make($course->slug . rand(10 , 99)), // Ép kiểu thành string để khớp với frontend
                'name' => $course->name,
                'path' => "/" . $course->slug, // Đường dẫn động
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Lấy dữ liệu thành công!',
            'personal_course_classes' => $formattedCourses
        ]);
    }
}
