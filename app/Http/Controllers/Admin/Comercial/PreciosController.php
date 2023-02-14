<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use App\Mail\CopyPreciosMail;
use App\Mail\PreciosMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PreciosController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('gestionar_precios_proveedores')) {
                return redirect()->route('home');
            }*/

            $pendientes = DB::table('precio_proveedores')
                ->select('precio_proveedores.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'precio_proveedores.proveedor_id')
                ->where('precio_proveedores.status', 0)
                ->get();

            $aprobados = DB::table('precio_proveedores')
                ->select('precio_proveedores.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'precio_proveedores.proveedor_id')
                ->where('precio_proveedores.status', 1)
                ->get();

            $proveedores = DB::table('proveedores')
                ->select('id', 'razon_social')
                ->where('estado', 1)
                ->get();

            $productos = DB::table('productos')
                ->select('id', 'nombre', 'marca', 'modelo')
                ->where('status', 1)
                ->get();

            return view('admin.comercial.precios', compact('proveedores', 'productos', 'pendientes', 'aprobados'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $proveedor = $request->proveedor;
            $moneda = $request->moneda;
            $fecha = $request->fecha;
            $productos = $request->productos;
            $cantidades = $request->cantidades;
            $notas = $request->notas;

            $precio_id = DB::table('precio_proveedores')->insertGetId([
                'code' => 'PR-' . Str::upper(Str::random(6)),
                'proveedor_id' => $proveedor,
                'moneda' => $moneda,
                'fecha_limite' => $fecha,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            foreach ($productos as $key => $producto) {
                DB::table('detalle_precios')->insert([
                    'precio_id' => $precio_id,
                    'producto_id' => $producto,
                    'cantidad_requerida' => $cantidades[$key],
                    'nota' => $notas[$key] ?? null,
                ]);
            }

            DB::commit();
            return response()->json(['info' => 1, 'message' => 'Precio agregado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'message' => 'Error al agregar el precio.']);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $proveedor = $request->proveedor;
            $moneda = $request->moneda;
            $fecha = $request->fecha;
            $productos = $request->productos;
            $cantidades = $request->cantidades;
            $notas = $request->notas;

            DB::table('precio_proveedores')->where('id', $id)->update([
                'proveedor_id' => $proveedor,
                'moneda' => $moneda,
                'fecha_limite' => $fecha,
            ]);

            DB::table('detalle_precios')->where('precio_id', $id)->delete();

            foreach ($productos as $key => $producto) {
                DB::table('detalle_precios')->insert([
                    'precio_id' => $id,
                    'producto_id' => $producto,
                    'cantidad_requerida' => $cantidades[$key],
                    'nota' => $notas[$key] ?? null,
                ]);
            }

            DB::commit();
            return response()->json(['info' => 1, 'message' => 'Solicitud modificada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'message' => 'Error al modificar la solicitud.']);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;

            DB::table('precio_proveedores')->where('id', $id)->delete();
            DB::table('detalle_precios')->where('precio_id', $id)->delete();

            DB::commit();
            return response()->json(['info' => 1, 'message' => 'Precio eliminado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'message' => 'Error al eliminar el precio.']);
        }
    }

    public function send_email(Request $request)
    {
        try {
            $id = $request->id;
            $emails = $request->emails;

            $data = DB::table('precio_proveedores')
                ->select('precio_proveedores.*', 'proveedores.razon_social', 'proveedores.nit')
                ->join('proveedores', 'proveedores.id', '=', 'precio_proveedores.proveedor_id')
                ->where('precio_proveedores.id', $id)
                ->first();

            Mail::to($emails)->send(new PreciosMail($id, $data->code, $data->razon_social, $data->fecha_limite));

            return response()->json(['info' => 1, 'message' => 'Email enviado correctamente.']);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function precios_update(Request $request)
    {
        try {
            $id = $request->get('id');
            $code = $request->get('token');
            $status = 0;
            $date = date('Y-m-d');

            if ($id == null || $code == null) {
                return view('errors.404');
            }

            if (auth()->user()) {
                $status = 1;
            }

            $precio = DB::table('precio_proveedores')
                ->select('precio_proveedores.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.clave', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'precio_proveedores.proveedor_id')
                ->where('precio_proveedores.id', $id)
                ->where('precio_proveedores.code', $code)
                ->where('precio_proveedores.status', $status)
                ->first();

            if ($precio == null) {
                return view('errors.404');
            }

            if ($precio->file_cotizacion != null) {
                $precio->file_cotizacion = 'images/precios_proveedores/' . ($precio->file_cotizacion);
            }

            if (!auth()->user()) {
                if ($precio->fecha_limite < $date) {
                    return view('errors.404');
                }
            }

            $productos = DB::table('detalle_precios')
                ->select('detalle_precios.*', 'productos.nombre', 'productos.modelo')
                ->join('productos', 'productos.id', '=', 'detalle_precios.producto_id')
                ->where('detalle_precios.precio_id', $id)
                ->get();

            return view('admin.comercial.precios_update', compact('precio', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function precios_update_view(Request $request)
    {
        try {
            $id = $request->get('id');
            $code = $request->get('token');
            $status = 1;
            $date = date('Y-m-d');

            if ($id == null || $code == null) {
                return view('errors.404');
            }

            $precio = DB::table('precio_proveedores')
                ->select('precio_proveedores.*', 'proveedores.razon_social', 'proveedores.nit', 'proveedores.clave', 'proveedores.codigo_verificacion')
                ->join('proveedores', 'proveedores.id', '=', 'precio_proveedores.proveedor_id')
                ->where('precio_proveedores.id', $id)
                ->where('precio_proveedores.code', $code)
                ->where('precio_proveedores.status', $status)
                ->first();

            if ($precio == null) {
                return view('errors.404');
            }

            if ($precio->file_cotizacion != null) {
                $precio->file_cotizacion = 'images/precios_proveedores/' . ($precio->file_cotizacion);
            }

            if ($precio->fecha_limite < $date) {
                return view('errors.404');
            }

            $productos = DB::table('detalle_precios')
                ->select('detalle_precios.*', 'productos.nombre', 'productos.modelo')
                ->join('productos', 'productos.id', '=', 'detalle_precios.producto_id')
                ->where('detalle_precios.precio_id', $id)
                ->get();

            return view('admin.comercial.precios_update_view', compact('precio', 'productos'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function precios_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $fecha_entrega = $request->fecha_entrega;
            $condicion_entrega = $request->condicion_entrega;
            $condiciones_pago = $request->condiciones_pago;
            $precio_dolar = $request->precio_dolar;
            $total = $request->total;
            $productos = json_decode($request->productos, true);
            $email = $request->email;
            $file = $request->file;
            $name = null;
            $precio = DB::table("detalle_precios")->where('id', $productos[0]['id'])->first();
            

            if ($file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images/precios_proveedores/', $name);
            }

            foreach ($productos as $producto) {
                DB::table('detalle_precios')->where('id', $producto['id'])->update([
                    'cantidad_disponible' => $producto['cantidad'],
                    'precio' => $producto['precio'],
                    'descuento' => $producto['descuento'],
                    'comentario' => $producto['comentario'],
                    'iva' => $producto['iva'],
                    'status' => 1
                ]);
            }

            DB::table('precio_proveedores')->where('id', $precio->precio_id)->update([
                'fecha_entrega' => $fecha_entrega,
                'condiciones_entrega' => $condicion_entrega,
                'condiciones_pago' => $condiciones_pago,
                'precio_dolar' => $precio_dolar == null ? 0 : $precio_dolar,
                'total' => $total,
                'file_cotizacion' => $name,
                'status' => 1
            ]);

            $data = DB::table('precio_proveedores')
                ->select('precio_proveedores.*', 'proveedores.razon_social', 'proveedores.nit')
                ->join('proveedores', 'proveedores.id', '=', 'precio_proveedores.proveedor_id')
                ->where('precio_proveedores.id', $precio->precio_id)
                ->first();

            Mail::to($email)->send(new CopyPreciosMail($data->id, $data->code, $data->razon_social, $data->fecha_limite));

            DB::commit();
            return response()->json(['info' => 1, 'message' => 'Precio actualizado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            return response()->json(['info' => 0, 'message' => 'Error al actualizar el precio.']);
        }
    }

    public function data_precios(Request $request)
    {
        $id = $request->id;
        $data = DB::table('precio_proveedores')
            ->select('precio_proveedores.*')
            ->where('precio_proveedores.id', $id)
            ->first();

        $productos = DB::table('detalle_precios')
            ->select('detalle_precios.*', 'productos.nombre', 'productos.modelo')
            ->join('productos', 'productos.id', '=', 'detalle_precios.producto_id')
            ->where('detalle_precios.precio_id', $id)
            ->get();

        return response()->json(['info' => 1, 'data' => $data, 'productos' => $productos]);
    }
}
