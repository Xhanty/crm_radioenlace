<?php

namespace App\Http\Controllers\Admin\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\TaskProject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public function index()
    {
        try {
            $proyectos_pendientes = DB::table('proyecto')
                ->select("proyecto.*", "categorias_proyectos.nombre as categoria", "empleados.nombre as empleado", "cliente.razon_social as cliente")
                ->leftJoin("categorias_proyectos", "proyecto.id_categoria", "=", "categorias_proyectos.id")
                ->leftJoin("empleados", "proyecto.created_by", "=", "empleados.id")
                ->leftJoin("cliente", "proyecto.id_cliente", "=", "cliente.id")
                ->where('visto_bueno', 0)
                ->orderBy('proyecto.id', 'desc')
                ->get();

            $proyectos_aprobados = DB::table('proyecto')
                ->select("proyecto.*", "categorias_proyectos.nombre as categoria", "empleados.nombre as empleado", "cliente.razon_social as cliente")
                ->leftJoin("categorias_proyectos", "proyecto.id_categoria", "=", "categorias_proyectos.id")
                ->leftJoin("empleados", "proyecto.created_by", "=", "empleados.id")
                ->leftJoin("cliente", "proyecto.id_cliente", "=", "cliente.id")
                ->where('visto_bueno', 1)
                ->orderBy('proyecto.id', 'desc')
                ->get();

            $categorias = DB::table('categorias_proyectos')->get();
            $clientes = DB::table('cliente')->where("estado", 1)->get();
            return view('admin.proyectos.proyectos', compact('proyectos_pendientes', 'proyectos_aprobados', 'categorias', 'clientes'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function proyectos_add(Request $request)
    {
        try {
            DB::table('proyecto')->insert([
                'id_categoria' => $request->categoria,
                'nombre' => $request->nombre ?? "Sin nombre",
                'id_cliente' => $request->cliente,
                'puntos' => $request->puntos ?? 0,
                'factura' => $request->facturacion ?? 0,
                'fecha' => date('Y-m-d'),
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_culminacion' => $request->fecha_culminacion ?? null,
                'descripcion' => $request->descripcion ?? "Sin descripcion",
                'created_by' => auth()->user()->id,
                'status' => 0,
                'porcentaje_tecnico' => $request->porcentaje_tecnico ?? 0,
                'porcentaje_participante' => $request->porcentaje_participante ?? 0,
                'puntos_mensual' => $request->puntos_mensuales ?? 0,
                'visto_bueno' => 0,
                'firma' => "",
            ]);
            return response()->json(['info' => 1, 'success' => 'Proyecto creado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al crear el proyecto']);
        }
    }

    public function proyectos_edit(Request $request)
    {
        try {
            DB::table('proyecto')->where('id', $request->id)->update([
                'id_categoria' => $request->categoria,
                'nombre' => $request->nombre ?? "Sin nombre",
                'id_cliente' => $request->cliente,
                'puntos' => $request->puntos ?? 0,
                'factura' => $request->facturacion ?? 0,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_culminacion' => $request->fecha_culminacion ?? null,
                'descripcion' => $request->descripcion ?? "Sin descripcion",
                'porcentaje_tecnico' => $request->porcentaje_tecnico ?? 0,
                'porcentaje_participante' => $request->porcentaje_participante ?? 0,
                'puntos_mensual' => $request->puntos_mensuales ?? 0,
            ]);
            return response()->json(['info' => 1, 'success' => 'Proyecto editado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al editar el proyecto']);
        }
    }

    public function proyectos_data(Request $request)
    {
        try {
            $proyecto = DB::table('proyecto')->where('id', $request->id)->first();

            return response()->json(['info' => 1, 'data' => $proyecto]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al obtener los datos del proyecto']);
        }
    }

    public function proyectos_delete(Request $request)
    {
        try {
            $id = $request->id;
            $tasks = TaskProject::where('project_id', $id)->get();

            foreach ($tasks as $task) {
                $files = DB::table("anexos_tasks_projects")->where('task', $task->id)->get();
                foreach ($files as $file) {
                    unlink('images/anexos_tasks_projects/' . $file->file);
                }
                DB::table("anexos_tasks_projects")->where('task', $task->id)->delete();
                DB::table("avances_tasks_projects")->where('task', $task->id)->delete();
                DB::table("asignaciones")->where("codigo", $task->code)->delete();
                TaskProject::where('id', $task->id)->delete();
            }

            DB::table('proyecto')->where('id', $request->id)->delete();
            return response()->json(['info' => 1, 'success' => 'Proyecto eliminado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el proyecto']);
        }
    }

    public function visto_bueno(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $visto_bueno = $request->visto_bueno;

            DB::table("proyecto")->where("id", $id)->update([
                "visto_bueno" => $visto_bueno
            ]);

            DB::commit();

            return response()->json(['info' => 1, 'success' => 'Proyecto modificado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al modificar el proyecto.']);
        }
    }
}
