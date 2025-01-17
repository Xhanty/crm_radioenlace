<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Exports\CotizacionExport;
use App\Http\Controllers\Controller;
use App\Mail\CotizacionMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class CotizacionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_cotizaciones')) {
                return redirect()->route('home');
            }

            $usuarios_cotizaciones = [];

            $permiso_ver = DB::table("permisos_new")
                ->select("cotizaciones")
                ->where("empleado", auth()->user()->id)
                ->where("modulo", "gestionar_cotizaciones")
                ->first();

            if ($permiso_ver && $permiso_ver->cotizaciones) {
                foreach (json_decode($permiso_ver->cotizaciones) as $usuario) {
                    array_push($usuarios_cotizaciones, $usuario);
                }
            }


            array_push($usuarios_cotizaciones, auth()->user()->id);

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
                    'cotizaciones.fecha_revision',
                    'cliente.razon_social',
                    'empleados.nombre as creador',
                    DB::raw('COUNT(detalle_cotizaciones.id) as productos')
                )
                ->join('detalle_cotizaciones', 'cotizaciones.id', '=', 'detalle_cotizaciones.cotizacion_id')
                ->join('cliente', 'cotizaciones.cliente_id', '=', 'cliente.id')
                ->join('empleados', 'cotizaciones.created_by', '=', 'empleados.id')
                ->where('cotizaciones.aprobado', 0)
                ->whereIn('cotizaciones.created_by', $usuarios_cotizaciones)
                ->whereNull('detalle_cotizaciones.titulo')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('history_cotizaciones')
                        ->whereRaw('history_cotizaciones.cotizacion_id = cotizaciones.id')
                        ->where('history_cotizaciones.tipo', 3);
                })
                ->orderBy('cotizaciones.id', 'desc')
                ->groupBy('cotizaciones.id', 'cotizaciones.code', 'cotizaciones.created_at', 'cotizaciones.descripcion', 'cotizaciones.status', 'cotizaciones.fecha_revision', 'cliente.razon_social', 'empleados.nombre')
                ->orderBy('cotizaciones.id', 'desc')
                ->get();

            $cotizaciones_para_aprobar = DB::table('cotizaciones')
                ->select(
                    'cotizaciones.id',
                    'cotizaciones.code',
                    'cotizaciones.created_at',
                    'cotizaciones.descripcion',
                    'cotizaciones.status',
                    'cotizaciones.aprobado',
                    'cotizaciones.fecha_revision',
                    'cliente.razon_social',
                    'empleados.nombre as creador',
                    DB::raw('COUNT(detalle_cotizaciones.id) as productos')
                )
                ->join('detalle_cotizaciones', 'cotizaciones.id', '=', 'detalle_cotizaciones.cotizacion_id')
                ->join('cliente', 'cotizaciones.cliente_id', '=', 'cliente.id')
                ->join('empleados', 'cotizaciones.created_by', '=', 'empleados.id')
                ->join("history_cotizaciones", "cotizaciones.id", "=", "history_cotizaciones.cotizacion_id")
                ->where('cotizaciones.aprobado', 0)
                ->where('history_cotizaciones.tipo', 3)
                ->whereNull('detalle_cotizaciones.titulo')
                ->orderBy('cotizaciones.aprobado', 'asc')
                ->groupBy('cotizaciones.id', 'cotizaciones.code', 'cotizaciones.created_at', 'cotizaciones.descripcion', 'cotizaciones.status', 'cotizaciones.fecha_revision', 'cotizaciones.aprobado', 'cliente.razon_social', 'empleados.nombre')
                ->orderBy('cotizaciones.id', 'desc')
                ->get();

            $cotizaciones_aprobadas = DB::table('cotizaciones')
                ->select(
                    'cotizaciones.id',
                    'cotizaciones.code',
                    'cotizaciones.created_at',
                    'cotizaciones.descripcion',
                    'cotizaciones.status',
                    'cotizaciones.aprobado',
                    'cotizaciones.fecha_revision',
                    'cliente.razon_social',
                    'empleados.nombre as creador',
                    DB::raw('COUNT(detalle_cotizaciones.id) as productos')
                )
                ->join('detalle_cotizaciones', 'cotizaciones.id', '=', 'detalle_cotizaciones.cotizacion_id')
                ->join('cliente', 'cotizaciones.cliente_id', '=', 'cliente.id')
                ->join('empleados', 'cotizaciones.created_by', '=', 'empleados.id')
                ->where('cotizaciones.aprobado', '>', 0)
                ->whereNull('detalle_cotizaciones.titulo')
                ->whereIn('cotizaciones.created_by', $usuarios_cotizaciones)
                ->orderBy('cotizaciones.aprobado', 'asc')
                ->groupBy('cotizaciones.id', 'cotizaciones.code', 'cotizaciones.created_at', 'cotizaciones.descripcion', 'cotizaciones.status', 'cotizaciones.fecha_revision', 'cotizaciones.aprobado', 'cliente.razon_social', 'empleados.nombre')
                ->orderBy('cotizaciones.id', 'desc')
                ->get();

            return view('admin.comercial.cotizaciones', compact('clientes', 'productos', 'cotizaciones_pendientes', 'cotizaciones_aprobadas', 'cotizaciones_para_aprobar'));
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
                ->leftJoin('productos', 'productos.id', 'detalle_cotizaciones.producto_id')
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
            $garantia = $request->garantia;
            $envio = $request->envio;

            //PRODUCTOS
            $productos = $request->productos;
            $divisas = $request->divisas;
            $cantidades = $request->cantidades;
            $tipos = $request->tipos;
            $precios = $request->precios;
            $ivas = $request->ivas;
            $retenciones = $request->retenciones;
            $tipo_pago = $request->tipo_pago;
            $img_grandes = $request->img_grande;
            $descripciones = $request->descripciones;

            // TITULOS
            $titulos = $request->titulos;

            //ORDEN
            $order = $request->order;

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
                'garantia' => $garantia ? $garantia : null,
                'envio' => $envio ? $envio : null,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $key_productos = 0;
            $key_titulos = 0;

            if ($cotizacion_id) {
                if ($order) {
                    foreach ($order as $key => $value) {
                        if ($value == 0) {
                            DB::table("detalle_cotizaciones")->insert([
                                'producto_id' => $productos[$key_productos],
                                'cotizacion_id' => $cotizacion_id,
                                'tipo_divisa' => $divisas[$key_productos],
                                'cantidad' => $cantidades[$key_productos],
                                'tipo_transaccion' => $tipos[$key_productos],
                                'precio' => $precios[$key_productos],
                                'iva' => $ivas[$key_productos] ? $ivas[$key_productos] : 0,
                                'retencion' => $retenciones[$key_productos] ? $retenciones[$key_productos] : 0,
                                'tipo_pago' => $tipo_pago[$key_productos],
                                'img_grande' => $img_grandes[$key_productos] ? $img_grandes[$key_productos] : 0,
                                'descripcion' => $descripciones[$key_productos] ? $descripciones[$key_productos] : null,
                                'created_by' => auth()->user()->id,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            $key_productos++;
                        } else if ($value == 1) {
                            DB::table("detalle_cotizaciones")->insert([
                                'titulo' => $titulos[$key_titulos],
                                'cotizacion_id' => $cotizacion_id,
                                'tipo_divisa' => null,
                                'cantidad' => null,
                                'tipo_transaccion' => null,
                                'precio' => null,
                                'iva' => 0,
                                'retencion' => 0,
                                'tipo_pago' => 0,
                                'img_grande' => 0,
                                'descripcion' => null,
                                'created_by' => auth()->user()->id,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            $key_titulos++;
                        }
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
            $garantia = $request->garantia;
            $envio = $request->envio;

            //PRODUCTOS
            $productos = $request->productos;
            $divisas = $request->divisas;
            $cantidades = $request->cantidades;
            $tipos = $request->tipos;
            $precios = $request->precios;
            $ivas = $request->ivas;
            $retenciones = $request->retenciones;
            $tipo_pago = $request->tipo_pago;
            $img_grandes = $request->img_grande;
            $descripciones = $request->descripciones;

            // TITULOS
            $titulos = $request->titulos;

            //ORDEN
            $order = $request->order;

            DB::table("cotizaciones")->where('id', $cotizacion)->update([
                'cliente_id' => $cliente,
                'descripcion' => $descripcion_general ? $descripcion_general : null,
                'incluye' => $incluye ? $incluye : null,
                'validez' => $validez,
                'forma_pago' => $forma_pago,
                'duracion' => $duracion,
                'tiempo_entrega' => $tiempo_entrega ? $tiempo_entrega : null,
                'descuento' => $descuento ? $descuento : null,
                'garantia' => $garantia ? $garantia : null,
                'envio' => $envio ? $envio : null,
            ]);

            DB::table("detalle_cotizaciones")->where('cotizacion_id', $cotizacion)->delete();

            if ($productos) {
                $key_productos = 0;
                $key_titulos = 0;

                if ($order) {
                    foreach ($order as $key => $value) {
                        if ($value == 0) {
                            DB::table("detalle_cotizaciones")->insert([
                                'producto_id' => $productos[$key_productos],
                                'cotizacion_id' => $cotizacion,
                                'tipo_divisa' => $divisas[$key_productos],
                                'cantidad' => $cantidades[$key_productos],
                                'tipo_transaccion' => $tipos[$key_productos],
                                'precio' => $precios[$key_productos],
                                'iva' => $ivas[$key_productos] ? $ivas[$key_productos] : 0,
                                'retencion' => $retenciones[$key_productos] ? $retenciones[$key_productos] : 0,
                                'tipo_pago' => $tipo_pago[$key_productos],
                                'img_grande' => $img_grandes[$key_productos] ? $img_grandes[$key_productos] : 0,
                                'descripcion' => $descripciones[$key_productos] ? $descripciones[$key_productos] : null,
                                'created_by' => auth()->user()->id,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            $key_productos++;
                        } else if ($value == 1) {
                            DB::table("detalle_cotizaciones")->insert([
                                'titulo' => $titulos[$key_titulos],
                                'cotizacion_id' => $cotizacion,
                                'tipo_divisa' => null,
                                'cantidad' => null,
                                'tipo_transaccion' => null,
                                'precio' => null,
                                'iva' => 0,
                                'retencion' => 0,
                                'tipo_pago' => 0,
                                'img_grande' => 0,
                                'descripcion' => null,
                                'created_by' => auth()->user()->id,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            $key_titulos++;
                        }
                    }
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
            ->select('detalle_cotizaciones.*', 'productos.nombre as producto', 'productos.imagen', 'productos.modelo')
            ->leftJoin('productos', 'productos.id', 'detalle_cotizaciones.producto_id')
            ->where('detalle_cotizaciones.cotizacion_id', $id)
            ->get();

        $creador = DB::table('empleados')->where('id', $cotizacion->created_by)->first();

        $pdf = PDF::loadView('admin.comercial.pdf.cotizacion', compact('cotizacion', 'productos', 'creador'));

        return $pdf->stream($cotizacion->razon_social . ' - (' . $cotizacion->code . ') (' . date('d-m-Y', strtotime($cotizacion->created_at)) . ').pdf');
    }

    public function send(Request $request)
    {
        try {
            $cotizacion_id = $request->id;
            $emails = $request->emails;

            $cotizacion = DB::table('cotizaciones')
                ->select('cotizaciones.*', 'cliente.razon_social', 'cliente.nit', 'cliente.ciudad', 'cliente.codigo_verificacion')
                ->join('cliente', 'cliente.id', 'cotizaciones.cliente_id')
                ->where('cotizaciones.id', $cotizacion_id)
                ->first();

            if (!$cotizacion) {
                return response()->json(['info' => 0, 'error' => 'Error al enviar la cotización']);
            }

            $productos = DB::table('detalle_cotizaciones')
                ->select('detalle_cotizaciones.*', 'productos.nombre as producto', 'productos.imagen', 'productos.modelo')
                ->join('productos', 'productos.id', 'detalle_cotizaciones.producto_id')
                ->where('detalle_cotizaciones.cotizacion_id', $cotizacion->id)
                ->orderByRaw('detalle_cotizaciones.precio * 1 DESC')
                ->get();

            $creador = DB::table('empleados')->where('id', $cotizacion->created_by)->first();

            $pdf = PDF::loadView('admin.comercial.pdf.cotizacion', compact('cotizacion', 'productos', 'creador'));

            $name = $cotizacion->razon_social . ' - (' . $cotizacion->code . ') (' . date('d-m-Y', strtotime($cotizacion->created_at)) . ').pdf';

            $content = $pdf->download()->getOriginalContent();

            Storage::put('public/cotizaciones/' . $name, $content);

            $route = storage_path('app/public/cotizaciones/' . $name);

            $attach = [];

            array_push($attach, $route);

            Mail::to($emails)->send(new CotizacionMail($route, $attach, $creador));

            unlink(storage_path('app/public/cotizaciones/' . $cotizacion->razon_social . ' - (' . $cotizacion->code . ') (' . date('d-m-Y', strtotime($cotizacion->created_at)) . ').pdf'));

            // Guardar la fecha de recordatorio
            DB::table("notificaciones_cotizaciones")->insert([
                'cotizacion_id' => $cotizacion_id,
                'fecha_recordatorio' => $request->fecha_recordatorio,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['info' => 1, 'message' => 'Cotización enviada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al enviar la cotización']);
        }
    }

    public function aprobacion(Request $request)
    {
        try {
            $cotizacion = $request->id;
            $aprobado = $request->aprobado;

            DB::table("cotizaciones")->where('id', $cotizacion)->update([
                'aprobado' => $aprobado,
            ]);

            return response()->json(['info' => 1, 'message' => 'Cotización aprobada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al aprobar la cotización']);
        }
    }

    public function update_revision(Request $request)
    {
        try {
            $cotizacion = $request->id;
            $fecha_revision = $request->fecha_revision;

            DB::table("cotizaciones")->where('id', $cotizacion)->update([
                'fecha_revision' => $fecha_revision,
            ]);

            return response()->json(['info' => 1, 'message' => 'Fecha de revisión actualizada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar la fecha de revisión']);
        }
    }

    public function history(Request $request)
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_cotizaciones')) {
                return redirect()->route('home');
            }

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

            $cotizacion->observaciones = DB::table('history_cotizaciones')
                ->select('history_cotizaciones.*', 'empleados.nombre AS creador')
                ->join('empleados', 'empleados.id', 'history_cotizaciones.created_by')
                ->where('history_cotizaciones.cotizacion_id', $id)
                ->orderBy('history_cotizaciones.id', 'DESC')
                ->get();

            return view('admin.comercial.history_cotizaciones', compact('cotizacion'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function history_add(Request $request)
    {
        try {
            $cotizacion = $request->id;
            $tipo = $request->tipo;
            $observacion = $request->observacion;
            $new_name = null;

            if ($anexo = $request->file('adjunto')) {
                $new_name = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/cotizaciones', $new_name);
            }

            DB::table("history_cotizaciones")->insert([
                'cotizacion_id' => $cotizacion,
                'tipo' => $tipo,
                'observacion' => $observacion,
                'adjunto' => $new_name,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['info' => 1, 'message' => 'Observación agregada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al agregar la observación']);
        }
    }

    public function history_contable(Request $request)
    {
        try {
            $id = $request->id;
            $tipo = $request->tipo;
            $check = $request->check;

            if ($tipo == 'comercial') {
                DB::table("history_cotizaciones")->where('id', $id)->update([
                    'check_comercial' => $check,
                ]);
            } else if ($tipo == 'gerencia') {
                DB::table("history_cotizaciones")->where('id', $id)->update([
                    'check_gerencia' => $check,
                ]);
            } else if ($tipo == 'tesoreria') {
                DB::table("history_cotizaciones")->where('id', $id)->update([
                    'check_tesoreria' => $check,
                ]);
            } else if ($tipo == 'contable') {
                DB::table("history_cotizaciones")->where('id', $id)->update([
                    'check_contable' => $check,
                ]);
            } else if ($tipo == 'pago') {
                DB::table("history_cotizaciones")->where('id', $id)->update([
                    'check_pago' => $check,
                ]);
            }

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function history_delete(Request $request)
    {
        try {
            $id = $request->id;

            DB::table("history_cotizaciones")->where('id', $id)->delete();

            return response()->json(['info' => 1, 'message' => 'Observación eliminada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la observación']);
        }
    }

    public function history_edit(Request $request)
    {
        try {
            $id = $request->id;
            $observacion = $request->observacion;

            DB::table("history_cotizaciones")->where('id', $id)->update([
                'observacion' => $observacion,
            ]);

            return response()->json(['info' => 1, 'message' => 'Observación actualizada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar la observación']);
        }
    }

    public function cotizaciones_excel()
    {
        $usuarios_cotizaciones = [];

        $permiso_ver = DB::table("permisos_new")
            ->select("cotizaciones")
            ->where("empleado", auth()->user()->id)
            ->where("modulo", "gestionar_cotizaciones")
            ->first();

        if ($permiso_ver && $permiso_ver->cotizaciones) {
            foreach (json_decode($permiso_ver->cotizaciones) as $usuario) {
                array_push($usuarios_cotizaciones, $usuario);
            }
        }


        array_push($usuarios_cotizaciones, auth()->user()->id);

        $cotizaciones = DB::table('cotizaciones')
            ->select(
                'cotizaciones.code',
                'cliente.nit',
                'cliente.razon_social',
                'cotizaciones.descripcion',
                'cotizaciones.created_at',
                'cotizaciones.aprobado',
                //'cotizaciones.fecha_revision',
                'empleados.nombre as creador',
            )
            ->join('cliente', 'cotizaciones.cliente_id', '=', 'cliente.id')
            ->join('empleados', 'cotizaciones.created_by', '=', 'empleados.id')
            ->where('cotizaciones.status', 1)
            ->whereIn('cotizaciones.created_by', $usuarios_cotizaciones)
            ->orderBy('cotizaciones.id', 'desc')
            //->groupBy('cotizaciones.code', 'cotizaciones.created_at', 'cotizaciones.descripcion', 'cotizaciones.aprobado', 'cliente.razon_social', 'empleados.nombre')
            ->orderBy('cotizaciones.id', 'desc')
            ->get();

        return Excel::download(new CotizacionExport($cotizaciones), 'cotizaciones_completadas.xlsx');
    }
}
