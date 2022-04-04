<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\Tests;

use App\Models\TestResult;
use App\Models\Question;
use App\Models\AssignCourse;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use PDF;

class TestResultController extends Controller
{
    public $user_id;
    public function __construct(Guard $auth) {
        $this->user_id = $auth->id();
    }

	public function getTestResult($id, TestResult $testresult) {
		$data['obtainedMarks'] = $testresult->getMarksObtained($id);;
        $data['result'] = TestResult::findOrFail($id);
        $data['answers'] = unserialize($data['result']->test_answers);
        $data['test'] = $data['result']->test;
        $data['questions'] = Question::all();
        $data['obtainedPercentage'] = empty($data['obtainedMarks'])?0:($data['obtainedMarks'] / $data['test']->full_marks) * 100;
        if(Auth::user()->role_id == 1){
            $data['assigned_courses'] = AssignCourse::join('courses', 'assign_courses.course_id', '=', 'courses.id')
                                ->select('assign_courses.start_date as start_date', 'assign_courses.end_date as end_date','courses.*', 'courses.id as course_id')
                                ->where('assign_courses.user_id', '=', $this->user_id )->orderBy('created_at', 'desc')->get();
        }
        return view('customized.super-admin.e-learnings.test-result.view', $data);
	}
	
	public function getResultCertificate($id, TestResult $testresult) {
        $result = TestResult::findOrFail($id);
        $answers = unserialize($result->test_answers);

        $data['obtainedMarks'] = $testresult->getMarksObtained($id);
        $data['user'] = $result->user;
        $data['test'] = $result->test;
        $data['result'] = $result;
        $data['course'] = $data['test']->lesson->courses->first();
        $data['lesson'] = $data['test']->lesson;
        $data['answers'] = $answers;
        $data['questions'] = Question::all();
        $user = $result->user;
        $course = $data['test']->lesson->courses->first();
        $lesson = $data['test']->lesson;
        $result = $result;

        $pdf = PDF::loadView('pdf.certificate', ['user'=> $user,'course'=> $course,'lesson'=>$lesson, 'result' => $result]);
        return $pdf->download('certificate.pdf');
    }
    /*=============================== Test Result ===========================================================*/

    public function getTestResults() {
        $data['results'] = TestResult::paginate(15);
        $data['status'] = 'all';
    	return view('customized.super-admin.result', $data);

    }
    
    public function getTestResultsFailed() {
    
        $data['results'] = TestResult::paginate(15);
    	return view('customized.super-admin.result-failed', $data);

    }
    
    public function getTestResultsPass()
    {
        $data['results'] = TestResult::paginate(15);
        $data['assigned_courses'] = AssignCourse::join('courses', 'assign_courses.course_id', '=', 'courses.id')
                                ->select('assign_courses.start_date as start_date', 'assign_courses.end_date as end_date','courses.*', 'courses.id as course_id')
                                ->where('assign_courses.user_id', '=', $this->user_id )->orderBy('created_at', 'desc')->paginate(15);

    	return view('customized.super-admin.result-pass', $data);

    }
}
