<?php

namespace App\Http\Controllers\Admin\Contabilidad\Ventas;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaCreditoController extends Controller
{
    public function index(Request $request)
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('contabilidad_recibo_pago')) {
                return redirect()->route('home');
            }*/

            $id = $request->get('id');

            if (!$id || $id < 1) {
                return view('errors.404');
            }

            $factura = DB::table('factura_venta')
                ->where('factura_venta.id', $id)
                ->first();

            if (!$factura) {
                return view('errors.404');
            }

            $last_number = DB::table('nota_credito_fv')
                ->select('numero')
                ->orderBy('numero', 'desc')
                ->first();

            if (!$last_number) {
                $num_consecutivo = 1;
            } else {
                $num_consecutivo = $last_number->numero + 1;
            }

            $usuarios = DB::table('empleados')
                ->select('id', 'nombre')
                ->where('status', 1)
                ->get();

            $clientes = DB::table('cliente')
                ->select('id', 'razon_social', 'nit')
                ->where('estado', 1)
                ->get();

            $impuestos_cargos = DB::table('configuracion_impuestos')
                ->where('en_uso', 1)
                ->where('nombre', 'like', '%iva %')
                ->get();

            $formas_pago = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 1)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();


            return view('admin.contabilidad.ventas.nota_credito', compact('factura', 'num_consecutivo', 'usuarios', 'clientes', 'impuestos_cargos', 'formas_pago', 'productos'));
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
            $tipo_nc = $request->tipo_nc;
            $fecha_nc = $request->fecha_nc;
            $usuario_nc = $request->usuario_nc;
            $consecutivo_nc = $request->consecutivo_nc;
            $motivo_nc = $request->motivo_nc;

            $id = $request->id;
            $fecha = $request->fecha;
            $cliente = $request->cliente;
            $vendedor = $request->vendedor;
            $consecutivo = $request->consecutivo;
            $total = $request->total;
            $productos = json_decode($request->productos, true);
            $observaciones = $request->observaciones;

            $total_bruto = $request->total_bruto;
            $descuentos = $request->descuentos;
            $subtotal = $request->subtotal;
            $impuestos_1 = $request->impuestos_1;
            $impuestos_2 = $request->impuestos_2;

            $retefuente = $request->retefuente;
            $reteica = $request->reteica;
            $reteiva = $request->reteiva;

            $valid_cons = DB::table('nota_credito_fv')
                ->where('numero', $consecutivo)
                ->first();

            $valid_cons_nc = DB::table('nota_credito_fv')
                ->where('consecutivo_nc', $consecutivo_nc)
                ->first();

            if ($valid_cons) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'La factura de venta ya existe']);
            }

            if ($valid_cons_nc) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'El consecutivo de la nota crédito ya existe']);
            }

            $id = DB::table("nota_credito_fv")->insertGetId([
                'tipo_nc' => $tipo_nc,
                'fecha_elaboracion_nc' => $fecha_nc,
                'usuario_nc' => $usuario_nc,
                'consecutivo_nc' => $consecutivo_nc,
                'motivo_nc' => $motivo_nc,
                'numero' => $consecutivo,
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
                'adjunto_pdf' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);

            if (!$id) {
                DB::rollBack();
                return response()->json(['info' => 0, 'error' => 'Error al crear la nota crédito']);
            }

            foreach ($productos as $producto) {
                $detalle = DB::table("detalle_nota_credito_fv")->insert([
                    'nota_credito_id' => $id,
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
                    return response()->json(['info' => 0, 'error' => 'Error al crear el detalle de la nota crédito']);
                }
            }

            DB::table('factura_venta')
                ->where('id', $request->id)
                ->update([
                    'status' => 0,
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Nota crédito creada correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }
}