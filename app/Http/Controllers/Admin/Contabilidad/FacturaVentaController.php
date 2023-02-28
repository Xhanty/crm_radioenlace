<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaVentaController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_facturacion')) {
                return redirect()->route('home');
            }

            $productos = DB::table('productos')
            ->select('id', 'nombre', 'marca', 'modelo')
            ->where('status', 1)
            ->get();

            $formas_pago = DB::table('formas_pago')
            ->select('id', 'nombre')
            ->where('status', 1)
            ->get();

            return view('admin.contabilidad.factura_venta', compact('productos', 'formas_pago'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
