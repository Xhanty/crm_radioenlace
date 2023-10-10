<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Exports\RemisionesExport;
use App\Http\Controllers\Controller;
use App\Mail\RemisionMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class RemisionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_remisiones')) {
                if (!auth()->user()->hasPermissionTo('ver_remisiones')) {
                    return redirect()->route('home');
                }
            }

            $remisiones_pendientes = DB::table('remisiones')
                ->select(
                    'remisiones.id',
                    'remisiones.code',
                    'remisiones.asunto',
                    'remisiones.created_at',
                    'remisiones.firma_recibed',
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
                ->groupBy('remisiones.id', 'remisiones.firma_recibed', 'remisiones.code', 'remisiones.asunto', 'remisiones.created_at', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre')
                ->get();

            $remisiones_aprobadas = DB::table('remisiones')
                ->select(
                    'remisiones.id',
                    'remisiones.code',
                    'remisiones.asunto',
                    'remisiones.firma_recibed',
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
                ->groupBy('remisiones.id', 'remisiones.firma_recibed', 'remisiones.code', 'remisiones.asunto', 'remisiones.created_at', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre')
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
            $code = DB::table('remisiones')->select('code')->orderBy('id', 'desc')->first();

            if (isset($code)) {
                $code = $code->code + 1;
            } else {
                $code = 1;
            }

            $remision = DB::table('remisiones')
                ->insertGetId([
                    'code' => $code,
                    'cliente_id' => $request->cliente_id,
                    'asunto' => $request->asunto,
                    'observacion' => $request->nota,
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

    public function data(Request $request)
    {
        try {
            $remision = DB::table('remisiones')
                ->where('remisiones.id', $request->id)
                ->first();

            $productos = DB::table('detelle_remisiones')
                ->where('detelle_remisiones.remision_id', $request->id)
                ->get();

            return response()->json([
                'info' => 1,
                'remision' => $remision,
                'productos' => $productos,
            ]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al obtener los datos de la remisión',
            ]);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('detelle_remisiones')
                ->where('remision_id', $request->id)
                ->delete();

            DB::table('remisiones')
                ->where('id', $request->id)
                ->update([
                    'cliente_id' => $request->cliente_id,
                    'asunto' => $request->asunto,
                    'observacion' => $request->observacion,
                ]);

            if (isset($request->productos) && count($request->productos) > 0) {
                foreach ($request->productos as $producto) {
                    DB::table('detelle_remisiones')
                        ->insert([
                            'remision_id' => $request->id,
                            'producto_id' => $producto['producto_id'],
                            'cantidad' => $producto['cantidad'],
                            'descripcion' => $producto['descripcion']
                        ]);
                }
            }

            DB::commit();

            return response()->json([
                'info' => 1,
                'message' => 'Remisión editada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al editar la remisión',
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('detelle_remisiones')
                ->where('remision_id', $request->id)
                ->delete();

            DB::table('remisiones')
                ->where('id', $request->id)
                ->delete();

            DB::commit();

            return response()->json([
                'info' => 1,
                'message' => 'Remisión eliminada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al eliminar la remisión',
            ]);
        }
    }

    public function completar(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('remisiones')
                ->where('id', $request->id)
                ->update([
                    'status' => 1,
                ]);

            DB::commit();

            return response()->json([
                'info' => 1,
                'message' => 'Remisión completada correctamente',
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json([
                'info' => 0,
                'message' => 'Error al completar la remisión',
            ]);
        }
    }

    public function print(Request $request)
    {
        $id = $request->get('token');

        if (!$id || $id < 1) {
            return view('errors.404');
        }

        $remision = DB::table('remisiones')
            ->select('remisiones.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
            ->join('cliente', 'cliente.id', 'remisiones.cliente_id')
            ->where('remisiones.id', $id)
            ->first();

        if (!$remision) {
            return view('errors.404');
        }

        $productos = DB::table('detelle_remisiones')
            ->select('detelle_remisiones.*', 'productos.nombre as producto', 'productos.imagen', 'productos.modelo')
            ->join('productos', 'productos.id', 'detelle_remisiones.producto_id')
            ->where('detelle_remisiones.remision_id', $id)
            ->get();

        $creador = DB::table('empleados')->where('id', $remision->created_by)->first();

        $pdf = PDF::loadView('admin.comercial.pdf.remision', compact('remision', 'productos', 'creador'));

        return $pdf->stream($remision->razon_social . ' - (' . $remision->code . ') (' . date('d-m-Y', strtotime($remision->created_at)) . ').pdf');
    }

    public function email(Request $request)
    {
        try {
            $remision_id = $request->id;
            $emails = $request->emails;

            $remision = DB::table('remisiones')
                ->select('remisiones.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
                ->join('cliente', 'cliente.id', 'remisiones.cliente_id')
                ->where('remisiones.id', $remision_id)
                ->first();

            if (!$remision) {
                return response()->json(['info' => 0, 'error' => 'Error al enviar la remisión']);
            }

            $productos = DB::table('detelle_remisiones')
                ->select('detelle_remisiones.*', 'productos.nombre as producto', 'productos.imagen', 'productos.modelo')
                ->join('productos', 'productos.id', 'detelle_remisiones.producto_id')
                ->where('detelle_remisiones.remision_id', $remision_id)
                ->get();

            $creador = DB::table('empleados')->where('id', $remision->created_by)->first();

            $pdf = PDF::loadView('admin.comercial.pdf.remision', compact('remision', 'productos', 'creador'));

            $name = $remision->razon_social . ' - (' . $remision->code . ') (' . date('d-m-Y', strtotime($remision->created_at)) . ').pdf';

            $content = $pdf->download()->getOriginalContent();

            Storage::put('public/remisiones/' . $name, $content);

            $route = storage_path('app/public/remisiones/' . $name);

            $attach = [];

            array_push($attach, $route);

            Mail::to($emails)->send(new RemisionMail($route, $attach, $creador));

            unlink(storage_path('app/public/remisiones/' . $remision->razon_social . ' - (' . $remision->code . ') (' . date('d-m-Y', strtotime($remision->created_at)) . ').pdf'));

            return response()->json(['info' => 1, 'message' => 'Cotización enviada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al enviar la cotización']);
        }
    }

    public function remisones_excel()
    {
        $remisiones = DB::table('remisiones')
            ->select(
                'remisiones.code',
                'cliente.nit',
                'cliente.razon_social',
                'remisiones.asunto',
                'empleados.nombre as creador',
                'remisiones.created_at',
            )
            ->join('cliente', 'cliente.id', '=', 'remisiones.cliente_id')
            ->join('empleados', 'empleados.id', '=', 'remisiones.created_by')
            ->where('remisiones.status', 1)
            ->orderBy('remisiones.id', 'desc')
            //->groupBy('remisiones.id', 'remisiones.firma_recibed', 'remisiones.code', 'remisiones.asunto', 'remisiones.created_at', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre')
            ->get();

        return Excel::download(new RemisionesExport($remisiones), 'remisiones_completadas.xlsx');
    }
}
