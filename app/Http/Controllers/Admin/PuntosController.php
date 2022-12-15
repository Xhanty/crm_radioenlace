<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PuntosController extends Controller
{
    public function index()
    {
        try {
            $puntos_pendientes = DB::table('puntos')
                ->join('empleados', 'empleados.id', '=', 'puntos.created_by')
                ->select('puntos.*', 'empleados.nombre')
                ->where('puntos.id_empleado', session('user'))
                ->where('puntos.status', 0)
                ->get();

            $puntos_cobrados = DB::table('puntos')
                ->join('empleados', 'empleados.id', '=', 'puntos.created_by')
                ->select('puntos.*', 'empleados.nombre')
                ->where('puntos.id_empleado', session('user'))
                ->where('puntos.status', 1)
                ->get();

            return view('admin.puntos.mis_puntos', compact('puntos_pendientes', 'puntos_cobrados'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gestionar_puntos()
    {
        try {
            $empleados = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', 1)
                ->get();

            $puntos_pendientes = DB::table('puntos')
                ->join('empleados as creador', 'creador.id', '=', 'puntos.created_by')
                ->join('empleados as empleado', 'empleado.id', '=', 'puntos.id_empleado')
                ->select('puntos.*', 'empleado.nombre as nombre_empleado', 'creador.nombre as nombre_creador')
                ->where('puntos.status', 0)
                ->get();

            $puntos_cobrados = DB::table('puntos')
                ->join('empleados as creador', 'creador.id', '=', 'puntos.created_by')
                ->join('empleados as empleado', 'empleado.id', '=', 'puntos.id_empleado')
                ->select('puntos.*', 'empleado.nombre as nombre_empleado', 'creador.nombre as nombre_creador')
                ->where('puntos.status', 1)
                ->get();

            return view('admin.puntos.gestionar_puntos', compact('puntos_pendientes', 'puntos_cobrados', 'empleados'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function puntos_add(Request $request)
    {
        try {
            $empleado = $request->empleado;
            $fecha = $request->fecha;
            $puntos = $request->puntos;
            $tipo = $request->tipo;
            $observacion = $request->observacion;

            DB::table('puntos')->insert([
                'id_empleado' => $empleado,
                'descripcion' => $observacion ? $observacion : '',
                'cantidad' => $puntos,
                'fecha' => $fecha,
                'tipo' => $tipo,
                'status' => 0,
                'created_by' => session('user'),
                'corte_by' => 0,
            ]);

            return response()->json(['info' => 1, 'success' => 'Puntos asignados correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function puntos_delete(Request $request)
    {
        try {
            $id = $request->id;

            DB::table('puntos')->where('id', $id)->delete();

            return response()->json(['info' => 1, 'success' => 'Puntos eliminados correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function puntos_data(Request $request)
    {
        try {
            $fechas1 = null;
            $fechas2 = null;

            if ($request->fechas) {
                $fechas1 = $request->fechas[0];
                $fechas2 = $request->fechas[1];
            }

            $empleado = $request->empleado;
            $tipo = $request->tipo;

            $puntos = DB::table('puntos')
                ->join('empleados as creador', 'creador.id', '=', 'puntos.created_by')
                ->join('empleados as empleado', 'empleado.id', '=', 'puntos.id_empleado')
                ->select('puntos.*', 'empleado.nombre as nombre_empleado', 'creador.nombre as nombre_creador')
                ->where(function ($query) use ($empleado) {
                    if ($empleado) {
                        $query->where('puntos.id_empleado', $empleado);
                    }
                })
                ->where('puntos.status', $tipo)
                ->where(function ($query) use ($fechas1, $fechas2) {
                    if ($fechas1 && $fechas2) {
                        $query->whereBetween('puntos.fecha', [$fechas1, $fechas2]);
                    }
                })
                ->get();

            return response()->json(['info' => 1, 'data' => $puntos]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function puntos_edit(Request $request)
    {
        try {
            $id = $request->id;
            $empleado = $request->empleado;
            $fecha = $request->fecha;
            $puntos = $request->puntos;
            $tipo = $request->tipo;
            $observacion = $request->observacion;

            DB::table('puntos')
                ->where('id', $id)
                ->update([
                    'id_empleado' => $empleado,
                    'descripcion' => $observacion ? $observacion : '',
                    'cantidad' => $puntos,
                    'fecha' => $fecha,
                    'tipo' => $tipo,
                ]);

            return response()->json(['info' => 1, 'success' => 'Puntos actualizados correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function corte_puntos(Request $request)
    {
        try {
            return response()->json(['info' => 1, 'success' => 'Puntos cortados correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
