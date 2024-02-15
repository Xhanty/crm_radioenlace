<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AsignacionesExport;
use App\Http\Controllers\Controller;
use App\Mail\AsignacionesMail;
use App\Models\TaskProject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AsignacionesController extends Controller
{
    public function index()
    {
        try {
            $asignaciones_pendientes = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->join("task_projects", "task_projects.code", "=", "asignaciones.codigo")
                ->join("proyecto", "task_projects.project_id", "=", "proyecto.id")
                ->select("asignaciones.*", "empleados.nombre", "task_projects.id AS task_id", "task_projects.project_id", "proyecto.nombre AS proyecto")
                ->where("asignaciones.status", 0)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "DESC")
                ->get();

            $asignaciones_completadas = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->join("task_projects", "task_projects.code", "=", "asignaciones.codigo")
                ->join("proyecto", "task_projects.project_id", "=", "proyecto.id")
                ->select("asignaciones.*", "empleados.nombre", "task_projects.id AS task_id", "task_projects.project_id", "proyecto.nombre AS proyecto")
                ->where("asignaciones.status", 1)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "DESC")
                ->get();

            return view('admin.asignaciones_proyectos.asignaciones', compact('asignaciones_pendientes', 'asignaciones_completadas'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function asignaciones_clientes()
    {
        try {
            $asignaciones_pendientes = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
                ->select("asignaciones.*", "empleados.nombre", "cliente.razon_social AS cliente")
                ->where("asignaciones.status", 0)
                ->where("asignaciones.revision", 0)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "DESC")
                ->get();

            $asignaciones_completadas = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
                ->select("asignaciones.*", "empleados.nombre", "cliente.razon_social AS cliente")
                ->where("asignaciones.status", 1)
                ->where("asignaciones.revision", 2)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "DESC")
                ->get();

            $clientes = DB::table("cliente")->where("estado", 1)->get();

            $asignaciones_revision = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.created_by")
                ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
                ->select("asignaciones.*", "empleados.nombre", "cliente.razon_social AS cliente")
                ->where("asignaciones.status", 0)
                ->where("asignaciones.revision", 1)
                ->where("asignaciones.id_empleado", session("user"))
                ->orderBy("asignaciones.id", "DESC")
                ->get();
            return view('admin.asignaciones_clientes.asignaciones', compact('asignaciones_pendientes', 'asignaciones_completadas', 'clientes', 'asignaciones_revision'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gestionar_asignaciones()
    {
        try {

            if (!auth()->user()->hasPermissionTo('gestion_asignaciones_proyectos')) {
                return redirect()->route('home');
            }

            $asignaciones_pendientes = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
                ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
                ->join("task_projects", "task_projects.code", "=", "asignaciones.codigo")
                ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador", "task_projects.id AS task_id", "task_projects.project_id")
                ->where("asignaciones.status", 0)
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $asignaciones_completadas = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
                ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
                ->join("task_projects", "task_projects.code", "=", "asignaciones.codigo")
                ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador", "task_projects.id AS task_id", "task_projects.project_id")
                ->where("asignaciones.status", 1)
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $empleados = DB::table("empleados")->where("status", 1)->get();

            return view('admin.asignaciones_proyectos.gestionar_asignaciones', compact('asignaciones_pendientes', 'asignaciones_completadas', 'empleados'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gestionar_asignaciones_clientes()
    {
        try {

            if (!auth()->user()->hasPermissionTo('gestion_asignacion')) {
                return redirect()->route('home');
            }

            $asignaciones_pendientes = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
                ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
                ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
                ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador", "cliente.razon_social AS cliente")
                ->where("asignaciones.status", 0)
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $asignaciones_completadas = DB::table("asignaciones")
                ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
                ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
                ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
                ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador", "cliente.razon_social AS cliente")
                ->where("asignaciones.status", 1)
                ->where("asignaciones.revision", 2)
                ->orderBy("asignaciones.id", "desc")
                ->get();

            $empleados = DB::table("empleados")->where("status", 1)->get();
            $clientes = DB::table("cliente")->where("estado", 1)->get();

            return view('admin.asignaciones_clientes.gestionar_asignaciones', compact('asignaciones_pendientes', 'asignaciones_completadas', 'empleados', 'clientes'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function asignacion_add(Request $request)
    {
        try {
            //DB::beginTransaction();
            $empleados = json_decode($request->empleados);
            $observaciones = json_decode($request->observaciones);
            $observacion_general = $request->observacion_general;
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $cliente = $request->cliente;
            $names_anexos = [];
            $codigo = $this->generar_codigo();

            foreach ($request->only('anexos') as $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $name = time() . $file->getClientOriginalName();
                        $file->move('images/asignaciones', $name);
                        $names_anexos[] = $name;
                    }
                }
            }

            foreach ($empleados as $key => $empleado) {
                $asignacion = DB::table("asignaciones")->insertGetId([
                    "id_empleado" => $empleado,
                    "id_cliente" => $cliente,
                    "asignacion" => $observaciones[$key] ? $observaciones[$key] : "",
                    "descripcion" => $observacion_general ? $observacion_general : "",
                    "fecha" => $fecha_inicio,
                    "fecha_culminacion" => $fecha_fin,
                    "created_by" => session("user"),
                    "status" => 0,
                    "fecha_completada" => null,
                    "visto_bueno" => 0,
                    "devuelta" => 0,
                    "codigo" => $codigo,
                ]);

                if ($names_anexos) {
                    foreach ($names_anexos as $name_anexo) {
                        DB::table("anexos_asignaciones")->insert([
                            "id_asignacion" => $asignacion,
                            "archivo" => $name_anexo,
                        ]);
                    }
                }

                $data_empleado = DB::table("empleados")->where("id", $empleado)->first();
                $data_asignacion = DB::table("asignaciones")->where("id", $asignacion)->first();

                Mail::to($data_empleado->email)->send(new AsignacionesMail($data_empleado, $data_asignacion, 1));
            }
            //DB::commit();

            return response()->json(['info' => 1, 'success' => 'Asignación creada correctamente.']);
        } catch (Exception $ex) {
            //DB::rollBack();
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
                    "revision" => 2,
                    "fecha_completada" => $fecha,
                ]);

                $data_asignacion = DB::table("asignaciones")->where("id", $id)->first();
                $creador = DB::table("empleados")->where("id", $data_asignacion->created_by)->first();

                Mail::to($creador->email)->send(new AsignacionesMail($creador, $data_asignacion, 0));
            } else {
                DB::table("asignaciones")->where("id", $id)->update([
                    "status" => $status,
                    "devuelta" => 1,
                    "revision" => 0,
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
                $path = 'images/anexos_asignaciones/' . $file->archivo;
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
            $recargar = 0;

            if ($anexo = $request->file('archivo')) {
                $new_name = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/anexos_asignaciones', $new_name);

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

            if ($status == 2) {
                DB::table("asignaciones")->where("id", $id)->update([
                    "revision" => 1,
                ]);

                $recargar = 1;
            }

            // Enviar Email
            $asignacion = DB::table("asignaciones")->where("id", $id)->first();
            $empleado = DB::table("empleados")->where("id", $asignacion->created_by)->first();

            Mail::to($empleado->email)->send(new AsignacionesMail($empleado, $asignacion, 10));
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Avance creado correctamente.', 'recargar' => $recargar]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al crear el avance.', 'recargar' => $recargar]);
        }
    }

    public function eliminar_asignacion(Request $request)
    {
        try {
            $id = $request->id;
            $code = DB::table("asignaciones")->where("id", $id)->first()->codigo;
            $task = TaskProject::where('code', $code)->first();

            if ($task) {
                $files = DB::table("anexos_tasks_projects")->where('task', $task->id)->get();

                foreach ($files as $file) {
                    unlink('images/anexos_tasks_projects/' . $file->file);
                }

                DB::table("anexos_tasks_projects")->where('task', $task->id)->delete();
                DB::table("avances_tasks_projects")->where('task', $task->id)->delete();
                TaskProject::where('id', $task->id)->delete();
            } else {
                $files = DB::table("anexos_asignaciones")->where("id_asignacion", $id)->get();
                foreach ($files as $file) {
                    $path = 'images/asignaciones/' . $file->archivo;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }

                DB::table("anexos_asignaciones")->where("id_asignacion", $id)->delete();
                DB::table("asignaciones")->where("id", $id)->delete();
            }
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
                $path = 'images/asignaciones/' . $file->archivo;
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
            $cliente = $request->cliente;
            $names_anexos = [];

            foreach ($request->only('anexos') as $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $name = time() . $file->getClientOriginalName();
                        $file->move('images/asignaciones', $name);
                        $names_anexos[] = $name;
                    }
                }
            }

            DB::table("asignaciones")->where("id", $id)->update([
                "id_empleado" => $empleado,
                "id_cliente" => $cliente,
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

    public function calendario()
    {
        $empleados_id = [12, 19, 17];
        $asignaciones_proyectos = /*DB::table("asignaciones")
            ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
            ->join("task_projects", "task_projects.code", "=", "asignaciones.codigo")
            ->join("proyecto", "task_projects.project_id", "=", "proyecto.id")
            ->select("asignaciones.*", "empleados.nombre", "task_projects.id AS task_id", "task_projects.project_id", "proyecto.nombre AS proyecto")
            ->whereIn("asignaciones.id_empleado", $empleados_id)
            ->orderBy("asignaciones.id", "DESC")
            ->get();*/ [];

        $asignaciones_generales = DB::table("asignaciones")
            ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
            ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
            ->select("asignaciones.*", "empleados.nombre", "cliente.razon_social AS cliente")
            ->whereIn("asignaciones.id_empleado", $empleados_id)
            ->orderBy("asignaciones.id", "DESC")
            ->get();

        return view('admin.calendario_asignaciones', compact('asignaciones_proyectos', 'asignaciones_generales'));
    }

    public function excel()
    {
        // Generar excel con las asignaciones finalizadas
        $asignaciones_completadas = DB::table("asignaciones")
            ->join("empleados", "empleados.id", "=", "asignaciones.id_empleado")
            ->join("empleados AS creador", "creador.id", "=", "asignaciones.created_by")
            ->join("cliente", "cliente.id", "=", "asignaciones.id_cliente")
            ->select("asignaciones.*", "empleados.nombre", "creador.nombre AS creador", "cliente.razon_social AS cliente")
            ->where("asignaciones.status", 1)
            ->where("asignaciones.revision", 2)
            ->orderBy("asignaciones.id", "desc")
            ->get();

        return Excel::download(new AsignacionesExport($asignaciones_completadas), 'asignaciones_completadas.xlsx');
    }
}
