<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\User;

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
        return response()->json($doctors, 200);
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
        return response()->json($doctor, 200);
    }

}
