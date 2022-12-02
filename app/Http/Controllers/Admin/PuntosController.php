<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PuntosController extends Controller
{
    public function index()
    {
        try {
            $puntos_pendientes = DB::table('puntos')
                ->join('empleados', 'empleados.id', '=', 'puntos.created_by')
                ->select('puntos.*', 'empleados.nombre')
                ->where('puntos.id_empleado', session('user'))
                ->where('puntos.status', 0)
                ->get();

            $puntos_cobrados = DB::table('puntos')
                ->join('empleados', 'empleados.id', '=', 'puntos.created_by')
                ->select('puntos.*', 'empleados.nombre')
                ->where('puntos.id_empleado', session('user'))
                ->where('puntos.status', 1)
                ->get();
                
            return view('admin.puntos.mis_puntos', compact('puntos_pendientes', 'puntos_cobrados'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function gestionar_puntos()
    {
        try {
            $puntos_pendientes = DB::table('puntos')
                ->join('empleados', 'empleados.id', '=', 'puntos.created_by')
                ->select('puntos.*', 'empleados.nombre')
                ->where('puntos.id_empleado', session('user'))
                ->where('puntos.status', 0)
                ->get();

            $puntos_cobrados = DB::table('puntos')
                ->join('empleados', 'empleados.id', '=', 'puntos.created_by')
                ->select('puntos.*', 'empleados.nombre')
                ->where('puntos.id_empleado', session('user'))
                ->where('puntos.status', 1)
                ->get();

            return view('admin.puntos.gestionar_puntos', compact('puntos_pendientes', 'puntos_cobrados'));
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
