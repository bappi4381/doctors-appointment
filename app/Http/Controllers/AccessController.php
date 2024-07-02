<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AccessController extends Controller
{
    public function get_roles()
    {
        $role = Role::all();
        return $role;
    }

    public function hasRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|exists:users,id',
            'roles' => 'required|array|exists:roles,name',
        ]);
 
        if ($validator->fails())
            return $validator->errors();
 
        $user = User::find($request->user);
        // return $user->hasRole($request->roles);
        if ($user->hasRole($request->roles)) {
            return response()->json(['message' => 'User has the admin role.']);
        }else{
            return response()->json(['message' => 'User has not the admin role.']);
        }
    }
}
