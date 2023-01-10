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
        try {
            if (!auth()->user()->hasPermissionTo('gestion_repuestos_reparacion')) {
                return redirect()->route('home');
            }
            
            $repuestos = DB::table('repuestos_reparacion')
            ->select('repuestos_reparacion.*', 'productos.nombre', 'productos.cod_interno', 'productos.serial')
            ->join("productos", "repuestos_reparacion.id_producto_reparacion", "=", "productos.id")
            ->get();
            return view('admin.movimientoInv.repuestos', compact('repuestos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function prestamos()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_prestamos')) {
                return redirect()->route('home');
            }

            return view('admin.movimientoInv.prestamos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
