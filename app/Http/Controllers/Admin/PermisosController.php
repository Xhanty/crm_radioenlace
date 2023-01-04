<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisosController extends Controller
{
    public function index()
    {
        try {
            $empleados = DB::table("empleados")->where("status", 1)->get();
            return view('permisos', compact('empleados'));
        } catch (Exception $e) {
            return view('errors.500');
            return $e->getMessage();
        }
    }

    public function data(Request $request)
    {
        try {
            $empleado = $request->empleado;

            $permisos = DB::table("permisos")
                ->where("permisos.id_usuario", $empleado)
                ->get();
            return response()->json([
                "info" => 1,
                "data" => $permisos
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
