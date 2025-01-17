<?php

namespace App\Http\Controllers\Admin\Contabilidad\Compras;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaCreditoController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_nota_credito')) {
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

            $clientes = DB::table('cliente')
                ->select('id', 'nit', 'razon_social')
                ->where('estado', 1)
                ->get();

            $usuarios = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', 1)
                ->get();

            return view('admin.contabilidad.compras.nota_credito', compact('productos', 'formas_pago', 'clientes', 'usuarios'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
