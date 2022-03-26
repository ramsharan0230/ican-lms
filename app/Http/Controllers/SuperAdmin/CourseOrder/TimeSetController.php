<?php

namespace App\Http\Controllers\SuperAdmin\CourseOrder;

use App\Http\Controllers\Controller;
use App\Models\CourseOrder;
use App\Models\TimeSet;
use Illuminate\Http\Request;
use View;
use PDF;

use Illuminate\Contracts\Auth\Guard;
use Excel;

class TimeSetController extends Controller
{
    public $status_message = null;
    public $alert_type = 'success';
    public $url = "";
    protected $user_id;

    public function __construct(Guard $auth)
    {
        $this->user_id = $auth->id();
    }

    public function index()
    {
        $data['data'] = TimeSet::get();
        return view('customized.super-admin.timeset.index', $data);
    }

    public function update(Request $request, $id)
    {
        $item = TimeSet::findOrFail($id);
        try {
            $item->update($request->all());
            $this->status_message = ' Successfully Updated';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Update Course.Try Again.';
            $this->alert_type     = 'danger';
        }

        return redirect()->route('time_set.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }
}
