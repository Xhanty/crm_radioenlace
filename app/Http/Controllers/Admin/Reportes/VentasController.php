<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('reportes_ventas')) {
                return redirect()->route('home');
            }*/

            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'empleados.nombre as empleado', 'empleados.codigo_empleado', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.razon_social')
                ->join('empleados', 'factura_venta.created_by', '=', 'empleados.id')
                ->join('cliente', 'factura_venta.cliente_id', '=', 'cliente.id')
                ->whereYear('factura_venta.created_at', date('Y'))
                ->get();

            $empleados = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', '1')
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', '1')
                ->get();

            return view('admin.reportes.ventas', compact('facturas', 'empleados', 'clientes'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function filtro(Request $request)
    {
        try {
            $factura = $request->factura;
            $cliente = $request->cliente;
            $empleado = $request->empleado;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'empleados.nombre as empleado', 'empleados.codigo_empleado', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.razon_social')
                ->join('empleados', 'factura_venta.created_by', '=', 'empleados.id')
                ->join('cliente', 'factura_venta.cliente_id', '=', 'cliente.id')
                ->where(function ($query) use ($factura) {
                    if ($factura != '') {
                        $query->where('factura_venta.numero', $factura);
                    }
                })
                ->where(function ($query) use ($cliente) {
                    if ($cliente != '') {
                        $query->where('factura_venta.cliente_id', $cliente);
                    }
                })
                ->where(function ($query) use ($empleado) {
                    if ($empleado != '') {
                        $query->where('factura_venta.created_by', $empleado);
                    }
                })
                ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                    if ($fecha_inicio != '' && $fecha_fin != '') {
                        $query->whereBetween('factura_venta.created_at', [$fecha_inicio, $fecha_fin]);
                    }
                })
                ->get();

            return response()->json([
                "info" => 1,
                "data" => $facturas
            ]);
        } catch (Exception $ex) {
            return response()->json([
                "info" => 0,
                "message" => $ex->getMessage()
            ]);
        }
    }
}
