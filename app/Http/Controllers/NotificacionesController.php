<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacionesController extends Controller
{
    public function notificaciones_eventos()
    {
        try {
            $events = [];
            $fecha_actual = date('Y-m-d H:i');
            $valid1 = strtotime('+ ' . env('NOTIFICATION_TIME_UNO') . ' minute', strtotime($fecha_actual));
            $valid2 = strtotime('+ ' . env('NOTIFICATION_TIME_DOS') . ' minute', strtotime($fecha_actual));
            $valid3 = strtotime('+ ' . env('NOTIFICATION_TIME_TRES') . ' minute', strtotime($fecha_actual));

            $valid1 = date('Y-m-d H:i', $valid1);
            $valid2 = date('Y-m-d H:i', $valid2);
            $valid3 = date('Y-m-d H:i', $valid3);

            $data = DB::table('calendario_eventos')
                ->select('calendario_eventos.*')
                ->where('empleado', '=', auth()->user()->id)
                ->where('start', '>', $fecha_actual)
                ->get();

            foreach ($data as $key => $value) {
                $valid_date = date('Y-m-d H:i', strtotime($value->start));
                if ($valid_date == $valid1 || $valid_date == $valid2 || $valid_date == $valid3) {
                    $start = date('H:i A', strtotime($value->start));
                    $end = date('H:i A', strtotime($value->end));

                    $events[] = [
                        'title' => $value->name,
                        'start' => $start,
                        'end' => $end,
                    ];
                }
            }

            return response()->json(['info' => 1, 'data' => $events]);
        } catch (Exception $ex) {
            return $ex;
            return response()->json(['info' => 0, 'success' => 'Error al traer los datos']);
        }
    }
}
