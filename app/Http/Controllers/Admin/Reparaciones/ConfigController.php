<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{

    public function accesorios()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_reparaciones')) {
                return redirect()->route('home');
            }

            $accesorios = DB::table('accesorios_reparaciones')
                ->select('accesorios_reparaciones.*', 'empleados.nombre as nombre_empleado')
                ->join("empleados", "accesorios_reparaciones.created_by", "=", "empleados.id")
                ->get();
            return view('admin.reparaciones.accesorios', compact('accesorios'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function categorias()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_reparaciones')) {
                return redirect()->route('home');
            }

            $categorias = DB::table('categorias_reparaciones')
                ->select('categorias_reparaciones.*', 'empleados.nombre as nombre_empleado')
                ->join("empleados", "categorias_reparaciones.created_by", "=", "empleados.id")
                ->get();
            return view('admin.reparaciones.categorias', compact('categorias'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }
    public function accesorios_add(Request $request)
    {
        try {
            DB::table('accesorios_reparaciones')->insert([
                'accesorio' => $request->nombre,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['info' => 1, 'success' => 'Accesorio creado correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear el accesorio']);
        }
    }

    public function accesorios_delete(Request $request)
    {
        try {
            DB::table('accesorios_reparaciones')->where('id', $request->id)->delete();
            return response()->json(['info' => 1, 'success' => 'Accesorio eliminado correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el accesorio']);
        }
    }

    public function categorias_add(Request $request)
    {
        try {
            DB::table('categorias_reparaciones')->insert([
                'categoria' => $request->nombre,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['info' => 1, 'success' => 'Categoria creada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear la categoria']);
        }
    }

    public function categorias_delete(Request $request)
    {
        try {
            DB::table('categorias_reparaciones')->where('id', $request->id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoria eliminada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoria']);
        }
    }
}
