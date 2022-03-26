<?php

namespace App\Http\Controllers\SuperAdmin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AssignCourse;
use App\Models\Course;
use App\Models\User;
use App\Models\TestResult;



class UsersController extends Controller
{
    public $status_message = null;
    public $alert_type = 'success';

    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['login', 'verifyLogin']]);
    }

    public function index()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'users.view');

        $data['users'] = User::orderBy('first_name')->with('role')->get();

        return view('customized.super-admin.users.index', $data);
    }

    public function getTerms()
    {
        $term = ApplicationInfo::find(1);
        return view('auth.term-and-condition', compact('term'));
    }

    public function loginPage(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function verifyLogin(Request $request)
    {
        if(Auth::attempt(['username' => $request->email, 'password' => $request->password, 'active_status' => true])) {
            $this->status_message = 'Logged In Successfully';
            return redirect()->route('super-admin-dashboard')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
        } elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active_status' => true])) {
            $this->status_message = 'Logged In Successfully';

            return redirect()->route('super-admin-dashboard')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
        }

        $this->status_message = 'Failed to Login. Incorrect Username or Password.';
        $this->alert_type = 'danger';
        return redirect()->route('login.page')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function dashboard(){
        // detect country with ip
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $client  = @$_SERVER['HTTP_CF_CONNECTING_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'');
        if($client != NULL){
            if(filter_var($client, FILTER_VALIDATE_IP)){
                $ip = $client;
            }else{
                $ip = $remote;
            }
        }elseif($forward != NULL){
            if(filter_var($forward, FILTER_VALIDATE_IP)){
                $ip = $forward;
            }else{
                $ip = $remote;
            }
        }else{
            $ip = $remote;
        }

        $ip_data = @json_decode(file_get_contents('https://json.geoiplookup.io/'.$ip));
        $data['ip'] = $ip;
        $data['country'] = "";
        if(env('APP_ENV') == "production"){
            if($ip_data->country_name != null){
                $data['country'] = $ip_data->country_name;
            }
        }

        $data['assigned_courses'] = AssignCourse::join('courses', 'assign_courses.course_id', '=', 'courses.id')
            ->select('assign_courses.start_date as start_date', 'assign_courses.end_date as end_date','courses.*', 'courses.id as course_id')
            ->where('assign_courses.user_id', '=', Auth::user()->id )->orderBy('created_at', 'desc')->get();

        $assigned_courses_id = $data['assigned_courses']->pluck('course_id');

        // dd($data);

        // $data['course_lessons'] = DB::table('course_lesson')
        //         ->join('lessons', 'course_lesson.lesson_id', '=', 'lessons.id')
        //         ->whereIn('course_lesson.course_id', $assigned_courses_id)->groupBy('course_lesson.course_id')->get();
                

        $data['available_courses'] = Course::where('published_status', 1)->where('price', 0)->orderBy('created_at', 'desc')->paginate(5);
        $data['pay_available_courses'] = Course::where('published_status', 1)->where('price', '!=',0)->orderBy('created_at', 'desc')->paginate(5);


        if(Auth::user()->role_id == 2) {
            $data['members'] = User::where('role_id', 1)->count();
            $test_taken = TestResult::with('test')->get();
            $data['test_taken'] = count($test_taken);
            $data['passed'] = 0;
            $data['failed'] = 0;
            if(!$test_taken->isEmpty())
            {
                foreach($test_taken as $t_taken)
                {
                    $obtainedMarks = $t_taken->getMarksObtained($t_taken->id);
                    if(!empty($t_taken->test) && $t_taken->test->pass_marks <= $obtainedMarks)
                    {
                        $data['passed']++;
                    }else{
                        $data['failed']++;
                    }
                }
            }
            return view('customized.super-admin.dashboard', compact('data'));
        } else {
            $paid_courses = CourseOrder::where('user_id', Auth::user()->id)->where('payment_type','course')->where('payment', 'paid')->get();

            $current_date = Carbon::now();
            $paid_date = CourseOrder::where('user_id', Auth::user()->id)->where('payment', 'paid')->where('payment_type','course')->orderBy('created_at','desc')->take(3)->get();

            $time_set       = TimeSet::findOrFail(1);

            $testDataEnough = CourseOrder::where('user_id', Auth::user()->id)
                                         ->where('created_at', '>', $time_set->start_date)->where('payment_type','course')->where('created_at', '<', $time_set->end_date)->where('payment', 'paid')->get();

            if (count($testDataEnough) >= 3) {
                $data['test_time_enough'] = false;
            } else {
                $data['test_time_enough'] = true;
            }

            $data['course_ids'] = [];
            if(!$paid_courses->isEmpty()){
                foreach($paid_courses as $course)
                {
                    $paid_date = strtotime($course->paid_datetime);
                    $current_time = time();
                    $datediff = $current_time - $paid_date;
                    $days = $datediff / (60 * 60 * 24);

                    if($days <= 15) {
                        $data['course_ids'][] = $course->course_id;
                    }
                }
            }
            $setting = Setting::first();
            $data['credit_hr'] = ($setting->credit/$setting->credit_hour_break);
        }
    }

    public function logOut()
    {
        Auth::logout();
        $this->status_message = 'Successfully Logged Out.';
        return redirect()->route('login.page')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }
}
