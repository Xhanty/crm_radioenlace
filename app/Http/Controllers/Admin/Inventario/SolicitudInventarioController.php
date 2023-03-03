<?php

namespace App\Http\Controllers\Admin\Inventario;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SolicitudInventarioController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('solicitud_elementos')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social as nombre', 'nit')
                ->where('estado', 1)
                ->get();

            $pendientes = DB::table('solicitud_inventario as si')
                ->join('solicitud_inventario_detalle as sid', 'sid.solicitud_id', '=', 'si.id')
                ->join('cliente as c', 'c.id', '=', 'si.cliente_id')
                ->select('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social as cliente', 'si.estado', 'si.codigo', 'c.nit', DB::raw('count(sid.id) as elementos'))
                ->where('si.estado', 0)
                ->where('si.solicitante_id', auth()->user()->id)
                ->groupBy('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social', 'si.estado', 'si.codigo', 'c.nit')
                ->get();

            $gestionados = DB::table('solicitud_inventario as si')
                ->join('solicitud_inventario_detalle as sid', 'sid.solicitud_id', '=', 'si.id')
                ->join('cliente as c', 'c.id', '=', 'si.cliente_id')
                ->select('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social as cliente', 'si.estado', 'si.codigo', 'c.nit', DB::raw('count(sid.id) as elementos'))
                ->where('si.solicitante_id', auth()->user()->id)
                ->where('si.estado', '!=', 0)
                ->groupBy('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social', 'si.estado', 'si.codigo', 'c.nit')
                ->get();

            return view('admin.inventario.solicitud_inventario', compact('clientes', 'pendientes', 'gestionados'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex;
        }
    }

    public function data(Request $request)
    {
        try {
            $solicitud = DB::table('solicitud_inventario')
                ->where('id', $request->id)
                ->first();

            $elementos = DB::table('solicitud_inventario_detalle')
                ->select('id', 'elemento', 'cantidad', 'status')
                ->where('solicitud_id', $request->id)
                ->get();

            return response()->json([
                'info' => 1,
                'solicitud' => $solicitud,
                'elementos' => $elementos,
            ]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al obtener los datos de la solicitud',
            ]);
        }
    }

    public function solicitud_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = $request->cliente;
            $descripcion = $request->descripcion;
            $elementos = $request->elementos;
            $cantidades = $request->cantidad;

            $solicitud = DB::table('solicitud_inventario')
                ->insertGetId([
                    'codigo' => 'SOL-' . Str::upper(Str::random(5)),
                    'tipo' => $request->tipo,
                    'solicitante_id' => auth()->user()->id,
                    'cliente_id' => $cliente,
                    'descripcion' => $descripcion,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

            foreach ($elementos as $key => $elemento) {
                DB::table('solicitud_inventario_detalle')
                    ->insert([
                        'solicitud_id' => $solicitud,
                        'elemento' => $elemento,
                        'cantidad' => $cantidades[$key],
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            DB::commit();
            return response()->json([
                'info' => 1,
                'message' => 'Solicitud de inventario creada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al crear la solicitud de inventario',
            ]);
        }
    }

    public function solicitud_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $cliente = $request->cliente;
            $descripcion = $request->descripcion;
            $elementos = $request->elementos;
            $cantidades = $request->cantidad;

            DB::table('solicitud_inventario')
                ->where('id', $id)
                ->update([
                    'cliente_id' => $cliente,
                    'tipo' => $request->tipo,
                    'descripcion' => $descripcion,
                ]);

            DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $id)
                ->delete();

            foreach ($elementos as $key => $elemento) {
                DB::table('solicitud_inventario_detalle')
                    ->insert([
                        'solicitud_id' => $id,
                        'elemento' => $elemento,
                        'cantidad' => $cantidades[$key],
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            DB::commit();
            return response()->json([
                'info' => 1,
                'message' => 'Solicitud de inventario actualizada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al actualizar la solicitud de inventario',
            ]);
        }
    }

    // GESTIÓN
    public function gestion()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_solicitudes')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social as nombre', 'nit')
                ->where('estado', 1)
                ->get();

            $pendientes = DB::table('solicitud_inventario as si')
                ->join('solicitud_inventario_detalle as sid', 'sid.solicitud_id', '=', 'si.id')
                ->join('empleados as e', 'e.id', '=', 'si.solicitante_id')
                ->join('cliente as c', 'c.id', '=', 'si.cliente_id')
                ->select('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social as cliente', 'si.estado', 'e.nombre as empleado', 'si.codigo', 'c.nit', DB::raw('count(sid.id) as elementos'))
                ->where('si.estado', 0)
                ->groupBy('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social', 'si.estado', 'si.codigo', 'e.nombre', 'c.nit')
                ->get();

            $gestionados = DB::table('solicitud_inventario as si')
                ->join('solicitud_inventario_detalle as sid', 'sid.solicitud_id', '=', 'si.id')
                ->join('empleados as e', 'e.id', '=', 'si.solicitante_id')
                ->join('cliente as c', 'c.id', '=', 'si.cliente_id')
                ->select('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social as cliente', 'si.estado', 'e.nombre as empleado', 'si.codigo', 'c.nit', DB::raw('count(sid.id) as elementos'))
                ->where('si.estado', '!=', 0)
                ->groupBy('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social', 'si.estado', 'si.codigo', 'e.nombre', 'c.nit')
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $almacenes = DB::table('almacenes')->whereNull("parent_id")->get();

            if ($almacenes->count() > 0) {
                $almacenes = $almacenes->toArray();
                $almacenes = $this->getAlmacenes($almacenes);
            } else {
                $almacenes = [];
            }

            return view('admin.inventario.gestion_solicitudes', compact('clientes', 'pendientes', 'gestionados', 'productos', 'almacenes'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex;
        }
    }

    public function getAlmacenes($almacenes)
    {
        foreach ($almacenes as $key => $almacen) {
            $almacenes[$key]->almacenes = DB::table('almacenes')->where('parent_id', $almacen->id)->get();

            if ($almacenes[$key]->almacenes->count() > 0) {
                $almacenes[$key]->almacenes = $almacenes[$key]->almacenes->toArray();
                $almacenes[$key]->almacenes = $this->getAlmacenes($almacenes[$key]->almacenes);
            } else {
                $almacenes[$key]->almacenes = [];
            }
        }

        return $almacenes;
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $count = DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $id)
                ->where('status', 1)
                ->count();

            if($count > 0){
                return response()->json([
                    'info' => 0,
                    'mensaje' => 'No se puede eliminar la solicitud de inventario porque ya tiene elementos gestionados',
                ]);
            }

            DB::table('solicitud_inventario')
                ->where('id', $id)
                ->delete();

            DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $id)
                ->delete();

            DB::commit();
            return response()->json([
                'info' => 1,
                'message' => 'Solicitud de inventario eliminada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al eliminar la solicitud de inventario',
            ]);
        }
    }

    public function rechazar(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;

            $count = DB::table('solicitud_inventario_detalle')
            ->where('solicitud_id', $id)
            ->where('status', 1)
                ->count();

            if ($count > 0) {
                return response()->json([
                    'info' => 0,
                    'mensaje' => 'No se puede rechazar la solicitud de inventario porque ya tiene elementos gestionados',
                ]);
            }

            DB::table('solicitud_inventario')
                ->where('id', $id)
                ->update([
                    'estado' => 2,
                ]);

            $elementos = DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $id)
                ->get();

            foreach ($elementos as $elemento) {
                DB::table('solicitud_inventario_detalle')
                    ->where('id', $elemento->id)
                    ->update([
                        'status' => 2,
                    ]);
            }

            DB::commit();
            return response()->json([
                'info' => 1,
                'message' => 'Solicitud de inventario rechazada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al rechazar la solicitud de inventario',
            ]);
        }
    }

    public function asignar_producto(Request $request)
    {
        try {
            DB::beginTransaction();
            $id_solicitud = $request->solicitud;

            $detalle_solicitud = DB::table('solicitud_inventario_detalle')
                ->where('id', $id_solicitud)
                ->first();

            $solicitud = DB::table('solicitud_inventario')
                ->where('id', $detalle_solicitud->solicitud_id)
                ->first();

            $count_all = DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $detalle_solicitud->solicitud_id)
                ->count();

            $reload = 0;

            DB::table('solicitud_inventario_detalle')->where("id", $id_solicitud)->update([
                "status" => 1,
            ]);

            $count_asignados = DB::table('solicitud_inventario_detalle')
            ->where('solicitud_id', $detalle_solicitud->solicitud_id)
                ->where('status', 1)
                ->count();

            if ($count_all == $count_asignados) {
                DB::table('solicitud_inventario')->where("id", $detalle_solicitud->solicitud_id)->update([
                    "estado" => 1,
                ]);

                $reload = 1;
            }

            // DESCONTAR DEL INVENTARIO

            $tipo = $solicitud->tipo;
            $almacen_id = $request->almacen;
            
            $cliente = $solicitud->cliente_id;
            $empleado = $request->solicitante_id;
            
            $serial = $request->producto;
            $cantidad = $request->cantidad;
            $observaciones = 'Producto asignado a la solicitud de inventario con código: ' . $solicitud->codigo;
            $status = 1;
            
            $cantidad_old = DB::table('inventario')->where("id", $serial)->first();
            $producto_id = $cantidad_old->producto_id;
            
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

            DB::commit();
            return response()->json([
                'info' => 1,
                'message' => 'Producto asignado correctamente',
                'reload' => $reload,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al asignar el producto',
            ]);
        }
    }
}
