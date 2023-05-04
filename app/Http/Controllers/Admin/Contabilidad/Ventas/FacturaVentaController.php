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

            $last_factura = DB::table('factura_venta')
                ->select('numero')
                ->orderBy('id', 'desc')
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

            $facturas = DB::table('factura_venta')
                ->select('factura_venta.*', 'cliente.razon_social', 'cliente.nit', 'cliente.codigo_verificacion')
                ->join('cliente', 'cliente.id', '=', 'factura_venta.cliente_id')
                ->where('factura_venta.status', 1)
                //->whereMonth('factura_venta.fecha_elaboracion', '=', date('m'))
                ->whereYear('factura_venta.fecha_elaboracion', '=', date('Y'))
                ->orderBy('factura_venta.id', 'desc')
                ->get();

            return view('admin.contabilidad.ventas.factura_venta', compact('productos', 'formas_pago', 'clientes', 'usuarios', 'facturas', 'num_factura'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $tipo = $request->tipo;
            $fecha = $request->fecha;
            $vendedor = $request->vendedor;
            $cliente = $request->cliente;
            $total = $request->total;
            $productos = $request->productos;

            $factura = DB::table('factura_venta')
                ->select('numero')
                ->orderBy('id', 'desc')
                ->first();

            if (!$factura) {
                $num_factura = 1;
            } else {
                $num_factura = $factura->numero + 1;
            }

            $id = DB::table("factura_venta")->insertGetId([
                'numero' => $num_factura,
                'tipo' => $tipo,
                'fecha_elaboracion' => $fecha,
                'cliente_id' => $cliente,
                'vendedor_id' => $vendedor,
                'valor_total' => $total,
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
                    //'cuenta' => $producto['cuenta'] ?? null,
                    'description' => $producto['descripcion'],
                    'bodega' => $producto['bodega'],
                    'cantidad' => $producto['cantidad'],
                    'valor_unitario' => $producto['valor_unitario'],
                    'descuento' => $producto['descuento'],
                    //'impuesto_cargo' => $producto['impuesto_cargo'],
                    //'impuesto_retencion' => $producto['impuesto_retencion'],
                    'valor_total' => $producto['total'],
                ]);

                if (!$detalle) {
                    DB::rollBack();
                    return response()->json(['info' => 0, 'error' => 'Error al crear el detalle de la factura de compra']);
                }
            }

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Factura de venta creada correctamente']);
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
            } else {
                $producto->detalle = DB::table('configuracion_puc')
                    ->select('code', 'nombre')
                    ->where('id', $producto->cuenta)
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
