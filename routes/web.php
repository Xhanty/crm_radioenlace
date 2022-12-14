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
})->name('/');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::middleware(['auth_user'])->group(function () {
    Route::post('/logout_user', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout_user');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/asignaciones', [App\Http\Controllers\Admin\AsignacionesController::class, 'index'])->name('asignaciones');
    Route::post('/asignaciones_data', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_data'])->name('asignaciones_data');
    Route::post('/asignaciones_avances_delete', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_avances_delete'])->name('asignaciones_avances_delete');
    Route::post('/asignaciones_avances_add', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_avances_add'])->name('asignaciones_avances_add');
    Route::get('/gestionar_asignaciones', [App\Http\Controllers\Admin\AsignacionesController::class, 'gestionar_asignaciones'])->name('gestionar_asignaciones');
    Route::get('/actividades_diarias', [App\Http\Controllers\Admin\AsignacionesController::class, 'actividades_diarias'])->name('actividades_diarias');
    Route::post('/asignacion_add', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignacion_add'])->name('asignacion_add');
    Route::post('/asignacion_edit', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignacion_edit'])->name('asignacion_edit');
    Route::post('/change_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'change_asignacion'])->name('change_asignacion');
    Route::post('/eliminar_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'eliminar_asignacion'])->name('eliminar_asignacion');
    Route::post('/change_visto_bueno', [App\Http\Controllers\Admin\AsignacionesController::class, 'change_visto_bueno'])->name('change_visto_bueno');
    Route::post('/eliminar_archivo_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'eliminar_archivo_asignacion'])->name('eliminar_archivo_asignacion');
    
    Route::get('/clientes', [App\Http\Controllers\Admin\ClientesController::class, 'index'])->name('clientes');
    Route::get('/clientes_list', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_list'])->name('clientes_list');
    Route::post('/clientes_data', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_data'])->name('clientes_data');
    Route::post('/clientes_update', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_update'])->name('clientes_update');
    Route::post('/clientes_add', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_add'])->name('clientes_add');
    Route::post('/clientes_delete', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_delete'])->name('clientes_delete');
    Route::post('/clientes_inactivar', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_inactivar'])->name('clientes_inactivar');
    
    Route::get('/empleados', [App\Http\Controllers\Admin\EmpleadosController::class, 'index'])->name('empleados');
    Route::get('/empleados_list', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_list'])->name('empleados_list');
    Route::post('/empleados_data', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_data'])->name('empleados_data');
    Route::post('/empleados_add', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_add'])->name('empleados_add');
    Route::post('/empleados_update', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_update'])->name('empleados_update');
    Route::post('/empleados_delete', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_delete'])->name('empleados_delete');
    Route::post('/empleados_inactivar', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_inactivar'])->name('empleados_inactivar');
    Route::post('/empleados_novedades', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_novedades'])->name('empleados_novedades');
    Route::post('/empleados_novedad_delete', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_novedad_delete'])->name('empleados_novedad_delete');
    Route::post('/empleados_anexo_delete', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_anexo_delete'])->name('empleados_anexo_delete');
    Route::post('/empleados_anexo_add', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_anexo_add'])->name('empleados_anexo_add');
    
    Route::get('/proveedores', [App\Http\Controllers\Admin\ProveedoresController::class, 'index'])->name('proveedores');
    Route::post('/proveedores_add', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_add'])->name('proveedores_add');
    Route::post('/proveedores_edit', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_edit'])->name('proveedores_edit');
    Route::post('/proveedores_delete', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_delete'])->name('proveedores_delete');
    Route::post('/proveedores_data', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_data'])->name('proveedores_data');
    Route::post('/proveedores_anexos_add', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_anexos_add'])->name('proveedores_anexos_add');
    Route::post('/proveedores_anexos_delete', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_anexos_delete'])->name('proveedores_anexos_delete');

    Route::get('/proyectos', [App\Http\Controllers\Admin\ProyectosController::class, 'index'])->name('proyectos');
    
    Route::get('/mis_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'index'])->name('mis_puntos');
    Route::get('/gestionar_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'gestionar_puntos'])->name('gestionar_puntos');
    Route::post('/puntos_add', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_add'])->name('puntos_add');
    Route::post('/puntos_delete', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_delete'])->name('puntos_delete');
    Route::post('/puntos_data', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_data'])->name('puntos_data');
    Route::post('/puntos_edit', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_edit'])->name('puntos_edit');
    Route::post('/corte_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'corte_puntos'])->name('corte_puntos');
    
    Route::get('/inventario', [App\Http\Controllers\Admin\InventarioController::class, 'index'])->name('inventario');
    Route::get('/productos_list', [App\Http\Controllers\Admin\InventarioController::class, 'productos_list'])->name('productos_list');
    Route::post('/productos_create', [App\Http\Controllers\Admin\InventarioController::class, 'productos_create'])->name('productos_create');
    Route::post('/data_producto', [App\Http\Controllers\Admin\InventarioController::class, 'data_producto'])->name('data_producto');
    Route::post('/baja_producto', [App\Http\Controllers\Admin\InventarioController::class, 'baja_producto'])->name('baja_producto');
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
    Route::post('/data_salud_vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'data_salud_vehiculos'])->name('data_salud_vehiculos');
    Route::post('/delete_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_delete'])->name('delete_vehiculo');

    Route::get('/checklist_email', [App\Http\Controllers\Admin\VehiculosController::class, 'checklist_email'])->name('checklist_email');

    Route::get('/categorias_archivos', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'index'])->name('categorias_archivos');
    Route::post('/categorias_archivos_create', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'add'])->name('categorias_archivos_create');
    Route::post('/categorias_archivos_delete', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'delete'])->name('categorias_archivos_delete');

    Route::get('/archivos', [App\Http\Controllers\Admin\Documentos\ArchivosController::class, 'index'])->name('archivos');

    Route::get('/productos_baja', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'productos_baja'])->name('productos_baja');
    Route::get('/repuestos_reparacion', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'repuestos_reparacion'])->name('repuestos_reparacion');
    Route::get('/productos_instalados', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'productos_instalados'])->name('productos_instalados');
    Route::get('/ventas', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'ventas'])->name('ventas');
    Route::get('/prestamos', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'prestamos'])->name('prestamos');
    Route::get('/alquileres', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'alquileres'])->name('alquileres');
    Route::get('/productos_asignados', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'productos_asignados'])->name('productos_asignados');
});
