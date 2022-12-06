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
Route::post('/clientes_data', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_data'])->name('clientes_data');

Route::get('/empleados', [App\Http\Controllers\Admin\EmpleadosController::class, 'index'])->name('empleados');
Route::get('/empleados_list', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_list'])->name('empleados_list');
Route::post('/empleados_data', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_data'])->name('empleados_data');

Route::get('/proveedores', [App\Http\Controllers\Admin\ProveedoresController::class, 'index'])->name('proveedores');

Route::get('/proyectos', [App\Http\Controllers\Admin\ProyectosController::class, 'index'])->name('proyectos');

Route::get('/mis_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'index'])->name('mis_puntos');
Route::get('/gestionar_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'gestionar_puntos'])->name('gestionar_puntos');

Route::get('/inventario', [App\Http\Controllers\Admin\InventarioController::class, 'index'])->name('inventario');
Route::get('/productos_list', [App\Http\Controllers\Admin\InventarioController::class, 'productos_list'])->name('productos_list');
Route::post('/productos_create', [App\Http\Controllers\Admin\InventarioController::class, 'productos_create'])->name('productos_create');
Route::post('/data_producto', [App\Http\Controllers\Admin\InventarioController::class, 'data_producto'])->name('data_producto');
Route::post('/delete_producto', [App\Http\Controllers\Admin\InventarioController::class, 'delete_producto'])->name('delete_producto');
Route::post('/productos_edit', [App\Http\Controllers\Admin\InventarioController::class, 'productos_edit'])->name('productos_edit');

Route::get('/categoria_productos', [App\Http\Controllers\Admin\CategoriaProductosController::class, 'index'])->name('categoria_productos');
Route::post('/categorias_create', [App\Http\Controllers\Admin\CategoriaProductosController::class, 'categorias_create'])->name('categorias_create');
Route::post('/categorias_delete', [App\Http\Controllers\Admin\CategoriaProductosController::class, 'categorias_delete'])->name('categorias_delete');

Route::get('/almacenes', [App\Http\Controllers\Admin\AlmacenesController::class, 'index'])->name('almacenes');
Route::post('/almacenes_create', [App\Http\Controllers\Admin\AlmacenesController::class, 'almacenes_create'])->name('almacenes_create');
Route::post('/almacenes_delete', [App\Http\Controllers\Admin\AlmacenesController::class, 'almacenes_delete'])->name('almacenes_delete');

Route::get('/actividades_inventario', [App\Http\Controllers\Admin\InventarioController::class, 'actividades_inventario'])->name('actividades_inventario');
Route::get('/actividades_inventario_list', [App\Http\Controllers\Admin\InventarioController::class, 'actividades_inventario_list'])->name('actividades_inventario_list');

Route::get('/reparaciones', [App\Http\Controllers\Admin\ReparacionesController::class, 'index'])->name('reparaciones');

Route::get('/vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'index'])->name('vehiculos');
Route::get('/vehiculos_list', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_list'])->name('vehiculos_list');
Route::post('/vehiculos_create', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_create'])->name('vehiculos_create');
Route::post('/vehiculos_edit', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_edit'])->name('vehiculos_edit');
Route::post('/data_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'data_vehiculo'])->name('data_vehiculo');
Route::post('/delete_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_delete'])->name('delete_vehiculo');

Route::get('/checklist_email', [App\Http\Controllers\Admin\VehiculosController::class, 'checklist_email'])->name('checklist_email');


Route::get('/categorias_archivos', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'index'])->name('categorias_archivos');
Route::post('/categorias_archivos_create', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'add'])->name('categorias_archivos_create');
Route::post('/categorias_archivos_delete', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'delete'])->name('categorias_archivos_delete');

Route::get('/archivos', [App\Http\Controllers\Admin\Documentos\ArchivosController::class, 'index'])->name('archivos');