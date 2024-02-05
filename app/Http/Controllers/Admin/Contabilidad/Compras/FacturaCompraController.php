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
                ->where('nombre', 'like', '%iva %')
                ->get();

            $impuestos_retencion = DB::table('configuracion_autoretencion')
                ->where('en_uso', 1)
                ->get();

            $facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                //->leftJoin('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                ->orderBy('factura_compra.numero', 'desc') // luego ordenar por fecha
                ->get();

            $facturas_by_nit = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                //->leftJoin('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->join('proveedores', 'proveedores.nit', '=', 'factura_compra.proveedor_id')
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                ->orderBy('factura_compra.numero', 'desc') // luego ordenar por fecha
                ->get();

            $facturas = $facturas->merge($facturas_by_nit);

            /*$facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                ->leftJoin('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->whereNull('proveedores.id')
                ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                ->orderBy('factura_compra.numero', 'desc') // luego ordenar por fecha
                ->get();

            $no_registrados = [];
            $total = 0;
            foreach ($facturas as $key => $value) {
                $proveedor = DB::table('proveedores')
                    ->select('id')
                    ->where('nit', $value->proveedor_id)
                    ->first();
                
                if ($proveedor) {
                    DB::table('factura_compra')
                        ->where('id', $value->id)
                        ->update(['proveedor_id' => $proveedor->id]);
                } else {
                    $no_registrados[] = $value->proveedor_id;
                    $total++;
                }
            }
            
            echo $total;
            exit;
            echo json_encode($no_registrados);
            exit;*/

            /*$facturas = DB::table('detalle_factura_compra')
                ->select('configuracion_puc.code', 'configuracion_puc.nombre', 'detalle_factura_compra.valor_total')
                ->join('configuracion_puc', 'detalle_factura_compra.cuenta', '=', 'configuracion_puc.id')
                ->get();

            // Crear un array para almacenar las sumas por 'code'
            $sumasPorCode = [];

            // Recorrer las facturas y sumar los 'valor_total' por 'code'
            foreach ($facturas as $factura) {
                $code = $factura->code;
                $valorTotal = (float) str_replace(',', '.', str_replace('.', '', $factura->valor_total));

                // Si el 'code' ya existe, sumar el 'valor_total'; de lo contrario, inicializarlo
                if (isset($sumasPorCode[$code])) {
                    $sumasPorCode[$code]['valor_total'] += $valorTotal;
                } else {
                    $sumasPorCode[$code] = [
                        "code" => $code,
                        "nombre" => $factura->nombre,
                        "valor_total" => $valorTotal
                    ];
                }
            }

            // Aplicar el formato al 'valor_total' en el array resultante
            $resultadoFinal = array_map(function ($item) {
                $item['valor_total'] = number_format($item['valor_total'], 2, ',', '.');
                return $item;
            }, array_values($sumasPorCode));

            // Imprimir o mostrar el resultado final
            echo json_encode($resultadoFinal);
            exit;*/

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
            return $ex->getMessage();
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

            if ($request->numero_factura_siigo) {
                $num_factura = $request->numero_factura_siigo;
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
                            $errorLog = 'Error en la consulta (FACTURA): ' . print_r($request->numero_factura_siigo, true) . "\n";
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

            DB::table('pagos_compras')->insert([
                'numero' => 0,
                'tipo' => 0,
                'factura_id' => $id,
                'valor' => $total, //Valor a pagar
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
            $estado = $request->estado;
            $numero_factura = $request->num_factura;
            $cons_inicio = $request->cons_inicio;
            $cons_fin = $request->cons_fin;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $mayor_menor_mora = $request->mayor_menor_mora;
            $dia_mora = $request->dia_mora;

            $facturas_by_nit = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                //->leftJoin('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->join('proveedores', 'proveedores.nit', '=', 'factura_compra.proveedor_id')
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->orderByDesc('factura_compra.favorito') // ordenar los favoritos primero
                ->orderBy('factura_compra.numero', 'desc') // luego ordenar por fecha
                ->get();

            $query = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.ciudad', 'proveedores.telefono_fijo', 'proveedores.direccion')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->orderBy('factura_compra.numero', 'desc'); // luego consecutivo

            $query_nit = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.ciudad', 'proveedores.telefono_fijo', 'proveedores.direccion')
                ->join('proveedores', 'proveedores.nit', '=', 'factura_compra.proveedor_id')
                ->orderBy('factura_compra.numero', 'desc'); // luego consecutivo

            if ($numero_factura) {
                $query->where('factura_compra.numero', $numero_factura);
                $query_nit->where('factura_compra.numero', $numero_factura);
            }

            if ($proveedor) {
                $query->where('factura_compra.proveedor_id', $proveedor);
                $query_nit->where('factura_compra.proveedor_id', $proveedor);
            }

            if ($estado != null) {
                $query->where('factura_compra.status', $estado);
                $query_nit->where('factura_compra.status', $estado);
            }

            if ($cons_inicio && $cons_fin) {
                $query->whereBetween('factura_compra.numero', [$cons_inicio, $cons_fin]);
                $query_nit->whereBetween('factura_compra.numero', [$cons_inicio, $cons_fin]);
            }

            if ($fecha_inicio && $fecha_fin) {
                $query->whereBetween('factura_compra.fecha_elaboracion', [$fecha_inicio, $fecha_fin]);
                $query_nit->whereBetween('factura_compra.fecha_elaboracion', [$fecha_inicio, $fecha_fin]);
            }

            if ($mayor_menor_mora && $dia_mora) {
                if ($mayor_menor_mora == 1) {
                    // Si es mayor y mirar cuantos días tiene de mora la factura, y los compare con $dia_mora
                    $query->whereRaw('DATEDIFF(CURDATE(), factura_compra.fecha_elaboracion) > ' . $dia_mora);
                    $query_nit->whereRaw('DATEDIFF(CURDATE(), factura_compra.fecha_elaboracion) > ' . $dia_mora);
                } elseif ($mayor_menor_mora == 2) {
                    // Si es menor y mirar cuantos días tiene de mora la factura, y los compare con $dia_mora
                    $query->whereRaw('DATEDIFF(CURDATE(), factura_compra.fecha_elaboracion) < ' . $dia_mora);
                    $query_nit->whereRaw('DATEDIFF(CURDATE(), factura_compra.fecha_elaboracion) < ' . $dia_mora);
                }
            }

            $facturas = $query->orderBy('factura_compra.numero', 'desc')->get();
            $facturas_by_nit = $query_nit->orderBy('factura_compra.numero', 'desc')->get();

            if ($facturas->isEmpty()) {
                return response()->json(['info' => 1]);
            }

            $facturas = $facturas->merge($facturas_by_nit);

            // Guardar la consulta en una sesión
            session()->put('facturas_compra_filtro', $facturas);

            return response()->json(['info' => 1, 'facturas' => $facturas]);
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

    public function pdf_export(Request $request)
    {
    }

    public function excel(Request $request)
    {
    }
}
