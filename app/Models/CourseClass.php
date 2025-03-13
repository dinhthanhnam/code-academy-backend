<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CourseClass extends Model
{
    protected $fillable = [
        'assigned_regular_class_id',
        'course_class_code',
        'name',
        'description',
        'start_date',
        'course_id',
        'slug',
    ];

    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function attendants()
    {
        return $this->belongsToMany(User::class, 'course_attendant', 'course_class_id', 'user_id')
            ->using(CourseAttendant::class)
            ->withPivot('role');
    }

    public function students()
    {
        return $this->attendants()->wherePivot('role', 'student');
    }

    public function lecturer()
    {
        return $this->attendants()->wherePivot('role', 'lecturer');
    }

    public function problems(): BelongsToMany
    {
        return $this->belongsToMany(Problem::class, 'course_problem', 'course_class_id', 'problem_id')
            ->using(CourseProblem::class)
            ->withPivot(['week_number', 'deadline', 'is_hard_deadline', 'is_active']);
    }

    public function all_problems()
    {
        return $this->belongsToMany(Problem::class, 'course_problem', 'course_class_id', 'problem_id')
            ->using(CourseProblem::class)
            ->withPivot(['week_number', 'deadline', 'is_hard_deadline', 'is_active'])
            ->where(function ($query) {
                $query->where('course_id', $this->course_id)
                    ->whereNull('course_class_id')
                    ->where('is_active', true);
            })
            ->orWhere(function ($query) {
                $query->where('course_class_id', $this->id)
                    ->where('is_active', true);
            });
    }
}
