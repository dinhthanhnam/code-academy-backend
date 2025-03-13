<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseProblem extends Pivot
{
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function course_class(): BelongsTo
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class);
    }
}
