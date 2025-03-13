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
}
