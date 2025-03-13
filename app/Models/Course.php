<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = ['course_code', 'name'];

    public function course_classes(): Builder|HasMany
    {
        return $this->hasMany(CourseClass::class, 'assigned_regular_class_id');
    }
    public function predefined_problems(): BelongsToMany
    {
        return $this->belongsToMany(Problem::class, 'course_problem', 'course_id', 'problem_id')
            ->using(CourseProblem::class)
            ->withPivot(['week_number', 'deadline', 'is_hard_deadline'])
            ->wherePivot('course_class_id', null);
    }

}
