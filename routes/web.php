<?php

use App\Http\Controllers\ActiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MedicalBoardController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\GroupParameterController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\RecordController;

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
    return view('auth\login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('records', RecordController::class);
        Route::resource('gparameters', GroupParameterController::class);
        Route::resource('parameters', ParameterController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('specialties', SpecialtyController::class);
        Route::resource('doctors', DoctorController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('medical-boards', MedicalBoardController::class);
        Route::resource('reports', ReportController::class);
        Route::get('reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');
        Route::get('reports/{report}/approve', [ReportController::class, 'approve'])->name('reports.approve');
        Route::resource('users', UserController::class);
		Route::get('general/', [GeneralSettingController::class, 'general'])->name('general');
        Route::patch('general/{id}/update', [GeneralSettingController::class, 'update_general'])->name('general.update');
		Route::get('zoom/', [GeneralSettingController::class, 'zoom'])->name('zoom');
        Route::patch('zoom/{id}/update', [GeneralSettingController::class, 'update_zoom'])->name('zoom.update');
        Route::get('activeLog', [ActiveController::class, 'getActiveLog'])->name('activeLog');
    });
