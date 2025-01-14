<?php

namespace App\Http\Controllers\Admin\Contabilidad\Ventas;

use App\Exports\FacturasVentaExcel;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class FacturaVentaController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_factura_venta')) {
                return redirect()->route('home');
            }

            // Cargar Facturas de Venta JSON
            /*$rutaArchivo = public_path('facturas_ventas_2024.json');
            if (File::exists($rutaArchivo)) {
                // Lee el contenido del archivo JSON
                $contenido = File::get($rutaArchivo);

                // Decodifica el JSON a un array asociativo
                $datos = json_decode($contenido, true);

                //for ($i = 0; $i < count($datos); $i++) {
                //foreach ($datos[$i] as $key => $value) {
                //}
                //}

                foreach ($datos as $key => $value) {
                    $token = $value["stamp"]["cufe"] ?? null;
                    $numero = $value["number"];
                    $tipo = 1;
                    $fecha_elaboracion = $value["date"];
                    $nit_cliente = $value["customer"]["identification"];
                    $id_cliente = 0;
                    $vendedor_id = 6;
                    $observaciones = $value["observations"] ?? null;
                    $valor_total = $value["total"];
                    $status = 1;
                    $created_at = date('Y-m-d H:i:s');
                    $created_by = 6;

                    // Actualizar después de crear la factura
                    $total_bruto = 0;
                    $descuentos = 0;
                    $subtotal = 0;
                    $impuestos_1 = [];
                    $impuestos_2 = [];

                    // Consultar el cliente
                    $cliente = DB::table('cliente')
                        ->where('nit', $nit_cliente)
                        ->first();

                    if ($cliente) {
                        $id_cliente = $cliente->id;
                    } else {
                        $id_cliente = DB::table('cliente')->insertGetId([
                            'nit' => $nit_cliente,
                            'razon_social' => 'N/A',
                        ]);
                    }

                    $valid_factura = DB::table('factura_venta')
                        ->where('numero', $numero)
                        ->first();

                    if (!$valid_factura) {
                        $factura = DB::table('factura_venta')->insertGetId([
                            'token' => $token,
                            'numero' => $numero,
                            'tipo' => $tipo,
                            'fecha_elaboracion' => $fecha_elaboracion,
                            'cliente_id' => $id_cliente,
                            'vendedor_id' => $vendedor_id,
                            'total_bruto' => $total_bruto,
                            'descuentos' => $descuentos,
                            'subtotal' => $subtotal,
                            'impuestos_1' => json_encode($impuestos_1),
                            'impuestos_2' => json_encode($impuestos_2),
                            'valor_total' => $valor_total,
                            'observaciones' => $observaciones,
                            'status' => $status,
                            'created_at' => $created_at,
                            'created_by' => $created_by,
                        ]);

                        foreach ($value["items"] as $key => $item) {
                            $impuesto_cargo = 0;
                            $impuesto_retencion = 0;
                            $descuento = 0;

                            if (isset($item["taxes"])) {
                                foreach ($item["taxes"] as $key => $tax) {
                                    if ($tax["type"] == "IVA") {
                                        $impuesto_cargo = $tax["percentage"];
                                    } else {
                                        $impuesto_retencion = $tax["percentage"];
                                    }
                                }
                            }

                            if (isset($item["discount"])) {
                                $descuento = $item["discount"]["value"];
                            }

                            $detalle = DB::table('detalle_factura_venta')->insert([
                                'factura_id' => $factura,
                                'producto' => null,
                                'serial_producto' => null,
                                'description' => $item["description"],
                                'code_siigo' => $item["code"],
                                'cantidad' => $item["quantity"],
                                'valor_unitario' => $item["price"],
                                'descuento' => $descuento,
                                'impuesto_cargo' => $impuesto_cargo,
                                'impuesto_retencion' => $impuesto_retencion,
                                'valor_total' => $item["total"],
                            ]);
                        }
                    }
                }
            }

            exit;*/

            // Cargar Recibos de Caja JSON
            /*$rutaArchivo = public_path('recibos_caja.json');
            if (File::exists($rutaArchivo)) {
                // Lee el contenido del archivo JSON
                $contenido = File::get($rutaArchivo);

                // Decodifica el JSON a un array asociativo
                $datos = json_decode($contenido, true);
                $numero = 0;

                foreach ($datos as $key => $value) {
                    $numero = $numero + 1;
                    $numero_siigo = $value["number"];
                    $tipo = 1;
                    $fecha_elaboracion = $value["date"];
                    $status = 1;
                    $created_at = date('Y-m-d H:i:s');
                    $created_by = 6;

                    // Cuenta de ahorros (MIRAR)
                    $forma_pago = 21;
                    $factura_id = null;
                    $grupo_facturas = null;
                    $cliente_id = null;
                    $valor = 0;
                    $observacion = null;

                    if (count($value["items"]) == 1) {
                        if (isset($value["items"][0]["due"])) {
                            $factura = $value["items"][0]["due"]["consecutive"];
                            $factura_data = DB::table('factura_venta')
                                ->where('numero', $factura)
                                ->first();
                            if ($factura_data) {
                                $factura_id = $factura_data->id;
                                $valor = $value["items"][0]["value"];
                                $observacion = $value["items"][0]["description"] ?? null;

                                DB::table('pagos_ventas')->insert([
                                    'numero' => $numero,
                                    'numero_siigo' => $numero_siigo,
                                    'tipo' => $tipo,
                                    'factura_id' => $factura_id,
                                    'fecha_elaboracion' => $fecha_elaboracion,
                                    'forma_pago' => $forma_pago,
                                    'valor' => $valor,
                                    'status' => $status,
                                    'observacion' => $observacion,
                                    'created_at' => $created_at,
                                    'created_by' => $created_by,
                                ]);

                                //Mirar si la factura ya fue pagada
                                if($factura_data->valor_total == $valor) {
                                    DB::table('factura_venta')
                                        ->where('id', $factura_id)
                                        ->update(['status' => 2]);
                                }
                            }
                        }
                    } else {
                        $cliente = $value["customer"]["identification"];
                        $cliente_data = DB::table('cliente')
                            ->where('nit', $cliente)
                            ->first();

                        if ($cliente_data) {
                            $grupo_facturas = [];
                            foreach ($value["items"] as $key => $item) {
                                if (isset($item["tax"])) {
                                    if ($item["tax"]["type"] == "ReteIVA") {
                                        $rete_iva = $item["tax"]["percentage"];
                                    } else if ($item["tax"]["type"] == "ReteICA") {
                                        $rete_ica = $item["tax"]["percentage"];
                                    } else if ($item["tax"]["type"] == "ReteFuente") {
                                        $rete_fuente = $item["tax"]["percentage"];
                                    }

                                    // Cuadrar los impuestos
                                } else {
                                    if (isset($item["due"])) {
                                        $factura = $item["due"]["consecutive"];
                                        $factura_data = DB::table('factura_venta')
                                            ->where('numero', $factura)
                                            ->first();
                                        if ($factura_data) {
                                            // Revisar para agrupar las facturas
                                            $factura_id = $factura_data->id;
                                            $valor = $item["value"];
                                            $data = [
                                                'id' => $factura_id,
                                                'valor' => $item["value"],
                                            ];
                                            array_push($grupo_facturas, $data);
                                            
                                            DB::table('pagos_ventas')->insert([
                                                'numero' => $numero,
                                                'numero_siigo' => $numero_siigo,
                                                'tipo' => $tipo,
                                                'factura_id' => $factura_id,
                                                'fecha_elaboracion' => $fecha_elaboracion,
                                                'forma_pago' => $forma_pago,
                                                'valor' => $valor,
                                                'status' => $status,
                                                'observacion' => $observacion,
                                                'created_at' => $created_at,
                                                'created_by' => $created_by,
                                            ]);
            
                                            //Mirar si la factura ya fue pagada
                                            if($factura_data->valor_total == $valor) {
                                                DB::table('factura_venta')
                                                    ->where('id', $factura_id)
                                                    ->update(['status' => 2]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            exit;*/

            // Eliminar la sesión de la consulta
            session()->forget('facturas_venta_filtro');

            $resolucion = DB::table('resolucion_dian')
                ->where('documento', 1)
                ->first();

            $last_factura = DB::table('factura_venta')
                ->select('numero')
                ->orderBy('id', 'desc')
                ->first();

            if (!$last_factura) {
                $num_factura = $resolucion->numero_inicio;
            } else {
                $num_factura = $last_factura->numero + 1;
            }

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $productos_filtro = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            foreach ($productos as $key => $producto) {
                $inventario = DB::table('inventario')
                    ->select('inventario.*')
                    ->where('inventario.producto_id', $producto->id)
                    ->orderBy('inventario.id', 'desc')
                    ->get();

                // Filtrar los inventarios con cantidad mayor a 0
                $producto->inventario = $inventario->filter(function ($value) {
                    return $value->cantidad > 0;
                });
            }

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
                //->orderByDesc('factura_venta.favorito') // ordenar los favoritos primero
                //->orderBy('factura_venta.fecha_elaboracion', 'desc') // luego ordenar por fecha
                ->orderBy('factura_venta.numero', 'desc')
                ->get();

            $view_alert = 0;
            $disabled_fv = 0;

            $resolucion_fv = DB::table('resolucion_dian')
                ->where('documento', 1)
                ->first();

            if ($resolucion_fv) {
                $last_numero = $num_factura - 1;

                if (($resolucion_fv->numero - $last_numero) <= 50) {
                    if (($resolucion_fv->numero - $last_numero) <= 1) {
                        $disabled_fv = 1;
                    }
                    $view_alert = 1;
                }

                $fecha_actual = date('Y-m-d');
                $fecha_vencimiento = $resolucion_fv->fecha;
                $dias = (strtotime($fecha_vencimiento) - strtotime($fecha_actual)) / 86400;
                if ($dias <= 15) {
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
                'productos_filtro'
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
                    'serial_producto' => $producto['seriales'] ?? null,
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
                        'serial_producto' => $producto['seriales'] ?? null,
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
                    ->select('productos.nombre', 'productos.marca', 'productos.modelo', 'detalle_factura_venta.description')
                    ->join('detalle_factura_venta', 'detalle_factura_venta.producto', '=', 'productos.id')
                    ->where('productos.id', $producto->producto)
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

            $factura->pagos = DB::table('pagos_ventas')
                ->where('factura_id', $id)
                ->where('tipo', 1)
                ->get();

            return response()->json(['info' => 1, 'factura' => $factura]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }

    public function filtro(Request $request)
    {
        try {
            // Eliminar la sesión de la consulta anterior
            session()->forget('facturas_venta_filtro');

            $cliente = $request->cliente;
            $estado = $request->estado;
            $producto = $request->producto;
            $numero_factura = $request->num_factura;
            $cons_inicio = $request->cons_inicio;
            $cons_fin = $request->cons_fin;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $mayor_menor_mora = $request->mayor_menor_mora;
            $dia_mora = $request->dia_mora;
            $palabra_clave = $request->palabra_clave;

            $query = DB::table('factura_venta')
                ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo', 'cliente.direccion')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->orderBy('factura_venta.numero', 'desc'); // luego consecutivo

            if ($numero_factura) {
                $query->where('factura_venta.numero', $numero_factura);
            }

            if ($cliente) {
                $query->where('factura_venta.cliente_id', $cliente);
            }

            if ($estado != null) {
                $query->where('factura_venta.status', $estado);
            }

            if ($producto) {
                $query->whereIn('factura_venta.id', function ($subquery) use ($producto) {
                    $subquery->select('factura_id')
                        ->from('detalle_factura_venta')
                        ->where('producto', $producto);
                });
            }

            if ($palabra_clave) {
                $query->whereIn('factura_venta.id', function ($subquery) use ($palabra_clave) {
                    $subquery->select('factura_id')
                        ->from('detalle_factura_venta')
                        ->where('description', 'like', '%' . $palabra_clave . '%');
                });
            }

            if ($cons_inicio && $cons_fin) {
                $query->whereBetween('factura_venta.numero', [$cons_inicio, $cons_fin]);
            }

            if ($fecha_inicio && $fecha_fin) {
                $query->whereBetween('factura_venta.fecha_elaboracion', [$fecha_inicio, $fecha_fin]);
            }

            if ($mayor_menor_mora && $dia_mora) {
                if ($mayor_menor_mora == 1) {
                    // Si es mayor y mirar cuantos días tiene de mora la factura, y los compare con $dia_mora
                    $query->whereRaw('DATEDIFF(CURDATE(), factura_venta.fecha_elaboracion) > ' . $dia_mora);
                } elseif ($mayor_menor_mora == 2) {
                    // Si es menor y mirar cuantos días tiene de mora la factura, y los compare con $dia_mora
                    $query->whereRaw('DATEDIFF(CURDATE(), factura_venta.fecha_elaboracion) < ' . $dia_mora);
                }
            }

            $facturas = $query->orderBy('factura_venta.numero', 'desc')->get();

            if ($facturas->isEmpty()) {
                return response()->json(['info' => 1]);
            }

            // Guardar la consulta en una sesión
            session()->put('facturas_venta_filtro', $facturas);

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

    public function visto_bueno(Request $request)
    {
        try {
            $id = $request->id;
            $visto_bueno = $request->visto_bueno;

            DB::table('factura_venta')
                ->where('id', $id)
                ->update(['visto_bueno' => $visto_bueno]);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0]);
        }
    }

    public function pdf_export(Request $request)
    {
        try {
            //Validar si existe la sesión de la consulta
            if (session()->has('facturas_venta_filtro')) {
                $facturas = session('facturas_venta_filtro');
            } else {
                $facturas = DB::table('factura_venta')
                    ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo', 'cliente.direccion')
                    ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                    ->orderBy('factura_venta.numero', 'desc')
                    ->get();
            }

            $ultima_factura = $facturas->first()->numero;

            // Recorrer las facturas y agregar los productos
            foreach ($facturas as $key => $factura) {
                $factura->productos = DB::table('detalle_factura_venta')
                    ->where('detalle_factura_venta.factura_id', $factura->id)
                    ->get();

                foreach ($factura->productos as $key => $producto) {
                    if ($producto->producto) {
                        $producto->detalle = DB::table('productos')
                            ->select('productos.nombre', 'productos.marca', 'productos.modelo', 'detalle_factura_venta.description')
                            ->join('detalle_factura_venta', 'detalle_factura_venta.producto', '=', 'productos.id')
                            ->where('productos.id', $producto->producto)
                            ->first();
                    }
                }
            }

            if ($facturas->isEmpty()) {
                return view('errors.404');
            } else {
                return view('admin.contabilidad.ventas.pdf.factura_venta_export', compact('facturas', 'ultima_factura'));
            }
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function excel(Request $request)
    {
        //Validar si existe la sesión de la consulta
        if (session()->has('facturas_venta_filtro')) {
            $facturas = session('facturas_venta_filtro');
        } else {
            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->orderBy('factura_venta.numero', 'desc')
                ->get();
        }

        // Recorrer las facturas y agregar los productos
        foreach ($facturas as $key => $factura) {
            $factura->detalle = DB::table('detalle_factura_venta')
                ->where('detalle_factura_venta.factura_id', $factura->id)
                ->get();

            foreach ($factura->detalle as $key => $producto) {
                if ($producto->producto) {
                    $producto->producto = DB::table('productos')
                        ->select('nombre', 'marca', 'modelo')
                        ->where('id', $producto->producto)
                        ->first();
                }
            }
        }

        if ($facturas->isEmpty()) {
            return response()->json(['info' => 0, 'error' => 'No hay facturas de venta para exportar']);
        } else {
            $data = $facturas->toArray();
            return Excel::download(new FacturasVentaExcel($data), 'Facturas de venta.xlsx');
        }
    }
}
