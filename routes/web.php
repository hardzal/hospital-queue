<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorscheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalrecordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Models\Polyclinic;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// login non pasien
Auth::routes(['register' => false]);

// login pasien
Route::get('pasien/login', [LoginController::class, 'login_pasien']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('patients', PatientController::class);
Route::resource('polyclinics', PolyclinicController::class);
Route::resource('users', UserController::class);
Route::resource('records', DoctorscheduleController::class);
Route::resource('doctorschedules', ScheduleController::class);
Route::resource('schedules', ScheduleController::class);

Route::get('print', [HomeController::class, 'test_print']);
