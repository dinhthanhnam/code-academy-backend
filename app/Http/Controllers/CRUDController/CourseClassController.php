<?php

namespace App\Http\Controllers\CRUDController;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseClassResource;
use App\Models\CourseClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CourseClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CourseClass::query();

        // Nếu có search query, thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('course_class_code', 'like', "%$search%");
            });
        }
        return CourseClassResource::collection($query->paginate(8));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_class_code' => 'required|string|max:255|unique:courses',
            'name' => 'required|string|max:255',
            'course_class_join_code' => 'required|string|max:255|unique:courses'
        ]);

        $course = CourseClass::create($validated);
        return new CourseClassResource($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $course = CourseClass::findOrFail($id);
            return new CourseClassResource($course);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Không tìm thấy lớp học phần'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $course_class = CourseClass::findOrFail($id);
            $validated = $request->validate([
                'course_code' => 'sometimes|string|max:255|unique:courses,course_code,' . $id,
                'name' => 'sometimes|string|max:255',
            ]);

            $course_class->update($validated);
            return response()->json([
                'message' => 'Cập nhật lớp học phần thành công',
                'success' => true,
                'data' => new CourseClassResource($course_class)
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Không tìm thấy lớp học phần',
                'success' => false,
            ], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Không tìm thấy lớp học phần',
                'success' => false,
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            try {
                $course_class = CourseClass::findOrFail($id);
                $course_class->delete();
                return response()->json(['message' => 'Xoá lớp học phần thành công', 'success' => true]);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Không tìm thấy lớp học phần', 'success' => false], Response::HTTP_NOT_FOUND);
            } catch (QueryException $e) {
                if ($e->getCode() === '23000') {
                    return response()->json([
                        'message' => 'Không thể xóa lớp học phần vì còn liên kết với dữ liệu khác (sinh viên/giảng viên)',
                        'success' => false
                    ], Response::HTTP_CONFLICT);
                }

                return response()->json([
                    'message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage(),
                    'success' => false
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
