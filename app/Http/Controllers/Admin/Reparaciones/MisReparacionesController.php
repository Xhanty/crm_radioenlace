<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MisReparacionesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_reparaciones_asignadas')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')->where('estado', 1)->get();
            $empleados = DB::table('empleados')->where('status', 1)->orderBy("nombre")->get();
            $categorias = DB::table('categorias_reparaciones')->get();
            $accesorios = DB::table('accesorios_reparaciones')->get();
            $productos = DB::table('productos')->where('status', 1)->get();
            $pendientes = DB::table('reparaciones')
                ->select('reparaciones.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado', 'detalle.modelo', 'detalle.serie')
                ->join('cliente', 'cliente.id', '=', 'reparaciones.cliente_id')
                ->leftJoin('detalle_reparaciones as detalle', 'detalle.reparacion_id', '=', 'reparaciones.id')
                ->leftJoin('empleados', 'empleados.id', '=', 'reparaciones.tecnico_id')
                ->where('reparaciones.status', 0)
                ->where('reparaciones.tecnico_id', auth()->user()->id)
                ->get();
            $finalizadas
                = DB::table('reparaciones')
                ->select('reparaciones.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado', 'detalle.modelo', 'detalle.serie')
                ->join('cliente', 'cliente.id', '=', 'reparaciones.cliente_id')
                ->leftJoin('detalle_reparaciones as detalle', 'detalle.reparacion_id', '=', 'reparaciones.id')
                ->leftJoin('empleados', 'empleados.id', '=', 'reparaciones.tecnico_id')
                ->where('reparaciones.status', 1)
                ->where('reparaciones.tecnico_id', auth()->user()->id)
                ->get();

            return view('admin.reparaciones.mis_reparaciones', compact('pendientes', 'finalizadas', 'clientes', 'empleados', 'categorias', 'accesorios', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function avances(Request $request)
    {
        try {
            $id = $request->id;

            $avances = DB::table('avances_reparaciones')
                ->select('avances_reparaciones.*', 'empleados.nombre as empleado')
                ->join('empleados', 'empleados.id', '=', 'avances_reparaciones.created_by')
                ->where('avances_reparaciones.reparacion_id', $id)
                ->get();

            return response()->json(['info' => 1, 'data' => $avances]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function avance_add(Request $request)
    {
        try {
            $id = $request->id;
            $avance = $request->observacion;
            $name_adjunto = null;

            if ($request->hasFile('adjunto')) {
                $file = $request->file('adjunto');
                $name_adjunto = time() . $file->getClientOriginalName();
                $file->move('images/anexos_reparaciones/', $name_adjunto);
            }

            DB::table('avances_reparaciones')->insert([
                'reparacion_id' => $id,
                'observacion' => $avance,
                'adjunto' => $name_adjunto,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return response()->json(['info' => 1, 'msg' => 'Avance agregado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function avance_delete(Request $request)
    {
        try {
            $id = $request->id;

            DB::table('avances_reparaciones')->where('id', $id)->delete();

            return response()->json(['info' => 1, 'msg' => 'Avance eliminado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function repuestos(Request $request)
    {
        try {
            $id = $request->id;

            $reparaciones = DB::table('repuestos_reparaciones')
                ->select('repuestos_reparaciones.*', 'productos.nombre as producto', 'empleados.nombre as empleado')
                ->join('productos', 'productos.id', '=', 'repuestos_reparaciones.producto_id')
                ->join('empleados', 'empleados.id', '=', 'repuestos_reparaciones.created_by')
                ->where('repuestos_reparaciones.reparacion_id', $id)
                ->get();

            return response()->json(['info' => 1, 'data' => $reparaciones]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'msg' => $ex->getMessage()]);
        }
    }
}

// (01) Almacen de radios en reparación (Solo en pendiente de reparación)