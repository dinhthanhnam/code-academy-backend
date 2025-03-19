<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 
 *
 * @property-read \App\Models\Course|null $course
 * @property-read \App\Models\CourseClass|null $course_class
 * @property-read \App\Models\Exercise|null $exercise
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseExercise query()
 * @mixin \Eloquent
 */
class CourseExercise extends Pivot
{
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function course_class(): BelongsTo
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
