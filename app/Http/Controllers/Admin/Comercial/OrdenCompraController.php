<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenCompraController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_orden_compra')) {
                return redirect()->route('home');
            }

            $ordenes_pendientes = DB::table("ordenes_compra")
            ->select("ordenes_compra.id", "ordenes_compra.descripcion", "ordenes_compra.fecha", "cliente.razon_social as nombre_cliente", "empleados.nombre as nombre_empleado", DB::raw("SUM(productos_orden_compra.cantidad) as cantidad"))
            ->join("cliente", "ordenes_compra.id_cliente", "=", "cliente.id")
            ->join("empleados", "ordenes_compra.created_by", "=", "empleados.id")
            ->join("productos_orden_compra", "ordenes_compra.id", "=", "productos_orden_compra.id_orden_compra")
            ->where("ordenes_compra.status", 0)
            ->groupBy("ordenes_compra.id", "ordenes_compra.descripcion", "ordenes_compra.fecha", "cliente.razon_social", "empleados.nombre")
            ->get();

            $ordenes_completadas = DB::table("ordenes_compra")
            ->select("ordenes_compra.id", "ordenes_compra.descripcion", "ordenes_compra.fecha", "cliente.razon_social as nombre_cliente", "empleados.nombre as nombre_empleado", DB::raw("SUM(productos_orden_compra.cantidad) as cantidad"))
            ->join("cliente", "ordenes_compra.id_cliente", "=", "cliente.id")
            ->join("empleados", "ordenes_compra.created_by", "=", "empleados.id")
            ->join("productos_orden_compra", "ordenes_compra.id", "=", "productos_orden_compra.id_orden_compra")
            ->where("ordenes_compra.status", 1)
            ->groupBy("ordenes_compra.id", "ordenes_compra.descripcion", "ordenes_compra.fecha", "cliente.razon_social", "empleados.nombre")
            ->get();

            return view('admin.comercial.orden_compra', compact('ordenes_pendientes', 'ordenes_completadas'));
        } catch (Exception $ex) {
            return $ex;
            return view('errors.500');
        }
    }
}
