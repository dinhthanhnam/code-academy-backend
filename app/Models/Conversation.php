<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $regular_class_id
 * @property int|null $course_class_id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseClass|null $course_class
 * @property-read \App\Models\RegularClass|null $regular_class
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereCourseClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereRegularClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
