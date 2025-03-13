<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegularClass extends Model
{
    protected $fillable = ['class_code', 'name', 'slug'];

    public function users()
    {
        return $this->hasMany(User::class, 'regular_class_id');
    }

    public function regular_students()
    {
        return $this->hasMany(User::class, 'regular_class_id')->where('role', 'student');
    }
    public function regular_lecturer()
    {
        return $this->hasOne(User::class, 'regular_class_id')->where('role', 'lecturer');
    }
}
