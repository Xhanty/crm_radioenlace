<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Exception;

class InventarioController extends Controller
{
    public function index()
    {
        try {
            $categorias = DB::table('categorias')->get();
            return view('admin.inventario.inventario', compact('categorias'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function productos_create(Request $request)
    {
        try {
            DB::beginTransaction();
            $image = $request->file('foto');
            $new_name = rand() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/productos'), $new_name);

            DB::table("productos")->insert([
                'id_categoria' => $request->categoria ? $request->categoria : 1,
                'cod_producto' => $request->codigo ? $request->codigo : "",
                'cod_interno' => "",
                'nombre' => $request->nombre ? $request->nombre : "",
                'marca' => $request->marca ? $request->marca : "",
                'modelo' => $request->modelo ? $request->modelo : "",
                'serial' => "",
                'imagen' => $new_name,
                'observaciones' => $request->observaciones ? $request->observaciones : "",
                'fecha_creacion' => date('Y-m-d'),
                'status' => 1,
                'created_by' => session('user')
            ]);

            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Producto creado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al crear el producto.']);
            return $ex;
        }
    }

    public function productos_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $new_name = rand() . rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/productos'), $new_name);

                DB::table("productos")->where('id', $request->id)->update([
                    'id_categoria' => $request->categoria ? $request->categoria : 1,
                    'cod_producto' => $request->codigo ? $request->codigo : "",
                    'nombre' => $request->nombre ? $request->nombre : "",
                    'marca' => $request->marca ? $request->marca : "",
                    'modelo' => $request->modelo ? $request->modelo : "",
                    'imagen' => $new_name,
                    'observaciones' => $request->observaciones ? $request->observaciones : "",
                ]);
            } else {
                DB::table("productos")->where('id', $request->id)->update([
                    'id_categoria' => $request->categoria ? $request->categoria : 1,
                    'cod_producto' => $request->codigo ? $request->codigo : "",
                    'nombre' => $request->nombre ? $request->nombre : "",
                    'marca' => $request->marca ? $request->marca : "",
                    'modelo' => $request->modelo ? $request->modelo : "",
                    'observaciones' => $request->observaciones ? $request->observaciones : "",
                ]);
            }

            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Producto editado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al editar el producto.']);
        }
    }

    public function delete_producto(Request $request)
    {
        try {
            DB::beginTransaction();
            $imagen = DB::table("productos")->where('id', $request->id)->first();
            $image_path = public_path('images/productos/' . $imagen->imagen);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            DB::table("productos")->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Producto eliminado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el producto.']);
            return $ex->getMessage();
        }
    }

    public function productos_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("productos")
                ->select('productos.*', 'categorias.nombre as categoria')
                ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a data-id="' . $row->id . '" title="Editar" class="edit btn btn-primary btn-sm btn_Edit"><i class="fa fa-pencil-alt"></i></a>
                    <a data-id="' . $row->id . '" title="Cambiar Estatus" class="edit btn btn-primary btn-sm btn_Baja"><i class="fas fa-times"></i></a>
                    <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function data_producto(Request $request)
    {
        try {
            $producto = DB::table('productos')->where('id', $request->id)->first();
            return response()->json(['info' => 1, 'producto' => $producto]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al obtener los datos del producto.']);
        }
    }

    public function actividades_inventario()
    {
        try {
            return view('admin.inventario.actividades');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function actividades_inventario_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("actividad_productos")
                ->select('actividad_productos.*', 'empleados.nombre as empleado', 'productos.imagen as img_producto', 'productos.nombre as producto')
                ->join("inventario", "actividad_productos.id_inventario", "=", "inventario.id")
                ->join("productos", "inventario.id_producto", "=", "productos.id")
                ->join("empleados", "actividad_productos.id_usuario", "=", "empleados.id")
                ->orderBy('actividad_productos.id', 'desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if ($row->tipo == 3 || $row->tipo == 5 || $row->tipo == 4) {
                        $actionBtn = '<a data-id="' . $row->id . '" title="Reingresar Producto" class="delete btn btn-primary btn-sm btn_Reingreso"><i class="fas fa-exchange-alt"></i></a>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function baja_producto(Request $request)
    {
        try {
            DB::beginTransaction();
            $producto = DB::table("productos")->where('id', $request->id)->first();
            if ($producto->status == 1) {
                DB::table("productos")->where('id', $request->id)->update([
                    'status' => 0
                ]);
            } else {
                DB::table("productos")->where('id', $request->id)->update([
                    'status' => 1
                ]);
            }
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Producto actualizado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el producto.']);
        }
    }

    public function productos_reingreso(Request $request)
    {
        try {
            DB::beginTransaction();
            $actividad = DB::table("actividad_productos")->where('id', $request->id)->first();
            $inventario = DB::table("inventario")->where('id', $actividad->id_inventario)->first();

            DB::table("inventario")->where('id', $inventario->id)->update([
                'cantidad' => $inventario->cantidad + $actividad->cantidad
            ]);

            DB::table("actividad_productos")->where('id', $request->id)->delete();

            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Producto reingresado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el producto.']);
        }
    }

    public function gestion_inventario()
    {
        try {
            $categorias = DB::table('categorias')->get();
            return view('admin.inventario.gestion_inventario', compact('categorias'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gestion_existencias_list()
    {
        $data = DB::table("inventario")
            ->select('inventario.*', 'productos.nombre as producto', 'productos.imagen',
            'productos.cod_producto', 'productos.nombre', 'productos.marca',
            'productos.modelo', 'productos.id_categoria', 'almacenes.nombre as almacen',
            'empleados.nombre as creador', 'categorias.nombre as categoria')
            ->leftJoin('productos', 'inventario.id_producto', '=', 'productos.id')
            ->leftJoin('empleados', 'inventario.created_by', '=', 'empleados.id')
            ->leftJoin('almacenes', 'inventario.ubicacion', '=', 'almacenes.id')
            ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->orderBy('inventario.id', 'desc')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a data-id="' . $row->id . '" title="Editar" class="edit btn btn-primary btn-sm btn_Edit"><i class="fa fa-pencil-alt"></i></a>
                <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function gestion_inventario_list()
    {
        $data = DB::table("inventario")
            ->select('inventario.*', 'productos.nombre as producto', 'productos.imagen',
            'productos.cod_producto', 'productos.nombre', 'productos.marca',
            'productos.modelo', 'productos.id_categoria', 'categorias.nombre as categoria')
            ->leftJoin('productos', 'inventario.id_producto', '=', 'productos.id')
            ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->where('inventario.cantidad', '>', 0)
            ->orderBy('inventario.id', 'desc')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a data-id="' . $row->id . '" title="Editar" class="edit btn btn-primary btn-sm btn_Edit"><i class="fa fa-pencil-alt"></i></a>
                <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
