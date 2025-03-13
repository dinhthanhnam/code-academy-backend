<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code', 'name'];

    public function courseClasses() {
        return $this->hasMany(CourseClass::class, 'assigned_regular_class_id');
    }
}
