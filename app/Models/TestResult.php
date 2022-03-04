<?php

namespace App\Models;

use App\Models\Test;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $table = "test_results";
    protected $fillable = [
    	'test_id', 'user_id', 'question_id','test_quesstions', 'test_answers', 'correct_answers', 'user_ip', 'user_country'
    ];

    public function test() {
    	return $this->belongsTo('App\Models\Test', 'test_id');
    }

    public function user() {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getMarksObtained($result_id) {
        $result = $this->findOrFail($result_id);
        $answers = unserialize($result->test_answers);
        $test = Test::where('id', $result->test_id)->first();
        if($test){
            $fullmarks = $test->full_marks;
            //$questions_count = $test->questions->count();
            $questions_count = 10;
            if($questions_count == 0)
            {
                $marks = 0;
            }else{
                $marks = $fullmarks/$questions_count;
            }
    
            $obtainedMarks = 0;
            if($answers){
                foreach ($answers as $key => $answer) {
                    $question = Question::findOrFail($key);
    
                    if($question->question_type !== 'true-false') {
                        $check = array_diff_key(unserialize($question->question_answer), $answer);
    
                        if(empty($check)) {
                            $obtainedMarks += $marks;
                        }
                    } else {
                        if(serialize($answer) == $question->question_answer) {
                            $obtainedMarks += $marks;
                        }
                    }
                }
            }
    
            return $obtainedMarks;
        }else{
            return 0;
        }

    }
}
