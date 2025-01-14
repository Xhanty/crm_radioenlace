<?php

namespace App\Http\Controllers\Admin\Contabilidad\Ventas;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReciboPagoController extends Controller
{
    public function egresos()
    {
        try {
            $last_number = DB::table('pagos_ventas')
                ->select('numero')
                ->where('tipo', 1)
                ->orderBy('numero', 'desc')
                ->first();

            if (!$last_number) {
                $num_egreso = 1;
            } else {
                $num_egreso = $last_number->numero + 1;
            }

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $egresos_simples = DB::table('pagos_ventas')
                ->select('pagos_ventas.*', 'cliente.razon_social as cliente', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                ->join('factura_venta', 'factura_venta.id', '=', 'pagos_ventas.factura_id')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('pagos_ventas.tipo', 1)
                ->where('pagos_ventas.status', '!=', 3)
                ->whereYear('pagos_ventas.fecha_elaboracion', '=', date('Y'))
                ->orderBy('pagos_ventas.numero', 'desc')
                ->get();

            $egresos_grupales = DB::table('pagos_ventas')
                ->select('pagos_ventas.*', 'cliente.razon_social as cliente', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                ->join('cliente', 'cliente.id', '=', 'pagos_ventas.cliente_id')
                ->where('pagos_ventas.tipo', 1)
                ->whereNull('pagos_ventas.factura_id')
                ->whereYear('pagos_ventas.fecha_elaboracion', '=', date('Y'))
                ->orderBy('pagos_ventas.numero', 'desc')
                ->get();

            $rete_fuentes = DB::table('configuracion_impuestos')
                ->where('tipo_impuesto', 2)
                ->get();

            $rete_iva = DB::table('configuracion_impuestos')
                ->where('tipo_impuesto', 3)
                ->get();

            $rete_ica = DB::table('configuracion_impuestos')
                ->where('tipo_impuesto', 4)
                ->get();

            //Ordenar los egresos por numero

            $egresos = $egresos_simples->merge($egresos_grupales)->sortByDesc('numero');

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            return view('admin.contabilidad.ventas.egresos', compact('egresos', 'clientes', 'num_egreso', 'formas_pago', 'rete_fuentes', 'rete_iva', 'rete_ica'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function index(Request $request)
    {
        try {
            if (!auth()->user()->hasPermissionTo('contabilidad_recibo_pago')) {
                return redirect()->route('home');
            }

            $id = $request->get('fc');

            if (!$id || $id < 1) {
                return view('errors.404');
            }

            $factura = DB::table('factura_venta')
                ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('factura_venta.id', $id)
                ->first();

            if (!$factura) {
                return view('errors.404');
            }

            $last_number = DB::table('pagos_ventas')
                ->select('numero')
                ->where('tipo', 1)
                ->orderBy('numero', 'desc')
                ->first();

            if (!$last_number) {
                $num_egreso = 1;
            } else {
                $num_egreso = $last_number->numero + 1;
            }

            $centros_costos = DB::table('centros_costo')
                ->select('id', 'nombre', 'code')
                ->where('status', 1)
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $pagos = DB::table('pagos_ventas')
                ->select('pagos_ventas.*', 'empleados.nombre as creador')
                ->join('empleados', 'empleados.id', '=', 'pagos_ventas.created_by')
                ->where('factura_id', $id)
                ->where('tipo', 1)
                ->orderBy('id', 'asc')
                ->get();

            $rete_fuentes = DB::table('configuracion_impuestos')
                ->where('tipo_impuesto', 2)
                ->get();

            $rete_iva = DB::table('configuracion_impuestos')
                ->where('tipo_impuesto', 3)
                ->get();

            $rete_ica = DB::table('configuracion_impuestos')
                ->where('tipo_impuesto', 4)
                ->get();

            return view('admin.contabilidad.ventas.recibo_pago', compact('factura', 'num_egreso', 'centros_costos', 'clientes', 'formas_pago', 'pagos', 'rete_fuentes', 'rete_iva', 'rete_ica'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function info(Request $request)
    {
        try {
            $id = $request->id;
            $cuota = 0;
            $data = DB::table('pagos_ventas')
                ->select(
                    'pagos_ventas.*',
                    'configuracion_puc.nombre as forma_pago',
                    'cliente.razon_social as cliente',
                    'cliente.nit',
                    'cliente.codigo_verificacion',
                    'cliente.ciudad',
                    'cliente.telefono_fijo',
                    'factura_venta.valor_total as valor_factura',
                    'factura_venta.numero as numero_factura',
                )
                ->join('configuracion_puc', 'configuracion_puc.id', '=', 'pagos_ventas.forma_pago')
                ->join('factura_venta', 'factura_venta.id', '=', 'pagos_ventas.factura_id')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('pagos_ventas.id', $id)
                ->first();

            if (!$data) {
                return response()->json(['error' => 'No se encontraron datos', 'info' => 0]);
            }

            //Consultar factura
            $factura = DB::table('factura_venta')
                ->where('id', $data->factura_id)
                ->first();

            $data->factura = $factura;

            $cuotas = DB::table('pagos_ventas')
                ->where('factura_id', $data->factura_id)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            $lleva = DB::table('pagos_ventas')
                ->where('factura_id', $data->factura_id)
                ->where('id', '<', $id)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            foreach ($cuotas as $key => $value) {
                if ($value->id == $id) {
                    $cuota = $key + 1;
                }
            }

            return response()->json(['data' => $data, 'info' => 1, 'cuota' => $cuota, 'cuotas' => $lleva]);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'info' => 0]);
        }
    }

    public function info_grupales(Request $request)
    {
        try {
            $id = $request->id;
            $data = DB::table('pagos_ventas')
                ->select(
                    'pagos_ventas.*',
                    'configuracion_puc.nombre as forma_pago',
                    'cliente.razon_social as cliente',
                    'cliente.nit',
                    'cliente.codigo_verificacion',
                    'cliente.ciudad',
                    'cliente.telefono_fijo',
                )
                ->join('configuracion_puc', 'configuracion_puc.id', '=', 'pagos_ventas.forma_pago')
                ->join('cliente', 'cliente.id', '=', 'pagos_ventas.cliente_id')
                ->where('pagos_ventas.id', $id)
                ->first();

            //Facturas
            $js_facturas = json_decode($data->grupo_facturas);
            foreach ($js_facturas as $key => $value) {
                $factura = DB::table('factura_venta')
                    ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                    ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                    ->where('factura_venta.id', $value->id)
                    ->first();

                $js_facturas[$key]->factura = $factura;
            }

            $data->facturas = $js_facturas;

            if (!$data) {
                return response()->json(['error' => 'No se encontraron datos', 'info' => 0]);
            }

            return response()->json(['data' => $data, 'info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'info' => 0]);
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $factura_id = $request->id;
            //$tipo = $request->tipo;
            $fecha = $request->fecha;
            //$transaccion = $request->transaccion;
            $forma_pago = $request->forma_pago;
            //$total = $request->total;
            $pagado = $request->pagado;
            $terminado = $request->terminado;
            $numero_siigo = $request->numero_siigo;
            $observacion = $request->observacion;
            $adjunto = null;

            $last_number = DB::table('pagos_ventas')
                ->select('numero')
                ->where('tipo', 1)
                ->orderBy('numero', 'desc')
                ->first();


            if (!$last_number) {
                $numero = 1;
            } else {
                $numero = $last_number->numero + 1;
            }

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/contabilidad/recibos_caja/', $name);
                $adjunto = $name;
            }

            DB::table('pagos_ventas')->insert([
                'numero' => $numero,
                'numero_siigo' => $numero_siigo,
                'tipo' => 1,
                'factura_id' => $factura_id,
                'fecha_elaboracion' => $fecha,
                'forma_pago' => $forma_pago,
                'valor' => $pagado,
                'status' => 1,
                'observacion' => $observacion,
                'adjunto_pdf' => $adjunto ?? null,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($terminado == 1) {
                DB::table('factura_venta')
                    ->where('id', $factura_id)
                    ->update([
                        'status' => 2,
                    ]);

                DB::table('pagos_ventas')
                    ->where('id', $factura_id)
                    ->where('tipo', 0)
                    ->update([
                        'status' => 1,
                    ]);
            }

            DB::commit();
            return response()->json(['info' => 1, 'msg' => 'Pago registrado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function pdf(Request $request)
    {
        try {
            $id = $request->get('token');
            $grupal = $request->get('grupal');

            if (!$id) {
                return view('errors.500');
            }

            if ($grupal == 1) {
                $data = DB::table('pagos_ventas')
                    ->select(
                        'pagos_ventas.*',
                        'configuracion_puc.nombre as forma_pago',
                        'cliente.razon_social as cliente',
                        'cliente.nit',
                        'cliente.codigo_verificacion',
                        'cliente.ciudad',
                        'cliente.direccion',
                        'cliente.telefono_fijo',
                    )
                    ->join('configuracion_puc', 'configuracion_puc.id', '=', 'pagos_ventas.forma_pago')
                    ->join('cliente', 'cliente.id', '=', 'pagos_ventas.cliente_id')
                    ->where('pagos_ventas.id', $id)
                    ->first();

                //Facturas
                $js_facturas = json_decode($data->grupo_facturas);
                foreach ($js_facturas as $key => $value) {
                    $factura = DB::table('factura_venta')
                        ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                        ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                        ->where('factura_venta.id', $value->id)
                        ->first();

                    $js_facturas[$key]->factura = $factura;
                }

                $data->facturas = $js_facturas;
                return view('admin.contabilidad.ventas.pdf.egreso_grupal', compact('data'));
            }

            $cuota = 0;
            $data = DB::table('pagos_ventas')
                ->select(
                    'pagos_ventas.*',
                    'configuracion_puc.nombre as forma_pago',
                    'cliente.razon_social as cliente',
                    'cliente.nit',
                    'cliente.codigo_verificacion',
                    'cliente.ciudad',
                    'cliente.direccion',
                    'cliente.telefono_fijo',
                    'factura_venta.valor_total as valor_factura',
                    'factura_venta.numero as numero_factura',
                )
                ->join('configuracion_puc', 'configuracion_puc.id', '=', 'pagos_ventas.forma_pago')
                ->join('factura_venta', 'factura_venta.id', '=', 'pagos_ventas.factura_id')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('pagos_ventas.id', $id)
                ->first();

            if (!$data) {
                return view('errors.500');
            }

            $cuotas = DB::table('pagos_ventas')
                ->where('factura_id', $data->factura_id)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            $lleva = DB::table('pagos_ventas')
                ->where('factura_id', $data->factura_id)
                ->where('id', '<', $id)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            foreach ($cuotas as $key => $value) {
                if ($value->id == $id) {
                    $cuota = $key + 1;
                }
            }

            $factura = DB::table('factura_venta')
                ->where('id', $data->factura_id)
                ->first();

            return view('admin.contabilidad.ventas.pdf.egreso', compact('data', 'cuota', 'lleva', 'factura'));
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
            return view('errors.500');
        }
    }

    public function cliente_facturas(Request $request)
    {
        $cliente = $request->cliente;

        $facturas = DB::table('factura_venta')
            ->where('cliente_id', $cliente)
            ->where('status', 1)
            ->get();

        // Pagos de la factura
        foreach ($facturas as $key => $value) {
            $pagos = DB::table('pagos_ventas')
                ->where('cliente_id', $cliente)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            $value->pagos = $pagos;
        }

        return response()->json(['info' => 1, 'facturas' => $facturas]);
    }

    public function data_recibo_info(Request $request)
    {
        $recibo_id = $request->id;

        $recibo = DB::table('pagos_ventas')
            ->where('id', $recibo_id)
            ->first();

        $cliente = $recibo->cliente_id;

        $facturas = DB::table('factura_venta')
            ->where('cliente_id', $cliente)
            ->where('status', 1)
            ->get();

        // Pagos de la factura
        foreach ($facturas as $key => $value) {
            $pagos = DB::table('pagos_ventas')
                ->where('cliente_id', $cliente)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            $value->pagos = $pagos;
        }

        return response()->json(['info' => 1, 'facturas' => $facturas, 'recibo' => $recibo]);
    }

    public function anular_recibo_caja(Request $request)
    {
        $id = $request->id;

        DB::table('pagos_ventas')
            ->where('id', $id)
            ->update([
                'status' => 4,
            ]);

        return response()->json(['info' => 1, 'msg' => 'Recibo anulado correctamente']);
    }

    public function pago_grupo_add(Request $request)
    {
        $tipo = $request->tipo;
        $fecha = $request->fecha;
        $cliente = $request->cliente;
        //$numero = $request->numero;
        $numero_siigo = $request->numero_siigo;
        //$transaccion = $request->transaccion;
        $forma_pago = $request->forma_pago;
        $pagado = $request->pagado;
        $facturas = json_decode($request->facturas);
        $observacion = $request->observacion;
        $archivo = $request->archivo;
        $adjunto = null;

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $name = time() . $file->getClientOriginalName();
            $file->move('images/contabilidad/recibos_caja/', $name);
            $adjunto = $name;
        }

        $last_number = DB::table('pagos_ventas')
            ->select('numero')
            ->where('tipo', 1)
            ->orderBy('numero', 'desc')
            ->first();

        if (!$last_number) {
            $numero = 1;
        } else {
            $numero = $last_number->numero + 1;
        }

        DB::table('pagos_ventas')->insert([
            'numero' => $numero,
            'numero_siigo' => $numero_siigo,
            'tipo' => 1,
            //'factura_id' => $factura_id,
            'grupo_facturas' => json_encode($facturas),
            'cliente_id' => $cliente,
            'fecha_elaboracion' => $fecha,
            'forma_pago' => $forma_pago,
            'valor' => $pagado,
            'status' => 1,
            'observacion' => $observacion,
            'adjunto_pdf' => $adjunto ?? null,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        foreach ($facturas as $key => $value) {
            $factura = DB::table('factura_venta')
                ->where('id', $value->id)
                ->first();

            if ($factura->valor_total == $value->valor) {
                DB::table('factura_venta')
                    ->where('id', $value->id)
                    ->update([
                        'status' => 2,
                    ]);
            }
        }

        return response()->json(['info' => 1, 'msg' => 'Pago registrado correctamente']);
    }

    public function pago_grupo_edit(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;
        $fecha = $request->fecha;
        $cliente = $request->cliente;
        //$numero = $request->numero;
        $numero_siigo = $request->numero_siigo;
        //$transaccion = $request->transaccion;
        $forma_pago = $request->forma_pago;
        $pagado = $request->pagado;
        $facturas = json_decode($request->facturas);
        $observacion = $request->observacion;
        $archivo = $request->archivo;
        $adjunto = null;

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $name = time() . $file->getClientOriginalName();
            $file->move('images/contabilidad/recibos_caja/', $name);
            $adjunto = $name;
        }

        DB::table('pagos_ventas')->where('id', $id)->update([
            'numero_siigo' => $numero_siigo,
            'grupo_facturas' => json_encode($facturas),
            'cliente_id' => $cliente,
            'fecha_elaboracion' => $fecha,
            'forma_pago' => $forma_pago,
            'valor' => $pagado,
            'status' => 1,
            'observacion' => $observacion,
            'adjunto_pdf' => $adjunto ?? null,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        foreach ($facturas as $key => $value) {
            $factura = DB::table('factura_venta')
                ->where('id', $value->id)
                ->first();

            if ($factura->valor_total == $value->valor) {
                DB::table('factura_venta')
                    ->where('id', $value->id)
                    ->update([
                        'status' => 2,
                    ]);
            }
        }

        return response()->json(['info' => 1, 'msg' => 'Pago registrado correctamente']);
    }

    public function filtrar_recibos_caja(Request $request)
    {
        $cliente = $request->cliente;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        
        $egresos_grupales = DB::table('pagos_ventas')
            ->select('pagos_ventas.*', 'cliente.razon_social as cliente', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
            ->join('cliente', 'cliente.id', '=', 'pagos_ventas.cliente_id')
            ->where('pagos_ventas.tipo', 1)
            ->whereNull('pagos_ventas.factura_id');

        if ($cliente) {
            $egresos_grupales = $egresos_grupales->where('cliente_id', $cliente);
        }

        if ($fecha_inicio) {
            $egresos_grupales = $egresos_grupales->where('fecha_elaboracion', '>=', $fecha_inicio);
        }

        if ($fecha_fin) {
            $egresos_grupales = $egresos_grupales->where('fecha_elaboracion', '<=', $fecha_fin);
        }

        $egresos_grupales = $egresos_grupales->orderBy('pagos_ventas.numero', 'desc')
            ->get();

        return response()->json(['info' => 1, 'facturas' => $egresos_grupales]);
    }
}
