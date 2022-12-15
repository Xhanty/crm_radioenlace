<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class AlmacenesController extends Controller
{
    public function index()
    {
        try {
            $almacenes = DB::table('almacenes')
            ->select("almacenes.*", "empleados.nombre as creador")
            ->join("empleados", "empleados.id", "=", "almacenes.created_by")
            ->get();
            return view('admin.inventario.almacenes', compact('almacenes'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function almacenes_create(Request $request)
    {
        try {
            $nombre = $request->nombre;
            $categoria = DB::table('almacenes')->insert([
                'nombre' => $nombre,
                'created_by' => session('user'),
                'fecha' => date('Y-m-d'),
                'status' => 0
            ]);
            return response()->json(['info' => 1, 'success' => 'Almacén creado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al crear el almacén.']);
            return $ex;
        }
    }

    public function almacenes_delete(Request $request)
    {
        try {
            $id = $request->id;
            $categoria = DB::table('almacenes')->where('id', $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Almacén eliminado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el almacén.']);
            return $ex;
        }
    }
}
