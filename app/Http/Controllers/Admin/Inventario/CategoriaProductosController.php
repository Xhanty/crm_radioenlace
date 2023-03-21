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

            foreach ($subcategorias as $key => $value) {
                $total_productos = DB::table('productos')->where('sub_categoria', $value->id)->count();
                $subcategorias[$key]->productos = $total_productos;
            }
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
                $old = DB::table('subcategorias_productos')->where('categoria', $id)->get();
                $ids = [];

                foreach ($old as $key => $value) {
                    $ids[] = $value->id;
                }

                foreach ($subcategorias as $key => $value) {
                    if (isset($value['id'])) {
                        $ids = array_diff($ids, [$value['id']]);
                    }
                }

                DB::table('subcategorias_productos')->whereIn('id', $ids)->delete();

                foreach ($subcategorias as $key => $value) {
                    if ($value['id'] > 0) {
                        DB::table('subcategorias_productos')->where('id', $value['id'])->update([
                            'nombre' => $value['nombre']
                        ]);
                    } else {
                        DB::table('subcategorias_productos')->insert([
                            'nombre' => $value['nombre'],
                            'categoria' => $id,
                            'created_by' => session('user'),
                            'fecha' => date('Y-m-d')
                        ]);
                    }
                }
            }

            return response()->json(['info' => 1, 'success' => 'Categoría editada correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al editar la categoría.']);
        }
    }
}
