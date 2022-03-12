<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\Courses;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public $status_message = null;

    public $alert_type = 'success';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.view');

        $data['courses'] = Course::orderBy('created_at', 'desc')->get();
        return view('customized.super-admin.e-learnings.courses.index', $data);
    }

    public function create()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.add');

        $data['course'] = false;

        $data['categories'] = Category::orderBy('name')->select('name', 'id');
        $data['lessons'] = Lesson::where('published_status', '=', 1)->orderBy('name')->select('name', 'id');
        return view('customized.super-admin.e-learnings.courses.create', $data);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.add');

        try {
            $insert_course = Course::create(array_add($request->all(), 'creator_user_id', $request->user()->id));
            $insert_course->lessons()->sync($request->input('course_lessons'));
            $this->status_message = 'Course | ' . $request->input('name') . '| Successfully Created.';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Create Course.Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.courses.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function show(Course $courses) {

        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.view');

        $data['course'] = $courses;
        $data['course_lessons'] = DB::table('course_lesson')
            ->join('lessons', 'course_lesson.lesson_id', '=', 'lessons.id')
            ->select('lessons.name as lesson_name', 'lessons.lesson_content as lesson_content', 'lessons.id as lesson_id')
            ->where('course_lesson.course_id', '=', $courses->id)->get();

        return view('super-admin.e-learnings.courses.show', $data);
    }

    public function edit(Course $courses)
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.edit');

        $data['course'] = $courses;
        $data['categories'] = Category::orderBy('name')->lists('name', 'id');
        $data['lessons'] = Lesson::where('published_status', '=', 1)->orderBy('name')->lists('name', 'id');

        return view('super-admin.e-learnings.courses.edit', $data);
    }

    public function update(Request $request, Course $courses)
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.update');

        try{
            $courses->update($request->all());
            $courses->lessons()->sync($request->input('course_lessons'));

            $this->status_message = 'Course | ' . $request->input('name') . '| Successfully Updated';
        } catch(QueryException $qE) {
            $this->status_message = 'Failed to Update Course.Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.courses.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function destroy(Course $courses)
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'courses.delete');

        try {
            $courses->delete();
            $this->status_message = 'Course | ' . $courses->name .'| Successfully Deleted.';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Delete Course';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.courses.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }
}
