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
                        $file->move(public_path('images/anexos_asignaciones'), $name);
                        $names_anexos[] = $name;
                    }
                }
            }

            foreach ($empleados as $key => $empleado) {
                $asignacion = DB::table("asignaciones")->insertGetId([
                    "id_empleado" => $empleado,
                    "asignacion" => $observaciones[$key],
                    "descripcion" => $observacion_general,
                    "fecha" => $fecha_inicio,
                    "fecha_culminacion" => $fecha_fin,
                    "created_by" => session("user"),
                    "status" => 0,
                    "fecha_completada" => date("Y-m-d H:i:s", "0000-00-00 00:00:00"),
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
            $fecha = "0000-00-00 00:00:00";

            if ($status == 1) {
                $fecha = date("Y-m-d H:i:s");
            }

            DB::table("asignaciones")->where("id", $id)->update([
                "status" => $status,
                "devuelta" => 1,
                "fecha_completada" => $fecha,
            ]);
            DB::commit();

            return response()->json(['info' => 1, 'success' => 'Asignación modificada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al modificar la asignación.']);
        }
    }
}
