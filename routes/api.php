<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::post('/user/add', 'App\Http\Controllers\AdminController@userAdd');
Route::get('/doctors', 'App\Http\Controllers\DoctorsController@index');
Route::get('/doctor/{id}', 'App\Http\Controllers\DoctorsController@show');

Route::post('/patients', 'App\Http\Controllers\PatientsController@store');
Route::post('/specializations', 'App\Http\Controllers\SpecializationController@store');