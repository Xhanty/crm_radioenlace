<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EncuestasProveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Mail;

class ProveedoresController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_proveedores')) {
                return redirect()->route('home');
            }

            $proveedores = DB::table('proveedores')->get();
            return view('admin.proveedores', compact('proveedores'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function history(Request $request)
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_proveedores')) {
                return redirect()->route('home');
            }

            $id = $request->get('token');

            if (!$id || $id < 1) {
                return view('errors.404');
            }

            $proveedores = DB::table('proveedores')->where('id', $id)->first();

            if (!$proveedores) {
                return view('errors.404');
            }

            $proveedores->observaciones = DB::table('observaciones_proveedores')
                ->select('observaciones_proveedores.*', 'empleados.nombre as creador')
                ->join('empleados', 'empleados.id', 'observaciones_proveedores.created_by')
                ->where('proveedor_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            return view('admin.history_proveedores', compact('proveedores'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function proveedores_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";
            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/proveedores', $archivo);
            } else {
                $archivo = "noavatar.png";
            }

            DB::table("proveedores")->insert([
                "nit" => $request->nit,
                "codigo_verificacion" => $request->codigo ? $request->codigo : 0,
                "razon_social" => $request->razon_social ? $request->razon_social : "",
                "direccion" => $request->direccion ? $request->direccion : "",
                "telefono_fijo" => $request->telefono ? $request->telefono : "",
                "celular" => $request->celular ? $request->celular : "",
                "contacto" => $request->contacto ? $request->contacto : "",
                "email" => $request->email ? $request->email : "",
                "email_comercial" => $request->email_comercial  ? $request->email_comercial : "",
                "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                "ciudad" => $request->ciudad ? $request->ciudad : "",
                "observaciones" => $request->observaciones ? $request->observaciones : "",
                "avatar" => $archivo,
                "estado" => 1,
            ]);

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function proveedores_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = DB::table("proveedores")->where("id", $request->id)->first();
            if ($archivo->avatar != "" && file_exists('images/proveedores/' . $archivo->avatar)) {
                unlink('images/proveedores/' . $archivo->avatar);
            }
            DB::table("proveedores")->where("id", $request->id)->delete();
            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function proveedores_data(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = DB::table("proveedores")->where("id", $request->id)->first();
            $anexos = DB::table("anexos_proveedores")
                ->select("anexos_proveedores.*", "empleados.nombre as creador")
                ->join("empleados", "empleados.id", "anexos_proveedores.created_by")
                ->where("id_cliente", $request->id)
                ->get();
            DB::commit();
            return response()->json(["info" => 1, "data" => $data, "anexos" => $anexos]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "data" => [], "anexos" => []]);
        }
    }

    public function proveedores_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";
            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/proveedores', $archivo);

                DB::table("proveedores")->where("id", $request->id)->update([
                    "nit" => $request->nit,
                    "codigo_verificacion" => $request->codigo ? $request->codigo : 0,
                    "razon_social" => $request->razon_social ? $request->razon_social : "",
                    "direccion" => $request->direccion ? $request->direccion : "",
                    "telefono_fijo" => $request->telefono ? $request->telefono : "",
                    "celular" => $request->celular ? $request->celular : "",
                    "contacto" => $request->contacto ? $request->contacto : "",
                    "email" => $request->email ? $request->email : "",
                    "email_comercial" => $request->email_comercial  ? $request->email_comercial : "",
                    "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                    "ciudad" => $request->ciudad ? $request->ciudad : "",
                    "observaciones" => $request->observaciones ? $request->observaciones : "",
                    "avatar" => $archivo,
                ]);
            } else {
                DB::table("proveedores")->where("id", $request->id)->update([
                    "nit" => $request->nit,
                    "codigo_verificacion" => $request->codigo ? $request->codigo : 0,
                    "razon_social" => $request->razon_social ? $request->razon_social : "",
                    "direccion" => $request->direccion ? $request->direccion : "",
                    "telefono_fijo" => $request->telefono ? $request->telefono : "",
                    "celular" => $request->celular ? $request->celular : "",
                    "contacto" => $request->contacto ? $request->contacto : "",
                    "email" => $request->email ? $request->email : "",
                    "email_comercial" => $request->email_comercial  ? $request->email_comercial : "",
                    "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                    "ciudad" => $request->ciudad ? $request->ciudad : "",
                    "observaciones" => $request->observaciones ? $request->observaciones : "",
                ]);
            }

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function proveedores_anexos_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";
            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/proveedores/anexos', $archivo);
            }

            DB::table("anexos_proveedores")->insert([
                "id_cliente" => $request->id,
                "descripcion" => $request->descripcion ? $request->descripcion : "",
                "documento" => $archivo,
                "created_by" => session('user'),
                "fecha" => date("Y-m-d H:i:s"),
                "tipo" => $request->tipo_documento,
            ]);

            DB::commit();

            $anexos = DB::table("anexos_proveedores")
                ->select("anexos_proveedores.*", "empleados.nombre as creador")
                ->join("empleados", "empleados.id", "anexos_proveedores.created_by")
                ->where("id_cliente", $request->id)
                ->get();

            return response()->json(["info" => 1, "anexos" => $anexos]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "anexos" => []]);
        }
    }

    public function proveedores_anexos_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = DB::table("anexos_proveedores")->where("id", $request->id)->first();
            if ($archivo->documento != "" && file_exists('images/proveedores/anexos/' . $archivo->documento)) {
                unlink('images/proveedores/anexos/' . $archivo->documento);
            }
            DB::table("anexos_proveedores")->where("id", $request->id)->delete();
            DB::commit();

            $anexos = DB::table("anexos_proveedores")
                ->select("anexos_proveedores.*", "empleados.nombre as creador")
                ->join("empleados", "empleados.id", "anexos_proveedores.created_by")
                ->where("id_cliente", $request->id_proveedor)
                ->get();
            return response()->json(["info" => 1, "anexos" => $anexos]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "anexos" => []]);
        }
    }

    public function proveedores_status(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("proveedores")->where("id", $request->id)->update([
                "estado" => $request->status,
            ]);

            DB::table("observaciones_proveedores")->insert([
                'proveedor_id' => $request->id,
                "observacion" => $request->observacion,
                "created_by" => auth()->user()->id,
                "created_at" => date("Y-m-d H:i:s")
            ]);

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function info_proveedor(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = DB::table("proveedores")->where("id", $request->id)->first();
            DB::commit();
            return response()->json(["info" => 1, "data" => $data]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "data" => []]);
        }
    }

    public function encuestas_proveedores(Request $request)
    {
        $tk = $request->get('tk');
        $send = $request->get('send');
        $encuesta_id = $request->get('encuesta_view');

        if ($send && $send == 1) {
            // Consulta de encuesta
            $encuesta = DB::table('encuesta_satisfaccion')->where("id", $tk)->first();

            if ($encuesta && $encuesta->promedio == 0) {
                $send = 1;
                return view('encuestas.proveedores', compact('encuesta', 'send'));
            } else {
                return redirect('https://radioenlacesas.com');
            }
        }

        if ($encuesta_id) {
            // Consulta de encuesta
            $encuesta = DB::table('encuesta_satisfaccion')->where("id", $encuesta_id)->first();

            if ($encuesta) {
                $send = 0;
                return view('encuestas.proveedores', compact('encuesta', 'send'));
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
            ->where("proveedor_id", $id)
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
            "proveedor_id" => $id,
            "email" => $correo,
            "created_at" => date("Y-m-d H:i:s"),
        ]);

        // Envío de correo
        $data = array(
            'encuesta' => $encuesta,
            'fecha' => date("d/m/Y"),
            'cliente' => $id,
        );

        Mail::to($correo)->send(new EncuestasProveedores($data));

        return response()->json(["info" => 1]);
    }
}
