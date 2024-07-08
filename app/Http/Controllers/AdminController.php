<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(), [
                'username'  => 'required|string|max:50|unique:users',
                'firstname' => 'nullable|string',
                'lastname'  => 'nullable|string',
                'email'     => 'required|string|email|max:255|unique:users',
                'password'  => 'required|string|min:6',
                'user_type' => 'required|string|in:admin,doctor,patient',
                'phone'     => 'nullable|string',
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                return response($this->format($validator->errors(),'Data validation errors',422),422);
            }

            // Create a new user
            $newUser = User::create([
                'username'  => $request->username,
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'user_type' => $request->user_type,
                'phone'     => $request->phone,
            ]);
            return response($this->format($user,'User created successfully',201),201);
        }

        // Return an unauthorized response if the user is not an admin
        return response($this->format('','Unauthorized', 401),401);
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }
}
