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
            $image->move('images/productos', $new_name);

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
                $image->move('images/productos', $new_name);

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
                ->select('productos.*', 'categorias_productos.nombre as categoria')
                ->join('categorias_productos', 'productos.categoria', '=', 'categorias_productos.id')
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
            if (!auth()->user()->hasPermissionTo('gestion_inventario')) {
                return redirect()->route('home');
            }

            $empleados = DB::table('empleados')->where("status", 1)->get();
            $almacenes = DB::table('almacenes')->get();
            $proveedores = DB::table('proveedores')->where("estado", 1)->get();
            $clientes = DB::table('cliente')->where("estado", 1)->get();
            return view('admin.inventario.gestion_inventario', compact('empleados', 'almacenes', 'proveedores', 'clientes'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gestion_existencias_list()
    {
        $data = DB::table("inventario")
            ->select(
                'inventario.*',
                'productos.nombre as producto',
                'productos.imagen',
                'productos.cod_producto',
                'productos.nombre',
                'productos.marca',
                'productos.modelo',
                'productos.id_categoria',
                'almacenes.nombre as almacen',
                'empleados.nombre as creador',
                'categorias.nombre as categoria'
            )
            ->leftJoin('productos', 'inventario.id_producto', '=', 'productos.id')
            ->leftJoin('empleados', 'inventario.created_by', '=', 'empleados.id')
            ->leftJoin('almacenes', 'inventario.ubicacion', '=', 'almacenes.id')
            ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->orderBy('inventario.id', 'desc')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn =
                    '<a data-id="' . $row->id . '" title="Ver" class="btn btn-primary btn-sm btn_Show"><i class="fa fa-eye"></i></a>' .
                    '<a data-id="' . $row->id . '" title="Editar" class="btn btn-primary btn-sm btn_Edit"><i class="fa fa-pencil-alt"></i></a>' .
                    '<a data-id="' . $row->id . '" data-status="' . $row->status . '" title="Dar De Baja" class="btn btn-primary btn-sm btn_Baja"><i class="fas fa-times"></i></a>';

                if (auth()->user()->hasPermissionTo('delete_existencias_inventario')) {
                    $actionBtn .= '<a data-id="' . $row->id . '" data-asignado="' . $row->cantidad_asignada . '" title="Eliminar" class="btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
                }
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function gestion_inventario_list()
    {
        $data = DB::table("inventario")
            ->select(
                'inventario.*',
                'productos.nombre as producto',
                'productos.imagen',
                'productos.cod_producto',
                'productos.nombre',
                'productos.marca',
                'productos.modelo',
                'productos.id_categoria',
                'categorias.nombre as categoria'
            )
            ->leftJoin('productos', 'inventario.id_producto', '=', 'productos.id')
            ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->where('inventario.cantidad', '>', 0)
            ->orderBy('inventario.id', 'desc')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn =
                    '<a data-id="' . $row->id . '" data-nombre="' . $row->producto . '" data-img="' . $row->imagen . '" data-producto="' . $row->id_producto . '" data-cantidad="' . $row->cantidad . '" title="Seleccionar" class="btn btn-primary btn-sm btn_Seleccionar"><i class="fa fa-check"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function inventario_change_status(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;
            if ($status == 1) {
                DB::table("inventario")->where('id', $id)->update([
                    'status' => 0
                ]);
            } else {
                DB::table("inventario")->where('id', $id)->update([
                    'status' => 1
                ]);
            }
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Inventario actualizado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function inventario_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            DB::table("inventario")->where('id', $id)->delete();
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Inventario eliminado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el inventario.']);
        }
    }

    public function inventario_data(Request $request)
    {
        try {
            $id = $request->id;
            $data = DB::table("inventario")->where('id', $id)->first();
            return response()->json(['info' => 1, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al obtener los datos del inventario.']);
        }
    }

    public function inventario_detail(Request $request)
    {
        try {
            $id = $request->id;
            $data = DB::table("inventario")->where('id', $id)->first();

            $productos_instalados = DB::table("repuestos_reparacion")->where('id_inventario', $id)->get();

            $productos_vendidos = DB::table("productos_factura")
                ->select('productos_factura.*', 'cliente.razon_social as cliente')
                ->join("facturas", "productos_factura.id_factura", "=", "facturas.id")
                ->join("cliente", "facturas.id_cliente", "=", "cliente.id")
                ->where('id_inventario', $id)
                ->get();

            $productos_prestados = DB::table("prestamo")
                ->select('prestamo.*', 'cliente.razon_social as cliente', 'empleados.nombre as empleado')
                ->leftJoin("cliente", "prestamo.id_cliente", "=", "cliente.id")
                ->leftJoin("empleados", "prestamo.id_empleado", "=", "empleados.id")
                ->where('id_inventario', $id)->where("prestamo.status", 0)
                ->get();

            $productos_alquilados = []; //DB::table("productos_remision")->where('id_inventario', $id)->get();

            $productos_devueltos = DB::table("prestamo")
                ->select('prestamo.*', 'cliente.razon_social as cliente', 'empleados.nombre as empleado')
                ->leftJoin("cliente", "prestamo.id_cliente", "=", "cliente.id")
                ->leftJoin("empleados", "prestamo.id_empleado", "=", "empleados.id")
                ->where('id_inventario', $id)->where("prestamo.status", 1)
                ->get();

            $productos_asignados = DB::table("productos_asignados")
                ->select('productos_asignados.*', 'empleados.nombre as empleado')
                ->join("empleados", "productos_asignados.id_empleado", "=", "empleados.id")
                ->where('id_inventario', $id)
                ->get();

            return response()->json(['info' => 1, 'data' => $data, 'productos_instalados' => $productos_instalados, 'productos_vendidos' => $productos_vendidos, 'productos_prestados' => $productos_prestados, 'productos_alquilados' => $productos_alquilados, 'productos_devueltos' => $productos_devueltos, 'productos_asignados' => $productos_asignados]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al obtener los datos del inventario.']);
        }
    }

    public function inventario_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $serial = $request->serial;
            $codigo = $request->codigo;
            $cantidad = $request->cantidad;
            $cantidad_asig = $request->cantidad_asig;
            $ubicacion = $request->ubicacion;
            $ubicacion_ref = $request->ubicacion_ref;
            $asignado = $request->asignado;
            $descripcion = $request->descripcion;

            DB::table("inventario")->where("id", $id)->update([
                'serial' => $serial ? $serial : "",
                'codigo_interno' => $codigo ? $codigo : 0,
                'cantidad' => $cantidad ? $cantidad : 0,
                'cantidad_asignada' => $cantidad_asig ? $cantidad_asig : 0,
                'ubicacion' => $ubicacion ? $ubicacion : 0,
                'ubicacion_ref' => $ubicacion_ref ? $ubicacion_ref : "",
                'empleado_asignado' => $asignado ? $asignado : 0,
                'descripcion' => $descripcion ? $descripcion : "",
                'fecha_actualizacion' => date("Y-m-d H:i:s")
            ]);

            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Inventario actualizado correctamente.']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
            return $ex->getMessage();
        }
    }

    public function inventario_update_select(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $cantidad_old = $request->cantidad_old;
            $producto = $request->producto;
            $tipo = $request->tipo;

            if ($tipo == 0) {
            } else if ($tipo == 1) {
                DB::table("inventario")->where("id", $id)->update([
                    'id_proveedor' => $request->proveedor ? $request->proveedor : 0,
                    'ubicacion' => $request->ubicacion ? $request->ubicacion : 0,
                    'ubicacion_ref' => $request->ubicacion_ref ? $request->ubicacion_ref : "",
                    'precio_compra' => $request->precio_compra ? $request->precio_compra : 0,
                    'precio_venta' => $request->precio_venta ? $request->precio_venta : 0,
                    'serial' => $request->serial,
                    'cod_interno' => $request->codigo_interno,
                    'cantidad' => $request->cantidad + $cantidad_old,
                    'descripcion' => $request->descripcion ? $request->descripcion : "",
                ]);
            } else if ($tipo == 2) {
                DB::table('ventas')->insert([
                    'id_cliente' => $request->cliente,
                    'id_producto' => $producto,
                    'anexo' => "",
                    'fecha' => date("Y-m-d"),
                    'created_by' => session('user'),
                    'cantidad' => $request->cantidad,
                    'precio_compra' => $request->precio_compra,
                    'precio_venta' => $request->precio_venta,
                ]);
            } else if ($tipo == 3) {
            } else if ($tipo == 4) {
                DB::table("prestamo")->insert([
                    'id_inventario' => $id,
                    'cantidad' => $request->cantidad,
                    'id_cliente' => $request->cliente,
                    'id_empleado' => $request->empleado,
                    'tipo' => 4,
                    'created_by' => session('user'),
                    'status' => 0,
                    'fecha' => date("Y-m-d"),
                ]);
            } else if ($tipo == 5) {
                DB::table("productos_asignados")->insert([
                    'cantidad' => $request->cantidad,
                    'id_empleado' => $request->empleado,
                    'id_inventario' => $id,
                    'descripcion' => session('user'),
                    'fecha' => date("Y-m-d H:i:s"),
                    'created_by' => session('user'),
                    'status' => 0,
                ]);
            } else if ($tipo == 6) {
                DB::table("instalaciones")->insert([
                    'id_inventario' => $id,
                    'id_cliente' => $request->cliente,
                    'cantidad' => $request->cantidad,
                    'tipo' => 6,
                    'created_by' => session('user'),
                    'status' => 1,
                    'fecha' => date("Y-m-d"),
                ]);
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
            return $ex->getMessage();
        }
    }
}
