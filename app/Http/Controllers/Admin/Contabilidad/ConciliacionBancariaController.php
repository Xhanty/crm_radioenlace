<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ConciliacionBancariaController extends Controller
{
    public function index()
    {
        /*if (!auth()->user()->hasPermissionTo('contabilidad_factura_venta')) {
            return redirect()->route('home');
        }*/

        $empleados = DB::table('empleados')
            ->select('id', 'nombre')
            ->where('status', 1)
            ->get();

        $conciliaciones = DB::table('conciliacion_bancaria')
            ->join('empleados', 'conciliacion_bancaria.created_by', '=', 'empleados.id')
            ->select('conciliacion_bancaria.*', 'empleados.nombre AS empleado')
            ->get();

        foreach ($conciliaciones as $conciliacion) {
            $conciliacion->detalle = DB::table('detalle_conciliacion_bancaria')
                ->where('conciliacion_id', $conciliacion->id)
                ->get();

            $conciliacion->valid_completar = 0;

            foreach ($conciliacion->detalle as $detalle) {
                if (!$detalle->documento || $detalle->documento == '') {
                } else {
                    $conciliacion->valid_completar = 1;
                }
            }
        }

        $clientes = DB::table('cliente')
            ->select('id', 'razon_social', 'nit')
            ->where('estado', 1)
            ->get();

        return view('admin.contabilidad.conciliacion_banc', compact('empleados', 'conciliaciones', 'clientes'));
    }

    public function valid(Request $request)
    {
        $mes  = $request->mes;
        $anio = $request->anio;

        $valid = DB::table('conciliacion_bancaria')
            ->where('mes', $mes)
            ->where('anio', $anio)
            ->count();

        if ($valid > 0) {
            return response()->json([
                'info' => 0,
            ]);
        } else {
            return response()->json([
                'info' => 1,
            ]);
        }
    }

    public function data(Request $request)
    {
        $id = $request->id;

        $data = DB::table('conciliacion_bancaria')
            ->where('id', $id)
            ->first();

        $data->detalle = DB::table('detalle_conciliacion_bancaria')
            ->select('detalle_conciliacion_bancaria.*', 'cliente.razon_social AS nombre_cliente', 'cliente.nit AS nit_cliente')
            ->leftJoin('cliente', 'detalle_conciliacion_bancaria.cliente', '=', 'cliente.id')
            ->where('detalle_conciliacion_bancaria.conciliacion_id', $id)
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $data,
        ]);
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $mes = $request->mes;
            $anio = $request->anio;
            $saldo_final = $request->saldo_final;
            $archivo = null;
            $data = json_decode($request->data);
            $created_at = date('Y-m-d H:i:s');
            $created_by = auth()->user()->id;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/conciliacion_bancaria/', $name);
                $archivo = $name;
            }

            $conciliacion_id = DB::table('conciliacion_bancaria')->insertGetId([
                'mes' => $mes,
                'anio' => $anio,
                'saldo_final' => $saldo_final,
                'archivo' => $archivo ?? null,
                'created_at' => $created_at,
                'created_by' => $created_by,
            ]);

            foreach ($data as $item) {
                $detalle = DB::table('detalle_conciliacion_bancaria')->insert([
                    'conciliacion_id' => $conciliacion_id,
                    'fecha' => $item->fecha,
                    'descripcion' => $item->descripcion,
                    'debito' => $item->debito ?? null,
                    'credito' => $item->credito ?? null,
                    'saldo' => $item->saldo,
                    //'documento' => $item->documento,
                    'cliente' => $item->cliente ?? null,
                    'nota' => $item->nota ?? null,
                    'created_at' => $created_at,
                    'created_by' => $created_by,
                ]);
            }

            DB::commit();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();

            $conciliacion_id = $request->id;
            $mes = $request->mes;
            $anio = $request->anio;
            $saldo_final = $request->saldo_final;
            $data = json_decode($request->data);
            $updated_by = auth()->user()->id;
            $updated_at = date('Y-m-d H:i:s');
            $archivo = null;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/conciliacion_bancaria/', $name);
                $archivo = $name;
            }

            DB::table('conciliacion_bancaria')
                ->where('id', $conciliacion_id)
                ->update([
                    'mes' => $mes,
                    'anio' => $anio,
                    'saldo_final' => $saldo_final,
                    'archivo' => $archivo ?? null,
                    'updated_by' => $updated_by,
                    'updated_at' => $updated_at,
                ]);

            DB::table('detalle_conciliacion_bancaria')
                ->where('conciliacion_id', $conciliacion_id)
                ->delete();

            foreach ($data as $item) {
                $detalle = DB::table('detalle_conciliacion_bancaria')->insert([
                    'conciliacion_id' => $conciliacion_id,
                    'fecha' => $item->fecha,
                    'descripcion' => $item->descripcion,
                    'debito' => $item->debito ?? '',
                    'credito' => $item->credito ?? '',
                    'saldo' => $item->saldo,
                    'documento' => $item->documento,
                    'nota' => $item->nota,
                    'created_at' => $updated_at,
                    'created_by' => $updated_by,
                ]);
            }

            DB::commit();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            return response()->json([
                'info' => 0,
            ]);
        }
    }
    
    public function completar(Request $request)
    {
        try {
            DB::beginTransaction();

            $conciliacion_id = $request->id;

            DB::table('conciliacion_bancaria')
                ->where('id', $conciliacion_id)
                ->update([
                    'visto_bueno' => 1,
                ]);

            DB::commit();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function rechazar(Request $request)
    {
        try {
            DB::beginTransaction();

            $conciliacion_id = $request->id;

            DB::table('conciliacion_bancaria')
                ->where('id', $conciliacion_id)
                ->update([
                    'visto_bueno' => 0,
                ]);

            DB::commit();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function eliminar(Request $request)
    {
        try {
            DB::beginTransaction();

            $conciliacion_id = $request->id;

            DB::table('conciliacion_bancaria')
                ->where('id', $conciliacion_id)
                ->delete();

            DB::table('detalle_conciliacion_bancaria')
                ->where('conciliacion_id', $conciliacion_id)
                ->delete();

            DB::commit();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
            ]);
        }
    }
}
