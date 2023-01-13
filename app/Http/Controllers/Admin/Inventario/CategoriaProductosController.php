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
            if (!auth()->user()->hasPermissionTo('gestion_categorias_inventario')) {
                return redirect()->route('home');
            }

            $categorias = DB::table('categorias_productos')
                ->select("categorias_productos.*", "empleados.nombre as creador", DB::raw("count(subcategorias_productos.id) as total_subs"))
                ->join("empleados", "empleados.id", "=", "categorias_productos.created_by")
                ->leftJoin("productos", "productos.categoria", "=", "categorias_productos.id")
                ->leftJoin("subcategorias_productos", "subcategorias_productos.categoria", "=", "categorias_productos.id")
                ->groupBy("categorias_productos.id", "categorias_productos.nombre", "categorias_productos.created_by", "categorias_productos.fecha", "creador")
                ->get();

            foreach ($categorias as $key => $value) {
                $total_productos = DB::table('productos')->where('categoria', $value->id)->count();
                $categorias[$key]->total_productos = $total_productos;
            }

            return view('admin.inventario.categorias', compact('categorias'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function categorias_create(Request $request)
    {
        try {
            $nombre = $request->nombre;
            $subcategorias = $request->subcategorias;
            DB::table('categorias_productos')->insert([
                'nombre' => $nombre,
                'created_by' => session('user'),
                'fecha' => date('Y-m-d')
            ]);

            $categoria = DB::table('categorias_productos')->where('nombre', $nombre)->first();

            foreach ($subcategorias as $subcategoria) {
                DB::table('subcategorias_productos')->insert([
                    'nombre' => $subcategoria,
                    'categoria' => $categoria->id,
                    'created_by' => session('user'),
                    'fecha' => date('Y-m-d')
                ]);
            }

            return response()->json(['info' => 1, 'success' => 'Categoría creada correctamente']);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0, 'error' => 'Error al crear la categoría.']);
        }
    }

    public function categorias_delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::table('subcategorias_productos')->where('categoria', $id)->delete();
            DB::table('categorias_productos')->where('id', $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoría eliminada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoría.']);
            return $ex;
        }
    }

    public function subcategorias_get(Request $request)
    {
        try {
            $id = $request->id;
            $subcategorias = DB::table('subcategorias_productos')->where('categoria', $id)->get();
            return response()->json(['info' => 1, 'data' => $subcategorias]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al obtener las subcategorías.']);
        }
    }

    public function categorias_edit(Request $request)
    {
        try {
            $id = $request->id;
            $nombre = $request->nombre;
            $subcategorias = $request->subcategorias;

            DB::table('categorias_productos')->where('id', $id)->update([
                'nombre' => $nombre
            ]);

            if ($subcategorias) {
                foreach ($subcategorias as $subcategoria) {
                    DB::table('subcategorias_productos')->insert([
                        'nombre' => $subcategoria,
                        'categoria' => $id,
                        'created_by' => session('user'),
                        'fecha' => date('Y-m-d')
                    ]);
                }
            }

            return response()->json(['info' => 1, 'success' => 'Categoría editada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al editar la categoría.']);
        }
    }
}
