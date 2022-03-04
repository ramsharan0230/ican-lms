<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    protected $fillable = [
        'lesson_id',
        'name',
        'duration',
        'repetition',
        'published_status',
        'description',
        'full_marks',
        'pass_marks',
        'shuffle_questions',
        'shuffle_answers'
    ];

    public function lesson() {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }

    public function questions() {
        return $this->belongsToMany('App\Models\Question', 'question_test', 'test_id', 'question_id');
    }

    public function test_results() {
        return $this->hasMany('App\Models\TestResult', 'test_id');
    }

    public function shuffle_answers(&$array) {
        $keys = array_keys($array);

        shuffle($keys);
        if($keys) {
            foreach($keys as $key) {
                $new[$key] = $array[$key];
            }
            $array = $new;
        }
        
        return true;
    }
}
