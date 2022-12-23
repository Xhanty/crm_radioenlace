<?php

namespace App\Http\Controllers\Admin\SeguimientoCliente;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        try {
            $categorias = DB::table('categorias_seguimiento_clientes')
            ->select('categorias_seguimiento_clientes.*', 'empleados.nombre as nombre_empleado', DB::raw('count(seguimiento_clientes.id) as cantidad_seguimiento_cliente'))
            ->join("empleados", "categorias_seguimiento_clientes.created_by", "=", "empleados.id")
            ->leftJoin("seguimiento_clientes", "categorias_seguimiento_clientes.id", "=", "seguimiento_clientes.id_categoria")
            ->groupBy('categorias_seguimiento_clientes.id', 'categorias_seguimiento_clientes.nombre', 'categorias_seguimiento_clientes.created_by', 'empleados.nombre')
            ->orderBy('cantidad_seguimiento_cliente', 'desc')
            ->get();
            return view('admin.seguimiento_cliente.categorias', compact('categorias'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function add(Request $request)
    {
        try {
            DB::table('categorias_seguimiento_clientes')->insert([
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
            DB::table('categorias_seguimiento_clientes')->where('id', $request->id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoría eliminada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoría']);
        }
    }
}
