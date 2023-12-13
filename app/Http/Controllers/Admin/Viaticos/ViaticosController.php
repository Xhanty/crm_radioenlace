<?php

namespace App\Http\Controllers\Admin\Viaticos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViaticosController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('visitas_viaticos')) {
                return redirect()->route('home');
            }*/

            $visitas_pendientes = DB::table('visitas_viaticos')
                ->select('visitas_viaticos.*', 'cliente.razon_social', 'cliente.nit')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->where('visitas_viaticos.status', 0)
                ->get();

            $viaticos_pendientes = DB::table('viaticos')
                ->select('viaticos.*', 'visitas_viaticos.destino', 'visitas_viaticos.consecutivo as cs', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('visitas_viaticos', 'visitas_viaticos.id', '=', 'viaticos.visita_id')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'viaticos.cretead_by')
                ->where('viaticos.status', 0)
                ->get();

            $viaticos_completados = DB::table('viaticos')
                ->select('viaticos.*', 'visitas_viaticos.destino', 'visitas_viaticos.consecutivo as cs', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('visitas_viaticos', 'visitas_viaticos.id', '=', 'viaticos.visita_id')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'viaticos.cretead_by')
                ->where('viaticos.status', '>', 0)
                ->get();

            return view('admin.viaticos.viaticos', compact('visitas_pendientes', 'viaticos_pendientes', 'viaticos_completados'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function aprobar($id)
    {
        try {
            DB::table('viaticos')
                ->where('id', $id)
                ->update(['status' => 1]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }

    public function rechazar($id)
    {
        try {
            DB::table('viaticos')
                ->where('id', $id)
                ->update(['status' => 2]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }

    public function add(Request $request)
    {
        try {
            $data = $request->all();

            $consecutivo = DB::table('viaticos')
                ->select(DB::raw('max(consecutivo) as consecutivo'))
                ->first();

            $viatico = DB::table('viaticos')
                ->insert([
                    'consecutivo' => $consecutivo->consecutivo + 1,
                    'visita_id' => $data['visita_id'],
                    'alimentacion' => json_encode($data['alimentacion']),
                    'movilidad' => json_encode($data['movilidad']),
                    'otros' => json_encode($data['gastos']),
                    'valor' => $data['total'],
                    'cretead_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }

    public function edit(Request $request)
    {
        try {
            $data = $request->all();

            $viatico = DB::table('viaticos')
                ->where('id', $data['id'])
                ->update([
                    'visita_id' => $data['visita_id'],
                    'alimentacion' => json_encode($data['alimentacion']),
                    'movilidad' => json_encode($data['movilidad']),
                    'otros' => json_encode($data['gastos']),
                    'valor' => $data['total'],
                ]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = $request->all();

            $viatico = DB::table('viaticos')
                ->where('id', $data['id'])
                ->delete();

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }

    public function data(Request $request)
    {
        try {
            $data = $request->all();

            $viatico = DB::table('viaticos')
                ->select('viaticos.*', 'visitas_viaticos.destino', 'visitas_viaticos.consecutivo as cs', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('visitas_viaticos', 'visitas_viaticos.id', '=', 'viaticos.visita_id')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'viaticos.cretead_by')
                ->where('viaticos.id', $data['id'])
                ->first();

            $viatico->alimentacion = json_decode($viatico->alimentacion);
            $viatico->movilidad = json_decode($viatico->movilidad);
            $viatico->otros = json_decode($viatico->otros);

            return response()->json(['info' => 1, 'data' => $viatico]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }
}
