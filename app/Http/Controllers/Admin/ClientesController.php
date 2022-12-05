<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        try {
            return view('admin.clientes');
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function clientes_list()
    {
        try {
            $clientes = DB::table('cliente')->get();
            return response()->json(["data" => $clientes]);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function clientes_data(Request $request)
    {
        try {
            $facturacion = DB::table('datos_facturacion')->where("id_cliente", $request->cliente)->first();
            $tecnicos = DB::table('datos_tecnico')->where("id_cliente", $request->cliente)->first();
            $anexos = DB::table('anexos_clientes')
            ->select('anexos_clientes.*', 'empleados.nombre as creador')
            ->join("empleados", "empleados.id", "=", "anexos_clientes.created_by")
            ->where("id_cliente", $request->cliente)
            ->get();

            return response()->json(["facturacion" => $facturacion, "tecnicos" => $tecnicos, "anexos" => $anexos]);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
