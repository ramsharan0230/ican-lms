<?php

namespace App\Http\Controllers\SuperAdmin\CourseOrder;

use App\Models\Setting;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\CourseOrder;
use App\Models\TimeSet;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;

class OrderController extends Controller
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
        $from_date = $request->from_date ? Carbon::parse($request->from_date)->toDateString() : null;
        $to_date = $request->to_date;

        $hasRequest = $request->from_date != null && $request != null;
        $paymentInfo = $request->payment;
        $paymentMethods = CourseOrder::select('payment_method')->distinct()->get()->pluck('payment_method');
        $orders = CourseOrder::with('user')
            ->where('payment', 'paid');
            
        if($paymentInfo){
            $orders = $orders->where('payment_method', $paymentInfo);
        }


        $parsedTo = Carbon::parse($to_date)->addDays(1)->toDateString();
        $query  =   [
            'from_date'    =>      $from_date,
            'to_date'      =>      $parsedTo,
        ];



        if ($hasRequest) {
            $data['orders'] = $orders
                ->whereBetween('created_at', $query)
                ->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            $data['orders'] = $orders->orderBy('created_at', 'DESC')->paginate(10);
        }

        $data['query'] = $hasRequest ? null : $query;
        $data['paymentMethods'] = $paymentMethods;

        return view('customized.super-admin.courseorders.index', $data);
    }




    /**
     *
     */

    public function cpeOrder(Request $request)
    {
        if (isset($request->user_id) && !empty($request->user_id)) {
            $data['orders'] = CourseOrder::with('user')->where('user_id', $request->user_id)->with('course')->where('payment', 'paid')->where('payment_type', 'cpe')->get();
        }
        $data['orders'] = [];
        return view('super-admin.courseorders.cpe_index', $data);
    }

    public function fixOrderReferenceIssue(){
        //$value="REF{{$order->id}}_{{Auth::user()->category}}_{{Auth::user()->serial_no}}_{{$course->id}}";
        if (Auth::check()) {
            $orderss = CourseOrder::with('user')->with('course')->where('payment', 'paid')->where('payment_method', 'Connect Ips')->whereNull('operation_id')->get();
            foreach ($orderss as $order) {
                $order->operation_id = 'REF'.$order->id.'_'.$order->user->category.'_'.$order->user->serial_no.'_'.$order->course->id;
                $order->save();
            }
            return "Success Fully Fixed Reference id Null Issue... :)";
        }
        else{
            return "Please login to perform this action.";
        }

//    $paymentMethods = CourseOrder::select('payment_method')->distinct()->get()->pluck('payment_method');
//   return response()->json($orders);

    }

    public function show($id)
    {
        $data['order'] = CourseOrder::with('user')->with('course')->where('id', $id)->first();
        return view('super-admin.courseorders.show', $data);
    }

    public function export_course_payment_report(Request $request)
    {
        $ordersQuery = CourseOrder::with('user')->with('course')->where('payment', 'paid');
        if ($request->from_date) {
            $ordersQuery->where('paid_datetime', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $ordersQuery->where('paid_datetime', '<=', $request->to_date);
        }

        $orders = $ordersQuery->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Reference Id', 'User', 'MembershipID', 'Course', 'Amount', 'Payment', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if (!$orders->isEmpty()) {
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

        $orders = CourseOrder::with('user')->with('course')->where('payment', 'paid')->where('created_at', '>=', $time_set->start_date)->where('created_at', '<=', $time_set->end_date)->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('OrderID', 'User', 'MembershipID', 'Course', 'Amount', 'Payment',  'Reference Id', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if (!$orders->isEmpty()) {
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

        $orders = CourseOrder::with('user')->with('course')->where('payment', 'paid')->where('created_at', '>=', $time_set->start_date)->where('payment_type', 'cpe')->where('created_at', '<=', $time_set->end_date)->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('OrderID', 'User', 'MembershipID', 'Course', 'Amount', 'Payment', 'Reference Id', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if (!$orders->isEmpty()) {
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
        $orders = CourseOrder::with('user')->with('course')->where('payment', 'paid')->where('payment_type', 'cpe')->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=course_payment.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('OrderID', 'User', 'MembershipID', 'Course', 'Amount', 'Payment', 'Reference Id', 'Payment Method', 'Paid Date', 'Created Date');

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            if (!$orders->isEmpty()) {
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

    public function courseSetting()
    {
        $setting = Setting::first();
        return view('super-admin.e-learnings.settings.edit',compact('setting'));
    }

    public function settingUpdate(Request $request,$id)
    {
        $setting =Setting::find($id);
        $setting->credit = $request->credit;
        $setting->credit_hour_break = $request->credit_hour_break;
        $setting->save();

        return back()->with(['status_message' => 'Credit hours setting change successfully.']);

    }

}
