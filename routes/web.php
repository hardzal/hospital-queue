<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorscheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalrecordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientLoginController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsAppController;
use App\Models\MQueue;
use App\Models\Queue;
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
Route::post('/logout', [PatientLoginController::class, 'postLogout'])->name('patient.logout');

Route::get('/hello', [PatientLoginController::class, 'hello']);

Route::group(['middleware' => 'auth:patient'], function () {
    Route::get('/queues/register', [QueueController::class, 'register'])->name('queue.register');
    Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');
    Route::get('/getSchedules/{poly_id}', [QueueController::class, 'getSchedules'])->name('queue.schedules');
    Route::get('/getDate/{time}', [QueueController::class, 'getDate'])->name('queues.time');
    Route::get('/home', [HomeController::class, 'index'])->name('patient.home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('patient.profile');
    Route::get('/histories', [HomeController::class, 'histories'])->name('patient.histories');
});

Route::get('/', [PatientLoginController::class, 'index'])->name('home');
Route::get('/queues/{poly?}/{date?}', [QueueController::class, 'index'])->name('queues');
Route::get('/schedules', [DoctorController::class, 'index'])->name('doctor.schedule');
Route::post('/queue/new', [QueueController::class, 'newQueue'])->name('queue.new');

Route::post('/queue/search', [QueueController::class, 'search'])->name('queue.search');
Route::get('/queue/{queue}', [QueueController::class, 'show'])->name('queue.show');
Route::get('/print/{queue}', [HomeController::class, 'print'])->name('patient.print');

// antrian routes
// 1. User mendaftar antrian
// 2. Antrian user masuk ke database
// 3. Daftar antrian baru tampil ke layar
// 4. jika antrian berganti maka layar akan memperbaharui data antrian

// routes mengecek antrian
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

    Route::resource('whatsapp', WhatsAppController::class);
    Route::get('/queues/list/{polyclinic_id?}/{queue_date?}', [QueueController::class, 'lists'])->name('queues.list');
    Route::post('/queues/{queue}', [QueueController::class, 'update'])->name('queues.update');
    Route::delete('/queues/{queue}', [QueueController::class, 'delete'])->name('queues.destroy');

    Route::post('/queue/{queue}/call', [QueueController::class, 'call'])->name('queue.call');
});
Route::get('test_print', [HomeController::class, 'test_print']);
