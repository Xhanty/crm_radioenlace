<?php

namespace App\Http\Controllers\Admin\Contabilidad\Comprobantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprobanteContableController extends Controller
{
    public function index()
    {
        /*if (!auth()->user()->hasPermissionTo('contabilidad_factura_venta')) {
            return redirect()->route('home');
        }*/

        $empleados = DB::table('empleados')
            ->select('id', 'nombre')
            ->where('status', 1)
            ->get();

        /*$comprobantes = DB::table('comprobantes_contables')
            ->join('empleados', 'comprobantes_contables.created_by', '=', 'empleados.id')
            ->select('comprobantes_contables.*', 'empleados.nombre AS empleado')
            ->get();*/

        $clientes = DB::table('cliente')
            ->select('id', 'razon_social', 'nit')
            ->where('estado', 1)
            ->get();

        return view('admin.contabilidad.comprobantes', compact('empleados', 'clientes'));
    }
}
