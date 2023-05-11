<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReparacionesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_reparaciones')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')->where('estado', 1)->get();
            $empleados = DB::table('empleados')->where('status', 1)->get();
            $categorias = DB::table('categorias_reparaciones')->get();
            $accesorios = DB::table('accesorios_reparaciones')->get();

            return view('admin.reparaciones.reparaciones', compact('categorias', 'accesorios', 'clientes', 'empleados'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
