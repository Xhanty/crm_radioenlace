<?php

namespace App\Http\Controllers\Admin\Documentos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchivosController extends Controller
{
    public function index()
    {
        try {
            $anexos = DB::table('anexos_clientes')
            ->select("anexos_clientes.*", "cliente.razon_social as cliente", "empleados.nombre as creador")
            ->join("cliente", "anexos_clientes.id_cliente", "=", "cliente.id")
            ->join("empleados", "empleados.id", "=", "anexos_clientes.created_by")
            ->orderBy("anexos_clientes.id", "desc")
            ->get();

            $clientes = DB::table('cliente')->where("estado", 1)->get();
            $categorias = DB::table('categorias_archivos')->get();
            return view('admin.documentos.archivos', compact('anexos', 'clientes', 'categorias'));
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
