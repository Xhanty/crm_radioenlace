<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ActasReunionesController extends Controller
{
    public function index()
    {
        $actas = DB::table('actas_reuniones')->get();

        $usuarios = DB::table('empleados')->where('status', 1)->get();

        return view('actas.actas_reuniones', compact('usuarios', 'actas'));
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $fecha_elaboracion = $request->fecha_elaboracion;
            $hora_inicio = $request->hora_inicio;
            $hora_fin = $request->hora_fin;
            $area = $request->area;
            $asunto = $request->asunto;
            $asistentes = $request->asistentes;
            $observaciones = $request->observaciones;
            $adjunto = null;
            $data = json_decode($request->data, true);

            if ($request->hasFile('adjunto')) {
                $file = $request->file('adjunto');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/actas_reuniones/', $name);
                $adjunto = $name;
            }

            $id = DB::table("actas_reuniones")->insertGetId([
                'fecha_elaboracion' => $fecha_elaboracion,
                'hora_inicio' => $hora_inicio,
                'hora_fin' => $hora_fin,
                'area' => $area,
                'asunto' => $asunto,
                'asistentes' => $asistentes,
                'observaciones' => $observaciones,
                'adjunto' => $adjunto,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$id) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'Error al crear el acta']);
            }

            foreach ($data as $item) {
                $detalle = DB::table("actas_reuniones_detalles")->insert([
                    'acta_id' => $id,
                    'compromiso' => $item['compromiso'],
                    'asistente_id' => $item['asistente'],
                    'fecha' => $item['fecha'],
                ]);

                if (!$detalle) {
                    DB::rollBack();
                    return response()->json(['info' => 0, 'error' => 'Error al crear el detalle del acta']);
                }
            }

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Acta creada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('actas_reuniones_detalles')->where('acta_id', $request->id)->delete();
            DB::table('actas_reuniones')->where('id', $request->id)->delete();

            DB::commit();

            return response()->json(['info' => 1, 'mensaje' => 'Acta eliminada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function print(Request $request)
    {
        if (!$request->token) {
            return redirect()->route('actas_reuniones');
        }

        $acta = DB::table('actas_reuniones')
            ->select('actas_reuniones.*', 'empleados.nombre as nombre_empleado')
            ->join('empleados', 'empleados.id', '=', 'actas_reuniones.created_by')
            ->where('actas_reuniones.id', $request->token)
            ->first();

        if (!$acta) {
            return redirect()->route('actas_reuniones');
        }

        $detalle = DB::table('actas_reuniones_detalles')
            ->select('actas_reuniones_detalles.*', 'empleados.nombre as nombre_empleado')
            ->join('empleados', 'empleados.id', '=', 'actas_reuniones_detalles.asistente_id')
            ->where('actas_reuniones_detalles.acta_id', $request->token)
            ->get();

        $pdf = PDF::loadView('actas.pdf', compact('acta', 'detalle'));

        return $pdf->stream('Acta.pdf');
    }
}
