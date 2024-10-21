<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AsistenciaController;

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
Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->middleware(['auth', 'verified']);
//Route::get('/asistencias/reportes', [App\Http\Controllers\AlumnoController::class, 'reporte2'])->middleware('auth');

Route::resource('/salas', SalaController::class);
Route::resource('/planes', PlanController::class);
Route::resource('/alumnos', AlumnoController::class);
Route::resource('/docentes', DocenteController::class);
Route::resource('/usuarios', UserController::class);
Route::resource('/asistencias', AsistenciaController::class);

Route::get('/reportes', [ReporteController::class, 'index'])->middleware('auth');
Route::get('/reportes/asistencias', [ReporteController::class, 'reporte_por_fechas'])->middleware('auth');
           // ruta  -   vista
//Route::view('salas', 'livewire.salas');
//Route::view('planes', 'livewire.planes');
//Route::view('alumnos', 'livewire.alumnos');
Route::view('permisos', 'livewire.permisos')->middleware('can:Permisos_index');

//ruta para acceso a imágenes
Route::get('/docente/imagen/{filename}', [DocenteController::class, 'mostrarImagen'])->name('docente.imagen');
Route::get('/alumno/imagen/{filename}', [AlumnoController::class, 'mostrarImagen'])->name('alumno.imagen');
Route::get('/alumno/qr/{alumnoId}', [AsistenciaController::class, 'storeQr'])->name('alumno.qr');
Route::get('/alumno/imprimir-qr', [AlumnoController::class, 'imprimirQr'])->name('alumno.imprimir-qr');

Route::get('/asistencia/ingreso', [AsistenciaController::class, 'ingreso'])->name('asistencia.ingreso');
Route::get('/asistencia/ingresoSearch', [AsistenciaController::class, 'ingresoSearch'])->name('asistencia.ingresoSearch');
Route::get('/asistencia/egresoSearch', [AsistenciaController::class, 'egresoSearch'])->name('asistencia.egresoSearch');
Route::get('/asistencia/egreso', [AsistenciaController::class, 'egreso'])->name('asistencia.egreso');
Route::post('/asistencia/accion', [AsistenciaController::class, 'accion'])->name('asistencia.accion');

Route::get('/pdfqralumno/{alumnoId}', [PdfController::class, 'pdfQrAlumno'])->name('pdf.qr.alumno');
Route::get('/pdfqrall', [PdfController::class, 'pdfQrAll'])->name('pdf.qr.all');




