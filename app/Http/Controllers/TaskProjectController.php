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

            $tasks = auth()->user()->statuses()->with('tasks.user')->with('tasks', function ($query) use ($project) {
                $query->where('project_id', $project);
            })->get();

            session(['project_tasks' => $project]);
            session(['name_project' => $valid_project->nombre]);

            return view('tasks.index', compact('tasks'));
        } catch (Exception $ex) {
            return view("errors.500");
            return $ex->getMessage();
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
                }
            }
        }

        $project = session('project_tasks');

        $tasks = auth()->user()->statuses()->with('tasks.user')->with('tasks', function ($query) use ($project) {
            $query->where('project_id', $project);
        })->get();

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
        TaskProject::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'init_date' => $request->init_date,
            'end_date' => $request->end_date,
        ]);

        $project = session('project_tasks');

        $tasks = auth()->user()->statuses()->with('tasks.user')->with('tasks', function ($query) use ($project) {
            $query->where('project_id', $project);
        })->get();

        return $tasks;
    }

    public function tasks_delete(Request $request)
    {
        TaskProject::where('id', $request->id)->delete();

        $project = session('project_tasks');

        $tasks = auth()->user()->statuses()->with('tasks.user')->with('tasks', function ($query) use ($project) {
            $query->where('project_id', $project);
        })->get();

        return $tasks;
    }

    public function task_add_file(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/files/', $name);

        $task = TaskProject::where('id', $request->id)->first();

        $task->files = $task->files . ',' . $name;
        $task->save();

        $project = session('project_tasks');

        $tasks = auth()->user()->statuses()->with('tasks.user')->with('tasks', function ($query) use ($project) {
            $query->where('project_id', $project);
        })->get();

        return $tasks;
    }
}
