<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReparacionesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_reparaciones')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')->where('estado', 1)->get();
            $empleados = DB::table('empleados')->where('status', 1)->orderBy("nombre")->get();
            $categorias = DB::table('categorias_reparaciones')->get();
            $accesorios = DB::table('accesorios_reparaciones')->get();
            $pendientes = DB::table('reparaciones')
                ->select('reparaciones.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado', DB::raw('count(detalle_reparaciones.id) as cantidad'))
                ->join('cliente', 'cliente.id', '=', 'reparaciones.cliente_id')
                ->leftJoin('detalle_reparaciones', 'detalle_reparaciones.reparacion_id', '=', 'reparaciones.id')
                ->leftJoin('empleados', 'empleados.id', '=', 'reparaciones.tecnico_id')
                ->where('reparaciones.status', 0)
                ->groupBy(
                    'reparaciones.id',
                    'reparaciones.tecnico_id',
                    'reparaciones.status',
                    'reparaciones.aprobado',
                    'reparaciones.fecha_terminado',
                    'reparaciones.token',
                    'reparaciones.cliente_id',
                    'reparaciones.correos',
                    'reparaciones.created_by',
                    'reparaciones.created_at',
                    'cliente.razon_social',
                    'cliente.nit',
                    'empleados.nombre'
                )
                ->get();
            $finalizadas
                = DB::table('reparaciones')
                ->select('reparaciones.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado', DB::raw('count(detalle_reparaciones.id) as cantidad'))
                ->join('cliente', 'cliente.id', '=', 'reparaciones.cliente_id')
                ->leftJoin('detalle_reparaciones', 'detalle_reparaciones.reparacion_id', '=', 'reparaciones.id')
                ->leftJoin('empleados', 'empleados.id', '=', 'reparaciones.tecnico_id')
                ->where('reparaciones.status', 1)
                ->groupBy(
                    'reparaciones.id',
                    'reparaciones.tecnico_id',
                    'reparaciones.status',
                    'reparaciones.aprobado',
                    'reparaciones.fecha_terminado',
                    'reparaciones.token',
                    'reparaciones.cliente_id',
                    'reparaciones.correos',
                    'reparaciones.created_by',
                    'reparaciones.created_at',
                    'cliente.razon_social',
                    'cliente.nit',
                    'empleados.nombre'
                )
                ->get();

            return view('admin.reparaciones.reparaciones', compact('categorias', 'accesorios', 'clientes', 'empleados', 'pendientes', 'finalizadas'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function generar_codigo()
    {
        $codigo = rand(1000000, 9999999);
        return "RP-" . $codigo;
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = $request->cliente;
            $correos = $request->correos;
            $reparaciones = json_decode($request->reparaciones);
            $token = $this->generar_codigo();

            $id_reparacion = DB::table('reparaciones')->insertGetId([
                'token' => $token,
                'cliente_id' => $cliente,
                'correos' => $correos ?? null,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            foreach ($reparaciones as $key => $value) {
                $nombre_foto = null;
                if ($anexo = $request->file('foto')) {
                    $nombre_foto = time() . $anexo->getClientOriginalName();
                    $anexo->move('images/reparaciones', $nombre_foto);
                }

                DB::table('detalle_reparaciones')->insert([
                    'reparacion_id' => $id_reparacion,
                    'categoria_id' => $value->categoria,
                    'modelo' => $value->modelo,
                    'serie' => $value->serie,
                    'encargado_id' => $value->encargado,
                    'accesorios' => json_encode($value->accesorios),
                    'observacion' => $value->observaciones,
                    'foto' => $nombre_foto,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
            DB::commit();
            return response()->json(['info' => 1, 'message' => 'Reparación registrada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'message' => 'Error al registrar la reparación.']);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $cliente = $request->cliente;
            $correos = $request->correos;
            $reparaciones = json_decode($request->reparaciones);

            DB::table('reparaciones')->where('id', $id)->update([
                'cliente_id' => $cliente,
                'correos' => $correos ?? null,
            ]);

            DB::table('detalle_reparaciones')->where('reparacion_id', $id)->delete();

            foreach ($reparaciones as $key => $value) {
                $nombre_foto = null;
                if ($anexo = $request->file('foto')) {
                    $nombre_foto = time() . $anexo->getClientOriginalName();
                    $anexo->move('images/reparaciones', $nombre_foto);
                }

                DB::table('detalle_reparaciones')->insert([
                    'reparacion_id' => $id,
                    'categoria_id' => $value->categoria,
                    'modelo' => $value->modelo,
                    'serie' => $value->serie,
                    'encargado_id' => $value->encargado,
                    'accesorios' => json_encode($value->accesorios),
                    'observacion' => $value->observaciones,
                    'foto' => $nombre_foto,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            DB::commit();
            return response()->json(['info' => 1, 'message' => 'Reparación registrada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'message' => 'Error al actualizar la reparación.']);
        }
    }

    public function info(Request $request)
    {
        try {
            $reparacion = DB::table('reparaciones')->where('id', $request->id)->first();
            $detalle = DB::table('detalle_reparaciones')->where('reparacion_id', $request->id)->get();
            return response()->json(['info' => 1, 'data' => $reparacion, 'detalle' => $detalle]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'message' => 'Error al obtener la información.']);
        }
    }

    public function completar(Request $request)
    {
        try {
            DB::table('reparaciones')->where('id', $request->id)->update([
                'status' => 1,
            ]);
            return response()->json(['info' => 1, 'message' => 'Reparación finalizada correctamente.']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'message' => 'Error al finalizar la reparación.']);
        }
    }

    public function aprobado(Request $request)
    {
        try {
            DB::table('reparaciones')->where('id', $request->id)->update([
                'aprobado' => 1,
                'fecha_terminado' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['info' => 1, 'message' => 'Reparación finalizada correctamente.']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'message' => 'Error al finalizar la reparación.']);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::table('reparaciones')->where('id', $request->id)->delete();
            DB::table('detalle_reparaciones')->where('reparacion_id', $request->id)->delete();
            DB::table('avances_reparaciones')->where('reparacion_id', $request->id)->delete();
            return response()->json(['info' => 1, 'message' => 'Reparación eliminada correctamente.']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'message' => 'Error al eliminar la reparación.']);
        }
    }

    public function tecnico(Request $request)
    {
        try {
            DB::table('reparaciones')->where('id', $request->id)->update([
                'tecnico_id' => $request->tecnico
            ]);
            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'message' => 'Error al obtener la información.']);
        }
    }
}
