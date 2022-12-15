<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepuestosController extends Controller
{
    public function index()
    {
        $repuestos = DB::table('repuestos_reparacion')
        ->select('repuestos_reparacion.*', 'productos.nombre', 'productos.cod_interno', 'productos.serial')
        ->join("productos", "repuestos_reparacion.id_producto_reparacion", "=", "productos.id")
        ->get();
        return view('admin.movimientoInv.repuestos', compact('repuestos'));
    }

    public function prestamos()
    {
        return view('admin.movimientoInv.prestamos');
    }
}
