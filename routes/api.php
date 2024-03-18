<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/create-user', function () {
    $user = new User;
    $user->first_name = 'Ralph';
    $user->last_name = 'Clemente';
    $user->email = 'ralph@gmail.com';
    $user->username = 'ralph';
    $user->password = Hash::make('ralph');
    $user->save();

    return response()->json(['message' => 'User created successfully']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
