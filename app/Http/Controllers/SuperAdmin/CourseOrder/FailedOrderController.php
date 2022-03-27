<?php

namespace App\Http\Controllers\SuperAdmin\CourseOrder;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AssignCourse;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\CourseOrder;
use View;
use PDF;
use App\Models\TimeSet;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Excel;

class FailedOrderController extends Controller
{
    public $status_message = null;
    public $alert_type = 'success';
    protected $user_id;
    public $url = "";

    public function __construct(Guard $auth)
    {
        $this->user_id = $auth->id();
    }

    public function index(Request $request)
    {
//        if(isset($request->from_date) || isset($request->to_date)){
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $query  =   [
                'from_date'    =>      $request->from_date,
                'to_date'      =>      $request->to_date,
            ];


            $data['orders'] =
                $request->from_date != null && $request->to_date != null ?
                CourseOrder::with('user')->where('payment', '!=', 'paid')->whereBetween('created_at', $query)->paginate(10)
                :
                CourseOrder::with('user')->whereNull('id')->paginate(10)
            ;
        $data['query'] = $query;
        return view('customized.super-admin.failed-courseorders.index', $data);
    }

    /**
     * Search Failed Orders
     */
    public function failedSearch(Request $request)
    {
        if($request->search){
            DB::enableQueryLog();
            $search  = $request->search;
           
            $data['orders'] = DB::select("select * from `course_payments`, `users` where `course_payments`.`user_id` = `users`.`id` AND `course_payments`.`payment` != 'paid' and CONCAT(users.first_name, ' ', users.last_name) like '$search%'");
            // echo "<pre>";
            // var_dump($data['orders']);
            // echo "</pre>";
            return view('super-admin.failed-courseorders.search_index', $data);
        }
        return redirect()->back();
    }
   
    /**
     * Get Edit Data 
     */
    public function editFailedOrder($id)
    {
        $course_order = CourseOrder::findOrFail($id);
        // die($course_order);
        return view('super-admin.failed-courseorders.edit', compact('course_order'));
    }

    /**
     * Update Failed Course Orders
     */
    public function updateFailedOrder(Request $request, $id)
    {
        $course_order = CourseOrder::findOrFail($id);

        $this->validate($request, [
            'payment' => 'required',
            'operation_id' => 'required',
            'paid_date' => 'required'
        ]);
        
        $course_order->operation_id = $request->operation_id;
        $course_order->payment = $request->payment;
        if($request->payment_method != null){
            $course_order->payment_method = $request->payment_method;
        }
        $course_order->save();
        
        return redirect()->route('course-orders.failed-orders');
        
    }

     
    public function export_course_payment_report(Request $request)
    {
        $ordersQuery = CourseOrder::with('user')->with('course')->where('payment',"!=",'paid');
        
        if ($request->from_date) {
            $ordersQuery->where('paid_datetime', '>=', $request->from_date);
        } 
        if ($request->to_date) {
            $ordersQuery->where('paid_datetime', '<=', $request->to_date);
        } 
        
        $orders = $ordersQuery->get();
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=failed_course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Reference Id', 'User', 'MembershipID', 'Course', 'Amount', 'Payment', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function() use ($orders, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if(!$orders->isEmpty()) {
                foreach ($orders as $order) {
                    fputcsv(
                        $file,
                        array(
                            $order->operation_id,
                            $order->user->first_name . ' ' . $order->user->last_name,
                            $order->user->category . '-' . $order->user->serial_no,
                            $order->course->name,
                            $order->paid_amount,
                            $order->payment,
                            $order->payment_method,
                            $order->paid_datetime,
                            $order->created_at
                        )
                    );
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    
     
    public function export_course_payment_report_fiscal()
    {
               $time_set = TimeSet::first();

        $orders = CourseOrder::with('user')->with('course')->where('payment','!=','paid')->where('created_at','>=',$time_set->start_date)->where('created_at','<=',$time_set->end_date)->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=failed_course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('OrderID', 'User', 'MembershipID', 'Course', 'Amount', 'Payment',  'Reference Id', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function() use ($orders, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if(!$orders->isEmpty()) {
                foreach ($orders as $order) {
                    fputcsv(
                        $file,
                        array(
                            $order->id,
                            $order->user->first_name . ' ' . $order->user->last_name,
                            $order->user->category . '-' . $order->user->serial_no,
                            $order->course->name,
                            $order->paid_amount,
                            $order->payment,
                            $order->operation_id,
                            $order->payment_method,
                            $order->paid_datetime,
                            $order->created_at
                        )
                    );
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    
         
    public function cpe_export_course_payment_report_fiscal()
    {
               $time_set = TimeSet::first();

        $orders = CourseOrder::with('user')->with('course')->where('payment','!=','paid')->where('created_at','>=',$time_set->start_date)->where('payment_type','cpe')->where('created_at','<=',$time_set->end_date)->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=failed_course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('OrderID', 'User', 'MembershipID', 'Course', 'Amount', 'Payment', 'Reference Id', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function() use ($orders, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if(!$orders->isEmpty()) {
                foreach ($orders as $order) {
                    fputcsv(
                        $file,
                        array(
                            $order->id,
                            $order->user->first_name . ' ' . $order->user->last_name,
                            $order->user->category . '-' . $order->user->serial_no,
                            $order->course->name,
                            $order->paid_amount,
                            $order->payment,
                            $order->operation_id,
                            $order->payment_method,
                            $order->paid_datetime,
                            $order->created_at
                        )
                    );
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    
     public function cpe_export_course_payment_report()
    {
        $orders = CourseOrder::with('user')->with('course')->where('payment','!=','paid')->where('payment_type','cpe')->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=failed_course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('OrderID', 'User', 'MembershipID', 'Course', 'Amount', 'Payment','Reference Id', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function() use ($orders, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if(!$orders->isEmpty()) {
                foreach ($orders as $order) {
                    fputcsv(
                        $file,
                        array(
                            $order->id,
                            $order->user->first_name . ' ' . $order->user->last_name,
                            $order->user->category . '-' . $order->user->serial_no,
                            $order->course->name,
                            $order->paid_amount,
                            $order->payment,
                            $order->operation_id,
                            $order->payment_method,
                            $order->paid_datetime,
                            $order->created_at
                        )
                    );
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }


    public function paidAmount($id, Request $request)
    {
        $course = CourseOrder::findOrFail($id);
        $course->update(['payment' => 'paid']);
        $course->save();

        return redirect()->back();


    }
}
