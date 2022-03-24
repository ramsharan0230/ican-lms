<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\Questions;

use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public $status_message = null;

    public $alert_type = 'success';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.view');

        $data['questions'] = Question::join('lessons', 'questions.lesson_id', '=', 'lessons.id')
                            ->select('questions.*', 'lessons.name as lesson_name')
                            ->orderBy('created_at', 'desc')->paginate(10);

        return view('customized.super-admin.e-learnings.questions.index', $data);
    }

    public function createTrueFalseQuestion()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');

        $data['lessons'] = Lesson::orderBy('name')->lists('name', 'id');

        return view('super-admin.e-learnings.questions.create-true-false-question', $data);
    }

    public function storeTrueFalseQuestion(Request $request)
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');

        try {
            $request['question_type'] = 'true-false';
            $request['question_answer'] = serialize($request->question_answer);

            Question::create($request->all());
            $this->status_message = 'True-False Question Successfully Created';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Create True-False Question. Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function editTrueFalseQuestion(Question $true_false) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.edit');

        $data['true_false'] = $true_false;
        $data['lessons'] = Lesson::orderBy('name')->lists('name', 'id');

        return view('super-admin.e-learnings.questions.edit-true-false-question', $data);
    }

    public function updateTrueFalseQuestion(Request $request, Question $true_false) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.edit');

        try {
            $request['question_type'] = 'true-false';
            $request['question_answer'] = serialize($request->question_answer);

            $true_false->update($request->all());

            $this->status_message = 'Question True-False Successfully Updated.';
        } catch(QueryException $qE) {
            $this->status_message = 'Failed to Update True-False Question.Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function createMultipleSelectSingleQuestion()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');
        $data['question_options'] = false;
        $data['lessons'] = Lesson::orderBy('name')->lists('name', 'id');

        return view('super-admin.e-learnings.questions.create-multiple-select-single-question', $data);
    }

    public function storeMultipleSelectSingleQuestion(Request $request)
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');
        $this->validate($request, [
            'question_text' => 'required',
            'question_answer' => 'required',
        ]);
        try {
            // dd($request->all());
            $request['question_type'] = 'multiple-select-single';
            $request['question_options'] = serialize($request['question_options']);
            $request['question_answer'] = serialize($request['question_answer']);

            // $answers = $request['question_answer'];
            // array_shift($answers);
            // $answers = serialize($answers);
            // $request['question_answer'] = $answers;
            //dd($request->all());
            Question::create($request->all());
            $this->status_message = 'Multiple Select Question Successfully Created';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Create Multiple Select Single rue-False Question. Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function editMultipleSelectSingleQuestion(Question $multiple_select_single) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.edit');

        $data['multiple_select_single'] = $multiple_select_single;
        $data['question_options'] = unserialize($multiple_select_single->question_options);
        $data['question_answers'] = unserialize($multiple_select_single->question_answer);

        $data['lessons'] = Lesson::orderBy('name')->lists('name', 'id');

        return view('super-admin.e-learnings.questions.edit-multiple-select-single-question', $data);
    }

    public function updateMultipleSelectSingleQuestion(Request $request, Question $multiple_select_single) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');

        try {
            $request['question_type'] = 'multiple-select-single';
            $request['question_options'] = serialize($request['question_options']);
            $request['question_answer'] = serialize($request['question_answer']);

            $multiple_select_single->update($request->all());
            $this->status_message = 'Multiple Select Question Successfully Updated';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Update Multiple Select Single rue-False Question. Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function createMultipleSelectMultipleQuestion()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');

        $data['lessons'] = Lesson::orderBy('name')->lists('name', 'id');
        $data['question_options'] = false;

        return view('super-admin.e-learnings.questions.create-multiple-select-multiple-question', $data);
    }

    public function storeMultipleSelectMultipleQuestion(Request $request) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');

        try {
            $request['question_type'] = 'multiple-select-multiple';
            $request['question_answer'] = serialize($request['question_answer']);
            $request['question_options'] = serialize($request['question_options']);
            Question::create($request->all());
            
            $this->status_message = 'Multiple Select Question Successfully Created';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Create Multiple Select Single rue-False Question. Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function editMultipleSelectMultipleQuestion(Question $multiple_select_multiple) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.edit');

        $data['multiple_select_multiple'] = $multiple_select_multiple;
        $data['question_options'] = unserialize($multiple_select_multiple->question_options);
        $data['question_answers'] = unserialize($multiple_select_multiple->question_answer);

        $data['lessons'] = Lesson::orderBy('name')->lists('name', 'id');
        // dd($data);
        return view('super-admin.e-learnings.questions.edit-multiple-select-multiple-question', $data);
    }

    public function updateMultipleSelectMultipleQuestion(Request $request, Question $multiple_select_multiple) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'questions.add');

        try {
            $request['question_type'] = 'multiple-select-multiple';
            $request['question_options'] = serialize($request['question_options']);
            $request['question_answer'] = serialize($request['question_answer']);
            
            //dd($request->all());
            $multiple_select_multiple->update($request->all());
            $this->status_message = 'Multiple Select Question Successfully Updated';
        } catch (QueryException $qE) {
            $this->status_message = 'Failed to Update Multiple Select Single rue-False Question. Try Again.';
            $this->alert_type = 'danger';
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function destroy(Question $question) {
        try {
            $question->delete();
            $this->status_message = "Successfully deleted question.";    
        } catch (QueryException $e) {
            $this->status_message = "Failed to delete question, Try again.";
            $this->alert_type = "danger";
        
        }

        return redirect()->route('e-learning.questions.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }
}
