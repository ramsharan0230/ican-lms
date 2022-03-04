<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $guarded = ['id'];

    public function tests() {
    	return $this->hasMany('App\Models\Test', 'lesson_id');
    }

    public function courses() {
        return $this->belongsToMany('App\Models\Course', 'course_lesson', 'lesson_id', 'course_id');
    }
}
