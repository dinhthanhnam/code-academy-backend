<?php

namespace App\Http\Controllers\CRUDController;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseClassResource;
use App\Models\CourseClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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
        return CourseClassResource::collection($query->paginate(7));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_class_code' => 'required|string|max:255|unique:courses',
            'name' => 'required|string|max:255',
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
            return new CourseClass($course);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Không tìm thấy học phần'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
