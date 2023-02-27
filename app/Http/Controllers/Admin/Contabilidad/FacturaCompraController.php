<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FacturaCompraController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_facturacion')) {
                return redirect()->route('home');
            }

            return view('admin.contabilidad.factura_compra');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
