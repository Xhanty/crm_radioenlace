<?php

namespace App\Http\Controllers\Admin\Contabilidad\Compras;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EgresoController extends Controller
{
    public function comprobantes()
    {
        try {
            /*$facturas = DB::table('factura_venta')->get();

            foreach ($facturas as $key => $value) {
                DB::table('pagos_ventas')->insert([
                    'numero' => 0,
                    'tipo' => 0,
                    'factura_id' => $value->id,
                    'valor' => $value->valor_total,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }*/

            $comprobantes = DB::table('pagos_compras')
                ->select('pagos_compras.*', 'proveedores.razon_social as proveedor', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.ciudad', 'proveedores.telefono_fijo')
                ->join('factura_compra', 'factura_compra.id', '=', 'pagos_compras.factura_id')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->where('pagos_compras.tipo', 1)
                ->whereYear('pagos_compras.fecha_elaboracion', '=', date('Y'))
                ->orderBy('pagos_compras.numero', 'desc')
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            return view('admin.contabilidad.compras.egresos', compact('comprobantes', 'proveedores'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function index(Request $request)
    {
        try {
            $id = $request->get('fc');

            if (!$id || $id < 1) {
                return view('errors.404');
            }

            $factura = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion', 'proveedores.ciudad', 'proveedores.telefono_fijo')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->where('factura_compra.id', $id)
                ->first();

            if (!$factura) {
                return view('errors.404');
            }

            $last_number = DB::table('pagos_compras')
                ->select('numero')
                ->where('tipo', 1)
                ->orderBy('id', 'desc')
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

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $pagos = DB::table('pagos_compras')
                ->where('factura_id', $id)
                ->where('tipo', 1)
                ->get();

            return view('admin.contabilidad.compras.egreso', compact('factura', 'num_egreso', 'centros_costos', 'proveedores', 'formas_pago', 'pagos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function info(Request $request)
    {
        try {
            $id = $request->id;
            $cuota = 0;
            $data = DB::table('pagos_compras')
                ->select(
                    'pagos_compras.*',
                    'configuracion_puc.nombre as forma_pago',
                    'proveedores.razon_social as proveedor',
                    'proveedores.nit',
                    'proveedores.codigo_verificacion',
                    'proveedores.ciudad',
                    'proveedores.telefono_fijo',
                    'factura_compra.valor_total as valor_factura',
                    'factura_compra.factura_proveedor',
                    'factura_compra.num_factura_proveedor',
                )
                ->join('configuracion_puc', 'configuracion_puc.id', '=', 'pagos_compras.forma_pago')
                ->join('factura_compra', 'factura_compra.id', '=', 'pagos_compras.factura_id')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->where('pagos_compras.id', $id)
                ->first();

            if (!$data) {
                return response()->json(['error' => 'No se encontraron datos', 'info' => 0]);
            }

            $cuotas = DB::table('pagos_compras')
                ->where('factura_id', $data->factura_id)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            $lleva = DB::table('pagos_compras')
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
            $centro = $request->centro;
            $fecha = $request->fecha;
            //$transaccion = $request->transaccion;
            $forma_pago = $request->forma_pago;
            //$total = $request->total;
            $pagado = $request->pagado;
            $terminado = $request->terminado;
            $observacion = $request->observacion;

            $last_number = DB::table('pagos_compras')
                ->select('numero')
                ->where('tipo', 1)
                ->orderBy('numero', 'desc')
                ->first();


            if (!$last_number) {
                $numero = 1;
            } else {
                $numero = $last_number->numero + 1;
            }

            DB::table('pagos_compras')->insert([
                'numero' => $numero,
                'tipo' => 1,
                'factura_id' => $factura_id,
                'centro_costo' => $centro,
                'fecha_elaboracion' => $fecha,
                'forma_pago' => $forma_pago,
                'valor' => $pagado,
                'status' => 1,
                'observacion' => $observacion,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($terminado == 1) {
                DB::table('factura_compra')
                    ->where('id', $factura_id)
                    ->update([
                        'status' => 2,
                    ]);

                DB::table('pagos_compras')
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

            if(!$id){
                return view('errors.500');
            }

            $cuota = 0;
            $data = DB::table('pagos_compras')
            ->select(
                'pagos_compras.*',
                'configuracion_puc.nombre as forma_pago',
                'proveedores.razon_social as proveedor',
                'proveedores.nit',
                'proveedores.codigo_verificacion',
                'proveedores.ciudad',
                'proveedores.direccion',
                'proveedores.telefono_fijo',
                'factura_compra.valor_total as valor_factura',
                'factura_compra.factura_proveedor',
                'factura_compra.num_factura_proveedor',
            )
                ->join('configuracion_puc', 'configuracion_puc.id', '=', 'pagos_compras.forma_pago')
                ->join('factura_compra', 'factura_compra.id', '=', 'pagos_compras.factura_id')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->where('pagos_compras.id', $id)
                ->first();

            if (!$data) {
                return view('errors.500');
            }

            $cuotas = DB::table('pagos_compras')
            ->where('factura_id', $data->factura_id)
                ->where('tipo', 1)
                ->where('status', 1)
                ->get();

            $lleva = DB::table('pagos_compras')
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

            return view('admin.contabilidad.compras.pdf.egreso', compact('data', 'cuota', 'lleva'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
