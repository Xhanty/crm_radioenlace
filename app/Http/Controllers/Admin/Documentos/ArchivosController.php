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
            return view('errors.500');
        }
    }

    public function archivos_add(Request $request)
    {
        try {
            $id_cliente = $request->cliente;
            $id_categoria = $request->categoria;
            $documento = $request->file('archivo');
            $created_by = session('user');

            $nombre = time() . '_' . $documento->getClientOriginalName();
            $documento->move(public_path() . '/images/anexos_clientes/', $nombre);

            DB::table('anexos_clientes')->insert([
                'id_cliente' => $id_cliente,
                'tipo' => $id_categoria,
                'documento' => $nombre,
                'created_by' => $created_by,
                "descripcion" => "",
                "fecha" => date("Y-m-d H:i:s"),
            ]);

            return response()->json([
                'info' => 1,
                'message' => 'Archivo guardado correctamente',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
                'message' => 'Error al guardar el archivo',
            ]);
        }
    }

    public function archivos_delete(Request $request)
    {
        try {
            $id = $request->id;
            $anexo = DB::table('anexos_clientes')->where("id", $id)->first();
            $file = public_path() . 'images/anexos_clientes/' . $anexo->documento;
            if (file_exists($file)) {
                unlink($file);
            }

            DB::table('anexos_clientes')->where("id", $id)->delete();

            return response()->json([
                'info' => 1,
                'message' => 'Archivo eliminado correctamente',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
                'message' => 'Error al eliminar el archivo',
            ]);
        }
    }
}
