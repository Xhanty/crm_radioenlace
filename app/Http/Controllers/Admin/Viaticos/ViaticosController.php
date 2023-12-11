<?php

namespace App\Http\Controllers\Admin\Viaticos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViaticosController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('visitas_viaticos')) {
                return redirect()->route('home');
            }*/

            $visitas_pendientes = DB::table('visitas_viaticos')
                ->select('visitas_viaticos.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'visitas_viaticos.empleado_id')
                ->where('visitas_viaticos.status', 0)
                ->get();

            return view('admin.viaticos.viaticos', compact('visitas_pendientes'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
