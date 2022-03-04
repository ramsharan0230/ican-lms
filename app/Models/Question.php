<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'question_type',
        'lesson_id',
        'question_text',
        'question_options',
        'question_answer',
    ];

    public function Tests() {
        return $this->belongsToMany('App\Models\Test', 'question_test', 'question_id', 'test_id');
    }

    public function lessions() {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }
}
