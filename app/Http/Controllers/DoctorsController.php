<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\User;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::where('user_type', 'doctor')->get(); // Retrieve all users with user_type 'doctor'
        return response($this->format($doctors,'',200),200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user has the 'admin' role
        if ($user->hasRole('admin')) {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'bio' => 'required|string',
                'experience' => 'required|string',
                'specialization_id' => 'required|exists:specializations,id',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response($this->format($validator->errors(),'Data validation errors',422),422);
            }

            // If user is authenticated
            if (!$user) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }

            // Create a new doctor record
            $doctor_info = Doctors::create([
                'user_id' => $user->id,
                'specialization_id' => $request->input('specialization_id'),
                'bio' => $request->input('bio'),
                'experience' => $request->input('experience'),
            ]);

            // Return success response
            return response($this->format($doctor_info,'Doctor info created successfully',201),201);
        } 
        else
        {
            // If user does not have admin role, return unauthorized response
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctors  $doctors
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = User::where('id', $id)->where('user_type', 'doctor')->first();
        return response($this->format($doctor,'Get successfully Doctor info',200),200);
    }

   

}
