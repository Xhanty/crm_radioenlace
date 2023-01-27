<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_cotizaciones')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social')
                ->where('estado', 1)
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre')
                ->where('status', 1)
                ->get();

            return view('admin.comercial.cotizaciones', compact('clientes', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
