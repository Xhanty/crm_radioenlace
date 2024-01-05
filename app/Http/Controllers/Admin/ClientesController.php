<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EncuestasClientes;
use App\Mail\SagrilaftClientesMail;
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
            $cliente = DB::table('cliente')->where("id", $encuesta->cliente_id)->first();

            if ($encuesta && $encuesta->promedio == 0) {
                $send = 1;
                return view('encuestas.clientes', compact('encuesta', 'send', "cliente"));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        if ($encuesta_id) {
            // Consulta de encuesta
            $encuesta = DB::table('encuesta_satisfaccion')->where("id", $encuesta_id)->first();
            $cliente = DB::table('cliente')->where("id", $encuesta->cliente_id)->first();

            if ($encuesta) {
                $send = 0;
                return view('encuestas.clientes', compact('encuesta', 'send', "cliente"));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        return redirect('https://radioenlacesas.com');
    }

    // Encuestas
    public function encuestas(Request $request)
    {
        $id = $request->id;

        $encuestas = DB::table('encuesta_satisfaccion')
            ->where("cliente_id", $id)
            ->get();

        $cliente = DB::table('cliente')->where("id", $encuestas->cliente_id)->first();

        return response()->json(["info" => 1, "encuestas" => $encuestas, "cliente" => $cliente]);
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


    // SAGRILAFT
    public function sagrilaft_clientes(Request $request)
    {
        $tk = $request->get('tk');
        $send = $request->get('send');
        $sagrilaft_id = $request->get('cuestionario_view');

        if ($send && $send == 1) {
            // Consulta de sagrilaft
            $sagrilaft = DB::table('sagrilafts')->where("id", $tk)->first();

            if ($sagrilaft) {
                $send = 1;
                return view('sagrilafts.clientes', compact('sagrilaft', 'send'));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        if ($sagrilaft_id) {
            // Consulta de sagrilaft
            $sagrilaft = DB::table('sagrilafts')->where("id", $sagrilaft_id)->first();

            if ($sagrilaft) {
                $send = 0;

                if ($sagrilaft->tipo_persona == 1) {
                    $sagrilaft->naturales = DB::table('sagrilaft_naturales')->where("sagrilaft_id", $sagrilaft->id)->first();
                } else {
                    $sagrilaft->juridicos = DB::table('sagrilaft_juridicos')->where("sagrilaft_id", $sagrilaft->id)->first();
                }

                return view('sagrilafts.clientes', compact('sagrilaft', 'send'));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        return redirect('https://radioenlacesas.com');
    }

    public function sagrilafts(Request $request)
    {
        $id = $request->id;

        $sagrilafts = DB::table('sagrilafts')
            ->where("cliente_id", $id)
            ->get();

        return response()->json(["info" => 1, "sagrilafts" => $sagrilafts]);
    }

    public function sagrilaft_save(Request $request)
    {
        // Obtener que viene en el request
        $data = $request->all();
        
        $sagrilaft = $data['sagrilaft_send'];
        $tipo_persona = $data['tipo_persona'];

        // Actualizar sagrilaft dependiendo del tipo de persona
        // 1 = Persona natural
        // 2 = Persona juridica
        if ($tipo_persona == 1) {
            DB::table('sagrilafts')->where('id', $sagrilaft)->update([
                'ingresos_mensuales' => $data['ingresos'],
                'egresos_mensuales' => $data['egresos'],
                'activos' => $data['activos'],
                'pasivos' => $data['pasivos'],
                'patrimonio' => $data['patrimonio'],
                'revisor_fiscal' => $data['revisor_fiscal'],
                'otros_ingresos' => $data['otros_ingresos'],
                //'concepto_otros_ingresos' => null,
                'operaciones_internacionales' => $data['operaciones_internacionales'],
                'descrip_internacional' => $data['operaciones_cual'],
                'mercancia_internacional' => $data['mercancia_exportada'],

                /*'referencias_comerciales' => $data['referencias_comerciales'],
                'referencias_financieras' => $data['referencias_financieras'],
                'gran_contribuyente' => $data['gran_contribuyente'],
                'autorretenedor' => $data['autorretenedor'],
                'responsable_iva' => $data['responsable_iva'],
                'no_responsable_iva' => $data['no_responsable_iva'],
                'resolucion_contribuyente' => $data['resolucion_contribuyente'],
                'resolucion_autorretenedor' => $data['resolucion_autorretenedor'],
                'origen_bienes' => $data['origen_bienes'],
                'origen_bienes_text' => $data['origen_bienes_text'],
                'objeto_social' => $data['objeto_social'],*/
                
                //'firma' => $data['firma'],
                //'huella' => $data['huella'],
                'fecha_diligenciado' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

            $adjunto_cedula = null;
            $adjunto_renta_1 = null;
            $adjunto_renta_2 = null;
            $adjunto_ingresos = null;
            $adjunto_rut = null;
            $adjunto_referencias = null;
            $adjunto_banco = null;
            $adjunto_portafolio = null;

            if ($anexo = $request->file('adjunto_cedula')) {
                $adjunto_cedula = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_cedula);
            }

            if ($anexo = $request->file('adjunto_renta_1')) {
                $adjunto_renta_1 = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_renta_1);
            }

            /*if ($anexo = $request->file('adjunto_renta_2')) {
                $adjunto_renta_2 = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_renta_2);
            }*/

            if ($anexo = $request->file('adjunto_ingresos')) {
                $adjunto_ingresos = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_ingresos);
            }

            if ($anexo = $request->file('adjunto_rut')) {
                $adjunto_rut = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_rut);
            }

            if ($anexo = $request->file('adjunto_referencias')) {
                $adjunto_referencias = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_referencias);
            }

            if ($anexo = $request->file('adjunto_banco')) {
                $adjunto_banco = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_banco);
            }

            if ($anexo = $request->file('adjunto_portafolio')) {
                $adjunto_portafolio = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/sagrilaft', $adjunto_portafolio);
            }

            DB::table('sagrilaft_naturales')->insert([
                'sagrilaft_id' => $sagrilaft,
                'nombre' => $data['nombre_natural'],
                'tipo_documento' => $data['tipodoc_natural'],
                'documento' => $data['documento_natural'],
                'expedicion' => $data['expedicion_natural'],
                'lugar' => $data['lugar_natural'],
                'fecha_nacimiento' => $data['fnacimiento_natural'],
                'nacionalidad' => $data['nacionalidad_natural'],
                'ocupacion' => $data['ocupacion_natural'],
                'actividad_economica' => $data['actividad_natural'],
                'ciiu' => $data['ciiu_natural'],
                'donde_trabaja' => $data['empresa_natural'],
                'cargo' => $data['cargo_natural'],
                'direccion_trabajo' => $data['ciudadtr_natural'],
                'telefono_trabajo' => $data['telefono_natural'],
                'fax_trabajo' => $data['fax_natural'],
                'domicilio' => $data['domicilio_natural'],
                'ciudad' => $data['ciudad_natural'],
                'departamento' => $data['departamento_natural'],
                'telefono' => $data['fijo_natural'],
                'email' => $data['email_natural'],
                'email_facturacion' => $data['emailfact_natural'],
                'adjunto_cedula' => $adjunto_cedula,
                'adjunto_renta_1' => $adjunto_renta_1,
                //'adjunto_renta_2' => $adjunto_renta_2,
                'adjunto_ingresos' => $adjunto_ingresos,
                'adjunto_rut' => $adjunto_rut,
                'adjunto_referencias' => $adjunto_referencias,
                'adjunto_banco' => $adjunto_banco,
                'adjunto_portafolio' => $adjunto_portafolio,
            ]);
        } else {
            DB::table('sagrilafts')->where('id', $sagrilaft)->update([
                'ingresos_mensuales' => $data['ingresos'],
                'egresos_mensuales' => $data['egresos'],
                'activos' => $data['activos'],
                'pasivos' => $data['pasivos'],
                'patrimonio' => $data['patrimonio'],
                'revisor_fiscal' => $data['revisor_fiscal'],
                'otros_ingresos' => $data['otros_ingresos'],
                //'concepto_otros_ingresos' => null,
                'operaciones_internacionales' => $data['operaciones_internacionales'],
                'descrip_internacional' => $data['operaciones_cual'],
                'mercancia_internacional' => $data['mercancia_exportada'],

                /*'referencias_comerciales' => $data['referencias_comerciales'],
                'referencias_financieras' => $data['referencias_financieras'],
                'gran_contribuyente' => $data['gran_contribuyente'],
                'autorretenedor' => $data['autorretenedor'],
                'responsable_iva' => $data['responsable_iva'],
                'no_responsable_iva' => $data['no_responsable_iva'],
                'resolucion_contribuyente' => $data['resolucion_contribuyente'],
                'resolucion_autorretenedor' => $data['resolucion_autorretenedor'],
                'origen_bienes' => $data['origen_bienes'],
                'origen_bienes_text' => $data['origen_bienes_text'],
                'objeto_social' => $data['objeto_social'],*/
                
                //'firma' => $data['firma'],
                //'huella' => $data['huella'],
                'fecha_diligenciado' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

            $adjunto_existencia = null;
            $adjunto_rut = null;
            $adjunto_cc_representante = null;
            $adjunto_renta = null;
            $adjunto_estado_financiero = null;
            $adjunto_calidad = null;
            $adjunto_operador = null;
            $adjunto_referencia = null;
            $adjunto_banco = null;
            $adjunto_licensias = null;

            DB::table('sagrilaft_juridicos')->insert([
                'sagrilaft_id' => $sagrilaft,
                'razon_social' => $data['razonsocial_juridica'],
                'nit' => $data['nit_juridica'],
                'clase_sociedad' => $data['clase_juridica'],
                'constitucion' => $data['escritura_juridica'],
                'n_matricula' => $data['matricula_juridica'],
                'representante_legal' => $data['representante_juridica'],
                'tipo_documento' => $data['tipodoc_juridica'],
                'documento' => $data['documento_juridica'],
                'expedicion' => $data['expedicion_juridica'],
                'lugar' => $data['lugar_juridica'],
                'fecha_nacimiento' => $data['fnacimiento_juridica'],
                'direccion_oficina' => $data['oficina_juridica'],
                'ciudad' => $data['ciudad_juridica'],
                'departamento' => $data['departamento_juridica'],
                'fax' => $data['fax_juridica'],
                'tipo_empresa' => $data['tipoempresa_juridica'],
                'ciiu' => $data['ciiu_juridica'],
                'actividad_economica' => $data['actividad_juridica'],
                'email' => $data['email_juridica'],
                'telefono' => $data['telfono_juridica'],
                'persona_contacto' => $data['contacto_juridica'],
                'cargo' => $data['cargo_juridica'],
                'email_factura' => $data['emailfact_juridica'],
                //'accionistas' => $data['accionistas_juridica'],
                'adjunto_existencia' => $adjunto_existencia,
                'adjunto_rut' => $adjunto_rut,
                'adjunto_cc_representante' => $adjunto_cc_representante,
                'adjunto_renta' => $adjunto_renta,
                'adjunto_estado_financiero' => $adjunto_estado_financiero,
                'adjunto_calidad' => $adjunto_calidad,
                'adjunto_operador' => $adjunto_operador,
                'adjunto_referencia' => $adjunto_referencia,
                'adjunto_banco' => $adjunto_banco,
                'adjunto_licensias' => $adjunto_licensias,
            ]);
        }

        return redirect('https://radioenlacesas.com');
    }

    public function sagrilaft_send(Request $request)
    {
        $id = $request->id;
        $correo = $request->correo;

        // Registro de sagrilaft
        $sagrilaft = DB::table('sagrilafts')->insertGetId([
            "cliente_id" => $id,
            "email" => $correo,
            "created_at" => date("Y-m-d H:i:s"),
        ]);

        // Envio de correo
        $data = array(
            'cuestionario' => $sagrilaft,
            'fecha' => date("d/m/Y"),
            'cliente' => $id,
        );

        Mail::to($correo)->send(new SagrilaftClientesMail($data));

        return response()->json(["info" => 1]);
    }
}
