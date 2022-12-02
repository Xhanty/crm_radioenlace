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

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/asignaciones', [App\Http\Controllers\Admin\AsignacionesController::class, 'index'])->name('asignaciones');
Route::get('/gestionar_asignaciones', [App\Http\Controllers\Admin\AsignacionesController::class, 'gestionar_asignaciones'])->name('gestionar_asignaciones');
Route::get('/actividades_diarias', [App\Http\Controllers\Admin\AsignacionesController::class, 'actividades_diarias'])->name('actividades_diarias');
Route::post('/asignacion_add', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignacion_add'])->name('asignacion_add');
Route::post('/change_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'change_asignacion'])->name('change_asignacion');
Route::post('/eliminar_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'eliminar_asignacion'])->name('eliminar_asignacion');

Route::get('/clientes', [App\Http\Controllers\Admin\ClientesController::class, 'index'])->name('clientes');
Route::get('/clientes_list', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_list'])->name('clientes_list');

Route::get('/empleados', [App\Http\Controllers\Admin\EmpleadosController::class, 'index'])->name('empleados');

Route::get('/proveedores', [App\Http\Controllers\Admin\ProveedoresController::class, 'index'])->name('proveedores');

Route::get('/proyectos', [App\Http\Controllers\Admin\ProyectosController::class, 'index'])->name('proyectos');

Route::get('/mis_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'index'])->name('mis_puntos');
Route::get('/gestionar_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'gestionar_puntos'])->name('gestionar_puntos');

Route::get('/inventario', [App\Http\Controllers\Admin\InventarioController::class, 'index'])->name('inventario');

Route::get('/reparaciones', [App\Http\Controllers\Admin\ReparacionesController::class, 'index'])->name('reparaciones');

Route::get('/vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'index'])->name('vehiculos');
Route::get('/vehiculos_list', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_list'])->name('vehiculos_list');
Route::post('/vehiculos_create', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_create'])->name('vehiculos_create');
Route::post('/vehiculos_edit', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_edit'])->name('vehiculos_edit');
Route::post('/data_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'data_vehiculo'])->name('data_vehiculo');
Route::post('/delete_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_delete'])->name('delete_vehiculo');

Route::get('/checklist_email', [App\Http\Controllers\Admin\VehiculosController::class, 'checklist_email'])->name('checklist_email');