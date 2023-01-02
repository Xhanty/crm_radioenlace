<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $asignaciones_pendientes = DB::table('asignaciones')
                ->where('status', 0)
                ->where('id_empleado', session('user'))
                ->count();
            $asignaciones_completadas = DB::table('asignaciones')
                ->where('status', 1)
                ->where('id_empleado', session('user'))
                ->count();


            $puntos_pendientes = DB::table('puntos')
                ->where('status', 0)
                ->where('id_empleado', session('user'))
                ->sum("cantidad");
            $puntos_cobrados = DB::table('puntos')
                ->where('status', 1)
                ->where('id_empleado', session('user'))
                ->sum("cantidad");


            $reparaciones_pendientes = DB::table('reparaciones')
                ->where('status', 0)
                ->where('id_empleado_repara', session('user'))
                ->count();
            $reparaciones_completadas = DB::table('reparaciones')
                ->where('status', 1)
                ->where('id_empleado_repara', session('user'))
                ->count();


            $productos_asignados = DB::table('productos_asignados')
                ->where('status', 0)
                ->where('id_empleado', session('user'))
                ->count();
            $productos_devueltos = DB::table('productos_asignados')
                ->where('status', 1)
                ->where('id_empleado', session('user'))
                ->count();

            $asignaciones = DB::table("asignaciones")
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "desc")
                ->where('asignaciones.status', 0)
                ->whereNull('asignaciones.id_cliente')
                ->limit(5)
                ->get();
                
            return view('home', compact('asignaciones_pendientes', 'asignaciones_completadas', 'puntos_pendientes', 'puntos_cobrados', 'reparaciones_pendientes', 'reparaciones_completadas', 'productos_asignados', 'productos_devueltos', 'asignaciones'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
