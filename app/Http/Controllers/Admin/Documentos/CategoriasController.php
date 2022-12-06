<?php

namespace App\Http\Controllers\Admin\Documentos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        try {
            $categorias = DB::table('categorias_archivos')
            ->select('categorias_archivos.*', 'empleados.nombre as creador')
            ->join("empleados", "categorias_archivos.created_by", "=", "empleados.id")
            ->get();
            return view('admin.documentos.categorias', compact('categorias'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function add(Request $request)
    {
        try {
            $nombre = $request->nombre;
            $categoria = DB::table('categorias_archivos')->insert([
                'nombre' => $nombre,
                'created_by' => session('user'),
                'fecha' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['info' => 1, 'success' => 'Categoría creada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al crear la categoría.']);
            return $ex;
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            $categoria = DB::table('categorias_archivos')->where('id', $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoría eliminada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoría.']);
            return $ex;
        }
    }
}
