<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $fillable = ['regular_class_id', 'course_class_id', 'slug'];

    public function regular_class()
    {
        return $this->belongsTo(RegularClass::class, 'regular_class_id');
    }

    public function course_class()
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }
}
