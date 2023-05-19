<?php

namespace App\Http\Controllers\Admin\Contabilidad\Compras;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class FacturaCompraController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_factura_compra')) {
                return redirect()->route('home');
            }

            $last_factura = DB::table('factura_compra')
                ->select('numero')
                ->orderBy('numero', 'desc')
                ->first();

            if (!$last_factura) {
                $num_factura = 1;
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

            $centros_costos = DB::table('centros_costo')
                ->select('id', 'nombre', 'code')
                ->where('status', 1)
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            $cuentas_gastos = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 0)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $impuestos_cargos = DB::table('configuracion_impuestos')
                ->where('en_uso', 1)
                ->get();

            $impuestos_retencion = DB::table('configuracion_autoretencion')
                ->where('en_uso', 1)
                ->get();

            $facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                //->whereMonth('factura_compra.fecha_elaboracion', '=', date('m'))
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                ->orderBy('factura_compra.numero', 'desc') // luego ordenar por fecha
                //->orderBy('factura_compra.fecha_elaboracion', 'desc') // luego ordenar por fecha
                //->orderBy('factura_compra.id', 'desc')
                ->get();

            $almacenes = DB::table('almacenes')->whereNull("parent_id")->get();

            if ($almacenes->count() > 0) {
                $almacenes = $almacenes->toArray();
                $almacenes = $this->getAlmacenes($almacenes);
            } else {
                $almacenes = [];
            }

            return view('admin.contabilidad.compras.factura_compra', compact(
                'productos',
                'formas_pago',
                'centros_costos',
                'proveedores',
                'cuentas_gastos',
                'facturas',
                'num_factura',
                'impuestos_cargos',
                'impuestos_retencion',
                'almacenes'
            ));
        } catch (Exception $ex) {
            //return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function getAlmacenes($almacenes)
    {
        foreach ($almacenes as $key => $almacen) {
            $almacenes[$key]->almacenes = DB::table('almacenes')->where('parent_id', $almacen->id)->get();

            if ($almacenes[$key]->almacenes->count() > 0) {
                $almacenes[$key]->almacenes = $almacenes[$key]->almacenes->toArray();
                $almacenes[$key]->almacenes = $this->getAlmacenes($almacenes[$key]->almacenes);
            } else {
                $almacenes[$key]->almacenes = [];
            }
        }

        return $almacenes;
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $tipo = $request->tipo;
            $centro = $request->centro;
            $fecha = $request->fecha;
            $proveedor = $request->proveedor;
            $factura_proveedor = $request->factura_proveedor;
            $consecutivo_proveedor = $request->consecutivo_proveedor;
            $total = $request->total;
            $productos = json_decode($request->productos, true);
            $observaciones = $request->observaciones;
            $adjunto = null;

            $total_bruto = $request->total_bruto;
            $descuentos = $request->descuentos;
            $subtotal = $request->subtotal;
            $impuestos_1 = $request->impuestos_1;
            $impuestos_2 = $request->impuestos_2;

            if ($tipo == 1) {
                $factura = DB::table('factura_compra')
                    ->select('numero')
                    ->orderBy('numero', 'desc')
                    ->first();
            } else {
                $factura = DB::table('factura_compra')
                    ->select('numero')
                    ->where('tipo', 2)
                    ->orderBy('numero', 'desc')
                    ->first();
            }

            if (!$factura) {
                $num_factura = 1;
            } else {
                $num_factura = $factura->numero + 1;
            }

            if ($request->hasFile('factura')) {
                $file = $request->file('factura');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/facturas_compra/', $name);
                $adjunto = $name;
            }

            $id = DB::table("factura_compra")->insertGetId([
                'numero' => $num_factura,
                'tipo' => $tipo,
                'centro_costo' => $centro,
                'fecha_elaboracion' => $fecha,
                'fecha_vencimiento' => date('Y-m-d', strtotime($fecha . ' + 30 days')),
                'proveedor_id' => $proveedor,
                'factura_proveedor' => $factura_proveedor,
                'num_factura_proveedor' => $consecutivo_proveedor,
                'total_bruto' => $total_bruto,
                'descuentos' => $descuentos,
                'subtotal' => $subtotal,
                'impuestos_1' => $impuestos_1,
                'impuestos_2' => $impuestos_2,
                'valor_total' => $total,
                'observaciones' => $observaciones ?? null,
                'adjunto_pdf' => $adjunto ?? null,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);

            if (!$id) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'Error al crear la factura de compra']);
            }

            foreach ($productos as $producto) {
                if ($producto['tipo'] == 1) {
                    $detalle = DB::table("detalle_factura_compra")->insert([
                        'factura_id' => $id,
                        'tipo' => $producto['tipo'],
                        'producto' => $producto['producto'] ?? null,
                        'serial_producto' => $producto['serial'] ?? null,
                        'cuenta' => null,
                        'description' => $producto['descripcion'],
                        'bodega' => $producto['bodega'],
                        'cantidad' => $producto['cantidad'],
                        'valor_unitario' => $producto['valor_unitario'],
                        'descuento' => $producto['descuento'],
                        'impuesto_cargo' => intval($producto['impuesto_cargo']),
                        'impuesto_retencion' => intval($producto['impuesto_retencion']),
                        'valor_total' => $producto['total'],
                    ]);
                } else {
                    if ($request->id_siigo) {
                        $id_cuenta = DB::table('configuracion_puc')->where(DB::raw('LOWER(nombre)'), 'like', '%' . strtolower($producto['producto']) . '%')->orderBy('id', 'desc')->first();

                        if ($id_cuenta) {
                            $producto['producto'] = $id_cuenta->id;
                        } else {
                            DB::rollBack();
                            $errorLog = 'Error en la consulta (PRODUCTO): ' . print_r($request->id_siigo, true) . "\n";
                            $file = 'errores.log';
                            file_put_contents($file, $errorLog, FILE_APPEND);
                            return response()->json(['info' => 0, 'error' => 'Error al crear el detalle de la factura de compra']);
                            exit;
                        }
                    }
                    $detalle = DB::table("detalle_factura_compra")->insert([
                        'factura_id' => $id,
                        'tipo' => $producto['tipo'],
                        'producto' => null,
                        'serial_producto' => null,
                        'cuenta' => $producto['producto'] ?? null,
                        'description' => $producto['descripcion'],
                        'bodega' => $producto['bodega'],
                        'cantidad' => $producto['cantidad'],
                        'valor_unitario' => $producto['valor_unitario'],
                        'descuento' => $producto['descuento'],
                        'impuesto_cargo' => intval($producto['impuesto_cargo']),
                        'impuesto_retencion' => intval($producto['impuesto_retencion']),
                        'valor_total' => $producto['total'],
                    ]);
                }

                if (!$detalle) {
                    DB::rollBack();
                    return response()->json(['info' => 0, 'error' => 'Error al crear el detalle de la factura de compra']);
                }
            }

            $last_number = DB::table('pagos_compras')
                ->select('numero')
                ->where('tipo', 1)
                ->orderBy('numero', 'desc')
                ->first();


            if (!$last_number) {
                $num_egreso = 1;
            } else {
                $num_egreso = $last_number->numero + 1;
            }

            DB::table('pagos_compras')->insert([
                'numero' => $num_egreso,
                'tipo' => 0, //Valor a pagar
                'factura_id' => $id,
                'valor' => $total,
                'status' => 0, //Pendiente
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Factura de compra creada correctamente']);
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
            $tipo = $request->tipo;
            $centro = $request->centro;
            $fecha = $request->fecha;
            $proveedor = $request->proveedor;
            $factura_proveedor = $request->factura_proveedor;
            $consecutivo_proveedor = $request->consecutivo_proveedor;
            $total = $request->total;
            $productos = json_decode($request->productos, true);
            $observaciones = $request->observaciones;
            $adjunto = null;

            $total_bruto = $request->total_bruto;
            $descuentos = $request->descuentos;
            $subtotal = $request->subtotal;
            $impuestos_1 = $request->impuestos_1;
            $impuestos_2 = $request->impuestos_2;

            if ($request->hasFile('factura')) {
                $file = $request->file('factura');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/facturas_compra/', $name);
                $adjunto = $name;
            }

            DB::table("factura_compra")->where("id", $id)->update([
                'tipo' => $tipo,
                'centro_costo' => $centro,
                'fecha_elaboracion' => $fecha,
                'fecha_vencimiento' => date('Y-m-d', strtotime($fecha . ' + 30 days')),
                'proveedor_id' => $proveedor,
                'factura_proveedor' => $factura_proveedor,
                'num_factura_proveedor' => $consecutivo_proveedor,
                'total_bruto' => $total_bruto,
                'descuentos' => $descuentos,
                'subtotal' => $subtotal,
                'impuestos_1' => $impuestos_1,
                'impuestos_2' => $impuestos_2,
                'valor_total' => $total,
                'observaciones' => $observaciones ?? null,
                'adjunto_pdf' => $adjunto ?? null,
            ]);

            if ($productos && count($productos) > 0) {
                $valid = DB::table('pagos_compras')
                    ->where('tipo', 1)
                    ->where('factura_id', $id)
                    ->first();

                if ($valid) {
                    DB::rollBack();
                    return response()->json(['info' => 2, 'error' => 'No se puede editar la factura de compra porque ya tiene un pago asociado']);
                }

                DB::table("detalle_factura_compra")->where("factura_id", $id)->delete();

                foreach ($productos as $producto) {
                    if ($producto['tipo'] == 1) {
                        $detalle = DB::table("detalle_factura_compra")->insert([
                            'factura_id' => $id,
                            'tipo' => $producto['tipo'],
                            'producto' => $producto['producto'] ?? null,
                            'serial_producto' => $producto['serial'] ?? null,
                            'cuenta' => null,
                            'description' => $producto['descripcion'],
                            'bodega' => $producto['bodega'],
                            'cantidad' => $producto['cantidad'],
                            'valor_unitario' => $producto['valor_unitario'],
                            'descuento' => $producto['descuento'],
                            'impuesto_cargo' => $producto['impuesto_cargo'],
                            'impuesto_retencion' => $producto['impuesto_retencion'],
                            'valor_total' => $producto['total'],
                        ]);
                    } else {
                        $detalle = DB::table("detalle_factura_compra")->insert([
                            'factura_id' => $id,
                            'tipo' => $producto['tipo'],
                            'producto' => null,
                            'serial_producto' => null,
                            'cuenta' => $producto['producto'] ?? null,
                            'description' => $producto['descripcion'],
                            'bodega' => $producto['bodega'],
                            'cantidad' => $producto['cantidad'],
                            'valor_unitario' => $producto['valor_unitario'],
                            'descuento' => $producto['descuento'],
                            'impuesto_cargo' => $producto['impuesto_cargo'],
                            'impuesto_retencion' => $producto['impuesto_retencion'],
                            'valor_total' => $producto['total'],
                        ]);
                    }

                    if (!$detalle) {
                        DB::rollBack();
                        return response()->json(['info' => 0, 'error' => 'Error al modificar el detalle de la factura de compra']);
                    }
                }
            }

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Factura de compra modificada correctamente']);
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

        $factura = DB::table('factura_compra')
            ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.ciudad', 'proveedores.telefono_fijo', 'proveedores.direccion')
            ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
            ->where('factura_compra.id', $id)
            ->first();

        if (!$factura) {
            return view('errors.404');
        }

        $factura->productos = DB::table('detalle_factura_compra')
            ->select('detalle_factura_compra.*', 'configuracion_impuestos.tarifa as tarifa_cargo', 'configuracion_autoretencion.tarifa as tarifa_retencion')
            ->where('detalle_factura_compra.factura_id', $id)
            ->leftJoin('configuracion_impuestos', 'configuracion_impuestos.id', '=', 'detalle_factura_compra.impuesto_cargo')
            ->leftJoin('configuracion_autoretencion', 'configuracion_autoretencion.id', '=', 'detalle_factura_compra.impuesto_retencion')
            ->get();

        foreach ($factura->productos as $key => $producto) {
            if ($producto->producto) {
                $producto->detalle = DB::table('productos')
                    ->select('nombre', 'marca', 'modelo')
                    ->where('id', $producto->producto)
                    ->first();
            } else {
                $producto->detalle = DB::table('configuracion_puc')
                    ->select('code', 'nombre')
                    ->where('id', $producto->cuenta)
                    ->first();
            }
        }

        return view('admin.contabilidad.compras.pdf.factura_compra', compact('factura'));
    }

    public function info(Request $request)
    {
        try {
            $id = $request->id;
            $factura = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.ciudad', 'proveedores.telefono_fijo')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->where('factura_compra.id', $id)
                ->first();

            if (!$factura) {
                return response()->json(['info' => 0]);
            }

            $factura->productos = DB::table('detalle_factura_compra')
                ->select('detalle_factura_compra.*', 'configuracion_impuestos.tarifa as tarifa_cargo', 'configuracion_autoretencion.tarifa as tarifa_retencion')
                ->where('detalle_factura_compra.factura_id', $id)
                ->leftJoin('configuracion_impuestos', 'configuracion_impuestos.id', '=', 'detalle_factura_compra.impuesto_cargo')
                ->leftJoin('configuracion_autoretencion', 'configuracion_autoretencion.id', '=', 'detalle_factura_compra.impuesto_retencion')
                ->get();

            foreach ($factura->productos as $key => $producto) {
                if ($producto->producto) {
                    $producto->detalle = DB::table('productos')
                        ->select('nombre', 'marca', 'modelo')
                        ->where('id', $producto->producto)
                        ->first();
                } else {
                    $producto->detalle = DB::table('configuracion_puc')
                        ->select('code', 'nombre')
                        ->where('id', $producto->cuenta)
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
            $proveedor = $request->proveedor;
            $numero_factura = $request->numero_factura;
            $serial = $request->serial;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if ($numero_factura) {
                $factura_id = DB::table('factura_compra')
                    ->select('id')
                    ->where('numero', $numero_factura)
                    ->first();

                return response()->json(['info' => 1, 'token' => $factura_id->id]);
            }

            if ($serial) {
                $factura_id = DB::table('detalle_factura_compra')
                    ->select('factura_id')
                    ->where('detalle_factura_compra.serial_producto', $serial)
                    ->first();

                return response()->json(['info' => 1, 'token' => $factura_id->id]);
            }

            if ($proveedor) {
                if ($fecha_inicio && $fecha_fin) {
                    $facturas = DB::table('factura_compra')
                        ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                        ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                        ->where('factura_compra.proveedor_id', $proveedor)
                        ->whereBetween('factura_compra.created_at', [$fecha_inicio, $fecha_fin])
                        ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                        ->orderBy('factura_compra.fecha_elaboracion', 'desc') // luego ordenar por fecha
                        ->orderBy('factura_compra.id', 'desc')
                        ->get();
                } else {
                    $facturas = DB::table('factura_compra')
                        ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                        ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                        ->where('factura_compra.proveedor_id', $proveedor)
                        ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                        ->orderBy('factura_compra.fecha_elaboracion', 'desc') // luego ordenar por fecha
                        ->orderBy('factura_compra.id', 'desc')
                        ->get();
                }

                return response()->json(['info' => 1, 'facturas' => $facturas]);
            }

            if ($fecha_inicio && $fecha_fin) {
                $facturas = DB::table('factura_compra')
                    ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                    ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                    ->whereBetween('factura_compra.fecha', [$fecha_inicio, $fecha_fin])
                    ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                    ->orderBy('factura_compra.fecha_elaboracion', 'desc') // luego ordenar por fecha
                    ->orderBy('factura_compra.id', 'desc')
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
            DB::table('factura_compra')
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

            DB::table('factura_compra')
                ->where('id', $id)
                ->update(['favorito' => $favorito]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }
}
