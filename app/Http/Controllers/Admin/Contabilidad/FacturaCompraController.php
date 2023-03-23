<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class FacturaCompraController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_factura_compra')) {
                return redirect()->route('home');
            }

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $centros_costos = DB::table('centros_costo')
                ->select('id', 'nombre', 'code')
                ->where('status', 1)
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            $cuentas_gastos = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            return view('admin.contabilidad.factura_compra', compact('productos', 'formas_pago', 'centros_costos', 'proveedores', 'cuentas_gastos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function pdf(Request $request) {
        $id = $request->get('token');

        if (!$id || $id < 1) {
            return view('errors.404');
        }

        $factura = [];

        /*if (!$factura) {
            return view('errors.404');
        }*/

        //$pdf = PDF::loadView('admin.contabilidad.pdf.factura_compra', compact('factura'));

        //return $pdf->stream('Factura Compra.pdf');

        return view('admin.contabilidad.pdf.factura_compra', compact('factura'));
    }
}
