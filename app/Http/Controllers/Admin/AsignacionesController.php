<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionesController extends Controller
{
    public function index()
    {
        try {
            $asignaciones_pendientes = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->select("asignaciones.*", "empleados.nombre")
                ->where("asignaciones.status", 0)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $asignaciones_completadas = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->select("asignaciones.*", "empleados.nombre")
                ->where("asignaciones.status", 1)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "desc")
                ->get();
            return view('admin.asignaciones.asignaciones', compact('asignaciones_pendientes', 'asignaciones_completadas'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function actividades_diarias()
    {
        return view('admin.asignaciones.actividades_diarias');
    }

    public function gestionar_asignaciones()
    {
        try {
            $asignaciones_pendientes = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
                ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
                ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador")
                ->where("asignaciones.status", 0)
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $asignaciones_completadas = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
                ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
                ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador")
                ->where("asignaciones.status", 1)
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $empleados = DB::table("empleados")->where("status", 1)->get();

            return view('admin.asignaciones.gestionar_asignaciones', compact('asignaciones_pendientes', 'asignaciones_completadas', 'empleados'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function asignacion_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $empleados = explode(',', $request->empleados);
            $observaciones = explode(',', $request->observaciones);
            $observacion_general = $request->observacion_general;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $names_anexos = [];

            foreach ($request->only('anexos') as $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $name = time() . $file->getClientOriginalName();
                        $file->move(public_path('images/asignaciones'), $name);
                        $names_anexos[] = $name;
                    }
                }
            }

            foreach ($empleados as $key => $empleado) {
                $asignacion = DB::table("asignaciones")->insertGetId([
                    "id_empleado" => $empleado,
                    "asignacion" => $observaciones[$key] ? $observaciones[$key] : "",
                    "descripcion" => $observacion_general ? $observacion_general : "",
                    "fecha" => $fecha_inicio,
                    "fecha_culminacion" => $fecha_fin,
                    "created_by" => session("user"),
                    "status" => 0,
                    "fecha_completada" => null,
                    "visto_bueno" => 0,
                    "devuelta" => 0,
                    "codigo" => $this->generar_codigo(),
                ]);

                if ($names_anexos) {
                    foreach ($names_anexos as $name_anexo) {
                        DB::table("anexos_asignaciones")->insert([
                            "id_asignacion" => $asignacion,
                            "archivo" => $name_anexo,
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Asignación creada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al crear la asignación.']);
        }
    }

    public function generar_codigo()
    {
        $codigo = rand(1000000, 9999999);
        return "RE166" . $codigo;
    }

    public function change_asignacion(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;

            if ($status == 1) {
                $fecha = date("Y-m-d H:i:s");

                DB::table("asignaciones")->where("id", $id)->update([
                    "status" => $status,
                    "status" => 1,
                    "fecha_completada" => $fecha,
                ]);
            } else {
                DB::table("asignaciones")->where("id", $id)->update([
                    "status" => $status,
                    "devuelta" => 1,
                    "status" => 0,
                    "fecha_completada" => null,
                ]);
            }
            DB::commit();

            return response()->json(['info' => 1, 'success' => 'Asignación modificada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al modificar la asignación.']);
        }
    }

    public function asignaciones_data(Request $request)
    {
        try {
            $id = $request->id;
            $avances = DB::table("avances_asignaciones")
                ->where("avances_asignaciones.id_asignacion", $id)
                ->orderBy("avances_asignaciones.id", "desc")
                ->get();

            $asignacion = DB::table("asignaciones")
                ->where("asignaciones.id", $id)
                ->first();

            $archivos = DB::table("anexos_asignaciones")
                ->where("anexos_asignaciones.id_asignacion", $id)
                ->get();
            return response()->json(['info' => 1, 'success' => 'Datos obtenidos correctamente.', 'data' => $avances, 'asignacion' => $asignacion, 'archivos' => $archivos]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function asignaciones_avances_delete(Request $request)
    {
        try {
            $id = $request->id;
            $file = DB::table("avances_asignaciones")->where("id", $id)->first();
            if ($file->archivo) {
                $path = public_path('images/anexos_asignaciones/' . $file->archivo);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            DB::table("avances_asignaciones")->where("id", $id)->delete();

            return response()->json(['info' => 1, 'success' => 'Avance eliminado correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function asignaciones_avances_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->asignacion_id;
            $descripcion = $request->descripcion;
            $status = $request->status;

            if ($anexo = $request->file('archivo')) {
                $new_name = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move(public_path('images/anexos_asignaciones'), $new_name);

                DB::table("avances_asignaciones")->insert([
                    "id_asignacion" => $id,
                    "archivo" => $new_name,
                    "fecha" => date("Y-m-d H:i:s"),
                    "descripcion" => $descripcion,
                    "id_status" => $status,
                ]);
            } else {
                DB::table("avances_asignaciones")->insert([
                    "id_asignacion" => $id,
                    "archivo" => "",
                    "fecha" => date("Y-m-d H:i:s"),
                    "descripcion" => $descripcion,
                    "id_status" => $status,
                ]);
            }

            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Avance creado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al crear el avance.']);
        }
    }

    public function eliminar_asignacion(Request $request)
    {
        try {
            $id = $request->id;
            $files = DB::table("anexos_asignaciones")->where("id_asignacion", $id)->get();
            foreach ($files as $file) {
                $path = public_path('images/asignaciones/' . $file->archivo);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            DB::table("anexos_asignaciones")->where("id_asignacion", $id)->delete();
            DB::table("asignaciones")->where("id", $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Asignación eliminada correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function change_visto_bueno(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $visto_bueno = $request->visto_bueno;

            DB::table("asignaciones")->where("id", $id)->update([
                "visto_bueno" => $visto_bueno
            ]);

            DB::commit();

            return response()->json(['info' => 1, 'success' => 'Asignación modificada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al modificar la asignación.']);
        }
    }

    public function eliminar_archivo_asignacion(Request $request)
    {
        try {
            $id = $request->id;
            $files = DB::table("anexos_asignaciones")->where("id", $id)->get();
            foreach ($files as $file) {
                $path = public_path('images/asignaciones/' . $file->archivo);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            DB::table("anexos_asignaciones")->where("id", $id)->delete();

            return response()->json(['info' => 1, 'success' => 'Archivo eliminado correctamente.']);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function asignacion_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $empleado = $request->empleado;
            $observacion = $request->observacion;
            $observacion_general = $request->observacion_general;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $names_anexos = [];

            foreach ($request->only('anexos') as $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $name = time() . $file->getClientOriginalName();
                        $file->move(public_path('images/asignaciones'), $name);
                        $names_anexos[] = $name;
                    }
                }
            }

            DB::table("asignaciones")->where("id", $id)->update([
                "id_empleado" => $empleado,
                "asignacion" => $observacion ? $observacion : "",
                "descripcion" => $observacion_general ? $observacion_general : "",
                "fecha" => $fecha_inicio,
                "fecha_culminacion" => $fecha_fin,
            ]);

            if ($names_anexos) {
                foreach ($names_anexos as $name_anexo) {
                    DB::table("anexos_asignaciones")->insert([
                        "id_asignacion" => $id,
                        "archivo" => $name_anexo,
                    ]);
                }
            }

            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Asignación modificada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al crear la asignación.']);
        }
    }
}