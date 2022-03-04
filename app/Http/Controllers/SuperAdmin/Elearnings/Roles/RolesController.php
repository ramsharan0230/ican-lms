<?php

namespace App\Http\Controllers\SuperAdmin\Elearnings\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public $status_message = null;
    public $alert_type = 'success';

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'roles.view');

        $data['roles'] = Role::orderBy('name')->get();

        return view('customized.super-admin.roles.index', $data);
        // return view('super-admin.roles.index', $data);
    }

    public function create()
    {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'roles.add');

        $data['roles_permissions'] = Permission::where('type', 'roles')->get();
        $data['users_permissions'] = Permission::where('type', 'users')->get();
        $data['courses_permissions'] = Permission::where('type', 'courses')->get();
        $data['questions_permissions'] = Permission::where('type', 'questions')->get();
        $data['tests_permissions'] = Permission::where('type', 'tests')->get();
        $data['lessons_permissions'] = Permission::where('type', 'lessons')->get();
        $data['assign_courses_permissions'] = Permission::where('type', 'assigned-courses')->get();
        $data['categories_permissions'] = Permission::where('type', 'categories')->get();

        // return view('super-admin.roles.create', $data);
        return view('customized.super-admin.roles.create', $data);

    }

    public function store(Request $request) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'roles.add');

        try {
            $insert_role = Role::create($request->all());

            $this->status_message = 'Role Successfully Added';


            foreach($request->input('permissions') as $permission_id) {
                DB::table('role_permission')->insert([
                    'role_id' => $insert_role->id,
                    'permission_id' => $permission_id
                ]);
            }
        } catch(QueryException $qE) {
            $this->status_message = 'Failed To Add Role';
            $this->alert_type = 'danger';
            $qE->getMessage();
        }

        return redirect()->route('roles.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function show() {

    }

    public function edit(Role $roles) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'roles.edit');

        $permissions = DB::table('role_permission')->where('role_id', $roles->id)->lists('permission_id');

        $data['role'] = array_add($roles, 'permissions', $permissions);

        $data['roles_permissions'] = Permission::where('type', 'roles')->get();
        $data['users_permissions'] = Permission::where('type', 'users')->get();
        $data['courses_permissions'] = Permission::where('type', 'courses')->get();
        $data['questions_permissions'] = Permission::where('type', 'questions')->get();
        $data['tests_permissions'] = Permission::where('type', 'tests')->get();
        $data['lessons_permissions'] = Permission::where('type', 'lessons')->get();
        $data['assign_courses_permissions'] = Permission::where('type', 'assigned-courses')->get();
        $data['categories_permissions'] = Permission::where('type', 'categories')->get();

        // return view('super-admin.roles.edit', $data);
        return view('customized.super-admin.roles.edit', $data);

    }

    public function update(Request $request, Role $roles) {
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'roles.edit');

        try {
            $roles->update($request->all());

            $this->status_message = 'Role Successfully Updated';

            if($request->input('permissions') !=null){
                foreach($request->input('permissions') as $permission_id) {
                    DB::table('role_permission')->insert([
                        'role_id' => $roles->id,
                        'permission_id' => $permission_id
                    ]);
                }
            }
        } catch(QueryException $qE) {
            $this->status_message = 'Failed To Update Role';
            $this->alert_type = 'danger';
            $qE->getMessage();
        }

        return redirect()->route('roles.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }

    public function destroy($id){
        Auth::user()->customCheckPermission(Auth::user()->id, Auth::user()->role_id, 'roles.delete');
        
        try {
            $role =Role::findOrFail($id);
            if($role->user->count()) {
                //dd('has users');
                $this->status_message = "Roles is assigned to user, Can't delete.";
                $this->alert_type = "danger";
            } else {
                $role->user()->delete();
                $role->delete();
                $this->status_message = "Role Seccessfully deleted.";
            }
                       
        } catch (QueryException $e) {
            $this->status_message = "Failed to delete role, Try again.";
            $this->alert_type = "danger";
        }

        return redirect()->route('roles.index')->with(['status_message' => $this->status_message, 'alert_type' => $this->alert_type]);
    }
}