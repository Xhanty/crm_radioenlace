<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepuestosController extends Controller
{
    public function repuestos_reparacion()
    {
        $repuestos = DB::table('repuestos_reparacion')
        ->select('repuestos_reparacion.*', 'productos.nombre', 'productos.cod_interno', 'productos.serial')
        ->join("productos", "repuestos_reparacion.id_producto_reparacion", "=", "productos.id")
        ->get();
        return view('admin.movimientoInv.repuestos', compact('repuestos'));
    }

    public function productos_baja()
    {
        return view('admin.movimientoInv.productos_baja');
    }

    public function productos_instalados()
    {
        return view('admin.movimientoInv.productos_instalados');
    }

    public function ventas()
    {
        return view('admin.movimientoInv.ventas');
    }

    public function prestamos()
    {
        return view('admin.movimientoInv.prestamos');
    }

    public function alquileres()
    {
        return view('admin.movimientoInv.alquileres');
    }

    public function productos_asignados()
    {
        return view('admin.movimientoInv.productos_asignados');
    }
}
