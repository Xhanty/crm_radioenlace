<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use App\Mail\Cotizacion;
use App\Mail\CotizacionMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class CotizacionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_cotizaciones')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social')
                ->where('estado', 1)
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $cotizaciones_pendientes = DB::table('cotizaciones')
                ->select(
                    'cotizaciones.id',
                    'cotizaciones.code',
                    'cotizaciones.created_at',
                    'cotizaciones.descripcion',
                    'cotizaciones.status',
                    'cliente.razon_social',
                    'empleados.nombre as creador',
                    DB::raw('COUNT(detalle_cotizaciones.id) as productos')
                )
                ->join('detalle_cotizaciones', 'cotizaciones.id', '=', 'detalle_cotizaciones.cotizacion_id')
                ->join('cliente', 'cotizaciones.cliente_id', '=', 'cliente.id')
                ->join('empleados', 'cotizaciones.created_by', '=', 'empleados.id')
                ->where('cotizaciones.status', 0)
                ->groupBy('cotizaciones.id', 'cotizaciones.code', 'cotizaciones.created_at', 'cotizaciones.descripcion', 'cotizaciones.status', 'cliente.razon_social', 'empleados.nombre')
                ->get();

            $cotizaciones_aprobadas = DB::table('cotizaciones')
                ->select(
                    'cotizaciones.id',
                    'cotizaciones.code',
                    'cotizaciones.created_at',
                    'cotizaciones.descripcion',
                    'cotizaciones.status',
                    'cliente.razon_social',
                    'empleados.nombre as creador',
                    DB::raw('COUNT(detalle_cotizaciones.id) as productos')
                )
                ->join('detalle_cotizaciones', 'cotizaciones.id', '=', 'detalle_cotizaciones.cotizacion_id')
                ->join('cliente', 'cotizaciones.cliente_id', '=', 'cliente.id')
                ->join('empleados', 'cotizaciones.created_by', '=', 'empleados.id')
                ->where('cotizaciones.status', 1)
                ->groupBy('cotizaciones.id', 'cotizaciones.code', 'cotizaciones.created_at', 'cotizaciones.descripcion', 'cotizaciones.status', 'cliente.razon_social', 'empleados.nombre')
                ->get();

            return view('admin.comercial.cotizaciones', compact('clientes', 'productos', 'cotizaciones_pendientes', 'cotizaciones_aprobadas'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function data(Request $request)
    {
        try {
            $cotizacion = DB::table('cotizaciones')
                ->where('cotizaciones.id', $request->id)
                ->first();

            $cotizacion->detalle = DB::table('detalle_cotizaciones')
                ->select('detalle_cotizaciones.*', 'productos.nombre as producto')
                ->join('productos', 'productos.id', 'detalle_cotizaciones.producto_id')
                ->where('detalle_cotizaciones.cotizacion_id', $request->id)
                ->get();

            return response()->json([
                'info' => 1,
                'data' => $cotizacion,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = $request->cliente;
            $duracion = $request->duracion;
            $validez = $request->validez;
            $tiempo_entrega = $request->tiempo_entrega;
            $forma_pago = $request->forma_pago;
            $descuento = $request->descuento;
            $descripcion_general = $request->descripcion_general;
            $incluye = $request->incluye;

            //PRODUCTOS
            $productos = $request->productos;
            $divisas = $request->divisas;
            $cantidades = $request->cantidades;
            $tipos = $request->tipos;
            $precios = $request->precios;
            $descripciones = $request->descripciones;

            $code = DB::table('cotizaciones')->max('code') + 1;

            $cotizacion_id = DB::table("cotizaciones")->insertGetId([
                'code' => $code,
                'cliente_id' => $cliente,
                'descripcion' => $descripcion_general ? $descripcion_general : null,
                'incluye' => $incluye ? $incluye : null,
                'validez' => $validez,
                'forma_pago' => $forma_pago,
                'duracion' => $duracion,
                'tiempo_entrega' => $tiempo_entrega ? $tiempo_entrega : null,
                'descuento' => $descuento ? $descuento : null,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($cotizacion_id) {
                if ($productos) {
                    foreach ($productos as $key => $producto) {
                        DB::table("detalle_cotizaciones")->insert([
                            'producto_id' => $producto,
                            'cotizacion_id' => $cotizacion_id,
                            'tipo_divisa' => $divisas[$key],
                            'cantidad' => $cantidades[$key],
                            'tipo_transaccion' => $tipos[$key],
                            'precio' => $precios[$key],
                            'descripcion' => $descripciones[$key] ? $descripciones[$key] : null,
                            'created_by' => auth()->user()->id,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Cotización creada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear la cotización']);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $cotizacion = $request->id;
            $cliente = $request->cliente;
            $duracion = $request->duracion;
            $validez = $request->validez;
            $tiempo_entrega = $request->tiempo_entrega;
            $forma_pago = $request->forma_pago;
            $descuento = $request->descuento;
            $descripcion_general = $request->descripcion_general;
            $incluye = $request->incluye;

            //PRODUCTOS
            $productos = $request->productos;
            $divisas = $request->divisas;
            $cantidades = $request->cantidades;
            $tipos = $request->tipos;
            $precios = $request->precios;
            $descripciones = $request->descripciones;

            DB::table("cotizaciones")->where('id', $cotizacion)->update([
                'cliente_id' => $cliente,
                'descripcion' => $descripcion_general ? $descripcion_general : null,
                'incluye' => $incluye ? $incluye : null,
                'validez' => $validez,
                'forma_pago' => $forma_pago,
                'duracion' => $duracion,
                'tiempo_entrega' => $tiempo_entrega ? $tiempo_entrega : null,
                'descuento' => $descuento ? $descuento : null
            ]);

            DB::table("detalle_cotizaciones")->where('cotizacion_id', $cotizacion)->delete();

            if ($productos) {
                foreach ($productos as $key => $producto) {
                    DB::table("detalle_cotizaciones")->insert([
                        'producto_id' => $producto,
                        'cotizacion_id' => $cotizacion,
                        'tipo_divisa' => $divisas[$key],
                        'cantidad' => $cantidades[$key],
                        'tipo_transaccion' => $tipos[$key],
                        'precio' => $precios[$key],
                        'descripcion' => $descripciones[$key] ? $descripciones[$key] : null,
                        'created_by' => auth()->user()->id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Cotización actualizada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar la cotización']);
        }
    }

    public function completar(Request $request)
    {
        try {
            $cotizacion = $request->id;

            DB::table("cotizaciones")->where('id', $cotizacion)->update([
                'status' => 1,
            ]);

            return response()->json(['info' => 1, 'message' => 'Cotización completada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al completar la cotización']);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $cotizacion = $request->id;

            DB::table("detalle_cotizaciones")->where('cotizacion_id', $cotizacion)->delete();
            DB::table("cotizaciones")->where('id', $cotizacion)->delete();

            DB::commit();

            return response()->json(['info' => 1, 'message' => 'Cotización eliminada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la cotización']);
        }
    }

    public function print(Request $request)
    {
        $id = $request->get('token');

        if (!$id || $id < 1) {
            return view('errors.404');
        }

        $cotizacion = DB::table('cotizaciones')
            ->select('cotizaciones.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
            ->join('cliente', 'cliente.id', 'cotizaciones.cliente_id')
            ->where('cotizaciones.id', $id)
            ->first();

        if (!$cotizacion) {
            return view('errors.404');
        }

        $productos = DB::table('detalle_cotizaciones')
            ->select('detalle_cotizaciones.*', 'productos.nombre as producto', 'productos.imagen')
            ->join('productos', 'productos.id', 'detalle_cotizaciones.producto_id')
            ->where('detalle_cotizaciones.cotizacion_id', $id)
            ->orderByRaw('detalle_cotizaciones.precio * 1 DESC')
            ->get();

        $creador = DB::table('empleados')->where('id', $cotizacion->created_by)->first();

        $pdf = PDF::loadView('admin.comercial.pdf.cotizacion', compact('cotizacion', 'productos', 'creador'));

        return $pdf->stream($cotizacion->razon_social . ' - (' . $cotizacion->code . ') (' . date('d-m-Y', strtotime($cotizacion->created_at)) . ').pdf');
    }

    public function send(Request $request)
    {
        try {
            $cotizacion = $request->id;
            $emails = $request->emails;

            $cotizacion = DB::table('cotizaciones')
                ->select('cotizaciones.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
                ->join('cliente', 'cliente.id', 'cotizaciones.cliente_id')
                ->where('cotizaciones.id', $cotizacion)
                ->first();

            if (!$cotizacion) {
                return response()->json(['info' => 0, 'error' => 'Error al enviar la cotización']);
            }

            $productos = DB::table('detalle_cotizaciones')
                ->select('detalle_cotizaciones.*', 'productos.nombre as producto', 'productos.imagen')
                ->join('productos', 'productos.id', 'detalle_cotizaciones.producto_id')
                ->where('detalle_cotizaciones.cotizacion_id', $cotizacion->id)
                ->orderByRaw('detalle_cotizaciones.precio * 1 DESC')
                ->get();

            $creador = DB::table('empleados')->where('id', $cotizacion->created_by)->first();
            
            //$pdf = PDF::loadView('admin.comercial.pdf.cotizacion', compact('cotizacion', 'productos'))

            Mail::to($emails)->send(new CotizacionMail($cotizacion, $productos));

            return response()->json(['info' => 1, 'message' => 'Cotización enviada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al enviar la cotización']);
        }
    }
}
