<?php

namespace App\Http\Controllers\Admin\Inventario;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class GestionController extends Controller
{
    public $names_almacenes = [];

    public function historial(Request $request)
    {
        try {
            $this->names_almacenes = [];

            if (!auth()->user()->hasPermissionTo('gestion_inventario')) {
                return redirect()->route('home');
            }

            $id = $request->get('token');

            if ($id == null || $id == '' || $id < 1) {
                return view('errors.404');
            }

            $inventario = DB::table('inventario')
                ->select('inventario.*', 'productos.nombre as producto', 'productos.marca as marca', 'productos.modelo as modelo', 'productos.imagen as imagen')
                ->join('productos', 'productos.id', '=', 'inventario.producto_id')
                ->where('inventario.id', $id)
                ->first();

            if (!$inventario) {
                return view('errors.403');
            }

            $inventario->movimientos = DB::table('movimientos_inventario')
                ->select('movimientos_inventario.*', 'tbl_creador.nombre as creador', 'proveedores.razon_social as proveedor', 'cliente.razon_social as cliente', 'empleados.nombre as empleado')
                ->join('empleados as tbl_creador', 'tbl_creador.id', '=', 'movimientos_inventario.created_by')
                ->leftJoin('proveedores', 'proveedores.id', '=', 'movimientos_inventario.proveedor_id')
                ->leftJoin('cliente', 'cliente.id', '=', 'movimientos_inventario.cliente_id')
                ->leftJoin('empleados', 'empleados.id', '=', 'movimientos_inventario.empleado_id')
                ->where('movimientos_inventario.inventario_id', $id)
                ->orderBy('movimientos_inventario.id', 'desc')
                ->get();

            if (count($inventario->movimientos) > 0) {
                foreach ($inventario->movimientos as $key => $value) {

                    $almacen = DB::table('almacenes')
                        ->select('almacenes.*')
                        ->where('almacenes.id', $value->almacen_id)
                        ->get();

                    if ($almacen->count() > 0) {
                        $almacen = $almacen->toArray();
                        $almacen = $this->getNameAlmacen($almacen);
                    }

                    $nombre  = '';

                    if ($this->names_almacenes) {
                        $this->names_almacenes = array_reverse($this->names_almacenes);
                        for ($i = 0; $i < count($this->names_almacenes); $i++) {
                            if ($i == 0) {
                                $nombre = $this->names_almacenes[$i] . ', ';
                            } else if ($i == count($this->names_almacenes) - 1) {
                                $nombre = $nombre . ' ' . $almacen[0]->nombre;
                            } else {
                                $nombre = $nombre . ' ' . $this->names_almacenes[$i] . ', ';
                            }
                        }
                    } else {
                        $nombre = $almacen[0]->nombre;
                    }

                    $inventario->movimientos[$key]->ubicacion = $nombre;
                    $this->names_almacenes = [];
                }
            }

            return view('admin.inventario.historial', compact('inventario'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function data(Request $request)
    {
        try {
            $id = $request->id;

            $producto = DB::table('productos')
                ->select('productos.*')
                ->where('productos.id', $id)
                ->first();

            $producto->inventario = DB::table('inventario')
                ->select('inventario.*')
                ->where('inventario.producto_id', $id)
                ->orderBy('inventario.id', 'desc')
                ->get();

            if (count($producto->inventario) > 0) {
                foreach ($producto->inventario as $key => $value) {
                    $producto->inventario[$key]->salidas = DB::table('salida_inventario')
                        ->where('salida_inventario.inventario_id', $value->id)
                        ->where('salida_inventario.status', 0)
                        ->where('salida_inventario.tipo', '<=', 4)
                        ->orderBy('salida_inventario.id', 'desc')
                        ->limit(1)
                        ->get();
                }
            }

            return response()->json(['info' => 1, 'data' => $producto]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function ingreso_inventario(Request $request)
    {
        try {
            $tipo = $request->tipo;
            $codigo_interno = $request->codigo_interno;
            $almacen_id = $request->almacen_id;
            $proveedor_id = $request->proveedor_id;
            $producto_id = $request->producto_id;
            $serial = $request->serial;
            $precio_venta = $request->precio_venta;
            $precio_compra = $request->precio_compra;
            $serial_compra = $request->serial_compra;
            $observaciones = $request->observaciones;
            $cantidad = $request->cantidad;

            if ($serial != 0 && $serial > 0) {
                $cantidad_old = DB::table('inventario')->where("id", $serial)->first();
                DB::table('inventario')->where("id", $serial)->update([
                    'cantidad' => $cantidad_old->cantidad + $cantidad,
                    'codigo_interno' => $codigo_interno ? $codigo_interno : null,
                ]);

                DB::table('movimientos_inventario')->insert([
                    'tipo' => $tipo,
                    'inventario_id' => $serial,
                    'almacen_id' => $almacen_id,
                    'cantidad' => $cantidad,
                    'proveedor_id' => $proveedor_id ? $proveedor_id : null,
                    'precio_venta' => $precio_venta ? $precio_venta : null,
                    'precio_compra' => $precio_compra ? $precio_compra : null,
                    'observaciones' => $observaciones ? $observaciones : null,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $inventario_id = DB::table('inventario')->insertGetId([
                    'producto_id' => $producto_id,
                    'codigo_interno' => $codigo_interno ? $codigo_interno : null,
                    'serial' => $serial_compra,
                    'cantidad' => $cantidad,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                DB::table('movimientos_inventario')->insert([
                    'tipo' => $tipo,
                    'inventario_id' => $inventario_id,
                    'almacen_id' => $almacen_id,
                    'cantidad' => $cantidad,
                    'proveedor_id' => $proveedor_id ? $proveedor_id : null,
                    'precio_venta' => $precio_venta ? $precio_venta : null,
                    'precio_compra' => $precio_compra ? $precio_compra : null,
                    'observaciones' => $observaciones ? $observaciones : null,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            return response()->json(['info' => 1, 'data' => 'Inventario actualizado.']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function reingreso_inventario(Request $request)
    {
        try {
            DB::beginTransaction();
            $tipo = $request->tipo;
            $almacen_id = $request->almacen_id;
            $serial = $request->serial;
            $cantidad = $request->cantidad;
            $observaciones = $request->observaciones;
            $count_salida = 0;
            $count_inventario = 0;
            $movimiento = 0;

            $data_old = DB::table('salida_inventario')->where("id", $serial)->first();
            if ($data_old && $data_old != null) {
                $data_inventario = DB::table('inventario')->where("id", $data_old->inventario_id)->first();

                $status = 0;

                $count_salida = $data_old->cantidad - $cantidad;

                $count_inventario = $data_inventario->cantidad + $cantidad;

                if ($count_salida == 0) {
                    $status = 1;
                }
            } else {
                $data_inventario = DB::table('inventario')->where("id", $serial)->first();
                $movimiento = 1;
            }

            if ($tipo == 1 && $movimiento == 1) {
                DB::table('inventario')->where("id", $serial)->update([
                    'cantidad' => $data_inventario->cantidad,
                    'status' => 1,
                ]);

                DB::table('movimientos_inventario')->insert([
                    'tipo' => $tipo,
                    'inventario_id' => $serial,
                    'almacen_id' => $almacen_id,
                    'cantidad' => $cantidad,
                    'observaciones' => $observaciones ? $observaciones : null,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            } else {

                DB::table('inventario')->where("id", $data_old->inventario_id)->update([
                    'cantidad' => $count_inventario,
                    'status' => $status,
                ]);

                DB::table('salida_inventario')->where("id", $serial)->update([
                    'cantidad' => $count_salida,
                    'status' => $status,
                    'observaciones' => $observaciones,
                ]);


                DB::table('movimientos_inventario')->insert([
                    'tipo' => $tipo,
                    'inventario_id' => $data_old->inventario_id,
                    'almacen_id' => $almacen_id,
                    'cantidad' => $cantidad,
                    'observaciones' => $observaciones ? $observaciones : null,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            DB::commit();
            return response()->json(['info' => 1, 'data' => 'Inventario actualizado.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function get_inventario(Request $request)
    {
        try {
            $id = $request->id;

            $producto = DB::table('productos')
                ->select('productos.*')
                ->where('productos.id', $id)
                ->first();

            $producto->inventario = DB::table('inventario')
                ->select('inventario.*')
                ->where('inventario.producto_id', $id)
                ->orderBy('inventario.id', 'desc')
                ->get();

            if ($producto->inventario) {
                foreach ($producto->inventario as $key => $value) {
                    $last = DB::table('movimientos_inventario')
                        ->select('movimientos_inventario.almacen_id')
                        ->where('movimientos_inventario.inventario_id', $value->id)
                        ->orderBy('movimientos_inventario.id', 'desc')
                        ->first();

                    $almacen = DB::table('almacenes')
                        ->select('almacenes.*')
                        ->where('almacenes.id', $last->almacen_id)
                        ->get();


                    if ($almacen->count() > 0) {
                        $almacen = $almacen->toArray();
                        $almacen = $this->getNameAlmacen($almacen);
                    }

                    $nombre  = '';

                    if ($this->names_almacenes) {
                        $this->names_almacenes = array_reverse($this->names_almacenes);
                        for ($i = 0; $i < count($this->names_almacenes); $i++) {
                            if ($i == 0) {
                                $nombre = $this->names_almacenes[$i] . '<br>';
                            } else if ($i == count($this->names_almacenes) - 1) {
                                $nombre = $nombre . ' ' . $almacen[0]->nombre;
                            } else {
                                $nombre = $nombre . ' ' . $this->names_almacenes[$i] . '<br>';
                            }
                        }
                    } else {
                        $nombre = $almacen[0]->nombre;
                    }

                    $producto->inventario[$key]->almacen = $nombre;
                    $this->names_almacenes = [];
                }
            }

            return response()->json(['info' => 1, 'data' => $producto]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function get_serial(Request $request)
    {
        try {
            $data = DB::table('movimientos_inventario')
                ->select('inventario.*', 'movimientos_inventario.id as id_movimiento', 'movimientos_inventario.proveedor_id', 'movimientos_inventario.precio_venta', 'movimientos_inventario.precio_compra', 'movimientos_inventario.observaciones')
                ->where('inventario.id', $request->id)
                ->join('inventario', 'inventario.id', '=', 'movimientos_inventario.inventario_id')
                ->first();

            return response()->json(['info' => 1, 'data' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function modificar_serial(Request $request)
    {
        try {
            DB::beginTransaction();
            $inventario_id = $request->id;
            $movimiento_id = $request->movimiento_id;
            $proveedor = $request->proveedor;
            $codigo_interno = $request->codigo_interno;
            $serial = $request->serial;
            $precio_venta = $request->precio_venta;
            $precio_compra = $request->precio_compra;
            $observaciones = $request->observaciones;

            DB::table('inventario')->where("id", $inventario_id)->update([
                'serial' => $serial,
                'codigo_interno' => $codigo_interno,
            ]);

            DB::table('movimientos_inventario')->where("id", $movimiento_id)->update([
                'proveedor_id' => $proveedor,
                'precio_venta' => $precio_venta,
                'precio_compra' => $precio_compra,
                'observaciones' => $observaciones,
            ]);
            DB::commit();
            return response()->json(['info' => 1, 'data' => 'Serial actualizado.']);
        } catch (Exception $ex) {
            
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function salidas_inventario(Request $request)
    {
        try {
            $tipo = $request->tipo;
            $almacen_id = $request->almacen_id;
            $producto_id = $request->producto_id;
            $cliente = $request->cliente;
            $empleado = $request->empleado;
            $serial = $request->serial;
            $cantidad = $request->cantidad;
            $observaciones = $request->observaciones;
            $status = 1;

            $cantidad_old = DB::table('inventario')->where("id", $serial)->first();

            if ($cantidad_old->cantidad == $cantidad) {
                $status = 0;
            }

            if ($tipo == 2) {
                DB::table('inventario')->where("id", $serial)->update([
                    'cantidad' => $cantidad_old->cantidad - 0,
                    'status' => 1,
                ]);
            } else {
                DB::table('inventario')->where("id", $serial)->update([
                    'cantidad' => $cantidad_old->cantidad - $cantidad,
                    'status' => $status,
                ]);
            }

            DB::table('salida_inventario')->insert([
                'tipo' => $tipo,
                'producto_id' => $producto_id,
                'inventario_id' => $serial,
                'cantidad' => $cantidad,
                'user_id' => $empleado ? $empleado : null,
                'cliente_id' => $cliente ? $cliente : null,
                'observaciones' => $observaciones ? $observaciones : null,
                'status' => 0,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('movimientos_inventario')->insert([
                'tipo' => $tipo + 1,
                'inventario_id' => $serial,
                'almacen_id' => $almacen_id,
                'cantidad' => $cantidad,
                'empleado_id' => $empleado ? $empleado : null,
                'cliente_id' => $cliente ? $cliente : null,
                'observaciones' => $observaciones ? $observaciones : null,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['info' => 1, 'data' => 'Inventario actualizado.']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function eliminar_serial(Request $request)
    {
        try {
            $id = $request->id;

            DB::table('salida_inventario')->where("inventario_id", $id)->delete();
            DB::table('movimientos_inventario')->where("inventario_id", $id)->delete();
            DB::table('inventario')->where("id", $id)->delete();

            return response()->json(['info' => 1, 'data' => 'Serial eliminado.']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el serial.']);
        }
    }

    public function getNameAlmacen($almacenes)
    {
        foreach ($almacenes as $key => $almacen) {
            $almacenes[$key]->almacenes = DB::table('almacenes')->where('id', $almacen->parent_id)->get();

            array_push($this->names_almacenes, $almacenes[$key]->nombre);

            if ($almacenes[$key]->almacenes->count() > 0) {
                $almacenes[$key]->almacenes = $almacenes[$key]->almacenes->toArray();
                $almacenes[$key]->almacenes = $this->getNameAlmacen($almacenes[$key]->almacenes);
            } else {
                $almacenes[$key]->almacenes = [];
            }
        }

        return $almacenes;
    }
}
