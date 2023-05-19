<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MisReparacionesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_reparaciones_asignadas')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')->where('estado', 1)->get();
            $empleados = DB::table('empleados')->where('status', 1)->orderBy("nombre")->get();
            $categorias = DB::table('categorias_reparaciones')->get();
            $accesorios = DB::table('accesorios_reparaciones')->get();
            $pendientes = DB::table('reparaciones')
                ->select('reparaciones.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado', DB::raw('count(detalle_reparaciones.id) as cantidad'))
                ->join('cliente', 'cliente.id', '=', 'reparaciones.cliente_id')
                ->leftJoin('detalle_reparaciones', 'detalle_reparaciones.reparacion_id', '=', 'reparaciones.id')
                ->leftJoin('empleados', 'empleados.id', '=', 'reparaciones.tecnico_id')
                ->where('reparaciones.status', 0)
                ->where('reparaciones.tecnico_id', auth()->user()->id)
                ->groupBy(
                    'reparaciones.id',
                    'reparaciones.tecnico_id',
                    'reparaciones.status',
                    'reparaciones.aprobado',
                    'reparaciones.fecha_terminado',
                    'reparaciones.token',
                    'reparaciones.cliente_id',
                    'reparaciones.correos',
                    'reparaciones.created_by',
                    'reparaciones.created_at',
                    'cliente.razon_social',
                    'cliente.nit',
                    'empleados.nombre'
                )
                ->get();
            $finalizadas
                = DB::table('reparaciones')
                ->select('reparaciones.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado', DB::raw('count(detalle_reparaciones.id) as cantidad'))
                ->join('cliente', 'cliente.id', '=', 'reparaciones.cliente_id')
                ->leftJoin('detalle_reparaciones', 'detalle_reparaciones.reparacion_id', '=', 'reparaciones.id')
                ->leftJoin('empleados', 'empleados.id', '=', 'reparaciones.tecnico_id')
                ->where('reparaciones.status', 1)
                ->where('reparaciones.tecnico_id', auth()->user()->id)
                ->groupBy(
                    'reparaciones.id',
                    'reparaciones.tecnico_id',
                    'reparaciones.status',
                    'reparaciones.aprobado',
                    'reparaciones.fecha_terminado',
                    'reparaciones.token',
                    'reparaciones.cliente_id',
                    'reparaciones.correos',
                    'reparaciones.created_by',
                    'reparaciones.created_at',
                    'cliente.razon_social',
                    'cliente.nit',
                    'empleados.nombre'
                )
                ->get();

            return view('admin.reparaciones.mis_reparaciones', compact('pendientes', 'finalizadas', 'clientes', 'empleados', 'categorias', 'accesorios'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
