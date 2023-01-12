<?php

namespace App\Http\Controllers\Admin\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class AlmacenesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_almacenes_inventario')) {
                return redirect()->route('home');
            }

            $clientes = DB::table('cliente')
                ->select("cliente.id", "cliente.razon_social")
                ->join("almacenes", "almacenes.cliente", "=", "cliente.id")
                ->where("estado", 1)
                ->orderBy("cliente.razon_social")
                ->groupBy("cliente.id", "cliente.razon_social")
                ->get();

            foreach ($clientes as $key => $value) {
                $almacenes = DB::table('almacenes')
                    ->where("almacenes.cliente", $value->id)
                    ->orderBy("almacenes.nombre")
                    ->get();
                $clientes[$key]->almacenes = $almacenes;
            }

            foreach ($clientes as $key => $value) {
                foreach ($value->almacenes as $key2 => $value2) {
                    $estantes = DB::table('ubicaciones_almacen')
                        ->where("ubicaciones_almacen.almacen", $value2->id)
                        ->orderBy("ubicaciones_almacen.nombre")
                        ->get();
                    $clientes[$key]->almacenes[$key2]->estantes = $estantes;
                }
            }

            $almacenes_sede = DB::table('almacenes')
                ->select("almacenes.id", "almacenes.nombre")
                ->whereNull("almacenes.cliente")
                ->where("almacen", 1)
                ->orderBy("almacenes.nombre")
                ->groupBy("almacenes.id", "almacenes.nombre")
                ->get();

            foreach ($almacenes_sede as $key => $value) {
                $almacenes = DB::table('almacenes')
                    ->whereNull("almacenes.cliente")
                    ->where("almacen_id", $value->id)
                    ->orderBy("almacenes.nombre")
                    ->get();
                $almacenes_sede[$key]->almacenes = $almacenes;
            }

            foreach ($almacenes_sede as $key => $value) {
                foreach ($value->almacenes as $key2 => $value2) {
                    $estantes = DB::table('ubicaciones_almacen')
                        ->where("ubicaciones_almacen.almacen", $value2->id)
                        ->orderBy("ubicaciones_almacen.nombre")
                        ->get();
                    $almacenes_sede[$key]->almacenes[$key2]->estantes = $estantes;
                }
            }

            return view('admin.inventario.almacenes', compact('almacenes_sede', 'clientes'));
        } catch (Exception $ex) {
            return $ex;
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
