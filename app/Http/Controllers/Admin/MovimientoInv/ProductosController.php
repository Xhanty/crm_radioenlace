<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function productos_baja()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_productos_baja')) {
                return redirect()->route('home');
            }

            //$productos = 
            return view('admin.movimientoInv.productos_baja');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function productos_instalados()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_productos_instalados')) {
                return redirect()->route('home');
            }

            return view('admin.movimientoInv.productos_instalados');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function productos_asignados()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_productos_asignados')) {
                return redirect()->route('home');
            }

            return view('admin.movimientoInv.productos_asignados');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
