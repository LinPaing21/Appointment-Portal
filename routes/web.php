<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocterController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;

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

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Route::middleware('can:patient')->group(function () {
    Route::get('/patients/home', [PatientController::class, 'index'])->name('patients.home');

    Route::get('/patients/createAppointment/{id}', [PatientController::class, 'create'])->name('patients.create');

    Route::post('/patients/createAppointment', [PatientController::class, 'store'])->name('patients.store');

    Route::get('/patients/{p_id}/edit/{s_id}', [PatientController::class, 'edit']);

    Route::patch('/patients/{p_id}/edit/{s_id}', [PatientController::class, 'update']);

    Route::delete('/patients/{p_id}/destroy/{s_id}', [PatientController::class, 'destroy']);

    Route::get('/patients/showMyBookings/{id}', [ScheduleController::class, 'showBookings'])->name('patients.showbookings');

    Route::get('/patients/showMyHistory/{id}', [ScheduleController::class, 'showMyHistory'])->name('patients.showHistory');

    Route::get('/forms/makeDocter', [PatientController::class, 'requestDocterRole'])->name('patients.makeDocter');

    Route::post('/forms/makeDocter', [PatientController::class, 'addRequest'])->name('patients.storeRequest');
});

Route::middleware('can:docter')->group(function () {
    Route::get('/docters/home', [DocterController::class, 'index'])->name('docters.home');

    Route::get('/docters/{d_id}/edit/{s_id}', [DocterController::class, 'update']);

    Route::delete('/docters/{d_id}/destroy/{s_id}', [DocterController::class, 'destroy']);

    Route::get('/docters/showAppointments/{id}', [ScheduleController::class, 'showAppointments'])->name('docters.showAppointments');

    Route::get('/docters/showSessions/{id}', [ScheduleController::class, 'showSessions'])->name('docters.showSessions');

    Route::get('[/docters/showPatientHistory/{id}]', [ScheduleController::class, 'showPatientHistory'])->name('docters.showHistory');
});

Route::middleware('can:admin')->group(function () {
    Route::get('/admins/home', [AdminController::class, 'index'])->name('admins.home');

    Route::get('/admins/makeDocter/{id}', [AdminController::class, 'makeDocter'])->name('admins.makeDocter');

    Route::delete('/admins/deleteRequest/{id}', [AdminController::class, 'requestDestroy'])->name('admins.deleteReq');

    Route::delete('/admins/deleteUser/{id}', [AdminController::class, 'userDestroy'])->name('admins.deleteUser');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
