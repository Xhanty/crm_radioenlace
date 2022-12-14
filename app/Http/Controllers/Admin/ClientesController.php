<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        try {
            return view('admin.clientes');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function clientes_list()
    {
        try {
            $clientes = DB::table('cliente')->get();
            return response()->json(["data" => $clientes]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function clientes_data(Request $request)
    {
        try {
            $cliente = DB::table('cliente')->where("id", $request->cliente)->first();
            $facturacion = DB::table('datos_facturacion')->where("id_cliente", $request->cliente)->first();
            $tecnicos = DB::table('datos_tecnico')->where("id_cliente", $request->cliente)->first();
            $anexos = DB::table('anexos_clientes')
                ->select('anexos_clientes.*', 'empleados.nombre as creador')
                ->join("empleados", "empleados.id", "=", "anexos_clientes.created_by")
                ->where("id_cliente", $request->cliente)
                ->get();

            return response()->json(["facturacion" => $facturacion, "tecnicos" => $tecnicos, "anexos" => $anexos, "cliente" => $cliente]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function clientes_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";

            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move(public_path('images/clientes'), $archivo);
            }

            $cliente = DB::table("cliente")->insertGetId([
                "tipo" => $request->tipo_cliente ? $request->tipo_cliente : 0,
                "ciudad" => $request->ciudad ? $request->ciudad : "",
                "tipo_identificacion" => $request->tipo_documento ? $request->tipo_documento : 0,
                "nit" => $request->documento ? $request->documento : "",
                "razon_social" => $request->razon_social ? $request->razon_social : "",
                "direccion" => $request->direccion ? $request->direccion : "",
                "telefono_fijo" => $request->telefono ? $request->telefono : "",
                "celular" => $request->celular ? $request->celular : "",
                "contacto" => $request->contacto ? $request->contacto : "",
                "email" => $request->email ? $request->email : "",
                "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                "codigo_sucursal" => $request->codigo ? $request->codigo : "",
                "indicativo_telefono" => $request->indicativo ? $request->indicativo : "",
                "extencion" => $request->extension ? $request->extension : "",
                "observaciones" => "",
                "avatar" => $archivo,
                "estado" => 1,
                "codigo_verificacion" => 0,
                "documento" => "",
            ]);

            DB::table('datos_facturacion')->insert([
                'nombre' => "",
                'telefono' => "",
                'apellido' => "",
                'extension' => "",
                'email' => "",
                'codigo_postal' => "",
                'tipo_regimen' => "",
                'responsabilidad_fiscal' => "",
                'indicativo_telefono' => "",
                'id_cliente' => $cliente,
            ]);

            DB::table('datos_tecnico')->insert([
                'nombre' => "",
                'indicativo_telefono' => "",
                'apellido' => "",
                'telefono' => "",
                'email' => "",
                'extension' => "",
                'id_cliente' => $cliente,
            ]);

            DB::commit();
            return response()->json(["info" => 1, "success" => "Cliente creado correctamente"]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }

    public function clientes_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $tipo = $request->update_tipo;
            $cliente = $request->id;

            if ($tipo == 1) {
                $archivo = "";

                if ($anexo = $request->file('archivo')) {
                    $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                    $anexo->move(public_path('images/clientes'), $archivo);
                }

                DB::table("cliente")->where("id", $cliente)->update([
                    "tipo" => $request->tipo_cliente ? $request->tipo_cliente : 0,
                    "ciudad" => $request->ciudad ? $request->ciudad : "",
                    "tipo_identificacion" => $request->tipo_documento ? $request->tipo_documento : 0,
                    "nit" => $request->documento ? $request->documento : "",
                    "razon_social" => $request->razon_social ? $request->razon_social : "",
                    "direccion" => $request->direccion ? $request->direccion : "",
                    "telefono_fijo" => $request->telefono ? $request->telefono : "",
                    "celular" => $request->celular ? $request->celular : "",
                    "contacto" => $request->contacto ? $request->contacto : "",
                    "email" => $request->email ? $request->email : "",
                    "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                    "codigo_sucursal" => $request->codigo ? $request->codigo : "",
                    "indicativo_telefono" => $request->indicativo ? $request->indicativo : "",
                    "extencion" => $request->extension ? $request->extension : "",
                    "avatar" => $archivo,
                ]);
            } else if ($tipo == 2) {
                DB::table('datos_facturacion')->where("id_cliente", $cliente)->update([
                    'nombre' => $request->nombre ? $request->nombre : "",
                    'telefono' => $request->telefono ? $request->telefono : "",
                    'apellido' => $request->apellido ? $request->apellido : "",
                    'extension' => $request->extension ? $request->extension : "",
                    'email' => $request->email ? $request->email : "",
                    'codigo_postal' => $request->codigo ? $request->codigo : "",
                    'tipo_regimen' => $request->tipo_regimen ? $request->tipo_regimen : "",
                    'responsabilidad_fiscal' => $request->responsabilidad_fiscal ? $request->responsabilidad_fiscal : "",
                    'indicativo_telefono' => $request->indicativo_telefono ? $request->indicativo_telefono : ""
                ]);
            } else if ($tipo == 3) {
                DB::table('datos_tecnico')->where("id_cliente", $cliente)->update([
                    'nombre' => $request->nombre ? $request->nombre : "",
                    'indicativo_telefono' => $request->indicativo_telefono ? $request->indicativo_telefono : "",
                    'apellido' => $request->apellido ? $request->apellido : "",
                    'telefono' => $request->telefono ? $request->telefono : "",
                    'email' => $request->email ? $request->email : "",
                    'extension' => $request->extension ? $request->extension : "",
                ]);
            } else if ($tipo == 4) {
                $anexo = DB::table('anexos_clientes')->where("id", $request->id_anexo)->first();

                $path = public_path('images/clientes/' . $anexo->documento);
                if (file_exists($path)) {
                    unlink($path);
                }

                DB::table('anexos_clientes')->where("id", $request->id_anexo)->delete();
            } else if ($tipo == 5) {
                if ($anexo = $request->file('archivo')) {
                    $new_name = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                    $anexo->move(public_path('images/clientes'), $new_name);

                    DB::table("anexos_clientes")->insert([
                        "id_cliente" => $cliente,
                        "tipo" => $request->tipo_documento,
                        "documento" => $new_name,
                        "descripcion" => $request->descripcion ? $request->descripcion : "",
                        "fecha" => date("Y-m-d H:i:s"),
                        "created_by" => session('user')
                    ]);
                }
            }

            $anexos_back = DB::table('anexos_clientes')
                ->select('anexos_clientes.*', 'empleados.nombre as creador')
                ->join("empleados", "empleados.id", "=", "anexos_clientes.created_by")
                ->where("id_cliente", $cliente)
                ->get();

            DB::commit();

            return response()->json(["info" => 1, "anexos" => $anexos_back]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }

    public function clientes_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = $request->id;

            $anexos = DB::table('anexos_clientes')->where("id_cliente", $cliente)->get();

            foreach ($anexos as $anexo) {
                $path = public_path('images/clientes/' . $anexo->documento);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            DB::table('anexos_clientes')->where("id_cliente", $cliente)->delete();
            DB::table('datos_facturacion')->where("id_cliente", $cliente)->delete();
            DB::table('datos_tecnico')->where("id_cliente", $cliente)->delete();
            DB::table('cliente')->where("id", $cliente)->delete();

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }

    public function clientes_inactivar(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = $request->id;

            DB::table('cliente')->where("id", $cliente)->update([
                "estado" => $request->estado
            ]);

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }
}
