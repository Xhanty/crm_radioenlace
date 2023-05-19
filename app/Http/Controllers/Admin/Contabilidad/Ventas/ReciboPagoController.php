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
            $egresos = DB::table('pagos_ventas')
                ->select('pagos_ventas.*', 'cliente.razon_social as cliente', 'cliente.nit', 'cliente.codigo_verificacion', 'cliente.ciudad', 'cliente.telefono_fijo')
                ->join('factura_venta', 'factura_venta.id', '=', 'pagos_ventas.factura_id')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('pagos_ventas.tipo', 1)
                ->whereYear('pagos_ventas.fecha_elaboracion', '=', date('Y'))
                ->orderBy('pagos_ventas.numero', 'desc')
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            return view('admin.contabilidad.ventas.egresos', compact('egresos', 'clientes'));
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
                ->where('factura_id', $id)
                ->where('tipo', 1)
                ->get();

            return view('admin.contabilidad.ventas.recibo_pago', compact('factura', 'num_egreso', 'centros_costos', 'clientes', 'formas_pago', 'pagos'));
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
            $observacion = $request->observacion;

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
                'tipo' => 1,
                'factura_id' => $factura_id,
                'fecha_elaboracion' => $fecha,
                'forma_pago' => $forma_pago,
                'valor' => $pagado,
                'status' => 1,
                'observacion' => $observacion,
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

            if (!$id) {
                return view('errors.500');
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

            return view('admin.contabilidad.ventas.pdf.egreso', compact('data', 'cuota', 'lleva'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
