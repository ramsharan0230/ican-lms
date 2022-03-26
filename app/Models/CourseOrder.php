<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseOrder extends Model
{
    protected $table = 'course_payments';
    protected $fillable = ['operation_id'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function course() {
        return $this->belongsTo('App\Models\Course');
    }
}
