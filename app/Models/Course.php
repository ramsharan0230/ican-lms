<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'name',
        'display_name',
        'creator_user_id',
        'category_id',
        'published_status',
        'for_days',
        'marked_price',
        'description', 
        'price',
        'video',
        'you_tube_video','video_time', 
        'cpe',
        'cpe_price'

    ];

    public function lessons() {
        return $this->belongsToMany('App\Models\Lesson', 'course_lesson', 'course_id', 'lesson_id');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function price() {
        if($this->price) {
            return 'Rs. ' . $this->price;
        } else {
            return 'FREE';
        }
    }
}
