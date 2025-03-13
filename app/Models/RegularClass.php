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

    public function students()
    {
        return $this->hasMany(User::class, 'regular_class_id')->where('role', 'student');
    }
    public function lecturer()
    {
        return $this->hasOne(User::class, 'regular_class_id')->where('role', 'lecturer');
    }
}
