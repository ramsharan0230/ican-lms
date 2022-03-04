<?php

namespace App\Http\Controllers\SuperAdmin\Terms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\App;

class TermController extends Controller
{
    public $status_message = null;

    public $alert_type = 'success';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $terms = ApplicationInfo::get();
        // return view('super-admin.terms.index', compact('terms'));
        return view('customized.super-admin.terms.index', compact('terms'));
        
    }

    public function create()
    {
        return view('super-admin.terms.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $term = new ApplicationInfo();
        $term->title = $request->get('title');
        $term->description = $request->get('description');
        $term->save();

        $this->status_message = 'Terms Successfully Created.';
        return redirect()->route('terms.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function show($id)
    {
        $term = ApplicationInfo::find($id);
        return view('super-admin.terms.show', compact('term'));
    }

    public function edit($id)
    {
        $term = ApplicationInfo::find($id);
        return view('super-admin.terms.edit', compact('term'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $term = ApplicationInfo::find($id);
        $term->title = $request->get('title');
        $term->description = $request->get('description');
        $term->save();

        $this->status_message = 'Terms Successfully Updated.';
        return redirect()->route('terms.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);

    }
}
