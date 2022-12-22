<?php

namespace App\Http\Controllers\Admin\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class CategoriaProductosController extends Controller
{
    public function index()
    {
        try {
            $categorias = DB::table('categorias')
            ->select("categorias.*", "empleados.nombre as creador", DB::raw("count(productos.id) as total_productos"))
            ->join("empleados", "empleados.id", "=", "categorias.created_by")
            ->leftJoin("productos", "productos.id_categoria", "=", "categorias.id")
            ->groupBy("categorias.id", "categorias.nombre", "categorias.created_by", "categorias.fecha", "creador")
            ->get();
            return view('admin.inventario.categorias', compact('categorias'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function categorias_create(Request $request)
    {
        try {
            $nombre = $request->nombre;
            $categoria = DB::table('categorias')->insert([
                'nombre' => $nombre,
                'created_by' => session('user'),
                'fecha' => date('Y-m-d')
            ]);
            return response()->json(['info' => 1, 'success' => 'Categoría creada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al crear la categoría.']);
            return $ex;
        }
    }

    public function categorias_delete(Request $request)
    {
        try {
            $id = $request->id;
            $categoria = DB::table('categorias')->where('id', $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoría eliminada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoría.']);
            return $ex;
        }
    }
}
