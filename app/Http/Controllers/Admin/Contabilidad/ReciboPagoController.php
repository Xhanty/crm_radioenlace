<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReciboPagoController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_recibo_pago')) {
                return redirect()->route('home');
            }

            $centros_costos = DB::table('centros_costo')
                ->select('id', 'nombre', 'code')
                ->where('status', 1)
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            return view('admin.contabilidad.recibo_pago', compact('centros_costos', 'proveedores'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
