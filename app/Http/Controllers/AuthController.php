<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required|string|max:50|unique:users',
            'firstname' => 'nullable|string',
            'lastname'  => 'nullable|string',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6',
            'user_type' => 'required|string|in:doctor,patient',
            'phone'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'username'  => $request->username,
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'user_type' => $request->user_type,
            'phone'     => $request->phone,
        ]);

        $token = $user->createToken('YourAppToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required_without:email',
            'email' => 'required_without:username|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            // return response()->json(['errors' => $validator->errors()], 422);
            return response($this->format($validator->errors(),'Data validation errors',422),422);
        }

        $credentials = $request->only('username', 'email', 'password');
        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $credentials[$field], 'password' => $credentials['password']])) {
            $user = Auth::user();
            $token = $user->createToken('YourAppToken')->accessToken;
            // return response()->json(['token' => $token], 200);
            return response($this->format(['token' => $token,],'Successfully Logged In',200),200);
        }

        return response($this->format('','Unauthorized', 401),401);        
    }
}
