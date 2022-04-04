<?php

use App\Models\TestResult;
use App\Models\Question;


/* Custom Admin Functions */
// Saving images from


// Getting result Values
if (!function_exists('get_result')) {
    function get_result($id, TestResult $testresult)
    {
        $obtainedMarks = $testresult->getMarksObtained($id);;
        $result = TestResult::findOrFail($id);
        $test   = $result->test;


        $data['questions']          = Question::all();
        $data['obtainedPercentage'] = empty($obtainedMarks) ? 0 : ($obtainedMarks / $test->full_marks) * 100;


        if ($test->pass_marks <= $obtainedMarks) {
            return '<p class="label label-success">Passed</p>';
        } else {
            return '<p class="label label-danger">Failed</p>';
        }
    }
}


// Getting User Name
if (!function_exists('get_test')) {
    function get_test($id)
    {
        $test =\App\Models\Test::where('id',$id)->first();
        if (isset($test)) {
            return $test->name;
        } else {
            return null;
        }
    }
}

// Getting User Name
if (!function_exists('get_user')) {
    function get_user($id)
    {
        $user = \App\Models\User::where('id',$id)->first();
        if (isset($user)) {
            return $user->first_name.' '.$user->middle_name.' '.$user->last_name;
        } else {
            return null;
        }
    }
}

if (!function_exists('get_user_serial_no')) {
    function get_user_serial_no($id)
    {
        $user = \App\Models\User::where('id',$id)->first();
        if (isset($user)) {
            return $user->serial_no;
        } else {
            return null;
        }
    }
}

if (!function_exists('get_user_category')) {
    function get_user_category($id)
    {
        $user = \App\Models\User::where('id',$id)->first();
        if (isset($user)) {
            return $user->category;
        } else {
            return null;
        }
    }
}

if (!function_exists('get_result_check')) {
    function get_result_check($id, TestResult $testresult)
    {
        $obtainedMarks = $testresult->getMarksObtained($id);;
        $result = TestResult::findOrFail($id);
        $test   = $result->test;

        if ($test->pass_marks <= $obtainedMarks) {
            return true;
        } else {
            return false;
        }
    }
}

