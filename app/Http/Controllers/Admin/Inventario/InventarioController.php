<?php

namespace App\Http\Controllers\Admin\Inventario;

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
            if (!auth()->user()->hasPermissionTo('gestion_productos_inventario')) {
                return redirect()->route('home');
            }

            $categorias = DB::table('categorias_productos')->get();

            if ($categorias) {
                foreach ($categorias as $key => $value) {
                    $subcategorias = DB::table('subcategorias_productos')->where('categoria', $value->id)->get();
                    $categorias[$key]->subcategorias = $subcategorias;
                }
            }
            return view('admin.inventario.inventario', compact('categorias'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function productos_create(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->file('foto')) {
                $image = $request->file('foto');
                $new_name = rand() . rand() . '.' . $image->getClientOriginalExtension();
                $image->move('images/productos', $new_name);
            } else {
                $new_name = "noimagen.png";
            }

            DB::table("productos")->insert([
                'cod_producto' => $request->codigo,
                'id_creador' => session('user'),
                'categoria' => $request->categoria,
                'sub_categoria' => $request->subcategoria ? $request->subcategoria : null,
                'marca' => $request->marca ? $request->marca : '',
                'modelo' => $request->modelo ? $request->modelo : '',
                'nombre' => $request->nombre,
                'imagen' => $new_name,
                'observaciones' => $request->observaciones ? $request->observaciones : '',
                'created_at' => date('Y-m-d'),
                'status' => 1,
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
                $image->move('images/productos', $new_name);

                DB::table("productos")->where('id', $request->id)->update([
                    'categoria' => $request->categoria,
                    'sub_categoria' => $request->subcategoria ? $request->subcategoria : null,
                    'marca' => $request->marca ? $request->marca : '',
                    'modelo' => $request->modelo ? $request->modelo : '',
                    'nombre' => $request->nombre,
                    'imagen' => $new_name,
                    'observaciones' => $request->observaciones ? $request->observaciones : ''
                ]);
            } else {
                DB::table("productos")->where('id', $request->id)->update([
                    'categoria' => $request->categoria,
                    'sub_categoria' => $request->subcategoria ? $request->subcategoria : null,
                    'marca' => $request->marca ? $request->marca : '',
                    'modelo' => $request->modelo ? $request->modelo : '',
                    'nombre' => $request->nombre,
                    'observaciones' => $request->observaciones ? $request->observaciones : ''
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
            $image_path = 'images/productos/' . $imagen->imagen;
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
                ->select('productos.*', 'categorias_productos.nombre as categoria', 'subcategorias_productos.nombre as subcategoria')
                ->join('categorias_productos', 'productos.categoria', '=', 'categorias_productos.id')
                ->join('subcategorias_productos', 'subcategorias_productos.id', '=', 'productos.sub_categoria')
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

    public function productos_gestion_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("productos")
                ->select('productos.*', 'categorias_productos.nombre as categoria', 'subcategorias_productos.nombre as subcategoria')
                ->join('categorias_productos', 'productos.categoria', '=', 'categorias_productos.id')
                ->join('subcategorias_productos', 'subcategorias_productos.id', '=', 'productos.sub_categoria')
                ->get();

            foreach ($data as $key => $value) {
                $value->cantidad = DB::table('inventario')->where('producto_id', $value->id)->sum('cantidad');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a data-id="' . $row->id . '" title="Visualizar" class="ver btn btn-primary btn-sm btn_View"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $row->id . '" title="Ingreso" class="edit btn btn-success btn-sm btn_Ingreso"><i class="fas fa-cloud-download-alt"></i></a>
                    <a data-id="' . $row->id . '" title="Salida" class="edit btn btn-warning btn-sm btn_Salida"><i class="fas fa-cloud-upload-alt"></i></a>';
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
            if (!auth()->user()->hasPermissionTo('gestion_actividades_inventario')) {
                return redirect()->route('home');
            }

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

    public function gestion_inventario()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_inventario')) {
                return redirect()->route('home');
            }
            $proveedores = DB::table('proveedores')->where('estado', 1)->get();

            $clientes = DB::table('cliente')
                ->select("cliente.id", "cliente.razon_social")
                ->join("almacenes", "almacenes.cliente", "=", "cliente.id")
                ->where("estado", 1)
                ->orderBy("cliente.razon_social")
                ->groupBy("cliente.id", "cliente.razon_social")
                ->get();

            $clientes_all = DB::table('cliente')
                ->select("cliente.id", "cliente.razon_social")
                ->where("estado", 1)
                ->orderBy("cliente.razon_social")
                ->get();

            $empleados = DB::table('empleados')->where('status', 1)->get();

            foreach ($clientes as $key => $value) {
                $almacenes = DB::table('almacenes')
                    ->where("almacenes.cliente", $value->id)
                    ->orderBy("almacenes.nombre")
                    ->get();
                $clientes[$key]->almacenes = $almacenes;
            }

            foreach ($clientes as $key => $value) {
                foreach ($value->almacenes as $key2 => $value2) {
                    $estantes = DB::table('ubicaciones_almacen')
                        ->where("ubicaciones_almacen.almacen", $value2->id)
                        ->orderBy("ubicaciones_almacen.nombre")
                        ->get();
                    $clientes[$key]->almacenes[$key2]->estantes = $estantes;
                }
            }

            $almacenes_sede = DB::table('almacenes')
                ->select("almacenes.id", "almacenes.nombre", "almacenes.observaciones")
                ->whereNull("almacenes.cliente")
                ->where("almacen", 1)
                ->orderBy("almacenes.nombre")
                ->groupBy("almacenes.id", "almacenes.nombre", "almacenes.observaciones")
                ->get();

            foreach ($almacenes_sede as $key => $value) {
                $almacenes = DB::table('almacenes')
                    ->whereNull("almacenes.cliente")
                    ->where("almacen_id", $value->id)
                    ->orderBy("almacenes.nombre")
                    ->get();
                $almacenes_sede[$key]->almacenes = $almacenes;
            }

            foreach ($almacenes_sede as $key => $value) {
                foreach ($value->almacenes as $key2 => $value2) {
                    $estantes = DB::table('ubicaciones_almacen')
                        ->where("ubicaciones_almacen.almacen", $value2->id)
                        ->orderBy("ubicaciones_almacen.nombre")
                        ->get();
                    $almacenes_sede[$key]->almacenes[$key2]->estantes = $estantes;
                }
            }


            return view('admin.inventario.gestion_inventario', compact('proveedores', 'clientes', 'almacenes_sede', 'clientes_all', 'empleados'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
