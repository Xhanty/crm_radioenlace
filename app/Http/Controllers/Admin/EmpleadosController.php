<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadosController extends Controller
{
    public function index()
    {
        try {
            return view('admin.empleados');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function empleados_list()
    {
        try {
            $empleados = DB::table('empleados')->get();
            return response()->json(["data" => $empleados]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_data(Request $request)
    {
        try {
            $empleado = $request->empleado;
            $novedades = DB::table('novedades_nomina')->where('id_empleado', $empleado)->get();
            $horas = [];
            $anexos = DB::table('anexos')
                ->select('anexos.*', 'empleados.nombre as creador')
                ->join("empleados", "empleados.id", "=", "anexos.created_by")
                ->where("id_usuario", $request->empleado)
                ->get();

            return response()->json(["novedades" => $novedades, "horas" => $horas, "anexos" => $anexos]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_add(Request $request)
    {
        try {
            $archivo = "";

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $archivo = 'avatar_' . time() . "." . $file->getClientOriginalExtension();
                $path = public_path('images/empleados/' . $archivo);
                file_put_contents($path, file_get_contents($file));
            }

            $empleado = DB::table('empleados')->insertGetId([
                "codigo_empleado" => $request->codigo,
                "nombre" => $request->nombre ? $request->nombre : "",
                "cargo" => $request->cargo ? $request->cargo : "",
                "rol" => $request->rol ? $request->rol : 0,
                "email" => $request->email ? $request->email : "",
                "telefono_fijo" => $request->telefono ? $request->telefono : "",
                "telefono_celular" => $request->celular ? $request->celular : "",
                "direccion" => $request->direccion ? $request->direccion : "",
                "fecha_ingreso" => $request->fecha_ingreso ? $request->fecha_ingreso : date("Y-m-d"),
                "fecha_retiro" => $request->fecha_retiro ? $request->fecha_retiro : date("Y-m-d", strtotime(date("Y-m-d") . "+ 1 year")),
                "fecha_nacimiento" => $request->fecha_nacimiento ? $request->fecha_nacimiento : date("Y-m-d"),
                "eps" => $request->eps ? $request->eps : "",
                "caja_compensacion" => $request->caja ? $request->caja : "",
                "arl" => $request->arl ? $request->arl : "",
                "fondo_pension" => $request->fondo ? $request->fondo : "",
                "riesgos_profesionales" => $request->riesgos ? $request->riesgos : "",
                "avatar" => $archivo,
                "observaciones" => "",
                "prestamo" => 0,
                "periodo_dotacion" => "",
                "numero_licencia_conduccion" => "",
                "vencimiento_licencia_conduccion" => date("Y-m-d", strtotime(date("Y-m-d") . "+ 5 year")),
                "multas_transito_pendiente" => 0,
                "implementos_seguridad" => "",
                "culminacion_contrato" => date("Y-m-d", strtotime(date("Y-m-d") . "+ 1 year")),
                "status" => 1,
                "licencia_conduccion_moto" => "",
                "vencimiento_licencia_moto" => date("Y-m-d", strtotime(date("Y-m-d") . "+ 5 year")),
                "puntos" => 0,
                "clave" => sha1($request->codigo),
                "periodo_vacaciones" => "",
            ]);

            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_update(Request $request)
    {
        try {
            $empleado = $request->id;
            $tipo_form = $request->update_tipo;

            if ($tipo_form == 1) {
                $archivo = "";

                if ($request->hasFile('archivo')) {
                    $file = $request->file('archivo');
                    $archivo = 'avatar_' . time() . "." . $file->getClientOriginalExtension();
                    $path = public_path('images/empleados/' . $archivo);
                    file_put_contents($path, file_get_contents($file));
                }

                DB::table("empleados")->where("id", $empleado)->update([
                    "codigo_empleado" => $request->codigo,
                    "nombre" => $request->nombre,
                    "cargo" => $request->cargo,
                    "rol" => $request->rol,
                    "email" => $request->email,
                    "telefono_fijo" => $request->telefono,
                    "telefono_celular" => $request->celular,
                    "direccion" => $request->direccion,
                    "fecha_ingreso" => $request->fecha_ingreso,
                    "fecha_retiro" => $request->fecha_retiro,
                    "fecha_nacimiento" => $request->fecha_nacimiento,
                    "eps" => $request->eps,
                    "caja_compensacion" => $request->caja,
                    "arl" => $request->arl,
                    "fondo_pension" => $request->fondo,
                    "riesgos_profesionales" => $request->riesgos,
                    "avatar" => $archivo
                ]);
            } else if ($tipo_form == 2) {
                DB::table("empleados")->where("id", $empleado)->update([
                    "observaciones" => $request->observaciones,
                    "prestamo" => $request->prestamo,
                    "periodo_dotacion" => $request->dotacion,
                    "numero_licencia_conduccion" => $request->licencia,
                    "vencimiento_licencia_conduccion" => $request->vencimiento_licencia,
                    "multas_transito_pendiente" => $request->multas,
                    "implementos_seguridad" => $request->seguridad,
                    "culminacion_contrato" => $request->terminacion_contrato
                ]);
            } else if ($tipo_form == 3) {
            }

            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_inactivar(Request $request)
    {
        try {
            $empleado = $request->id;
            $estado = $request->estado;
            DB::table('empleados')->where('id', $empleado)->update(['status' => $estado]);
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_delete(Request $request)
    {
        try {
            $empleado = $request->id;
            $anexos = DB::table('anexos')->where("id_usuario", $empleado)->get();

            foreach ($anexos as $anexo) {
                $path = public_path('images/empleados/' . $anexo->documento);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            DB::table('anexos')->where("id_usuario", $empleado)->delete();
            DB::table('novedades_nomina')->where('id_empleado', $empleado)->delete();
            DB::table('empleados')->where('id', $empleado)->delete();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_novedades(Request $request)
    {
        try {
            $empleado = $request->id;
            DB::table('novedades_nomina')->insert([
                'id_empleado' => $empleado,
                'fecha' => date("Y-m-d"),
                'status' => 0,
                'created_by' => session('user'),
                'motivo' => $request->motivo ? $request->motivo : "",
                'dias' => $request->dias ? $request->dias : 0,
            ]);
            $novedades = DB::table('novedades_nomina')->where('id_empleado', $empleado)->get();
            return response()->json(["info" => 1, "novedades" => $novedades]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_novedad_delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::table('novedades_nomina')->where('id', $id)->delete();
            $novedades = DB::table('novedades_nomina')->where('id_empleado', $request->id_empleado)->get();
            return response()->json(["info" => 1, "novedades" => $novedades]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_anexo_delete(Request $request)
    {
        try {
            $anexo = DB::table('anexos')->where("id", $request->id)->first();

            $path = public_path('images/empleados/' . $anexo->documento);
            if (file_exists($path)) {
                unlink($path);
            }

            DB::table('anexos')->where("id", $request->id)->delete();

            $anexos = DB::table('anexos')
                ->select('anexos.*', 'empleados.nombre as creador')
                ->join("empleados", "empleados.id", "=", "anexos.created_by")
                ->where("id_usuario", $request->id_empleado)
                ->get();

            return response()->json(["info" => 1, "anexos" => $anexos]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function empleados_anexo_add(Request $request)
    {
        try {
            $empleado = $request->id;
            $file = $request->file('archivo');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/images/empleados/', $name);

            DB::table('anexos')->insert([
                'id_usuario' => $empleado,
                'documento' => $name,
                'tipo' => $request->tipo_documento,
                'fecha' => date("Y-m-d H:i:s"),
                'created_by' => session('user'),
                'descripcion' => $request->descripcion ? $request->descripcion : '',
                'carpeta' => 0,
                'id_carpeta' => 0,
            ]);

            $anexos = DB::table('anexos')
                ->select('anexos.*', 'empleados.nombre as creador')
                ->join("empleados", "empleados.id", "=", "anexos.created_by")
                ->where("id_usuario", $empleado)
                ->get();

            return response()->json(["info" => 1, "anexos" => $anexos]);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
