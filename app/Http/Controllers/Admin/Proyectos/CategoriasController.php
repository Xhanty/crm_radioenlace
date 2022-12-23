<?php

namespace App\Http\Controllers\Admin\Proyectos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        try {
            $categorias = DB::table('categorias_proyectos')
                ->select('categorias_proyectos.*', 'empleados.nombre as nombre_empleado', DB::raw('count(proyecto.id) as cantidad_proyectos'))
                ->join("empleados", "categorias_proyectos.created_by", "=", "empleados.id")
                ->leftJoin("proyecto", "categorias_proyectos.id", "=", "proyecto.id_categoria")
                ->groupBy('categorias_proyectos.id', 'categorias_proyectos.nombre', 'categorias_proyectos.created_by', 'empleados.nombre')
                ->orderBy('cantidad_proyectos', 'desc')
                ->get();
            return view('admin.proyectos.categorias', compact('categorias'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function add(Request $request)
    {
        try {
            DB::table('categorias_proyectos')->insert([
                'nombre' => $request->nombre,
                'created_by' => session('user')
            ]);
            return response()->json(['info' => 1, 'success' => 'Categoría creada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear la categoría']);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::table('categorias_proyectos')->where('id', $request->id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoría eliminada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoría']);
        }
    }
}
