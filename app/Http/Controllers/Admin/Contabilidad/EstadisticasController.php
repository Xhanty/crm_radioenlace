<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function estadistica_proveedores()
    {
        try {
            if (!auth()->user()->hasPermissionTo('estadistica_proveedores')) {
                return redirect()->route('home');
            }

            $proveedores = DB::table("proveedores")->where("estado", 1)->get();
            return view('admin.contabilidad.estadistica_proveedores', compact('proveedores'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function estadistica_compra()
    {
        try {
            if (!auth()->user()->hasPermissionTo('estadisticas_orden_compra')) {
                return redirect()->route('home');
            }

            $proveedores = DB::table("proveedores")->where("estado", 1)->get();
            $productos = DB::table("productos")->where("status", 1)->get();
            return view('admin.contabilidad.estadistica_compra', compact('proveedores', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function estadistica_ventas()
    {
        try {
            if (!auth()->user()->hasPermissionTo('estadisticas_ventas')) {
                return redirect()->route('home');
            }

            $proveedores = DB::table("proveedores")->where("estado", 1)->get();
            $productos = DB::table("productos")->where("status", 1)->get();
            return view('admin.contabilidad.estadistica_ventas', compact('proveedores', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
