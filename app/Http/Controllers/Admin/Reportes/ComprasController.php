<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    public function index()
    {
        try {

            /*if (!auth()->user()->hasPermissionTo('reportes_compras')) {
                return redirect()->route('home');
            }*/

            $facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'empleados.nombre as empleado', 'empleados.codigo_empleado', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.razon_social')
                ->join('empleados', 'factura_compra.created_by', '=', 'empleados.id')
                ->join('proveedores', 'factura_compra.proveedor_id', '=', 'proveedores.id')
                ->whereYear('factura_compra.fecha_elaboracion', date('Y'))
                ->whereMonth('factura_compra.fecha_elaboracion', date('m'))
                ->orderByRaw('CAST(REPLACE(factura_compra.valor_total, ".", "") AS DECIMAL(10,2)) DESC')
                ->get();

            $empleados = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', '1')
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', '1')
                ->get();

            return view('admin.reportes.compras', compact('facturas', 'empleados', 'proveedores'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function filtro(Request $request)
    {
        try {
            $factura = $request->factura;
            $proveedor = $request->proveedor;
            $empleado = $request->empleado;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            $facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'empleados.nombre as empleado', 'empleados.codigo_empleado', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.razon_social')
                ->join('empleados', 'factura_compra.created_by', '=', 'empleados.id')
                ->join('proveedores', 'factura_compra.proveedor_id', '=', 'proveedores.id')
                ->where(function ($query) use ($factura) {
                    if ($factura != '') {
                        $query->where('factura_compra.numero', $factura);
                    }
                })
                ->where(function ($query) use ($proveedor) {
                    if ($proveedor != '') {
                        $query->where('factura_compra.proveedor_id', $proveedor);
                    }
                })
                ->where(function ($query) use ($empleado) {
                    if ($empleado != '') {
                        $query->where('factura_compra.created_by', $empleado);
                    }
                })
                ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                    if ($fecha_inicio != '' && $fecha_fin != '') {
                        $query->whereBetween('factura_compra.fecha_elaboracion', [$fecha_inicio, $fecha_fin]);
                    }
                })
                ->orderByRaw('CAST(REPLACE(factura_compra.valor_total, ".", "") AS DECIMAL(10,2)) DESC')
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
