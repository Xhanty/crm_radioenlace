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
}
