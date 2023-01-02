<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\TaskProject;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            $project = $request->get('project');

            $valid_project = DB::table('proyecto')
                ->where('id', $project)
                ->first();

            if (!$project || !$valid_project) {
                return view("errors.404");
            }

            $id = auth()->user()->id;

            $valid_creator = TaskProject::where('created_by', $id)->where('project_id', $project)->count();

            $tasks = Status::get();

            if ($valid_creator > 0) {
                foreach ($tasks as $task) {
                    $task['tasks'] = TaskProject::where('status_id', $task->id)
                        ->where('project_id', $project)
                        ->orderBy('order')->get();
                    foreach ($task['tasks'] as $t) {
                        $users_id = json_decode($t->user_id);

                        $users = [];

                        foreach ($users_id as $key => $value) {
                            $find_user = DB::table('empleados')
                                ->where('id', $value)
                                ->first();
                            $users[] = $find_user;
                        }

                        $t['user'] = $users;
                    }
                }
            } else {
                foreach ($tasks as $task) {
                    $task['tasks'] = TaskProject::where('status_id', $task->id)
                        ->where('project_id', $project)
                        ->where('user_id', 'like', '%' . $id . '%')
                        ->orderBy('order')->get();
                    foreach ($task['tasks'] as $t) {
                        $users_id = json_decode($t->user_id);

                        $users = [];

                        foreach ($users_id as $key => $value) {
                            $find_user = DB::table('empleados')
                                ->where('id', $value)
                                ->first();
                            $users[] = $find_user;
                        }

                        $t['user'] = $users;
                    }
                }
            }

            session(['project_tasks' => $project]);
            session(['name_project' => $valid_project->nombre]);

            return view('tasks.index', compact('tasks'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view("errors.500");
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:56'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:statuses,id'],
        ]);
        $request['code'] = 'CRM-' . strtoupper(Str::random(6));
        $request['init_date'] = date('Y-m-d');
        $request['created_by'] = auth()->user()->id;
        $request['project_id'] = session('project_tasks');

        $empleados = $request->value_empleados;
        $ids_empleados = [];

        foreach ($empleados as $key => $value) {
            $ids_empleados[] = $value['id'];
        }

        $status = Status::find($request->status_id);
        $estado_asignacion = 0;
        $fecha_fin = null;

        if ($status->slug == 'completed') {
            $estado_asignacion = 1;
            $fecha_fin = date('Y-m-d H:i:s');
        }

        for ($i = 0; $i < count($ids_empleados); $i++) {
            $request['user_id'] = $ids_empleados[$i];

            DB::table("asignaciones")->insert([
                'id_empleado' => $request->user_id,
                'descripcion' => $request->description ? $request->description : '',
                'asignacion' => $request->title,
                'fecha' => date('Y-m-d H:i:s'),
                'fecha_culminacion' => $fecha_fin,
                'status' => $estado_asignacion,
                'created_by' => auth()->user()->id,
                'fecha_completada' => $fecha_fin,
                'visto_bueno' => 0,
                'devuelta' => 0,
                'codigo' => $request['code'],
            ]);
        }

        $request['user_id'] = json_encode($ids_empleados);
        $new = TaskProject::create($request->all());

        $find_user = DB::table('empleados')
            ->where('id', $new->user_id)
            ->first();

        $new['user'] = $find_user;

        return $new;
    }

    public function sync(Request $request)
    {
        $this->validate(request(), [
            'columns' => ['required', 'array']
        ]);

        foreach ($request->columns as $status) {
            foreach ($status['tasks'] as $i => $task) {
                $order = $i + 1;
                if ($task['status_id'] !== $status['id'] || $task['order'] !== $order) {
                    TaskProject::where('id', $task['id'])
                        ->update(['status_id' => $status['id'], 'order' => $order]);

                    $status = Status::find($status['id']);
                    $estado_asignacion = 0;
                    $fecha_fin = null;

                    if ($status->slug == 'completed') {
                        $estado_asignacion = 1;
                        $fecha_fin = date('Y-m-d H:i:s');
                    }

                    DB::table("asignaciones")->where('codigo', $task['code'])->update([
                        'status' => $estado_asignacion,
                        'fecha_completada' => $fecha_fin,
                    ]);
                }
            }
        }

        $project = session('project_tasks');

        $id = auth()->user()->id;

        $valid_creator = TaskProject::where('created_by', $id)->where('project_id', $project)->count();

        $tasks = Status::get();

        if ($valid_creator > 0) {
            foreach ($tasks as $task) {
                $task['tasks'] = TaskProject::where('status_id', $task->id)
                    ->where('project_id', $project)
                    ->orderBy('order')->get();
                foreach ($task['tasks'] as $t) {
                    $users_id = json_decode($t->user_id);

                    $users = [];

                    foreach ($users_id as $key => $value) {
                        $find_user = DB::table('empleados')
                        ->where('id', $value)
                        ->first();
                        $users[] = $find_user;
                    }

                    $t['user'] = $users;
                }
            }
        } else {
            foreach ($tasks as $task) {
                $task['tasks'] = TaskProject::where('status_id', $task->id)
                    ->where('project_id', $project)
                    ->where('user_id', 'like', '%' . $id . '%')
                    ->orderBy('order')->get();
                foreach ($task['tasks'] as $t) {
                    $users_id = json_decode($t->user_id);

                    $users = [];

                    foreach ($users_id as $key => $value) {
                        $find_user = DB::table('empleados')
                        ->where('id', $value)
                        ->first();
                        $users[] = $find_user;
                    }

                    $t['user'] = $users;
                }
            }
        }

        return $tasks;
    }

    public function show(TaskProject $task)
    {
        //
    }

    public function edit(TaskProject $task)
    {
        //
    }

    public function update(Request $request, TaskProject $task)
    {
    }

    public function destroy(TaskProject $task)
    {
        //
    }

    public function tasks_edit(Request $request)
    {
        $code = TaskProject::where('id', $request->id)->first();

        TaskProject::where('id', $request->id)->update([
            'puntos' => $request->puntos ? $request->puntos : 0,
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'init_date' => $request->init_date,
            'end_date' => $request->end_date,
        ]);

        DB::table("asignaciones")->where('codigo', $code->code)->update([
            'id_empleado' => $request->user_id,
            'descripcion' => $request->description,
            'asignacion' => $request->title,
            'fecha' => $request->init_date,
            'fecha_culminacion' => $request->end_date,
            'fecha_completada' => $request->end_date,
        ]);

        $project = session('project_tasks');

        $id = auth()->user()->id;

        $valid_creator = TaskProject::where('created_by', $id)->where('project_id', $project)->count();

        $tasks = Status::get();

        if ($valid_creator > 0) {
            foreach ($tasks as $task) {
                $task['tasks'] = TaskProject::where('status_id', $task->id)
                    ->where('project_id', $project)
                    ->orderBy('order')->get();
                foreach ($task['tasks'] as $t) {
                    $users_id = json_decode($t->user_id);

                    $users = [];

                    foreach ($users_id as $key => $value) {
                        $find_user = DB::table('empleados')
                        ->where('id', $value)
                        ->first();
                        $users[] = $find_user;
                    }

                    $t['user'] = $users;
                }
            }
        } else {
            foreach ($tasks as $task) {
                $task['tasks'] = TaskProject::where('status_id', $task->id)
                    ->where('project_id', $project)
                    ->where('user_id', 'like', '%' . $id . '%')
                    ->orderBy('order')->get();
                foreach ($task['tasks'] as $t) {
                    $users_id = json_decode($t->user_id);

                    $users = [];

                    foreach ($users_id as $key => $value) {
                        $find_user = DB::table('empleados')
                        ->where('id', $value)
                        ->first();
                        $users[] = $find_user;
                    }

                    $t['user'] = $users;
                }
            }
        }

        return $tasks;
    }

    public function tasks_delete(Request $request)
    {
        $code = TaskProject::where('id', $request->id)->first();
        $files = DB::table("anexos_tasks_projects")->where('task', $request->id)->get();

        foreach ($files as $file) {
            unlink('images/anexos_tasks_projects/' . $file->file);
        }

        DB::table("anexos_tasks_projects")->where('task', $request->id)->delete();
        DB::table("avances_tasks_projects")->where('task', $request->id)->delete();
        TaskProject::where('id', $request->id)->delete();
        DB::table("asignaciones")->where('codigo', $code->code)->delete();

        $project = session('project_tasks');

        $id = auth()->user()->id;

        $valid_creator = TaskProject::where('created_by', $id)->where('project_id', $project)->count();

        $tasks = Status::get();

        if ($valid_creator > 0) {
            foreach ($tasks as $task) {
                $task['tasks'] = TaskProject::where('status_id', $task->id)
                    ->where('project_id', $project)
                    ->orderBy('order')->get();
                foreach ($task['tasks'] as $t) {
                    $users_id = json_decode($t->user_id);

                    $users = [];

                    foreach ($users_id as $key => $value) {
                        $find_user = DB::table('empleados')
                        ->where('id', $value)
                        ->first();
                        $users[] = $find_user;
                    }

                    $t['user'] = $users;
                }
            }
        } else {
            foreach ($tasks as $task) {
                $task['tasks'] = TaskProject::where('status_id', $task->id)
                    ->where('project_id', $project)
                    ->where('user_id', 'like', '%' . $id . '%')
                    ->orderBy('order')->get();
                foreach ($task['tasks'] as $t) {
                    $users_id = json_decode($t->user_id);

                    $users = [];

                    foreach ($users_id as $key => $value) {
                        $find_user = DB::table('empleados')
                        ->where('id', $value)
                        ->first();
                        $users[] = $find_user;
                    }

                    $t['user'] = $users;
                }
            }
        }

        return $tasks;
    }

    public function anexos(Request $request)
    {
        $files = DB::table("anexos_tasks_projects")
            ->where('task', $request->id)
            ->get();

        return $files;
    }

    public function task_add_file(Request $request)
    {
        $files = $request->file('file');

        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $name_dos = time() . $file->getClientOriginalName();
            $file->move('images/anexos_tasks_projects/', $name_dos);

            DB::table('anexos_tasks_projects')->insert([
                'task' => $request->task_id,
                'file' => $name_dos,
                'name_file' => $name,
                'created_at' => date('Y-m-d'),
            ]);
        }

        $files = DB::table("anexos_tasks_projects")
            ->where('task', $request->task_id)
            ->get();

        return $files;
    }

    public function task_delete_file(Request $request)
    {
        $file = $request->file;

        if (file_exists('images/anexos_tasks_projects/' . $file)) {
            unlink('images/anexos_tasks_projects/' . $file);
        }

        DB::table('anexos_tasks_projects')
            ->where('id', $request->id)
            ->delete();

        $files = DB::table("anexos_tasks_projects")
            ->where('task', $request->task_id)
            ->get();

        return $files;
    }

    public function avances(Request $request)
    {
        $avances = DB::table("avances_tasks_projects")
            ->select('avances_tasks_projects.*', 'empleados.nombre as empleado', 'empleados.avatar')
            ->join('empleados', 'empleados.id', '=', 'avances_tasks_projects.user_id')
            ->where('task', $request->id)
            ->get();

        return $avances;
    }

    public function task_add_avance(Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            $name = $file->getClientOriginalName();
            $name_dos = time() . $file->getClientOriginalName();
            $file->move('images/avances_tasks_projects/', $name_dos);
        }

        DB::table('avances_tasks_projects')->insert([
            'user_id' => auth()->user()->id,
            'task' => $request->task_id,
            'avance' => $request->actividad,
            'file' => $name_dos ?? null,
            'name_file' => $name ?? null,
            'fecha' => date('Y-m-d'),
        ]);

        $avances = DB::table("avances_tasks_projects")
            ->select('avances_tasks_projects.*', 'empleados.nombre as empleado', 'empleados.avatar')
            ->join('empleados', 'empleados.id', '=', 'avances_tasks_projects.user_id')
            ->where('task', $request->task_id)
            ->get();

        return $avances;
    }

    public function task_delete_avance(Request $request)
    {
        $file = DB::table('avances_tasks_projects')
            ->where('id', $request->id)
            ->first();

        if ($file) {
            if (file_exists('images/anexos_tasks_projects/' . $file->file)) {
                unlink('images/anexos_tasks_projects/' . $file->file);
            }
        }

        DB::table('avances_tasks_projects')
            ->where('id', $request->id)
            ->delete();

        $avances = DB::table("avances_tasks_projects")
            ->select('avances_tasks_projects.*', 'empleados.nombre as empleado', 'empleados.avatar')
            ->join('empleados', 'empleados.id', '=', 'avances_tasks_projects.user_id')
            ->where('task', $request->task_id)
            ->get();

        return $avances;
    }

    public function task_add_file_observacion(Request $request)
    {
        $file = $request->file('file');

        $name = $file->getClientOriginalName();
        $name_dos = time() . $file->getClientOriginalName();
        $file->move('images/anexos_tasks_projects/', $name_dos);

        DB::table('avances_tasks_projects')->insert([
            'user_id' => auth()->user()->id,
            'task' => $request->task_id,
            'avance' => null,
            'file' => $name_dos,
            'name_file' => $name,
            'fecha' => date('Y-m-d'),
        ]);

        $avances = DB::table("avances_tasks_projects")
            ->select('avances_tasks_projects.*', 'empleados.nombre as empleado', 'empleados.avatar')
            ->join('empleados', 'empleados.id', '=', 'avances_tasks_projects.user_id')
            ->where('task', $request->task_id)
            ->get();

        return $avances;
    }
}
