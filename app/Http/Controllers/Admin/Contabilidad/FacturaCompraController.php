<?php

namespace App\Http\Controllers\Admin\Contabilidad;

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
                ->orderBy('id', 'desc')
                ->first();

            $num_factura = $last_factura->numero + 1;

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
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
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $facturas = DB::table('factura_compra')
                ->select('factura_compra.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'factura_compra.proveedor_id')
                ->where('factura_compra.status', 1)
                ->whereMonth('factura_compra.fecha_elaboracion', '=', date('m'))
                ->whereYear('factura_compra.fecha_elaboracion', '=', date('Y'))
                ->orderBy('factura_compra.id', 'desc')
                ->get();

            return view('admin.contabilidad.factura_compra', compact('productos', 'formas_pago', 'centros_costos', 'proveedores', 'cuentas_gastos', 'facturas', 'num_factura'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
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
            $productos = $request->productos;

            $factura = DB::table('factura_compra')
                ->select('numero')
                ->orderBy('id', 'desc')
                ->first();

            $num_factura = $factura->numero + 1;

            $id = DB::table("factura_compra")->insertGetId([
                'numero' => $num_factura,
                'tipo' => $tipo,
                'centro_costo' => $centro,
                'fecha_elaboracion' => $fecha,
                'fecha_vencimiento' => date('Y-m-d', strtotime($fecha . ' + 30 days')),
                'proveedor_id' => $proveedor,
                'factura_proveedor' => $factura_proveedor,
                'num_factura_proveedor' => $consecutivo_proveedor,
                'valor_total' => $total,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);

            if (!$id) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'Error al crear la factura de compra']);
            }

            foreach ($productos as $producto) {
                $detalle = DB::table("detalle_factura_compra")->insert([
                    'factura_id' => $id,
                    'tipo' => $producto['tipo'],
                    'producto' => $producto['producto'] ?? null,
                    //'cuenta' => $producto['cuenta'] ?? null,
                    'description' => $producto['descripcion'],
                    'bodega' => $producto['bodega'],
                    'cantidad' => $producto['cantidad'],
                    'valor_unitario' => $producto['valor_unitario'],
                    'descuento' => $producto['descuento'],
                    'impuesto_cargo' => $producto['impuesto_cargo'],
                    'impuesto_retencion' => $producto['impuesto_retencion'],
                    'valor_total' => $producto['total'],
                ]);

                if (!$detalle) {
                    DB::rollBack();
                    return response()->json(['info' => 0, 'error' => 'Error al crear el detalle de la factura de compra']);
                }
            }

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Factura de compra creada correctamente']);
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

        $detalle = DB::table('detalle_factura_compra')
            ->select('detalle_factura_compra.*', 'productos.nombre as producto', 'configuracion_puc.nombre as cuenta')
            ->join('productos', 'productos.id', '=', 'detalle_factura_compra.producto')
            ->join('configuracion_puc', 'configuracion_puc.id', '=', 'detalle_factura_compra.cuenta')
            ->where('detalle_factura_compra.factura_id', $id)
            ->get();

        return view('admin.contabilidad.pdf.factura_compra', compact('factura', 'detalle'));
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
                ->where('detalle_factura_compra.factura_id', $id)
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
}
