<?php

namespace App\Http\Controllers\Admin\Inventario;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
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
                ->select('si.id', 'si.descripcion', 'si.created_at', 'c.razon_social as cliente', 'si.estado', 'si.codigo','c.nit', DB::raw('count(sid.id) as elementos'))
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
                ->select('id', 'elemento', 'cantidad')
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

            return view('admin.inventario.gestion_solicitudes', compact('clientes', 'pendientes', 'gestionados', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex;
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;

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

            DB::table('solicitud_inventario')
                ->where('id', $id)
                ->update([
                    'estado' => 2,
                ]);

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

    public function aceptar(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;

            $count_all = DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $id)
                ->count();

            $count_aceptados = DB::table('solicitud_inventario_detalle')
                ->where('solicitud_id', $id)
                ->where('status', 1)
                ->count();

            if ($count_all == $count_aceptados) {
                DB::table('solicitud_inventario')
                    ->where('id', $id)
                    ->update([
                        'estado' => 1,
                    ]);
            } else {
                return response()->json([
                    'info' => 0,
                    'message' => 'Debe gestionar todos los elementos antes de aceptar la solicitud',
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
}
