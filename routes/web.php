<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;

use App\Http\Middleware\VerifyWebhookSecret;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [LoginController::class, 'loginPage']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [HomePageController::class, 'dashboard'])->name('dashboard')->middleware('super_admin');

// User Menu
Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('user');
});

// Manage Hospital
Route::controller(HospitalController::class)->group(function() {
    Route::get('/hospital', 'index')->name('hospital');
});

// Manage Patient
Route::controller(PatientController::class)->group(function() {
    Route::get('/patient', 'index')->name('patient');
});