<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ProveedoresController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_proveedores')) {
                return redirect()->route('home');
            }

            $proveedores = DB::table('proveedores')->get();
            return view('admin.proveedores', compact('proveedores'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function proveedores_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";
            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/proveedores', $archivo);
            }

            DB::table("proveedores")->insert([
                "nit" => $request->nit,
                "codigo_verificacion" => $request->codigo ? $request->codigo : 0,
                "razon_social" => $request->razon_social ? $request->razon_social : "",
                "direccion" => $request->direccion ? $request->direccion : "",
                "telefono_fijo" => $request->telefono ? $request->telefono : "",
                "celular" => $request->celular ? $request->celular : "",
                "contacto" => $request->contacto ? $request->contacto : "",
                "email" => $request->email ? $request->email : "",
                "email_comercial" => $request->email_comercial  ? $request->email_comercial : "",
                "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                "ciudad" => $request->ciudad ? $request->ciudad : "",
                "observaciones" => $request->observaciones ? $request->observaciones : "",
                "avatar" => $archivo,
                "estado" => 1,
            ]);

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function proveedores_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = DB::table("proveedores")->where("id", $request->id)->first();
            if ($archivo->avatar != "" && file_exists('images/proveedores/' . $archivo->avatar)) {
                unlink('images/proveedores/' . $archivo->avatar);
            }
            DB::table("proveedores")->where("id", $request->id)->delete();
            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function proveedores_data(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = DB::table("proveedores")->where("id", $request->id)->first();
            $anexos = DB::table("anexos_proveedores")
            ->select("anexos_proveedores.*", "empleados.nombre as creador")
            ->join("empleados", "empleados.id", "anexos_proveedores.created_by")
            ->where("id_cliente", $request->id)
            ->get();
            DB::commit();
            return response()->json(["info" => 1, "data" => $data, "anexos" => $anexos]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "data" => [], "anexos" => []]);
        }
    }

    public function proveedores_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";
            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/proveedores', $archivo);
            }

            DB::table("proveedores")->where("id", $request->id)->update([
                "nit" => $request->nit,
                "codigo_verificacion" => $request->codigo ? $request->codigo : 0,
                "razon_social" => $request->razon_social ? $request->razon_social : "",
                "direccion" => $request->direccion ? $request->direccion : "",
                "telefono_fijo" => $request->telefono ? $request->telefono : "",
                "celular" => $request->celular ? $request->celular : "",
                "contacto" => $request->contacto ? $request->contacto : "",
                "email" => $request->email ? $request->email : "",
                "email_comercial" => $request->email_comercial  ? $request->email_comercial : "",
                "tipo_regimen" => $request->tipo_regimen ? $request->tipo_regimen : "",
                "ciudad" => $request->ciudad ? $request->ciudad : "",
                "observaciones" => $request->observaciones ? $request->observaciones : "",
                "avatar" => $archivo,
                "estado" => 1,
            ]);

            DB::commit();
            return response()->json(["info" => 1]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0]);
        }
    }

    public function proveedores_anexos_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = "";
            if ($anexo = $request->file('archivo')) {
                $archivo = rand() . rand() . '.' . $anexo->getClientOriginalExtension();
                $anexo->move('images/proveedores/anexos', $archivo);
            }

            DB::table("anexos_proveedores")->insert([
                "id_cliente" => $request->id,
                "descripcion" => $request->descripcion ? $request->descripcion : "",
                "documento" => $archivo,
                "created_by" => session('user'),
                "fecha" => date("Y-m-d H:i:s"),
                "tipo" => $request->tipo_documento,
            ]);

            DB::commit();

            $anexos = DB::table("anexos_proveedores")
            ->select("anexos_proveedores.*", "empleados.nombre as creador")
            ->join("empleados", "empleados.id", "anexos_proveedores.created_by")
            ->where("id_cliente", $request->id)
            ->get();

            return response()->json(["info" => 1, "anexos" => $anexos]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "anexos" => []]);
        }
    }

    public function proveedores_anexos_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo = DB::table("anexos_proveedores")->where("id", $request->id)->first();
            if ($archivo->documento != "" && file_exists('images/proveedores/anexos/' . $archivo->documento)) {
                unlink('images/proveedores/anexos/' . $archivo->documento);
            }
            DB::table("anexos_proveedores")->where("id", $request->id)->delete();
            DB::commit();

            $anexos = DB::table("anexos_proveedores")
            ->select("anexos_proveedores.*", "empleados.nombre as creador")
            ->join("empleados", "empleados.id", "anexos_proveedores.created_by")
            ->where("id_cliente", $request->id_proveedor)
            ->get();
            return response()->json(["info" => 1, "anexos" => $anexos]);
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;
            return response()->json(["info" => 0, "anexos" => []]);
        }
    }
}
