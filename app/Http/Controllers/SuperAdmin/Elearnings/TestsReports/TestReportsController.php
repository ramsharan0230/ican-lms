<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\TestsReports;

use App\Models\TestResult;
use App\Models\Course;
use App\Models\AssignCourse;
use App\Models\User;
use App\Models\TimeSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;

class TestReportsController extends Controller
{
    public $status_message = null;
	public $alert_status = "success";
	public $user_id;
	public function __construct(Guard $auth) {
        $this->user_id = $auth->id();
    }

    public function getReportUserwise() {
    	$data['users'] = User::orderBy('created_at', 'desc')->paginate(20);
    	return view('customized.super-admin.e-learnings.test-reports.userwise', $data);
    }

    public function getReportUserwiseView($id) {
        $data['user'] = User::findOrFail($id);
        $data['test_results'] = TestResult::with('test')->with('user')->where('user_id', $id)->get();
        if(Auth::user()->role_id == 1){
            $data['assigned_courses'] = AssignCourse::join('courses', 'assign_courses.course_id', '=', 'courses.id')
                                ->select('assign_courses.start_date as start_date', 'assign_courses.end_date as end_date','courses.*', 'courses.id as course_id')
                                ->where('assign_courses.user_id', '=', $this->user_id )->orderBy('created_at', 'desc')->paginate(15);
        }
        return view('customized.super-admin.e-learnings.test-reports.results.userwise-view', $data);
    }

    public function getReportDatewise() {
    	$data['test_results'] = TestResult::with('test')->with('user')->orderBy('created_at', 'desc')->paginate(15);

        return view('customized.super-admin.e-learnings.test-reports.datewise', $data);
    }

    public function getReportDatewiseSearch(Request $request) {
        $from = $request->input('from');
        $to = $request->input('to');

        $data['test_results'] = TestResult::whereBetween('created_at', array($from, $to))->get();

    	return view('super-admin.e-learnings.test-reports.datewise', $data);
    }

    public function getReportCoursewise() {
    	$data['courses'] = Course::orderBy('created_at', 'desc')->get();

        return view('super-admin.e-learnings.test-reports.coursewise', $data);
    }

    public function getReportCoursewiseView($id) {
        $course = Course::findOrFail($id);

        $data['course'] = $course;
        $data['lessons'] = $course->lessons;

    	return view('super-admin.e-learnings.test-reports.results.coursewise-view', $data);
    }
    
    public function export_test_report()
    {
        $test_results = TestResult::with('test')->with('user')->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test_result.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ResultID', 'TestID', 'Test Name', 'MembershipID', 'Member Name', 'Full Marks', 'Pass Marks', 'Obtained Marks', 'Percentage', 'Status','Date');

        $callback = function() use ($test_results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($test_results as $result) {
                $result->obtainedMarks = $result->getMarksObtained($result->id);
                if($result->test->pass_marks <= $result->obtainedMarks) {
                    $result->test_status = 'Passed';
                }else {
                    $result->test_status = 'Failed';
                }
                $result->obtainedPercentage = empty($result->obtainedMarks)?0:($result->obtainedMarks / $result->test->full_marks) * 100;

                fputcsv($file, array($result->id, $result->test->id, $result->test->name, $result->user->category.'-'.$result->user->serial_no, $result->user->first_name.' '.$result->user->last_name, $result->test->full_marks, $result->test->pass_marks, round($result->obtainedMarks,2), round($result->obtainedPercentage, 2).'%', $result->test_status, $result->created_at));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
      public function export_test_report_failed()
    {
        $test_results = TestResult::with('test')->with('user')->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test_result.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ResultID', 'TestID', 'Test Name', 'MembershipID', 'Member Name', 'Full Marks', 'Pass Marks', 'Obtained Marks', 'Percentage', 'Status','Date');

        $callback = function() use ($test_results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($test_results as $result) {
                $result->obtainedMarks = $result->getMarksObtained($result->id);
                if($result->test->pass_marks <= $result->obtainedMarks) {
                    $result->test_status = 'Passed';
                }else {
                    $result->test_status = 'Failed';
                    $result->obtainedPercentage = empty($result->obtainedMarks)?0:($result->obtainedMarks / $result->test->full_marks) * 100;
                    fputcsv($file, array($result->id, $result->test->id, $result->test->name, $result->user->category.'-'.$result->user->serial_no, $result->user->first_name.' '.$result->user->last_name, $result->test->full_marks, $result->test->pass_marks, round($result->obtainedMarks,2), round($result->obtainedPercentage, 2).'%', $result->test_status, $result->created_at));
                }

            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
      public function export_test_report_pass()
    {
        $test_results = TestResult::with('test')->with('user')->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test_result.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ResultID', 'TestID', 'Test Name', 'MembershipID', 'Member Name', 'Full Marks', 'Pass Marks', 'Obtained Marks', 'Percentage', 'Status','Date');

        $callback = function() use ($test_results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($test_results as $result) {
                $result->obtainedMarks = $result->getMarksObtained($result->id);
                if($result->test->pass_marks <= $result->obtainedMarks) {
                    $result->test_status = 'Passed';
                    $result->obtainedPercentage = empty($result->obtainedMarks)?0:($result->obtainedMarks / $result->test->full_marks) * 100;
                    fputcsv($file, array($result->id, $result->test->id, $result->test->name, $result->user->category.'-'.$result->user->serial_no, $result->user->first_name.' '.$result->user->last_name, $result->test->full_marks, $result->test->pass_marks, round($result->obtainedMarks,2), round($result->obtainedPercentage, 2).'%', $result->test_status, date('Y-m-d', strtotime($result->created_at)),));

                }else {
                    $result->test_status = 'Failed';
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    
    
        public function export_test_report_pass_fiscal()
    {
        
        
                $time_set = TimeSet::first();

        $test_results = TestResult::with('test')->with('user')->where('created_at','>=',$time_set->start_date)->where('created_at','<=',$time_set->end_date)->get();
       $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test_result.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ResultID', 'TestID', 'Test Name', 'MembershipID', 'Member Name', 'Full Marks', 'Pass Marks', 'Obtained Marks', 'Percentage', 'Status','Date');

        $callback = function() use ($test_results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($test_results as $result) {
                $result->obtainedMarks = $result->getMarksObtained($result->id);
                if($result->test->pass_marks <= $result->obtainedMarks) {
                    $result->test_status = 'Passed';
                    $result->obtainedPercentage = empty($result->obtainedMarks)?0:($result->obtainedMarks / $result->test->full_marks) * 100;
                    fputcsv($file, array($result->id, $result->test->id, $result->test->name, $result->user->category.'-'.$result->user->serial_no, $result->user->first_name.' '.$result->user->last_name, $result->test->full_marks, $result->test->pass_marks, round($result->obtainedMarks,2), round($result->obtainedPercentage, 2).'%', $result->test_status, date('Y-m-d', strtotime($result->created_at)),));
           
                }else {
                    $result->test_status = 'Failed';
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    
    
    
    
        
      public function export_test_report_failed_fiscal()
    {
          $time_set = TimeSet::first();

        $test_results = TestResult::with('test')->with('user')->where('created_at','>=',$time_set->start_date)->where('created_at','<=',$time_set->end_date)->get();
      
              $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test_result.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ResultID', 'TestID', 'Test Name', 'MembershipID', 'Member Name', 'Full Marks', 'Pass Marks', 'Obtained Marks', 'Percentage', 'Status','Date');

        $callback = function() use ($test_results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($test_results as $result) {
                $result->obtainedMarks = $result->getMarksObtained($result->id);
                if($result->test->pass_marks <= $result->obtainedMarks) {
                    $result->test_status = 'Passed';
                }else {
                    $result->test_status = 'Failed';
                    $result->obtainedPercentage = empty($result->obtainedMarks)?0:($result->obtainedMarks / $result->test->full_marks) * 100;
                    fputcsv($file, array($result->id, $result->test->id, $result->test->name, $result->user->category.'-'.$result->user->serial_no, $result->user->first_name.' '.$result->user->last_name, $result->test->full_marks, $result->test->pass_marks, round($result->obtainedMarks,2), round($result->obtainedPercentage, 2).'%', $result->test_status, $result->created_at));
                }

            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    
    
    
    
      
    public function export_test_report_fiscal()
    {
       $time_set = TimeSet::first();

        $test_results = TestResult::with('test')->with('user')->where('created_at','>=',$time_set->start_date)->where('created_at','<=',$time_set->end_date)->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test_result.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ResultID', 'TestID', 'Test Name', 'MembershipID', 'Member Name', 'Full Marks', 'Pass Marks', 'Obtained Marks', 'Percentage', 'Status','Date');

        $callback = function() use ($test_results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($test_results as $result) {
                $result->obtainedMarks = $result->getMarksObtained($result->id);
                if($result->test->pass_marks <= $result->obtainedMarks) {
                    $result->test_status = 'Passed';
                }else {
                    $result->test_status = 'Failed';
                }
                $result->obtainedPercentage = empty($result->obtainedMarks)?0:($result->obtainedMarks / $result->test->full_marks) * 100;

                fputcsv($file, array($result->id, $result->test->id, $result->test->name, $result->user->category.'-'.$result->user->serial_no, $result->user->first_name.' '.$result->user->last_name, $result->test->full_marks, $result->test->pass_marks, round($result->obtainedMarks,2), round($result->obtainedPercentage, 2).'%', $result->test_status, $result->created_at));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
