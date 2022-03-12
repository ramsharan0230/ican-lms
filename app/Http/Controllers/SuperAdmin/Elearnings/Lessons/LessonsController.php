<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\Lessons;

use App\Models\Lesson;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    public $status_message = null;

    public $alert_type = 'success';

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.view');

        $data['lessons'] = Lesson::orderBy('created_at', 'desc')->get();
        return view('customized.super-admin.e-learnings.lessons.index', $data);
    }

    public function create() {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.add');

        return view('customized.super-admin.e-learnings.lessons.create');
    }

    public function store(Request $request) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.add');

        try {
            $data = $request->all();
            $data['creator_user_id'] = $request->user()->id;

            Lesson::create($data);
            $this->status_message = 'Lesson | ' . $request->name .'| Successfully Created.';
        } catch(QueryException $qE) {
            $this->status_message = 'Failed to Create Lesson.Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('lessons.index')->with(['status_message'=>$this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function show(Lesson $lessons) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.view');

        $data['lesson'] = $lessons;

        return view('super-admin.e-learnings.lessons.show', $data);
    }

    public function edit(Lesson $lessons) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.edit');

        $data['lesson'] = $lessons;
        return view('super-admin.e-learnings.lessons.edit', $data);
    }

    public function update(Request $request, Lesson $lessons) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.update');

        try{
           $lessons->update($request->all());
           $this->status_message = 'Lesson | ' . $request->input('name') .'| Successfully Updated.';
       } catch(QueryException $qE) {
           $this->status_message = 'Failed to Update Lesson.Try Again.';
           $this->alert_type = 'danger';
       }

        return redirect()->route('e-learning.lessons.index')->with(['status_message'=>$this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function destroy(Lesson $lessons)
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'lessons.delete');

        try {
            $lessons->delete();
            $this->status_message = 'Lesson | ' . $lessons->name .'| Successfully Deleted.';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Delete Lesson';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.lessons.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }
}
