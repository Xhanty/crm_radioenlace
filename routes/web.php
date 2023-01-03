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
    // CERRAR SESION
    Route::post('/logout_user', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout_user');

    // INICIO
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ASIGNACIONES PROYECTOS
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

    // PROYECTOS
    Route::get('/asignaciones_clientes', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_clientes'])->name('asignaciones_clientes');
    Route::get('/gestionar_asignaciones_clientes', [App\Http\Controllers\Admin\AsignacionesController::class, 'gestionar_asignaciones_clientes'])->name('gestionar_asignaciones_clientes');

    // PUNTOS
    Route::get('/mis_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'index'])->name('mis_puntos');
    Route::get('/gestionar_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'gestionar_puntos'])->name('gestionar_puntos');
    Route::post('/puntos_add', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_add'])->name('puntos_add');
    Route::post('/puntos_delete', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_delete'])->name('puntos_delete');
    Route::post('/puntos_data', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_data'])->name('puntos_data');
    Route::post('/puntos_edit', [App\Http\Controllers\Admin\PuntosController::class, 'puntos_edit'])->name('puntos_edit');
    Route::post('/corte_puntos', [App\Http\Controllers\Admin\PuntosController::class, 'corte_puntos'])->name('corte_puntos');

    // VEHICULOS
    Route::get('/vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'index'])->name('vehiculos');
    Route::get('/vehiculos_list', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_list'])->name('vehiculos_list');
    Route::post('/vehiculos_create', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_create'])->name('vehiculos_create');
    Route::post('/vehiculos_edit', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_edit'])->name('vehiculos_edit');
    Route::post('/data_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'data_vehiculo'])->name('data_vehiculo');
    Route::post('/data_salud_vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'data_salud_vehiculos'])->name('data_salud_vehiculos');
    Route::post('/delete_vehiculo', [App\Http\Controllers\Admin\VehiculosController::class, 'vehiculos_delete'])->name('delete_vehiculo');
    Route::post('/show_encuesta_salud', [App\Http\Controllers\Admin\VehiculosController::class, 'show_encuesta_salud'])->name('show_encuesta_salud');
    Route::post('/delete_encuesta_salud', [App\Http\Controllers\Admin\VehiculosController::class, 'delete_encuesta_salud'])->name('delete_encuesta_salud');
    Route::post('/add_encuesta_salud', [App\Http\Controllers\Admin\VehiculosController::class, 'add_encuesta_salud'])->name('add_encuesta_salud');
    Route::post('/get_tecnicos_vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'get_tecnicos_vehiculos'])->name('get_tecnicos_vehiculos');
    Route::post('/get_inspecciones_vehiculos', [App\Http\Controllers\Admin\VehiculosController::class, 'get_inspecciones_vehiculos'])->name('get_inspecciones_vehiculos');
    Route::post('/get_gruas', [App\Http\Controllers\Admin\VehiculosController::class, 'get_gruas'])->name('get_gruas');
    Route::post('/delete_encuesta_grua', [App\Http\Controllers\Admin\VehiculosController::class, 'delete_encuesta_grua'])->name('delete_encuesta_grua');
    Route::post('/delete_encuesta_tecnico', [App\Http\Controllers\Admin\VehiculosController::class, 'delete_encuesta_tecnico'])->name('delete_encuesta_tecnico');
    Route::post('/delete_encuesta_inspeccion', [App\Http\Controllers\Admin\VehiculosController::class, 'delete_encuesta_inspeccion'])->name('delete_encuesta_inspeccion');
    Route::get('/checklist_email', [App\Http\Controllers\Admin\VehiculosController::class, 'checklist_email'])->name('checklist_email');

    // CLIENTES
    Route::get('/clientes', [App\Http\Controllers\Admin\ClientesController::class, 'index'])->name('clientes');
    Route::get('/clientes_list', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_list'])->name('clientes_list');
    Route::post('/clientes_data', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_data'])->name('clientes_data');
    Route::post('/clientes_update', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_update'])->name('clientes_update');
    Route::post('/clientes_add', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_add'])->name('clientes_add');
    Route::post('/clientes_delete', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_delete'])->name('clientes_delete');
    Route::post('/clientes_inactivar', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_inactivar'])->name('clientes_inactivar');

    // EMPLEADOS
    Route::get('/empleados', [App\Http\Controllers\Admin\EmpleadosController::class, 'index'])->name('empleados');
    Route::get('/empleados_list', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_list'])->name('empleados_list');
    Route::get('/empleados_actives', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_actives'])->name('empleados_actives');
    Route::post('/empleados_data', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_data'])->name('empleados_data');
    Route::post('/empleados_add', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_add'])->name('empleados_add');
    Route::post('/empleados_update', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_update'])->name('empleados_update');
    Route::post('/empleados_delete', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_delete'])->name('empleados_delete');
    Route::post('/empleados_inactivar', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_inactivar'])->name('empleados_inactivar');
    Route::post('/empleados_novedades', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_novedades'])->name('empleados_novedades');
    Route::post('/empleados_novedad_delete', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_novedad_delete'])->name('empleados_novedad_delete');
    Route::post('/empleados_anexo_delete', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_anexo_delete'])->name('empleados_anexo_delete');
    Route::post('/empleados_anexo_add', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_anexo_add'])->name('empleados_anexo_add');

    // PROVEEDORES
    Route::get('/proveedores', [App\Http\Controllers\Admin\ProveedoresController::class, 'index'])->name('proveedores');
    Route::post('/proveedores_add', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_add'])->name('proveedores_add');
    Route::post('/proveedores_edit', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_edit'])->name('proveedores_edit');
    Route::post('/proveedores_delete', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_delete'])->name('proveedores_delete');
    Route::post('/proveedores_data', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_data'])->name('proveedores_data');
    Route::post('/proveedores_anexos_add', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_anexos_add'])->name('proveedores_anexos_add');
    Route::post('/proveedores_anexos_delete', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_anexos_delete'])->name('proveedores_anexos_delete');

    // INVENTARIO
    Route::get('/almacenes', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'index'])->name('almacenes');
    Route::post('/almacenes_create', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'almacenes_create'])->name('almacenes_create');
    Route::post('/almacenes_delete', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'almacenes_delete'])->name('almacenes_delete');
    Route::get('/categoria_productos', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'index'])->name('categoria_productos');
    Route::post('/categorias_create', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'categorias_create'])->name('categorias_create');
    Route::post('/categorias_delete', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'categorias_delete'])->name('categorias_delete');
    Route::get('/gestion_inventario', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'gestion_inventario'])->name('gestion_inventario');
    Route::get('/inventario', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'index'])->name('inventario');
    Route::get('/productos_list', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_list'])->name('productos_list');
    Route::get('/gestion_existencias_list', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'gestion_existencias_list'])->name('gestion_existencias_list');
    Route::get('/gestion_inventario_list', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'gestion_inventario_list'])->name('gestion_inventario_list');
    Route::post('/productos_create', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_create'])->name('productos_create');
    Route::post('/data_producto', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'data_producto'])->name('data_producto');
    Route::post('/baja_producto', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'baja_producto'])->name('baja_producto');
    Route::post('/delete_producto', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'delete_producto'])->name('delete_producto');
    Route::post('/productos_edit', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_edit'])->name('productos_edit');
    Route::post('/productos_reingreso', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_reingreso'])->name('productos_reingreso');
    Route::post('/inventario_change_status', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'inventario_change_status'])->name('inventario_change_status');
    Route::post('/inventario_delete', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'inventario_delete'])->name('inventario_delete');
    Route::post('/inventario_update', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'inventario_update'])->name('inventario_update');
    Route::post('/inventario_data', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'inventario_data'])->name('inventario_data');
    Route::post('/inventario_detail', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'inventario_detail'])->name('inventario_detail');
    Route::post('/inventario_update_select', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'inventario_update_select'])->name('inventario_update_select');
    Route::get('/actividades_inventario', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'actividades_inventario'])->name('actividades_inventario');
    Route::get('/actividades_inventario_list', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'actividades_inventario_list'])->name('actividades_inventario_list');

    // MOVIMIENTOS DE INVENTARIO
    Route::get('/productos_baja', [App\Http\Controllers\Admin\MovimientoInv\ProductosController::class, 'productos_baja'])->name('productos_baja');
    Route::get('/repuestos_reparacion', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'index'])->name('repuestos_reparacion');
    Route::get('/productos_instalados', [App\Http\Controllers\Admin\MovimientoInv\ProductosController::class, 'productos_instalados'])->name('productos_instalados');
    Route::get('/ventas', [App\Http\Controllers\Admin\MovimientoInv\VentasController::class, 'index'])->name('ventas');
    Route::get('/prestamos', [App\Http\Controllers\Admin\MovimientoInv\RepuestosController::class, 'prestamos'])->name('prestamos');
    Route::get('/alquileres', [App\Http\Controllers\Admin\MovimientoInv\AlquileresController::class, 'index'])->name('alquileres');
    Route::get('/productos_asignados', [App\Http\Controllers\Admin\MovimientoInv\ProductosController::class, 'productos_asignados'])->name('productos_asignados');

    // SOLICITUDES DE INVENTARIO
    Route::get('/solicitud_inventario', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'index'])->name('solicitud_inventario');

    // PROYECTOS 
    Route::get('/categorias_proyectos', [App\Http\Controllers\Admin\Proyectos\CategoriasController::class, 'index'])->name('categorias_proyectos');
    Route::post('/categorias_proyectos_add', [App\Http\Controllers\Admin\Proyectos\CategoriasController::class, 'add'])->name('categorias_proyectos_add');
    Route::post('/categorias_proyectos_delete', [App\Http\Controllers\Admin\Proyectos\CategoriasController::class, 'delete'])->name('categorias_proyectos_delete');
    Route::get('/proyectos', [App\Http\Controllers\Admin\Proyectos\ProyectosController::class, 'index'])->name('proyectos');
    Route::post('/proyectos_data', [App\Http\Controllers\Admin\Proyectos\ProyectosController::class, 'proyectos_data'])->name('proyectos_data');
    Route::post('/proyectos_delete', [App\Http\Controllers\Admin\Proyectos\ProyectosController::class, 'proyectos_delete'])->name('proyectos_delete');
    Route::post('/proyectos_add', [App\Http\Controllers\Admin\Proyectos\ProyectosController::class, 'proyectos_add'])->name('proyectos_add');
    Route::post('/proyectos_edit', [App\Http\Controllers\Admin\Proyectos\ProyectosController::class, 'proyectos_edit'])->name('proyectos_edit');
    Route::post('/change_visto_bueno_proyecto', [App\Http\Controllers\Admin\Proyectos\ProyectosController::class, 'visto_bueno'])->name('change_visto_bueno_proyecto');

    // SEGUIMIENTO DE CLIENTES
    Route::get('/categorias_seguimientos', [App\Http\Controllers\Admin\SeguimientoCliente\CategoriasController::class, 'index'])->name('categorias_seguimientos');
    Route::post('/categorias_seguimientos_add', [App\Http\Controllers\Admin\SeguimientoCliente\CategoriasController::class, 'add'])->name('categorias_seguimientos_add');
    Route::post('/categorias_seguimientos_delete', [App\Http\Controllers\Admin\SeguimientoCliente\CategoriasController::class, 'delete'])->name('categorias_seguimientos_delete');
    Route::get('/seguimientos_clientes', [App\Http\Controllers\Admin\SeguimientoCliente\SeguimientoController::class, 'index'])->name('seguimientos_clientes');
    Route::get('/tarjetas_seguimientos', [App\Http\Controllers\Admin\SeguimientoCliente\TarjetasController::class, 'index'])->name('tarjetas_seguimientos');

    // REPARACIONES
    Route::get('/reparaciones', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'index'])->name('reparaciones');
    Route::get('/mis_reparaciones', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'index'])->name('mis_reparaciones');

    // DOCUMENTOS
    Route::get('/categorias_archivos', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'index'])->name('categorias_archivos');
    Route::post('/categorias_archivos_create', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'add'])->name('categorias_archivos_create');
    Route::post('/categorias_archivos_delete', [App\Http\Controllers\Admin\Documentos\CategoriasController::class, 'delete'])->name('categorias_archivos_delete');
    Route::get('/archivos', [App\Http\Controllers\Admin\Documentos\ArchivosController::class, 'index'])->name('archivos');
    Route::post('/archivos_delete', [App\Http\Controllers\Admin\Documentos\ArchivosController::class, 'archivos_delete'])->name('archivos_delete');
    Route::post('/archivos_add', [App\Http\Controllers\Admin\Documentos\ArchivosController::class, 'archivos_add'])->name('archivos_add');
    Route::get('/documentos', [App\Http\Controllers\Admin\Documentos\DocumentosController::class, 'index'])->name('documentos');

    // COMERCIAL
    Route::get('/ordenes_compra', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'index'])->name('ordenes_compra');
    Route::get('/cotizaciones', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'index'])->name('cotizaciones');
    Route::get('/remisiones', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'index'])->name('remisiones');

    // CONTABILIDAD
    Route::get('/facturacion', [App\Http\Controllers\Admin\Contabilidad\FacturacionController::class, 'index'])->name('facturacion');
    Route::get('/estadistica_proveedores', [App\Http\Controllers\Admin\Contabilidad\EstadisticasController::class, 'estadistica_proveedores'])->name('estadistica_proveedores');
    Route::get('/estadistica_compra', [App\Http\Controllers\Admin\Contabilidad\EstadisticasController::class, 'estadistica_compra'])->name('estadistica_compra');
    Route::get('/estadistica_ventas', [App\Http\Controllers\Admin\Contabilidad\EstadisticasController::class, 'estadistica_ventas'])->name('estadistica_ventas');
    Route::get('/viaticos', [App\Http\Controllers\Admin\Contabilidad\ViaticosController::class, 'index'])->name('viaticos');
    Route::get('/causaciones', [App\Http\Controllers\Admin\Contabilidad\CausacionesController::class, 'index'])->name('causaciones');
    Route::get('/informe_contable', [App\Http\Controllers\Admin\Contabilidad\InformeContableController::class, 'index'])->name('informe_contable');
    Route::get('/nomina', [App\Http\Controllers\Admin\Contabilidad\NominaController::class, 'nomina'])->name('nomina');
    Route::get('/config_nomina', [App\Http\Controllers\Admin\Contabilidad\NominaController::class, 'config_nomina'])->name('config_nomina');
    Route::post('/update_config_nomina', [App\Http\Controllers\Admin\Contabilidad\NominaController::class, 'update_config_nomina'])->name('update_config_nomina');

    // GASTOS
    Route::get('/arrendamientos', [App\Http\Controllers\Admin\Gastos\ArrendamientosController::class, 'index'])->name('arrendamientos');
    Route::get('/gastos_varios', [App\Http\Controllers\Admin\Gastos\GastosController::class, 'gastos_varios'])->name('gastos_varios');
    Route::get('/gastos_fijos', [App\Http\Controllers\Admin\Gastos\GastosController::class, 'gastos_fijos'])->name('gastos_fijos');
    Route::get('/gastos_equivalentes', [App\Http\Controllers\Admin\Gastos\GastosController::class, 'gastos_equivalentes'])->name('gastos_equivalentes');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('tasks',  [App\Http\Controllers\TaskProjectController::class, 'index'])->name('tasks.index');
    Route::post('tasks', [App\Http\Controllers\TaskProjectController::class, 'store'])->name('tasks.store');
    Route::post('tasks_anexos', [App\Http\Controllers\TaskProjectController::class, 'anexos'])->name('tasks_anexos');
    Route::post('task_add_file', [App\Http\Controllers\TaskProjectController::class, 'task_add_file'])->name('task_add_file');
    Route::post('task_delete_file', [App\Http\Controllers\TaskProjectController::class, 'task_delete_file'])->name('task_delete_file');
    Route::post('tasks_avances', [App\Http\Controllers\TaskProjectController::class, 'avances'])->name('tasks_avances');
    Route::post('task_add_avance', [App\Http\Controllers\TaskProjectController::class, 'task_add_avance'])->name('task_add_avance');
    Route::post('task_add_file_observacion', [App\Http\Controllers\TaskProjectController::class, 'task_add_file_observacion'])->name('task_add_file_observacion');
    Route::post('task_delete_avance', [App\Http\Controllers\TaskProjectController::class, 'task_delete_avance'])->name('task_delete_avance');
    Route::post('tasks_edit', [App\Http\Controllers\TaskProjectController::class, 'tasks_edit'])->name('tasks_edit');
    Route::post('task_change_responsable', [App\Http\Controllers\TaskProjectController::class, 'task_change_responsable'])->name('task_change_responsable');
    Route::post('tasks_delete', [App\Http\Controllers\TaskProjectController::class, 'tasks_delete'])->name('tasks_delete');
    Route::put('tasks/sync', [App\Http\Controllers\TaskProjectController::class, 'sync'])->name('tasks.sync');
    Route::put('tasks/{task}', [App\Http\Controllers\TaskProjectController::class, 'update'])->name('tasks.update');
    
    Route::get('gantt',  [App\Http\Controllers\GanttController::class, 'index'])->name('gantt');
    Route::get('data_tasks_gantt',  [App\Http\Controllers\GanttController::class, 'data'])->name('data_tasks_gantt');
    //Route::get('gantt/{project}',  [App\Http\Controllers\GanttController::class, 'show'])->name('gantt.show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('statuses', [App\Http\Controllers\StatusController::class, 'store'])->name('statuses.store');
    Route::put('statuses', [App\Http\Controllers\StatusController::class, 'update'])->name('statuses.update');
});
