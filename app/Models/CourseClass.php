<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(CourseAttendant::class, 'course_class_id');
    }
}
