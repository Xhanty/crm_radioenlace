<?php

namespace App\Http\Controllers\Admin\Contabilidad\Ventas;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaVentaController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_factura_venta')) {
                return redirect()->route('home');
            }

            $resolucion = DB::table('resolucion_dian')
                ->where('documento', 1)
                ->first();

            $last_factura = DB::table('factura_venta')
                ->select('numero')
                ->orderBy('id', 'desc')
                ->first();

            if (!$last_factura) {
                $num_factura = $resolucion->numero_inicial;
            } else {
                $num_factura = $last_factura->numero + 1;
            }

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            $usuarios = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', 1)
                ->get();

            $impuestos_cargos = DB::table('configuracion_impuestos')
                ->where('en_uso', 1)
                ->where('nombre', 'like', '%iva %')
                ->get();

            $impuestos_retencion = DB::table('configuracion_autoretencion')
                ->where('en_uso', 1)
                ->get();

            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                //->whereMonth('factura_venta.fecha_elaboracion', '=', date('m'))
                ->whereYear('factura_venta.fecha_elaboracion', '=', date('Y'))
                ->orderByDesc('factura_venta.favorito') // ordenar los favoritos primero
                ->orderBy('factura_venta.fecha_elaboracion', 'desc') // luego ordenar por fecha
                ->orderBy('factura_venta.id', 'desc')
                ->get();

            $view_alert = 0;
            $disabled_fv = 0;

            $resolucion_fv = DB::table('resolucion_dian')
                ->where('documento', 1)
                ->first();

            if ($resolucion_fv) {
                $last_numero = $num_factura - 1;

                if (($resolucion_fv->numero - $last_numero) <= 10) {
                    if (($resolucion_fv->numero - $last_numero) <= 1) {
                        $disabled_fv = 1;
                    }
                    $view_alert = 1;
                }

                $fecha_actual = date('Y-m-d');
                $fecha_vencimiento = $resolucion_fv->fecha;
                $dias = (strtotime($fecha_vencimiento) - strtotime($fecha_actual)) / 86400;
                if ($dias <= 30) {
                    if ($dias <= 1) {
                        $disabled_fv = 1;
                    }
                    $view_alert = 2;
                }
            }

            return view('admin.contabilidad.ventas.factura_venta', compact(
                'num_factura',
                'productos',
                'formas_pago',
                'clientes',
                'usuarios',
                'impuestos_cargos',
                'impuestos_retencion',
                'facturas',
                'view_alert',
                'disabled_fv',
            ));
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
            return view('errors.500');
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $fecha = $request->fecha;
            $cliente = $request->cliente;
            $vendedor = $request->vendedor;
            $consecutivo = $request->consecutivo;
            $total = $request->total;
            $productos = json_decode($request->productos, true);
            $observaciones = $request->observaciones;
            $adjunto = null;

            $total_bruto = $request->total_bruto;
            $descuentos = $request->descuentos;
            $subtotal = $request->subtotal;
            $impuestos_1 = $request->impuestos_1;
            $impuestos_2 = $request->impuestos_2;

            $retefuente = $request->retefuente;
            $reteica = $request->reteica;
            $reteiva = $request->reteiva;

            /*$factura = DB::table('factura_venta')
                ->select('numero')
                ->orderBy('id', 'desc')
                ->first();

            $resolucion = DB::table('resolucion_dian')
                ->where('documento', 1)
                ->first();

            if (!$factura) {
                $num_factura = $resolucion->numero_inicial;
            } else {
                $num_factura = $factura->numero + 1;
            }*/

            $num_factura = $consecutivo;
            $valid_cons = DB::table('factura_venta')
                ->where('numero', $num_factura)
                ->first();

            if ($valid_cons) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'El consecutivo de factura ya existe']);
            }

            if ($request->hasFile('factura')) {
                $file = $request->file('factura');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/facturas_venta/', $name);
                $adjunto = $name;
            }

            $id = DB::table("factura_venta")->insertGetId([
                'numero' => $num_factura,
                'fecha_elaboracion' => $fecha,
                'cliente_id' => $cliente,
                'vendedor_id' => $vendedor,
                'total_bruto' => $total_bruto,
                'descuentos' => $descuentos,
                'subtotal' => $subtotal,
                'impuestos_1' => $impuestos_1,
                'impuestos_2' => $impuestos_2,
                'valor_retefuente' => $retefuente,
                'valor_reteica' => $reteica,
                'valor_reteiva' => $reteiva,
                'valor_total' => $total,
                'observaciones' => $observaciones ?? null,
                'adjunto_pdf' => $adjunto ?? null,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);

            if (!$id) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'Error al crear la factura de venta']);
            }

            foreach ($productos as $producto) {
                $detalle = DB::table("detalle_factura_venta")->insert([
                    'factura_id' => $id,
                    'producto' => $producto['producto'] ?? null,
                    'serial_producto' => $producto['serial'] ?? null,
                    'description' => $producto['descripcion'],
                    'cantidad' => $producto['cantidad'],
                    'valor_unitario' => $producto['valor_unitario'],
                    'descuento' => $producto['descuento'],
                    'impuesto_cargo' => $producto['impuesto_cargo'],
                    'impuesto_retencion' => $producto['impuesto_retencion'],
                    'valor_total' => $producto['total'],
                ]);

                if (!$detalle) {
                    DB::rollBack();
                    return response()->json(['info' => 0, 'error' => 'Error al crear el detalle de la factura de venta']);
                }
            }

            DB::table('pagos_ventas')->insert([
                'numero' => 0,
                'tipo' => 0, //Valor a pagar
                'factura_id' => $id,
                'valor' => $total,
                'status' => 0, //Pendiente
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Factura de venta creada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $fecha = $request->fecha;
            $cliente = $request->cliente;
            $vendedor = $request->vendedor;
            $total = $request->total;
            $productos = json_decode($request->productos, true);
            $observaciones = $request->observaciones;
            $adjunto = null;

            $total_bruto = $request->total_bruto;
            $descuentos = $request->descuentos;
            $subtotal = $request->subtotal;
            $impuestos_1 = $request->impuestos_1;
            $impuestos_2 = $request->impuestos_2;

            $retefuente = $request->retefuente;
            $reteica = $request->reteica;
            $reteiva = $request->reteiva;

            if ($request->hasFile('factura')) {
                $file = $request->file('factura');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/facturas_venta/', $name);
                $adjunto = $name;
            }

            DB::table("factura_venta")->where("id", $id)->update([
                'fecha_elaboracion' => $fecha,
                'cliente_id' => $cliente,
                'vendedor_id' => $vendedor,
                'total_bruto' => $total_bruto,
                'descuentos' => $descuentos,
                'subtotal' => $subtotal,
                'impuestos_1' => $impuestos_1,
                'impuestos_2' => $impuestos_2,
                'valor_retefuente' => $retefuente,
                'valor_reteica' => $reteica,
                'valor_reteiva' => $reteiva,
                'valor_total' => $total,
                'observaciones' => $observaciones ?? null,
                'adjunto_pdf' => $adjunto ?? null,
            ]);

            if ($productos && count($productos) > 0) {
                $valid = DB::table('pagos_ventas')
                    ->where('tipo', 1)
                    ->where('factura_id', $id)
                    ->first();

                if ($valid) {
                    DB::rollBack();
                    return response()->json(['info' => 2, 'error' => 'No se puede editar la factura de venta porque ya tiene un pago asociado']);
                }

                DB::table("detalle_factura_venta")->where("factura_id", $id)->delete();

                foreach ($productos as $producto) {
                    $detalle = DB::table("detalle_factura_venta")->insert([
                        'factura_id' => $id,
                        'producto' => $producto['producto'] ?? null,
                        'serial_producto' => $producto['serial'] ?? null,
                        'description' => $producto['descripcion'],
                        'cantidad' => $producto['cantidad'],
                        'valor_unitario' => $producto['valor_unitario'],
                        'descuento' => $producto['descuento'],
                        'impuesto_cargo' => $producto['impuesto_cargo'],
                        'impuesto_retencion' => $producto['impuesto_retencion'],
                        'valor_total' => $producto['total'],
                    ]);

                    if (!$detalle) {
                        DB::rollBack();
                        return response()->json(['info' => 0, 'error' => 'Error al modificar el detalle de la factura de venta']);
                    }
                }
            }

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Factura de venta modificada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function pdf(Request $request)
    {
        $id = $request->get('token');

        if (!$id || $id < 1) {
            return view('errors.404');
        }

        $factura = DB::table('factura_venta')
            ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo', 'cliente.direccion')
            ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
            ->where('factura_venta.id', $id)
            ->first();

        if (!$factura) {
            return view('errors.404');
        }

        $factura->productos = DB::table('detalle_factura_venta')
            ->where('detalle_factura_venta.factura_id', $id)
            ->get();

        foreach ($factura->productos as $key => $producto) {
            if ($producto->producto) {
                $producto->detalle = DB::table('productos')
                    ->select('nombre', 'marca', 'modelo')
                    ->where('id', $producto->producto)
                    ->first();
            }
        }

        return view('admin.contabilidad.ventas.pdf.factura_venta', compact('factura'));
    }

    public function info(Request $request)
    {
        try {
            $id = $request->id;
            $factura = DB::table('factura_venta')
                ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('factura_venta.id', $id)
                ->first();

            if (!$factura) {
                return response()->json(['info' => 0]);
            }

            $factura->productos = DB::table('detalle_factura_venta')
                ->where('detalle_factura_venta.factura_id', $id)
                ->get();

            foreach ($factura->productos as $key => $producto) {
                if ($producto->producto) {
                    $producto->detalle = DB::table('productos')
                        ->select('nombre', 'marca', 'modelo')
                        ->where('id', $producto->producto)
                        ->first();
                }
            }

            return response()->json(['info' => 1, 'factura' => $factura]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }

    public function filtro(Request $request)
    {
        try {
            $cliente = $request->cliente;
            $numero_factura = $request->numero_factura;
            $serial = $request->serial;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if ($numero_factura) {
                $factura_id = DB::table('factura_venta')
                    ->select('id')
                    ->where('numero', $numero_factura)
                    ->first();

                return response()->json(['info' => 1, 'token' => $factura_id->id]);
            }

            if ($serial) {
                $factura_id = DB::table('detalle_factura_venta')
                    ->select('factura_id')
                    ->where('detalle_factura_venta.serial_producto', $serial)
                    ->first();

                return response()->json(['info' => 1, 'token' => $factura_id->id]);
            }

            if ($cliente) {
                if ($fecha_inicio && $fecha_fin) {
                    $facturas = DB::table('factura_venta')
                        ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion')
                        ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                        ->where('factura_venta.cliente_id', $cliente)
                        ->whereBetween('factura_venta.created_at', [$fecha_inicio, $fecha_fin])
                        ->orderByDesc('factura_venta.favorito') // ordenar los favoritos primero
                        ->orderBy('factura_venta.fecha_elaboracion', 'desc') // luego ordenar por fecha
                        ->orderBy('factura_venta.id', 'desc')
                        ->get();
                } else {
                    $facturas = DB::table('factura_venta')
                        ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion')
                        ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                        ->where('factura_venta.cliente_id', $cliente)
                        ->orderByDesc('factura_venta.favorito') // ordenar los favoritos primero
                        ->orderBy('factura_venta.fecha_elaboracion', 'desc') // luego ordenar por fecha
                        ->orderBy('factura_venta.id', 'desc')
                        ->get();
                }

                return response()->json(['info' => 1, 'facturas' => $facturas]);
            }

            if ($fecha_inicio && $fecha_fin) {
                $facturas = DB::table('factura_venta')
                    ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion')
                    ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                    ->whereBetween('factura_venta.fecha', [$fecha_inicio, $fecha_fin])
                    ->orderByDesc('factura_venta.favorito') // ordenar los favoritos primero
                    ->orderBy('factura_venta.fecha_elaboracion', 'desc') // luego ordenar por fecha
                    ->orderBy('factura_venta.id', 'desc')
                    ->get();

                return response()->json(['info' => 1, 'facturas' => $facturas]);
            }

            return response()->json(['info' => 0]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }

    public function anular(Request $request)
    {
        try {
            $id = $request->id;
            DB::table('factura_venta')
                ->where('id', $id)
                ->update(['status' => 0]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }

    public function favorito(Request $request)
    {
        try {
            $id = $request->id;
            $favorito = $request->favorito;

            DB::table('factura_venta')
                ->where('id', $id)
                ->update(['favorito' => $favorito]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }
}
