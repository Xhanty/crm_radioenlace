<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use App\Mail\OrdenCompraMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class OrdenCompraController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_orden_compra')) {
                return redirect()->route('home');
            }

            $ordenes_pendientes = DB::table('ordenes_compra')
                ->select('ordenes_compra.id', 'ordenes_compra.code', 'ordenes_compra.descripcion', 'ordenes_compra.created_at', 'cliente.razon_social', 'empleados.nombre as creador', DB::raw('COUNT(detalle_ordenes.id) as productos'))
                ->join('cliente', 'cliente.id', '=', 'ordenes_compra.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'ordenes_compra.created_by')
                ->join('detalle_ordenes', 'ordenes_compra.id', '=', 'detalle_ordenes.orden_id')
                ->where('ordenes_compra.status', 0)
                ->groupBy('ordenes_compra.id', 'ordenes_compra.code', 'ordenes_compra.descripcion', 'ordenes_compra.created_at', 'cliente.razon_social', 'empleados.nombre')
                ->get();

            $ordenes_completadas = DB::table('ordenes_compra')
                ->select('ordenes_compra.id', 'ordenes_compra.code', 'ordenes_compra.aprobado', 'ordenes_compra.descripcion', 'ordenes_compra.created_at', 'cliente.razon_social', 'empleados.nombre as creador', DB::raw('COUNT(detalle_ordenes.id) as productos'))
                ->join('cliente', 'cliente.id', '=', 'ordenes_compra.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'ordenes_compra.created_by')
                ->join('detalle_ordenes', 'ordenes_compra.id', '=', 'detalle_ordenes.orden_id')
                ->where('ordenes_compra.status', 1)
                ->groupBy('ordenes_compra.id', 'ordenes_compra.code', 'ordenes_compra.aprobado', 'ordenes_compra.descripcion', 'ordenes_compra.created_at', 'cliente.razon_social', 'empleados.nombre')
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social')
                ->where('estado', 1)
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            return view('admin.comercial.orden_compra', compact('ordenes_pendientes', 'ordenes_completadas', 'clientes', 'productos'));
        } catch (Exception $ex) {
            return $ex;
            return view('errors.500');
        }
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = $request->cliente;
            $descripcion_general = $request->descripcion_general;

            //PRODUCTOS
            $productos = $request->productos;
            $cantidades = $request->cantidades;
            $precios = $request->precios;
            $ivas = $request->ivas;
            $retenciones = $request->retenciones;
            $descripciones = $request->descripciones;

            $code = DB::table('ordenes_compra')->max('code') + 1;

            $cotizacion_id = DB::table("ordenes_compra")->insertGetId([
                'code' => $code,
                'cliente_id' => $cliente,
                'descripcion' => $descripcion_general ? $descripcion_general : null,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($cotizacion_id) {
                if ($productos) {
                    foreach ($productos as $key => $producto) {
                        DB::table("detalle_ordenes")->insert([
                            'orden_id' => $cotizacion_id,
                            'producto_id' => $producto,
                            'cantidad' => $cantidades[$key],
                            'precio' => $precios[$key],
                            'iva' => $ivas[$key],
                            'retencion' => $retenciones[$key],
                            'descripcion' => $descripciones[$key]
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Orden de compra creada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear la orden de compra']);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $cliente = $request->cliente;
            $descripcion_general = $request->descripcion_general;

            //PRODUCTOS
            $productos = $request->productos;
            $cantidades = $request->cantidades;
            $precios = $request->precios;
            $ivas = $request->ivas;
            $retenciones = $request->retenciones;
            $descripciones = $request->descripciones;

            DB::table("ordenes_compra")->where('id', $id)->update([
                'cliente_id' => $cliente,
                'descripcion' => $descripcion_general ? $descripcion_general : null
            ]);

            DB::table('detalle_ordenes')
                ->where('orden_id', $id)
                ->delete();

            if ($productos) {
                foreach ($productos as $key => $producto) {
                    DB::table("detalle_ordenes")->insert([
                        'orden_id' => $id,
                        'producto_id' => $producto,
                        'cantidad' => $cantidades[$key],
                        'precio' => $precios[$key],
                        'iva' => $ivas[$key],
                        'retencion' => $retenciones[$key],
                        'descripcion' => $descripciones[$key]
                    ]);
                }
            }

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Orden de compra creada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear la orden de compra']);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('detalle_ordenes')
                ->where('orden_id', $request->id)
                ->delete();

            DB::table('ordenes_compra')
                ->where('id', $request->id)
                ->delete();

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Orden de compra eliminada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la orden de compra']);
        }
    }

    public function completar(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('ordenes_compra')
                ->where('id', $request->id)
                ->update([
                    'status' => 1,
                ]);

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Orden de compra completada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al completar la orden de compra']);
        }
    }

    public function data(Request $request)
    {
        try {
            $orden = DB::table('ordenes_compra')
                ->where('ordenes_compra.id', $request->id)
                ->first();

            $orden->detalle = DB::table('detalle_ordenes')
                ->select('detalle_ordenes.*', 'productos.nombre as producto', 'productos.modelo')
                ->join('productos', 'productos.id', 'detalle_ordenes.producto_id')
                ->where('detalle_ordenes.orden_id', $request->id)
                ->get();

            return response()->json([
                'info' => 1,
                'orden' => $orden,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function print(Request $request)
    {
        $id = $request->get('token');

        if (!$id || $id < 1) {
            return view('errors.404');
        }

        $orden = DB::table('ordenes_compra')
            ->select('ordenes_compra.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
            ->join('cliente', 'cliente.id', 'ordenes_compra.cliente_id')
            ->where('ordenes_compra.id', $id)
            ->first();

        if (!$orden) {
            return view('errors.404');
        }

        $productos = DB::table('detalle_ordenes')
            ->select('detalle_ordenes.*', 'productos.nombre as producto', 'productos.modelo', 'productos.imagen')
            ->join('productos', 'productos.id', 'detalle_ordenes.producto_id')
            ->where('detalle_ordenes.orden_id', $id)
            ->get();

        $creador = DB::table('empleados')->where('id', $orden->created_by)->first();

        $pdf = PDF::loadView('admin.comercial.pdf.orden_compra', compact('orden', 'productos', 'creador'));

        return $pdf->stream($orden->razon_social . ' - (' . $orden->code . ') (' . date('d-m-Y', strtotime($orden->created_at)) . ').pdf');
    }

    public function send_email(Request $request)
    {
        try {
            $orden_id = $request->id;
            $emails = $request->emails;

            $orden = DB::table('ordenes_compra')
            ->select('ordenes_compra.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
            ->join('cliente', 'cliente.id', 'ordenes_compra.cliente_id')
            ->where('ordenes_compra.id', $orden_id)
            ->first();

            if (!$orden) {
                return response()->json(['info' => 0, 'error' => 'Error al enviar la orden de compra']);
            }

            $productos = DB::table('detalle_ordenes')
            ->select('detalle_ordenes.*', 'productos.nombre as producto', 'productos.modelo', 'productos.imagen')
            ->join('productos', 'productos.id', 'detalle_ordenes.producto_id')
            ->where('detalle_ordenes.orden_id', $orden_id)
            ->get();

            $creador = DB::table('empleados')->where('id', $orden->created_by)->first();

            $pdf = PDF::loadView('admin.comercial.pdf.orden_compra', compact('orden', 'productos', 'creador'));

            $name = $orden->razon_social . ' - (' . $orden->code . ') (' . date('d-m-Y', strtotime($orden->created_at)) . ').pdf';

            $content = $pdf->download()->getOriginalContent();

            Storage::put('public/ordenes_compra/' . $name, $content);

            $route = storage_path('app/public/ordenes_compra/' . $name);

            $attach = [];

            array_push($attach, $route);

            Mail::to($emails)->send(new OrdenCompraMail($route, $attach, $creador));

            unlink(storage_path('app/public/ordenes_compra/' . $orden->razon_social . ' - (' . $orden->code . ') (' . date('d-m-Y', strtotime($orden->created_at)) . ').pdf'));

            return response()->json(['info' => 1, 'message' => 'Cotización enviada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al enviar la cotización']);
        }
    }
}
