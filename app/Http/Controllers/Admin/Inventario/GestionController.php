<?php

namespace App\Http\Controllers\Admin\Inventario;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{
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
                        ->where('salida_inventario.tipo', '<', 5)
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
                    'cantidad' => $cantidad_old->cantidad + $cantidad
                ]);
            } else {
                DB::table('inventario')->insert([
                    'producto_id' => $producto_id,
                    'serial' => $serial_compra,
                    'cantidad' => $cantidad,
                    'status' => 1,
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
            $serial = $request->serial;
            $cantidad = $request->cantidad;
            $observaciones = $request->observaciones;
            $count_salida = 0;
            $count_inventario = 0;

            $data_old = DB::table('salida_inventario')->where("id", $serial)->first();
            $data_inventario = DB::table('inventario')->where("id", $data_old->inventario_id)->first();

            $status = 0;

            $count_salida = $data_old->cantidad - $cantidad;

            $count_inventario = $data_inventario->cantidad + $cantidad;

            if ($count_salida == 0) {
                $status = 1;
            }

            DB::table('inventario')->where("id", $data_old->inventario_id)->update([
                'cantidad' => $count_inventario
            ]);

            DB::table('salida_inventario')->where("id", $serial)->update([
                'cantidad' => $count_salida,
                'status' => $status,
                'observaciones' => $observaciones,
            ]);

            return response()->json(['info' => 1, 'data' => 'Inventario actualizado.']);
        } catch (Exception $ex) {
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

            return response()->json(['info' => 1, 'data' => $producto]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }

    public function salidas_inventario(Request $request)
    {
        try {
            $tipo = $request->tipo;
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

            DB::table('inventario')->where("id", $serial)->update([
                'cantidad' => $cantidad_old->cantidad - $cantidad,
                'status' => $status,
            ]);

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

            return response()->json(['info' => 1, 'data' => 'Inventario actualizado.']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el inventario.']);
        }
    }
}
