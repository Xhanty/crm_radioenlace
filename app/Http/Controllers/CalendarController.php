<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    public function index()
    {
        $events = DB::table('calendario_eventos')->where('empleado', session('user'))->get();
        $categories = DB::table('categorias_calendario')->get();

        foreach ($events as $key => $value) {
            $categorie = DB::table('categorias_calendario')->where('id', $value->calendarId)->first();
            $events[$key]->category = $categorie;
        }
        return view('calendar.calendar', compact('events', 'categories'));
    }

    public function add(Request $request)
    {
        try {
            $code = 'CL-' . strtoupper(Str::random(20));
            $isAllDay = $request->isAllDay == 'true' ? 1 : 0;
            $isPrivate = $request->isPrivate == 'true' ? 1 : 0;
            $useCreationPopup = $request->useCreationPopup == 'true' ? 1 : 0;
            $start = date($request->start);
            $end = date($request->end);

            DB::table('calendario_eventos')->insert([
                'code' => $code,
                'empleado' => session('user'),
                'calendarId' => $request->calendarId,
                'isAllDay' => $isAllDay,
                'isPrivate' => $isPrivate,
                'name' => $request->name,
                'description' => $request->description ?? '',
                'state' => $request->state,
                'start' => $start,
                'end' => $end,
                'useCreationPopup' => $useCreationPopup,
                'created_at' => now(),
            ]);

            $events = DB::table('calendario_eventos')->where('empleado', session('user'))->get();
            foreach ($events as $key => $value) {
                $categorie = DB::table('categorias_calendario')->where('id', $value->calendarId)->first();
                $events[$key]->category = $categorie;
            }
            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $isAllDay = $request->isAllDay == 'true' ? 1 : 0;
            $isPrivate = $request->isPrivate == 'true' ? 1 : 0;
            $start = date($request->start);
            $end = date($request->end);

            DB::table('calendario_eventos')->where("code", $id)->where("empleado", session('user'))->update([
                'calendarId' => $request->calendarId,
                'isAllDay' => $isAllDay,
                'isPrivate' => $isPrivate,
                'name' => $request->name,
                'description' => $request->description ?? '',
                'state' => $request->state,
                'start' => $start,
                'end' => $end,
            ]);

            $events = DB::table('calendario_eventos')->where('empleado', session('user'))->get();
            foreach ($events as $key => $value) {
                $categorie = DB::table('categorias_calendario')->where('id', $value->calendarId)->first();
                $events[$key]->category = $categorie;
            }
            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::table('calendario_eventos')->where("code", $id)->where("empleado", session('user'))->delete();

            $events = DB::table('calendario_eventos')->where('empleado', session('user'))->get();
            foreach ($events as $key => $value) {
                $categorie = DB::table('categorias_calendario')->where('id', $value->calendarId)->first();
                $events[$key]->category = $categorie;
            }
            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
