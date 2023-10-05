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

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'empleados.nombre as empleado', 'empleados.codigo_empleado', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.razon_social')
                ->join('empleados', 'factura_venta.created_by', '=', 'empleados.id')
                ->join('cliente', 'factura_venta.cliente_id', '=', 'cliente.id')
                ->whereYear('factura_venta.created_at', date('Y'))
                ->orderByRaw('CAST(REPLACE(factura_venta.valor_total, ".", "") AS DECIMAL(10,2)) DESC')
                ->get();

            $empleados = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', '1')
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', '1')
                ->get();

            return view('admin.reportes.ventas', compact('facturas', 'empleados', 'clientes', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function filtro(Request $request)
    {
        try {
            $cliente = $request->cliente;
            $estado = $request->estado;
            $producto = $request->producto;
            $empleado = $request->empleado;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'empleados.nombre as empleado', 'empleados.codigo_empleado', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.razon_social')
                ->join('empleados', 'factura_venta.created_by', '=', 'empleados.id')
                ->join('cliente', 'factura_venta.cliente_id', '=', 'cliente.id')
                ->where(function ($query) use ($cliente) {
                    if ($cliente != '') {
                        $query->where('factura_venta.cliente_id', $cliente);
                    }
                })
                ->where(function ($query) use ($estado) {
                    if ($estado != '') {
                        $query->where('factura_venta.status', $estado);
                    }
                })
                ->where(function ($query) use ($producto) {
                    if ($producto != '') {
                        $query->whereIn('factura_venta.id', function($subquery) use ($producto) {
                            $subquery->select('factura_id')
                                ->from('detalle_factura_venta')
                                ->where('producto', $producto);
                        });
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
                ->orderByRaw('CAST(REPLACE(factura_venta.valor_total, ".", "") AS DECIMAL(10,2)) DESC')
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
