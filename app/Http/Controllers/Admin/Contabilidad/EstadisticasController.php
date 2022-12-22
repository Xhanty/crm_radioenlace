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
            return view('admin.contabilidad.estadistica_proveedores');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function estadistica_compra()
    {
        try {
            return view('admin.contabilidad.estadistica_compra');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function estadistica_ventas()
    {
        try {
            return view('admin.contabilidad.estadistica_ventas');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
