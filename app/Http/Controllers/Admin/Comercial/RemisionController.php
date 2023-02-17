<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemisionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_remisiones')) {
                return redirect()->route('home');
            }

            $remisiones_pendientes = DB::table('remisiones')
                ->select(
                    'remisiones.id',
                    'remisiones.code',
                    'remisiones.asunto',
                    'remisiones.created_at',
                    'cliente.razon_social',
                    'cliente.nit',
                    'empleados.nombre as creador',
                    DB::raw('count(detelle_remisiones.id) as cantidad_productos')
                )
                ->join('cliente', 'cliente.id', '=', 'remisiones.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'remisiones.created_by')
                ->leftJoin('detelle_remisiones', 'detelle_remisiones.remision_id', '=', 'remisiones.id')
                ->where('remisiones.status', 0)
                ->orderBy('remisiones.id', 'desc')
                ->groupBy('remisiones.id', 'remisiones.code', 'remisiones.asunto', 'remisiones.created_at', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre')
                ->get();

            $remisiones_aprobadas = DB::table('remisiones')
                ->select(
                    'remisiones.id',
                    'remisiones.code',
                    'remisiones.asunto',
                    'remisiones.created_at',
                    'cliente.razon_social',
                    'cliente.nit',
                    'empleados.nombre as creador',
                    DB::raw('count(detelle_remisiones.id) as cantidad_productos')
                )
                ->join('cliente', 'cliente.id', '=', 'remisiones.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'remisiones.created_by')
                ->leftJoin('detelle_remisiones', 'detelle_remisiones.remision_id', '=', 'remisiones.id')
                ->where('remisiones.status', 1)
                ->orderBy('remisiones.id', 'desc')
                ->groupBy('remisiones.id', 'remisiones.code', 'remisiones.asunto', 'remisiones.created_at', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre')
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social')
                ->where('estado', 1)
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            return view('admin.comercial.remisiones', compact('clientes', 'productos', 'remisiones_pendientes', 'remisiones_aprobadas'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $code = DB::table('remisiones')->max('code') + 1;

            $remision = DB::table('remisiones')
                ->insertGetId([
                    'code' => $code,
                    'cliente_id' => $request->cliente_id,
                    'asunto' => $request->asunto,
                    'observacion' => $request->observacion,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

            if (isset($request->productos) && count($request->productos) > 0) {
                foreach ($request->productos as $producto) {
                    DB::table('detelle_remisiones')
                        ->insert([
                            'remision_id' => $remision,
                            'producto_id' => $producto['producto_id'],
                            'cantidad' => $producto['cantidad'],
                            'descripcion' => $producto['descripcion']
                        ]);
                }
            }

            DB::commit();

            return response()->json([
                'info' => 1,
                'message' => 'Remisión creada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al crear la remisión',
            ]);
        }
    }
}
