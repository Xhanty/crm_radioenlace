<?php

namespace App\Http\Controllers\Admin\Proyectos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public function index()
    {
        try {
            $proyectos_pendientes = DB::table('proyecto')
                ->select("proyecto.*", "categorias_proyectos.nombre as categoria", "empleados.nombre as empleado", "cliente.razon_social as cliente")
                ->leftJoin("categorias_proyectos", "proyecto.id_categoria", "=", "categorias_proyectos.id")
                ->leftJoin("empleados", "proyecto.created_by", "=", "empleados.id")
                ->leftJoin("cliente", "proyecto.id_cliente", "=", "cliente.id")
                ->where('visto_bueno', 0)
                ->get();

            $proyectos_aprobados = DB::table('proyecto')
                ->select("proyecto.*", "categorias_proyectos.nombre as categoria", "empleados.nombre as empleado", "cliente.razon_social as cliente")
                ->leftJoin("categorias_proyectos", "proyecto.id_categoria", "=", "categorias_proyectos.id")
                ->leftJoin("empleados", "proyecto.created_by", "=", "empleados.id")
                ->leftJoin("cliente", "proyecto.id_cliente", "=", "cliente.id")
                ->where('visto_bueno', 1)
                ->get();
            return view('admin.proyectos.proyectos', compact('proyectos_pendientes', 'proyectos_aprobados'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
