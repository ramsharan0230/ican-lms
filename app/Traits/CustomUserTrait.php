<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait CustomUserTrait
{
    public function customCheckPermission($user_id, $role_id, $permission_name)
    {
        if(Auth::user()->is_super_admin == 1) {
            return true;
        }

        $check = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->join('role_permission', 'role_permission.role_id', '=', 'roles.id')
            ->join('permissions', 'permissions.id', '=', 'role_permission.permission_id')
            ->where('permissions.name', '=', $permission_name)
            ->where('users.id', '=', $user_id)
            ->where('users.role_id', '=', $role_id)
            ->get();

        if (count($check) > 0) {
            return true;
        }

        abort(503);
    }
}