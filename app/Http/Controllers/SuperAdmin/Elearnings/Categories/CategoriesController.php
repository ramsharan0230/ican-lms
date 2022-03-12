<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\Categories;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public $status_message = null;

    public $alert_type = 'success';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'categories.view');

        $data['categories'] = Category::orderBy('created_at', 'desc')->get();

        return view('customized.super-admin.e-learnings.categories.index', $data);
    }

    public function create()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'categories.add');
        return view('customized.super-admin.e-learnings.categories.create');
    }
}
