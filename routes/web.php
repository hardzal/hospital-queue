<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorscheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalrecordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientLoginController;
use App\Http\Controllers\PatientRegisterController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [PatientLoginController::class, 'showLoginForm'])->name('patient.loginForm');
Route::get('/register', [PatientLoginController::class, 'showRegisterForm'])->name('patient.registerForm');
Route::post('/login', [PatientLoginController::class, 'login'])->name('patient.login');
Route::post('/register', [PatientLoginController::class, 'register'])->name('patient.register');
Route::get('/logout', [PatientLoginController::class, 'logout'])->name('patient.logout');

Route::get('/', [PatientLoginController::class, 'index'])->name('home');

// login non pasien
Route::prefix('mimin')->group(function () {
    Auth::routes(['register' => false]);
});

// login user (admin, staff, dokter)
Route::group(['prefix' => 'inside', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::middleware('admin')->group(function () {
        Route::resource('patients', PatientController::class);
        Route::resource('polyclinics', PolyclinicController::class);
        Route::resource('records', MedicalrecordController::class);
        Route::resource('doctorschedules', DoctorScheduleController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::resource('users', UserController::class);
    });
});
Route::get('print', [HomeController::class, 'test_print']);
