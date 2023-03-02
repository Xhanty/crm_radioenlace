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

            $productos = DB::table('productos')
            ->select('id', 'nombre', 'marca', 'modelo')
            ->where('status', 1)
            ->get();

            return view('admin.contabilidad.recibo_pago', compact('productos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
