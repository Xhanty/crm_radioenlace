<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Artisan;

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

/*Route::get('/mail', function () {
    $markdown = new Markdown(view(), config('mail.markdown'));
    return $markdown->render('emails.CotizacionMail');
})->name('mail');*/

Route::get('/', function () {
    return view('auth.login');
})->name('/');

Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'DONE'; //Return anything
});

// PRECIOS PROVEEDORES
Route::get('/precios_update', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'precios_update'])->name('precios_update');
Route::get('/precios_update_view', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'precios_update_view'])->name('precios_update_view');
Route::post('/precios_edit', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'precios_edit'])->name('precios_edit');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

// RUTAS PARA USUARIOS
Route::middleware(['auth_user'])->group(function () {
    // CERRAR SESION
    Route::post('/logout_user', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout_user');

    // INICIO
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // NOTIFICACIONES
    Route::post('/notificaciones_eventos', [App\Http\Controllers\NotificacionesController::class, 'notificaciones_eventos'])->name('notificaciones_eventos');

    // ASIGNACIONES PROYECTOS
    Route::get('/asignaciones', [App\Http\Controllers\Admin\AsignacionesController::class, 'index'])->name('asignaciones');
    Route::post('/asignaciones_data', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_data'])->name('asignaciones_data');
    Route::post('/asignaciones_avances_delete', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_avances_delete'])->name('asignaciones_avances_delete');
    Route::post('/asignaciones_avances_add', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_avances_add'])->name('asignaciones_avances_add');
    Route::get('/gestionar_asignaciones', [App\Http\Controllers\Admin\AsignacionesController::class, 'gestionar_asignaciones'])->name('gestionar_asignaciones');
    Route::post('/asignacion_add', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignacion_add'])->name('asignacion_add');
    Route::post('/asignacion_edit', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignacion_edit'])->name('asignacion_edit');
    Route::post('/change_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'change_asignacion'])->name('change_asignacion');
    Route::post('/eliminar_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'eliminar_asignacion'])->name('eliminar_asignacion');
    Route::post('/change_visto_bueno', [App\Http\Controllers\Admin\AsignacionesController::class, 'change_visto_bueno'])->name('change_visto_bueno');
    Route::post('/eliminar_archivo_asignacion', [App\Http\Controllers\Admin\AsignacionesController::class, 'eliminar_archivo_asignacion'])->name('eliminar_archivo_asignacion');

    // ASIGNACIONES CLIENTES
    Route::get('/asignaciones_clientes', [App\Http\Controllers\Admin\AsignacionesController::class, 'asignaciones_clientes'])->name('asignaciones_clientes');
    Route::get('/gestionar_asignaciones_clientes', [App\Http\Controllers\Admin\AsignacionesController::class, 'gestionar_asignaciones_clientes'])->name('gestionar_asignaciones_clientes');
    Route::get('/asignaciones_clientes_excel', [App\Http\Controllers\Admin\AsignacionesController::class, 'excel'])->name('asignaciones_clientes_excel');

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
    Route::post('/checklist_send_email', [App\Http\Controllers\Admin\VehiculosController::class, 'send_email'])->name('checklist_send_email');

    // CLIENTES
    Route::get('/clientes', [App\Http\Controllers\Admin\ClientesController::class, 'index'])->name('clientes');
    Route::get('/clientes_list', [App\Http\Controllers\Admin\ClientesController::class, 'clientes_list'])->name('clientes_list');
    Route::post('/info_cliente', [App\Http\Controllers\Admin\ClientesController::class, 'info_cliente'])->name('info_cliente');
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
    Route::post('/empleados_change_clave', [App\Http\Controllers\Admin\EmpleadosController::class, 'empleados_change_clave'])->name('empleados_change_clave');

    // PROVEEDORES
    Route::get('/proveedores', [App\Http\Controllers\Admin\ProveedoresController::class, 'index'])->name('proveedores');
    Route::get('/history_proveedores', [App\Http\Controllers\Admin\ProveedoresController::class, 'history'])->name('history_proveedores');
    Route::post('/info_proveedor', [App\Http\Controllers\Admin\ProveedoresController::class, 'info_proveedor'])->name('info_proveedor');
    Route::post('/proveedores_add', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_add'])->name('proveedores_add');
    Route::post('/proveedores_edit', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_edit'])->name('proveedores_edit');
    Route::post('/proveedores_delete', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_delete'])->name('proveedores_delete');
    Route::post('/proveedores_data', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_data'])->name('proveedores_data');
    Route::post('/proveedores_anexos_add', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_anexos_add'])->name('proveedores_anexos_add');
    Route::post('/proveedores_anexos_delete', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_anexos_delete'])->name('proveedores_anexos_delete');
    Route::post('/proveedores_status', [App\Http\Controllers\Admin\ProveedoresController::class, 'proveedores_status'])->name('proveedores_status');

    // INVENTARIO
    Route::get('/almacenes', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'index'])->name('almacenes');
    Route::post('/almacenes_create', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'almacenes_create'])->name('almacenes_create');
    Route::post('/almacenes_update', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'almacenes_update'])->name('almacenes_update');
    Route::post('/almacenes_delete', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'almacenes_delete'])->name('almacenes_delete');
    Route::post('/almacenes_get_inventario', [App\Http\Controllers\Admin\Inventario\AlmacenesController::class, 'get_inventario'])->name('almacenes_get_inventario');
    Route::get('/categoria_productos', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'index'])->name('categoria_productos');
    Route::post('/categorias_create', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'categorias_create'])->name('categorias_create');
    Route::post('/subcategorias_get', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'subcategorias_get'])->name('subcategorias_get');
    Route::post('/categorias_edit', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'categorias_edit'])->name('categorias_edit');
    Route::post('/categorias_delete', [App\Http\Controllers\Admin\Inventario\CategoriaProductosController::class, 'categorias_delete'])->name('categorias_delete');
    Route::get('/gestion_inventario', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'gestion_inventario'])->name('gestion_inventario');
    Route::get('/inventario', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'index'])->name('inventario');
    Route::get('/productos_list', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_list'])->name('productos_list');
    Route::get('/productos_gestion_list', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_gestion_list'])->name('productos_gestion_list');
    Route::post('/productos_create', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_create'])->name('productos_create');
    Route::post('/data_producto', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'data_producto'])->name('data_producto');
    Route::post('/baja_producto', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'baja_producto'])->name('baja_producto');
    Route::post('/delete_producto', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'delete_producto'])->name('delete_producto');
    Route::post('/productos_edit', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'productos_edit'])->name('productos_edit');
    Route::post('/search_serial_inventario', [App\Http\Controllers\Admin\Inventario\InventarioController::class, 'search_serial_inventario'])->name('search_serial_inventario');

    // SOLICITUDES DE INVENTARIO
    Route::get('/solicitud_inventario', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'index'])->name('solicitud_inventario');
    Route::post('/data_solicitud_inventario', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'data'])->name('data_solicitud_inventario');
    Route::post('/solicitud_inventario_add', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'solicitud_add'])->name('solicitud_inventario_add');
    Route::post('/solicitud_inventario_update', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'solicitud_edit'])->name('solicitud_inventario_update');
    Route::post('/solicitud_inventario_rechazar', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'rechazar_individual'])->name('solicitud_inventario_rechazar');

    // GESTIÓN SOLICITUDES DE INVENTARIO
    Route::get('/gestion_solicitudes', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'gestion'])->name('gestion_solicitudes');
    Route::post('/delete_solicitud_inventario', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'delete'])->name('delete_solicitud_inventario');
    Route::post('/rechazar_solicitud_inventario', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'rechazar'])->name('rechazar_solicitud_inventario');
    Route::post('/solicitud_inventario_asignado', [App\Http\Controllers\Admin\Inventario\SolicitudInventarioController::class, 'asignar_producto'])->name('solicitud_inventario_asignado');

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

    // REPARACIONES CONFIG
    Route::get('/accesorios_reparaciones', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'accesorios'])->name('accesorios_reparaciones');
    Route::post('/accesorios_reparaciones_add', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'accesorios_add'])->name('accesorios_reparaciones_add');
    Route::post('/accesorios_reparaciones_add', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'accesorios_add'])->name('accesorios_reparaciones_add');
    Route::post('/accesorios_reparaciones_delete', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'accesorios_delete'])->name('accesorios_reparaciones_delete');

    Route::get('/categorias_reparaciones', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'categorias'])->name('categorias_reparaciones');
    Route::post('/categorias_reparaciones_add', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'categorias_add'])->name('categorias_reparaciones_add');
    Route::post('/categorias_reparaciones_delete', [App\Http\Controllers\Admin\Reparaciones\ConfigController::class, 'categorias_delete'])->name('categorias_reparaciones_delete');

    // REPARACIONES
    Route::get('/reparaciones', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'index'])->name('reparaciones');
    Route::get('/reparacion_pdf', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'pdf'])->name('reparacion_pdf');
    Route::get('/reparaciones_excel', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'excel'])->name('reparaciones_excel');
    Route::post('/reparaciones_info', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'info'])->name('reparaciones_info');
    Route::post('/reparaciones_add', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'add'])->name('reparaciones_add');
    Route::post('/reparaciones_edit', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'edit'])->name('reparaciones_edit');
    Route::post('/reparaciones_delete', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'delete'])->name('reparaciones_delete');
    Route::post('/reparaciones_completar', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'completar'])->name('reparaciones_completar');
    Route::post('/reparaciones_reversar', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'reversar'])->name('reparaciones_reversar');
    Route::post('/reparaciones_aprobado', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'aprobado'])->name('reparaciones_aprobado');
    Route::post('/reparaciones_tecnico', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'tecnico'])->name('reparaciones_tecnico');

    // MIS REPARACIONES
    Route::get('/mis_reparaciones', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'index'])->name('mis_reparaciones');
    Route::post('/mis_reparaciones', [App\Http\Controllers\Admin\Reparaciones\ReparacionesController::class, 'mis_reparaciones'])->name('mis_reparaciones');
    Route::post('/reparaciones_avances', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'avances'])->name('reparaciones_avances');
    Route::post('/reparaciones_repuestos', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'repuestos'])->name('reparaciones_repuestos');
    Route::post('/reparaciones_reparaciones', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'reparaciones'])->name('reparaciones_reparaciones');
    Route::post('/reparaciones_avances_add', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'avance_add'])->name('reparaciones_avances_add');
    Route::post('/reparaciones_avances_delete', [App\Http\Controllers\Admin\Reparaciones\MisReparacionesController::class, 'avance_delete'])->name('reparaciones_avances_delete');

    // DOCUMENTOS
    Route::get('/documentos', [App\Http\Controllers\Admin\Documentos\DocumentosController::class, 'index'])->name('documentos');

    // COMERCIAL
    Route::get('/ordenes_compra', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'index'])->name('ordenes_compra');
    Route::post('/orden_compra_create', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'create'])->name('orden_compra_create');
    Route::post('/orden_compra_data', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'data'])->name('orden_compra_data');
    Route::post('/orden_compra_data_proveedores', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'data_proveedores'])->name('orden_compra_data_proveedores');
    Route::post('/orden_compra_completar', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'completar'])->name('orden_compra_completar');
    Route::post('/orden_compra_delete', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'delete'])->name('orden_compra_delete');
    Route::post('/orden_compra_edit', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'edit'])->name('orden_compra_edit');
    Route::post('/orden_compra_email', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'send_email'])->name('orden_compra_email');
    Route::post('/orden_compra_aprobado', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'aprobacion'])->name('orden_compra_aprobado');
    Route::get('/ordenes_print', [App\Http\Controllers\Admin\Comercial\OrdenCompraController::class, 'print'])->name('ordenes_print');
    Route::get('/cotizaciones', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'index'])->name('cotizaciones');
    Route::get('/cotizaciones_print', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'print'])->name('cotizaciones_print');
    Route::post('/cotizacion_data', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'data'])->name('cotizacion_data');
    Route::post('/cotizacion_create', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'create'])->name('cotizacion_create');
    Route::post('/cotizacion_edit', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'edit'])->name('cotizacion_edit');
    Route::post('/cotizacion_completar', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'completar'])->name('cotizacion_completar');
    Route::post('/cotizacion_delete', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'delete'])->name('cotizacion_delete');
    Route::post('/cotizacion_email', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'send'])->name('cotizacion_email');
    Route::post('/cotizacion_aprobado', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'aprobacion'])->name('cotizacion_aprobado');
    Route::post('/cotizacion_fecha_revision', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'update_revision'])->name('cotizacion_fecha_revision');
    Route::get('/precios_proveedores', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'index'])->name('precios_proveedores');
    Route::post('/precios_proveedores_add', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'add'])->name('precios_proveedores_add');
    Route::post('/precios_proveedores_delete', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'delete'])->name('precios_proveedores_delete');
    Route::post('/precios_proveedores_send_email', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'send_email'])->name('precios_proveedores_send_email');
    Route::post('/precios_proveedores_data', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'data_precios'])->name('precios_proveedores_data');
    Route::post('/precios_proveedores_edit', [App\Http\Controllers\Admin\Comercial\PreciosController::class, 'edit'])->name('precios_proveedores_edit');

    // REMISIONES
    Route::get('/remisiones', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'index'])->name('remisiones');
    Route::get('/remisiones_print', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'print'])->name('remisiones_print');
    Route::post('/remisiones_data', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'data'])->name('remisiones_data');
    Route::post('/remisiones_add', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'add'])->name('remisiones_add');
    Route::post('/remisiones_edit', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'edit'])->name('remisiones_edit');
    Route::post('/remisiones_delete', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'delete'])->name('remisiones_delete');
    Route::post('/remisiones_completar', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'completar'])->name('remisiones_completar');
    Route::post('/remisiones_email', [App\Http\Controllers\Admin\Comercial\RemisionController::class, 'email'])->name('remisiones_email');

    // HISTORIAL DE COTIZACIONES
    Route::get('/history_cotizaciones', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'history'])->name('history_cotizaciones');
    Route::post('/history_cotizaciones_add', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'history_add'])->name('history_cotizaciones_add');
    Route::post('/history_cotizaciones_edit', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'history_edit'])->name('history_cotizaciones_edit');
    Route::post('/history_cotizaciones_delete', [App\Http\Controllers\Admin\Comercial\CotizacionController::class, 'history_delete'])->name('history_cotizaciones_delete');

    // CONTABILIDAD
    Route::get('/configuracion_contabilidad', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'index'])->name('configuracion_contabilidad');

    // ORGANIZACIÓN
    Route::post('/edit_organizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_organizacion'])->name('edit_organizacion');

    // RESOLUCIÓN
    Route::post('/resolucion_add', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'resolucion_add'])->name('resolucion_add');

    Route::post('/anexos_organizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'anexos_organizacion'])->name('anexos_organizacion');
    Route::post('/add_anexo_organizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_anexo_organizacion'])->name('add_anexo_organizacion');
    Route::post('/delete_anexo_organizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'delete_anexo_organizacion'])->name('delete_anexo_organizacion');

    Route::post('/tipo_empresa_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'tipo_empresa_data'])->name('tipo_empresa_data');
    Route::post('/add_tipo_empresa', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_tipo_empresa'])->name('add_tipo_empresa');
    Route::post('/edit_tipo_empresa', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_tipo_empresa'])->name('edit_tipo_empresa');
    Route::post('/status_tipo_empresa', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_tipo_empresa'])->name('status_tipo_empresa');

    Route::post('/tipo_regimen_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'tipo_regimen_data'])->name('tipo_regimen_data');
    Route::post('/add_tipo_regimen', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_tipo_regimen'])->name('add_tipo_regimen');
    Route::post('/edit_tipo_regimen', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_tipo_regimen'])->name('edit_tipo_regimen');
    Route::post('/status_tipo_regimen', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_tipo_regimen'])->name('status_tipo_regimen');

    Route::post('/tipo_documento_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'tipo_documento_data'])->name('tipo_documento_data');
    Route::post('/add_tipo_documento', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_tipo_documento'])->name('add_tipo_documento');
    Route::post('/edit_tipo_documento', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_tipo_documento'])->name('edit_tipo_documento');
    Route::post('/status_tipo_documento', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_tipo_documento'])->name('status_tipo_documento');

    Route::post('/centros_costos_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'centros_costos_data'])->name('centros_costos_data');
    Route::post('/add_centros_costos', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_centros_costos'])->name('add_centros_costos');
    Route::post('/edit_centros_costos', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_centros_costos'])->name('edit_centros_costos');
    Route::post('/status_centros_costos', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_centros_costos'])->name('status_centros_costos');

    Route::post('/tributos_dian_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'tributos_dian_data'])->name('tributos_dian_data');
    Route::post('/add_tributos_dian', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_tributos_dian'])->name('add_tributos_dian');
    Route::post('/edit_tributos_dian', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_tributos_dian'])->name('edit_tributos_dian');
    Route::post('/status_tributos_dian', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_tributos_dian'])->name('status_tributos_dian');

    Route::post('/actividades_economicas_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'actividades_economicas_data'])->name('actividades_economicas_data');
    Route::post('/add_actividad_economica', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_actividad_economica'])->name('add_actividad_economica');
    Route::post('/edit_actividad_economica', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_actividad_economica'])->name('edit_actividad_economica');
    Route::post('/status_actividad_economica', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_actividad_economica'])->name('status_actividad_economica');

    Route::post('/ciudades_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'ciudades_data'])->name('ciudades_data');
    Route::post('/add_ciudad', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_ciudad'])->name('add_ciudad');
    Route::post('/edit_ciudad', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_ciudad'])->name('edit_ciudad');
    Route::post('/status_ciudad', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_ciudad'])->name('status_ciudad');

    Route::post('/formas_pago_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'formas_pago_data'])->name('formas_pago_data');
    Route::post('/add_forma_pago', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_forma_pago'])->name('add_forma_pago');
    Route::post('/edit_forma_pago', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_forma_pago'])->name('edit_forma_pago');
    Route::post('/status_forma_pago', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'status_forma_pago'])->name('status_forma_pago');

    Route::get('/pucs_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'pucs'])->name('pucs_data');
    Route::get('/pucs_clientes_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'pucs_cliente'])->name('pucs_clientes_data');
    Route::get('/pucs_all_clientes_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'pucs_all_clientes_data'])->name('pucs_all_clientes_data');
    Route::post('/deshabilitar_puc_cliente', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'deshabilitar_puc_cliente'])->name('deshabilitar_puc_cliente');
    Route::post('/habilitar_puc_cliente', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'habilitar_puc_cliente'])->name('habilitar_puc_cliente');
    Route::post('/add_child_puc_cliente', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_child_puc_cliente'])->name('add_child_puc_cliente');
    Route::post('/edit_child_puc_cliente', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'edit_child_puc_cliente'])->name('edit_child_puc_cliente');
    Route::post('/delete_child_puc_cliente', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'delete_child_puc_cliente'])->name('delete_child_puc_cliente');

    Route::post('/add_cuenta_parametrizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_cuenta_parametrizacion'])->name('add_cuenta_parametrizacion');
    Route::post('/get_cuentas_parametrizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'get_cuentas_parametrizacion'])->name('get_cuentas_parametrizacion');
    Route::post('/update_status_cuenta_parametrizacion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'update_status_cuenta_parametrizacion'])->name('update_status_cuenta_parametrizacion');

    Route::post('/impuestos_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'get_impuestos'])->name('impuestos_data');
    Route::post('/retenciones_data', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'get_retenciones'])->name('retenciones_data');

    Route::post('/add_impuesto', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_impuesto'])->name('add_impuesto');
    Route::post('/delete_impuesto', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'delete_impuesto'])->name('delete_impuesto');
    Route::post('/update_uso_impuesto', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'update_uso_impuesto'])->name('update_uso_impuesto');

    Route::post('/add_retencion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'add_retencion'])->name('add_retencion');
    Route::post('/delete_retencion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'delete_retencion'])->name('delete_retencion');
    Route::post('/update_uso_retencion', [App\Http\Controllers\Admin\Contabilidad\ConfiguracionController::class, 'update_uso_retencion'])->name('update_uso_retencion');


    //NOMINA
    Route::get('/config_nomina', [App\Http\Controllers\Admin\Contabilidad\Nomina\NominaController::class, 'config_nomina'])->name('config_nomina');
    Route::post('/update_config_nomina', [App\Http\Controllers\Admin\Contabilidad\Nomina\NominaController::class, 'update_config_nomina'])->name('update_config_nomina');


    // FACTURA COMPRA
    Route::get('/factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'index'])->name('factura_compra');
    Route::get('/pdf_factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'pdf'])->name('pdf_factura_compra');
    Route::post('/info_factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'info'])->name('info_factura_compra');
    Route::post('/add_factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'add'])->name('add_factura_compra');
    Route::post('/edit_factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'edit'])->name('edit_factura_compra');
    Route::post('/filtrar_facturas_compras', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'filtro'])->name('filtrar_facturas_compras');
    Route::post('/anular_factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'anular'])->name('anular_factura_compra');
    Route::post('/favorito_factura_compra', [App\Http\Controllers\Admin\Contabilidad\Compras\FacturaCompraController::class, 'favorito'])->name('favorito_factura_compra');


    // COMPROBANTE EGRESO
    Route::get('/comprobantes_egresos', [App\Http\Controllers\Admin\Contabilidad\Compras\EgresoController::class, 'comprobantes'])->name('comprobantes_egresos');
    Route::get('/comprobante_egreso_pdf', [App\Http\Controllers\Admin\Contabilidad\Compras\EgresoController::class, 'pdf'])->name('comprobante_egreso_pdf');
    Route::get('/comprobante_egreso', [App\Http\Controllers\Admin\Contabilidad\Compras\EgresoController::class, 'index'])->name('comprobante_egreso');
    Route::post('/compras_info_pago', [App\Http\Controllers\Admin\Contabilidad\Compras\EgresoController::class, 'info'])->name('compras_info_pago');
    Route::post('/compras_add_pago', [App\Http\Controllers\Admin\Contabilidad\Compras\EgresoController::class, 'add'])->name('compras_add_pago');


    // FACTURA VENTA
    Route::get('/factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'index'])->name('factura_venta');
    Route::get('/pdf_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'pdf'])->name('pdf_factura_venta');
    Route::post('/info_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'info'])->name('info_factura_venta');
    Route::post('/add_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'add'])->name('add_factura_venta');
    Route::post('/edit_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'edit'])->name('edit_factura_venta');
    Route::post('/filtrar_facturas_ventas', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'filtro'])->name('filtrar_facturas_ventas');
    Route::post('/anular_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'anular'])->name('anular_factura_venta');
    Route::post('/favorito_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'favorito'])->name('favorito_factura_venta');
    Route::post('/visto_bueno_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'visto_bueno'])->name('visto_bueno_factura_venta');
    Route::get('/pdf_factura_venta_export', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'pdf_export'])->name('pdf_factura_venta_export');
    Route::get('/excel_factura_venta', [App\Http\Controllers\Admin\Contabilidad\Ventas\FacturaVentaController::class, 'excel'])->name('excel_factura_venta');

    // RECIBO PAGO
    Route::get('/recibo_pago', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'index'])->name('recibo_pago');
    Route::get('/recibos_pagos', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'egresos'])->name('recibos_pagos');
    Route::get('/recibos_pagos_pdf', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'pdf'])->name('recibos_pagos_pdf');
    Route::post('/recibo_pago_add', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'add'])->name('recibo_pago_add');
    Route::post('/recibos_info_pagos', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'info'])->name('recibos_info_pagos');
    Route::post('/recibos_info_pagos_grupales', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'info_grupales'])->name('recibos_info_pagos_grupales');
    Route::post('/recibos_info_cliente', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'cliente_facturas'])->name('recibos_info_cliente');
    Route::post('/recibo_pago_grupo_add', [App\Http\Controllers\Admin\Contabilidad\Ventas\ReciboPagoController::class, 'pago_grupo_add'])->name('recibo_pago_grupo_add');

    // CALENDARIO
    Route::get('/calendario', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendario');
    Route::post('/schedule_add', [App\Http\Controllers\CalendarController::class, 'add'])->name('schedule_add');
    Route::post('/schedule_update', [App\Http\Controllers\CalendarController::class, 'update'])->name('schedule_update');
    Route::post('/schedule_delete', [App\Http\Controllers\CalendarController::class, 'delete'])->name('schedule_delete');

    // PERMISOS
    Route::get('/permisos', [App\Http\Controllers\Admin\PermisosController::class, 'index'])->name('permisos');
    Route::post('/permisos_empleado', [App\Http\Controllers\Admin\PermisosController::class, 'data'])->name('permisos_empleado');
    Route::post('/permisos_user_update', [App\Http\Controllers\Admin\PermisosController::class, 'update'])->name('permisos_user_update');

    // CATEGORIAS CALENDARIO
    Route::get('/categorias_calendario', [App\Http\Controllers\Admin\CategoriasCalendarioController::class, 'index'])->name('categorias_calendario');
    Route::post('/categorias_calendario_add', [App\Http\Controllers\Admin\CategoriasCalendarioController::class, 'add'])->name('categorias_calendario_add');
    Route::post('/categorias_calendario_update', [App\Http\Controllers\Admin\CategoriasCalendarioController::class, 'update'])->name('categorias_calendario_update');
    Route::post('/categorias_calendario_delete', [App\Http\Controllers\Admin\CategoriasCalendarioController::class, 'delete'])->name('categorias_calendario_delete');

    // GESTION INVENTARIO
    Route::get('/historial_serial', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'historial'])->name('historial_serial');
    Route::post('/data_detalle_producto', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'data'])->name('data_detalle_producto');
    Route::post('/ingreso_inventario', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'ingreso_inventario'])->name('ingreso_inventario');
    Route::post('/reingreso_inventario', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'reingreso_inventario'])->name('reingreso_inventario');
    Route::post('/get_serial', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'get_serial'])->name('get_serial');
    Route::post('/modificar_serial', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'modificar_serial'])->name('modificar_serial');
    Route::post('/get_inventario', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'get_inventario'])->name('get_inventario');
    Route::post('/salidas_inventario', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'salidas_inventario'])->name('salidas_inventario');
    Route::post('/eliminar_serial', [App\Http\Controllers\Admin\Inventario\GestionController::class, 'eliminar_serial'])->name('eliminar_serial');

    // PROSPECTOS PERSONAS
    Route::get('/prospectos_bd', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'index'])->name('prospectos_bd');
    Route::get('/prospectos_list', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'list'])->name('prospectos_list');
    Route::post('/prospectos_bd_add', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'add'])->name('prospectos_bd_add');
    Route::post('/prospectos_bd_edit', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'edit'])->name('prospectos_bd_edit');
    Route::post('/prospectos_bd_view', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'data'])->name('prospectos_bd_view');
    Route::post('/prospectos_bd_delete', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'delete'])->name('prospectos_bd_delete');
    Route::get('/prospectos_bd_plantilla', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'download_plantilla'])->name('prospectos_bd_plantilla');
    Route::get('/prospectos_bd_excel', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'download_excel'])->name('prospectos_bd_excel');
    Route::post('/prospectos_bd_import', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'import_excel'])->name('prospectos_bd_import');
    Route::post('/prospectos_bd_status', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'change_status'])->name('prospectos_bd_status');
    Route::post('/prospectos_bd_fecha', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'change_fecha'])->name('prospectos_bd_fecha');

    // PROSPECTOS EMPRESAS
    Route::get('/prospectos_empresas_bd', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'index'])->name('prospectos_empresas_bd');
    Route::get('/prospectos_empresas_list', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'list'])->name('prospectos_empresas_list');
    Route::post('/prospectos_empresas_bd_add', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'add'])->name('prospectos_empresas_bd_add');
    Route::post('/prospectos_empresas_bd_edit', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'edit'])->name('prospectos_empresas_bd_edit');
    Route::post('/prospectos_empresas_bd_view', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'data'])->name('prospectos_empresas_bd_view');
    Route::post('/prospectos_empresas_bd_delete', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'delete'])->name('prospectos_empresas_bd_delete');
    Route::get('/prospectos_empresas_bd_plantilla', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'download_plantilla'])->name('prospectos_empresas_bd_plantilla');
    Route::get('/prospectos_empresas_bd_excel', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'download_excel'])->name('prospectos_empresas_bd_excel');
    Route::post('/prospectos_empresas_bd_import', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'import_excel'])->name('prospectos_empresas_bd_import');
    Route::post('/prospectos_empresas_status', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'change_status'])->name('prospectos_empresas_status');
    Route::post('/prospectos_empresas_fecha', [App\Http\Controllers\Admin\Comercial\ProspectosEmpresasController::class, 'change_fecha'])->name('prospectos_empresas_fecha');

    Route::get('/history_prospectos', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'history_prospectos'])->name('history_prospectos');
    Route::post('/history_prospectos_add', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'add_observacion'])->name('history_prospectos_add');
    Route::post('/history_prospectos_edit', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'edit_observacion'])->name('history_prospectos_edit');
    Route::post('/history_prospectos_delete', [App\Http\Controllers\Admin\Comercial\ProspectosController::class, 'delete_observacion'])->name('history_prospectos_delete');

    // VIATICOS
    Route::get('/config_viaticos', [App\Http\Controllers\Admin\Viaticos\ConfiguracionController::class, 'index'])->name('config_viaticos');
    Route::post('/config_viaticos_edit', [App\Http\Controllers\Admin\Viaticos\ConfiguracionController::class, 'edit'])->name('config_viaticos_edit');

    Route::get('/visitas_viaticos', [App\Http\Controllers\Admin\Viaticos\VisitasController::class, 'index'])->name('visitas_viaticos');
    Route::post('/visitas_viaticos_add', [App\Http\Controllers\Admin\Viaticos\VisitasController::class, 'add'])->name('visitas_viaticos_add');
    Route::post('/visitas_viaticos_data', [App\Http\Controllers\Admin\Viaticos\VisitasController::class, 'data'])->name('visitas_viaticos_data');
    Route::post('/visitas_viaticos_edit', [App\Http\Controllers\Admin\Viaticos\VisitasController::class, 'edit'])->name('visitas_viaticos_edit');
    Route::post('/visitas_viaticos_completar', [App\Http\Controllers\Admin\Viaticos\VisitasController::class, 'completar'])->name('visitas_viaticos_completar');
    Route::post('/visitas_viaticos_delete', [App\Http\Controllers\Admin\Viaticos\VisitasController::class, 'delete'])->name('visitas_viaticos_delete');

    Route::get('/viaticos', [App\Http\Controllers\Admin\Viaticos\ViaticosController::class, 'index'])->name('viaticos');
    Route::post('/viaticos_add', [App\Http\Controllers\Admin\Viaticos\ViaticosController::class, 'add'])->name('viaticos_add');
    Route::post('/viaticos_data', [App\Http\Controllers\Admin\Viaticos\ViaticosController::class, 'data'])->name('viaticos_data');
    Route::post('/viaticos_edit', [App\Http\Controllers\Admin\Viaticos\ViaticosController::class, 'edit'])->name('viaticos_edit');
    Route::post('/viaticos_delete', [App\Http\Controllers\Admin\Viaticos\ViaticosController::class, 'delete'])->name('viaticos_delete');
});

// RUTAS PARA EL CANVA ASIGNACION DE TAREAS (PROYECTOS)
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

    Route::post('statuses', [App\Http\Controllers\StatusController::class, 'store'])->name('statuses.store');
    Route::put('statuses', [App\Http\Controllers\StatusController::class, 'update'])->name('statuses.update');

    Route::get('gantt',  [App\Http\Controllers\GanttController::class, 'index'])->name('gantt');
    Route::get('data_tasks_gantt',  [App\Http\Controllers\GanttController::class, 'data'])->name('data_tasks_gantt');
    //Route::get('gantt/{project}',  [App\Http\Controllers\GanttController::class, 'show'])->name('gantt.show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('facturas',  [App\Http\Controllers\Admin\Siigo\FacturasController::class, 'get_facturas'])->name('facturas');

    //REPORTES
    Route::get('reporte_compras',  [App\Http\Controllers\Admin\Reportes\ComprasController::class, 'index'])->name('reporte_compras');
    Route::post('reportes_compras_filtro',  [App\Http\Controllers\Admin\Reportes\ComprasController::class, 'filtro'])->name('reportes_compras_filtro');
    Route::get('reporte_ventas',  [App\Http\Controllers\Admin\Reportes\VentasController::class, 'index'])->name('reporte_ventas');
    Route::post('reportes_ventas_filtro',  [App\Http\Controllers\Admin\Reportes\VentasController::class, 'filtro'])->name('reportes_ventas_filtro');
});

Route::get('calendario_asignaciones',  [App\Http\Controllers\Admin\AsignacionesController::class, 'calendario'])->name('calendario_asignaciones');
