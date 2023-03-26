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

            if (!auth()->user()->hasPermissionTo('permisos_usuarios')) {
                return redirect()->route('home');
            }

            $empleados = DB::table("empleados")->where("status", 1)->orderBy("nombre", "asc")->get();
            return view('permisos', compact('empleados'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function data(Request $request)
    {
        try {
            $empleado = $request->empleado;

            $permisos = DB::table("permisos_new")
                ->where("permisos_new.empleado", $empleado)
                ->get();
            return response()->json([
                "info" => 1,
                "data" => $permisos
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $permisos = $request->permisos;
            $empleado = $request->empleado;
            $type = $request->type;
            $admin = auth()->user()->id;

            if ($type && $type == 'cotizaciones') {
                DB::table("permisos_new")->where("modulo", 'gestionar_cotizaciones')->where("empleado", $empleado)->update([
                    'cotizaciones' => $request->empleados
                ]);
                
            } else {
                DB::table("permisos_new")->where("empleado", $empleado)->delete();

                foreach ($permisos as $permiso) {
                    DB::table("permisos_new")->insert([
                        "empleado" => $empleado,
                        "modulo" => $permiso,
                        "administrador" => $admin,
                        "fecha" => date("Y-m-d H:i:s")
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                "info" => 1,
                "message" => "Permisos actualizados correctamente"
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
    }
}
