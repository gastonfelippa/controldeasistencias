<?php

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

//Route::get('/', function () { return view('index'); })->middleware('auth');

Auth::routes(['register' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth');

Route::resource('/alumnos', App\Http\Controllers\AlumnoController::class);
Route::resource('/docentes', App\Http\Controllers\DocenteController::class);
Route::resource('/aulas', App\Http\Controllers\AulaController::class);
Route::resource('/niveles', App\Http\Controllers\NivelController::class);
Route::resource('/usuarios', App\Http\Controllers\UserController::class);
Route::resource('/asistencias', App\Http\Controllers\AsistenciaController::class);

