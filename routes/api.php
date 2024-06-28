<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;

use App\Http\Middleware\VerifyWebhookSecret;

use App\Http\Controllers\HomePageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Home Page
Route::controller(HomePageController::class)->group(function() {
    Route::get('/gsheet/data', 'getDataGSheet')->name('gsheet.data');
});

// Manage User
Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'getUser')->name('user.data');
    Route::post('/user/create', 'create')->name('user.create');
    Route::post('/user/update', 'update')->name('user.update');
    Route::post('/user/delete', 'delete')->name('user.delete');
    Route::post('/user/detail', 'detail')->name('user.detail');
});

// Manage Role
Route::controller(RoleController::class)->group(function() {
    Route::get('/role', 'getRole')->name('user.role');
});

// Manage Hospital
Route::controller(HospitalController::class)->group(function() {
    Route::get('/hospitals', 'getHospitals')->name('hospital');
    Route::post('/hospitals', 'create')->name('hospital.create');
    Route::post('/hospitals/delete', 'delete')->name('hospital.delete');
    Route::post('/hospitals/detail', 'detail')->name('hospital.detail');
});

// Manage Patient
Route::controller(PatientController::class)->group(function() {
    Route::get('/patients', 'getPatients')->name('patients');
    Route::post('/patients', 'create')->name('patients.create');
    Route::post('/patients/delete', 'delete')->name('patients.delete');
    Route::post('/patients/detail', 'detail')->name('patients.detail');
});