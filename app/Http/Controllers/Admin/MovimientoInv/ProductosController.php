<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function productos_baja()
    {
        return view('admin.movimientoInv.productos_baja');
    }

    public function productos_instalados()
    {
        return view('admin.movimientoInv.productos_instalados');
    }

    public function productos_asignados()
    {
        return view('admin.movimientoInv.productos_asignados');
    }
}
