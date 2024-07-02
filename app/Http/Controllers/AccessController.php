<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AccessController extends Controller
{
    public function hasRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|exists:users,id',
            'roles' => 'required|array|exists:roles,name',
        ]);
 
        if ($validator->fails())
            return $validator->errors();
 
        $user = User::find($request->user);
        return $user->hasRole($request->roles);
    }
}
