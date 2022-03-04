<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignCourse extends Model
{
    protected $table = 'assign_courses';

    protected $fillable = [
        'user_id',
        'course_id',
        'start_date',
        'end_date'
    ];

    //protected $dates = ['start_date', 'end_date'];


    public function course() {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
