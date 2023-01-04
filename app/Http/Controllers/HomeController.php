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
            $asignaciones_g_pendientes = DB::table('asignaciones')
                ->where('status', 0)
                ->where('id_cliente', '!=', null)
                ->where('id_empleado', session('user'))
                ->count();
            $asignaciones_g_completadas = DB::table('asignaciones')
                ->where('status', 1)
                ->where('id_cliente', '!=', null)
                ->where('id_empleado', session('user'))
                ->count();

            $asignaciones_p_pendientes = DB::table('asignaciones')
                ->where('status', 0)
                ->whereNull('id_cliente')
                ->where('id_empleado', session('user'))
                ->count();
            $asignaciones_p_completadas = DB::table('asignaciones')
                ->where('status', 1)
                ->whereNull('id_cliente')
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

            $asignaciones_proyectos = DB::table("asignaciones")
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "ASC")
                ->where('asignaciones.status', 0)
                ->whereNull('asignaciones.id_cliente')
                ->limit(5)
                ->get();

            $asignaciones_generales = DB::table("asignaciones")
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "ASC")
                ->where('asignaciones.status', 0)
                ->where('asignaciones.id_cliente', '!=', null)
                ->limit(5)
                ->get();

            return view('home', compact('puntos_pendientes', 'puntos_cobrados', 'reparaciones_pendientes', 'reparaciones_completadas', 'asignaciones_proyectos', 'asignaciones_generales', 'asignaciones_g_pendientes', 'asignaciones_g_completadas', 'asignaciones_p_pendientes', 'asignaciones_p_completadas'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
