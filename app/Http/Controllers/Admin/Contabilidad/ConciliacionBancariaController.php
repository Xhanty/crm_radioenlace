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

        return view('admin.contabilidad.conciliacion_banc', compact('empleados', 'conciliaciones'));
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
            ->where('conciliacion_id', $id)
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function add(Request $request)
    {
        $mes = $request->mes;
        $anio = $request->anio;
        $saldo_final = $request->saldo_final;
        $archivo = null;
        $data = $request->data;
        $created_at = date('Y-m-d H:i:s');
        $created_by = auth()->user()->id;

        $conciliacion_id = DB::table('conciliacion_bancaria')->insertGetId([
            'mes' => $mes,
            'anio' => $anio,
            'saldo_final' => $saldo_final,
            'archivo' => $archivo,
            'created_by' => $created_by,
            'created_at' => $created_at,
        ]);

        foreach ($data as $item) {
            $detalle = DB::table('detalle_conciliacion_bancaria')->insert([
                'conciliacion_id' => $conciliacion_id,
                'fecha' => $item['fecha'],
                'descripcion' => $item['descripcion'],
                'debito' => $item['debito'],
                'credito' => $item['credito'],
                'saldo' => $item['saldo'],
                'documento' => $item['documento'],
                'nota' => $item['nota'],
                'created_at' => $created_at,
                'created_by' => $created_by,
            ]);
        }

        return response()->json([
            'info' => 1,
        ]);
    }

    public function edit(Request $request)
    {
    }

    public function completar(Request $request)
    {
    }
}