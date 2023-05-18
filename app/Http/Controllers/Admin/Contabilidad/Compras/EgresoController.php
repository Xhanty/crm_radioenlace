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
            $facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->join("pagos_compras", "pagos_compras.factura_id", "=", "factura_compra.id")
                //->whereMonth('factura_compra.fecha_elaboracion', '=', date('m'))
                ->where('pagos_compras.tipo', '=', 1)
                ->where('factura_compra.status', '>', 0)
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->orderBy('factura_compra.numero', 'desc') // luego ordenar por fecha
                ->groupBy('factura_compra.id')
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            return view('admin.contabilidad.compras.egresos', compact('facturas', 'proveedores'));
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

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $factura_id = $request->id;
            $tipo = $request->tipo;
            $centro = $request->centro;
            $fecha = $request->fecha;
            $numero = $request->numero;
            $transaccion = $request->transaccion;
            $forma_pago = $request->forma_pago;
            $total = $request->total;
            $pagado = $request->pagado;
            $terminado = $request->terminado;
            $observacion = $request->observacion;

            DB::table('pagos_compras')->insert([
                'numero' => $numero,
                'tipo' => 1,
                'factura_id' => $factura_id,
                'valor' => $pagado,
                'status' => 1,
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
}
