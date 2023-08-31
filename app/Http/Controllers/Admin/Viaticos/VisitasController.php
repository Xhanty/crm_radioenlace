<?php

namespace App\Http\Controllers\Admin\Viaticos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitasController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('visitas_viaticos')) {
                return redirect()->route('home');
            }*/
            $clientes = DB::table('cliente')->where('estado', 1)->get();
            $empleados = DB::table('empleados')->where('status', 1)->orderBy("nombre")->get();
            $vehiculos = DB::table('vehiculos')->where('estado', 1)->orderBy("placa")->get();

            $visitas_pendientes = DB::table('visitas_viaticos')
                ->select('visitas_viaticos.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'visitas_viaticos.empleado_id')
                ->where('visitas_viaticos.status', 0)
                ->get();
            $visitas_completadas = DB::table('visitas_viaticos')
                ->select('visitas_viaticos.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'visitas_viaticos.empleado_id')
                ->where('visitas_viaticos.status', 1)
                ->get();

            return view('admin.viaticos.visitas', compact('visitas_pendientes', 'visitas_completadas', 'clientes', 'empleados', 'vehiculos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
