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
        return view('admin.empleados');
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
}
