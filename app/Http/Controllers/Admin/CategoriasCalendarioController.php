<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasCalendarioController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('permisos_usuarios')) {
                return redirect()->route('home');
            }

            $categories = DB::table('categorias_calendario')
                ->select('categorias_calendario.*', 'empleados.nombre as creador')
                ->join('empleados', 'categorias_calendario.created_by', '=', 'empleados.id')
                ->get();

            return view('admin.categorias_calendario', compact('categories'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function add(Request $request)
    {
        try {
            DB::table('categorias_calendario')->insert([
                'nombre' => $request->nombre,
                'color' => $request->color_texto,
                'bgColor' => $request->color_fondo,
                'dragBgColor' => $request->color_fondo,
                'borderColor' => $request->color_fondo,
                'created_by' => session('user'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['info' => 1, 'success' => 'Categoría creada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al crear la categoría']);
        }
    }

    public function update(Request $request)
    {
        try {
            DB::table('categorias_calendario')->where('id', $request->id)->update([
                'nombre' => $request->nombre,
                'color' => $request->color_texto,
                'bgColor' => $request->color_fondo,
                'dragBgColor' => $request->color_fondo,
                'borderColor' => $request->color_fondo,
            ]);
            return response()->json(['info' => 1, 'success' => 'Categoría actualizada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar la categoría']);
        }
    }

    public function delete(Request $request)
    {
        try {
            $valid = DB::table('calendario_eventos')->where('calendarId', $request->id)->count();
            if ($valid > 0) {
                return response()->json(['info' => 0, 'error' => 'No se puede eliminar la categoría porque tiene eventos asociados']);
            }
            DB::table('categorias_calendario')->where('id', $request->id)->delete();
            return response()->json(['info' => 1, 'success' => 'Categoría eliminada correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la categoría']);
        }
    }
}
