<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    public function index()
    {
        try {

            /*if (!auth()->user()->hasPermissionTo('reportes_compras')) {
                return redirect()->route('home');
            }*/

            $empleados = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', '1')
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', '1')
                ->get();

            return view('admin.reportes.compras', compact('empleados', 'proveedores'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
