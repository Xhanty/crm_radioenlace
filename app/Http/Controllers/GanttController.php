<?php

namespace App\Http\Controllers;

use App\Models\TaskProject;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function index()
    {
        return view('tasks.gantt');
    }

    public function data()
    {
        $tasks = TaskProject::all();
        $data = [];

        foreach ($tasks as $key => $value) {
            $fecha1 = new \DateTime($value->init_date);
            $fecha2 = new \DateTime($value->end_date);
            $fecha_hoy = new \DateTime(date('Y-m-d'));
            $duration = $fecha1->diff($fecha2);

            $data[] = [
                'id' => $value->id,
                'text' => $value->title,
                'start_date' => $value->init_date,
                'duration' => $duration->format('%a'),
                'progress' => $duration->format('%a'),
                'parent' => 0,
            ];
        }
        return response()->json([
            "data" => $data,
            "links" => [],
        ]);
    }
}
