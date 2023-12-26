<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EncuestasClientes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_clientes')) {
                return redirect()->route('home');
            }

            return view('admin.clientes');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function clientes_list()
    {
        try {
            $terceros = DB::table('cliente')->orderBy("id", "DESC")->get();

            /*foreach ($terceros as $key => $value) {
                if($value->tipo_tercero == 1) {
                    $value->avatar = 'proveedores/' . $value->avatar;
                } else if($value->tipo_tercero == 2) {
                    $value->avatar = 'clientes/' . $value->avatar;
                }
            }*/

            return response()->json(["data" => $terceros]);
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
                $anexo->move('images/clientes', $archivo);
            } else {
                $archivo = "noavatar.png";
            }

            $cliente = DB::table("cliente")->insertGetId([
                //"tipo_tercero" => 4,
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
            return response()->json(["info" => 1, "success" => "Tercero creado correctamente"]);
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
                    $anexo->move('images/clientes', $archivo);

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
                } else {
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
                    ]);
                }
            } else if ($tipo == 2) {
                $valid_data = DB::table('datos_facturacion')->where("id_cliente", $cliente)->first();

                if (!$valid_data) {
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
                }

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
                $valid_data = DB::table('datos_tecnico')->where("id_cliente", $cliente)->first();

                if (!$valid_data) {
                    DB::table('datos_tecnico')->insert([
                        'nombre' => "",
                        'indicativo_telefono' => "",
                        'apellido' => "",
                        'telefono' => "",
                        'email' => "",
                        'extension' => "",
                        'id_cliente' => $cliente,
                    ]);
                }

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

                $path = 'images/clientes/' . $anexo->documento;
                if (file_exists($path)) {
                    unlink($path);
                }

                DB::table('anexos_clientes')->where("id", $request->id_anexo)->delete();
            } else if ($tipo == 5) {
                if ($anexo = $request->file('archivo')) {
                    $new_name = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                    $anexo->move('images/clientes', $new_name);

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
                $path = 'images/clientes/' . $anexo->documento;
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

    public function info_cliente(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = DB::table("cliente")->where("id", $request->id)->first();
            DB::commit();
            return response()->json(["info" => 1, "data" => $data]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "data" => []]);
        }
    }

    public function encuestas_clientes(Request $request)
    {
        $tk = $request->get('tk');
        $send = $request->get('send');
        $encuesta_id = $request->get('encuesta_view');

        if ($send && $send == 1) {
            // Consulta de encuesta
            $encuesta = DB::table('encuesta_satisfaccion')->where("id", $tk)->first();

            if ($encuesta && $encuesta->promedio == 0) {
                $send = 1;
                return view('encuestas.clientes', compact('encuesta', 'send'));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        if ($encuesta_id) {
            // Consulta de encuesta
            $encuesta = DB::table('encuesta_satisfaccion')->where("id", $encuesta_id)->first();

            if ($encuesta) {
                $send = 0;
                return view('encuestas.clientes', compact('encuesta', 'send'));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        return redirect('https://radioenlacesas.com');
    }

    public function encuestas(Request $request)
    {
        $id = $request->id;

        $encuestas = DB::table('encuesta_satisfaccion')
            ->where("cliente_id", $id)
            ->get();

        return response()->json(["info" => 1, "encuestas" => $encuestas]);
    }

    public function encuestas_save(Request $request)
    {
        // Obtener que viene en el request
        $data = $request->all();
        $encuesta = $data['encuesta_send'];

        // Calcular el promedio de las respuestas
        $respuestas = [];
        $sumaRespuestas = 0;

        // Iterar sobre las respuestas y calcular el promedio
        for ($i = 1; $i <= 16; $i++) {
            $pregunta = "pregunta" . $i;
            $respuestas[$pregunta] = $data[$pregunta];
            $sumaRespuestas += $data[$pregunta];
        }

        $promedio = $sumaRespuestas / 16; // Dividir por el número de preguntas

        // Agregar las observaciones al array de respuestas
        $respuestas['pregunta_1'] = $data['pregunta_1'];
        $respuestas['pregunta_2'] = $data['pregunta_2'];
        $respuestas['observaciones'] = $data['observaciones'];

        // Actualizar encuesta
        DB::table('encuesta_satisfaccion')->where('id', $encuesta)->update([
            'encargado' => $data['encargado_add'],
            'cargo' => $data['cargo_add'],
            'promedio' => $promedio,
            'respuestas' => json_encode($respuestas), // Almacenar las respuestas como JSON
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect('https://radioenlacesas.com');
    }

    public function encuestas_send(Request $request)
    {
        $id = $request->id;
        $correo = $request->correo;

        // Registro de encuesta
        $encuesta = DB::table('encuesta_satisfaccion')->insertGetId([
            "cliente_id" => $id,
            "email" => $correo,
            "created_at" => date("Y-m-d H:i:s"),
        ]);


        // Envio de correo
        $data = array(
            'encuesta' => $encuesta,
            'fecha' => date("d/m/Y"),
            'cliente' => $id,
        );

        Mail::to($correo)->send(new EncuestasClientes($data));

        return response()->json(["info" => 1]);
    }
}
