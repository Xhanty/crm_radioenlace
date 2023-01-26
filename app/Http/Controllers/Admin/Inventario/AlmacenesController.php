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

            $almacenes = DB::table('almacenes')->whereNull("parent_id")->get();

            if ($almacenes->count() > 0) {
                $almacenes = $almacenes->toArray();
                $almacenes = $this->getAlmacenes($almacenes);
            } else {
                $almacenes = [];
            }

            $clientes = DB::table('cliente')
                ->select("cliente.id", "cliente.razon_social")
                ->where("estado", 1)
                ->orderBy("cliente.razon_social")
                ->get();

            //return $almacenes;
            return view('admin.inventario.almacenes', compact('almacenes', 'clientes'));
        } catch (Exception $ex) {
            return $ex;
            return view('errors.500');
        }
    }

    public function almacenes_create(Request $request)
    {
        try {
            $nivel = $request->nivel;
            $padre = $request->parent;
            $nombre = $request->nombre;
            $observaciones = $request->observacion;

            if ($nivel == 0) {
                DB::table('almacenes')->insert([
                    'nombre' => $nombre,
                    'observaciones' => $observaciones,
                    'created_by' => session('user'),
                    'fecha' => date('Y-m-d'),
                    'status' => 1,
                    'parent_id' => null
                ]);
            } else {
                DB::table('almacenes')->insert([
                    'nombre' => $nombre,
                    'observaciones' => $observaciones,
                    'created_by' => session('user'),
                    'fecha' => date('Y-m-d'),
                    'status' => 1,
                    'parent_id' => $padre
                ]);
            }

            return response()->json(['info' => 1, 'success' => 'Almacén creado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al crear el almacén.']);
            return $ex;
        }
    }

    public function almacenes_update(Request $request)
    {
        try {
            $id = $request->id;
            $nombre = $request->nombre;
            $observacion = $request->observacion;

            DB::table('almacenes')
                ->where('id', $id)
                ->update([
                    'nombre' => $nombre,
                    'observaciones' => $observacion ? $observacion : null,
                ]);

            return response()->json(['info' => 1, 'success' => 'Almacén actualizado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el almacén.']);
            return $ex;
        }
    }

    public function almacenes_delete(Request $request)
    {
        try {
            $id = $request->id;

            $valid_products = DB::table('movimientos_inventario')
                ->where('almacen_id', $id)
                ->count();

            if ($valid_products > 0) {
                return response()->json(['info' => 0, 'success' => 'No se puede eliminar el almacén, tiene productos asociados.']);
            }

            $almacenes = DB::table('almacenes')->where('id', $id)->get();

            if ($almacenes->count() > 0) {
                $almacenes = $almacenes->toArray();
                $almacenes = $this->getAlmacenes($almacenes);
            }

            if (count($almacenes) > 0) {
                foreach ($almacenes as $key => $value) {
                    if (count($value->almacenes) > 0) {
                        $this->delete_subalmacenes($value->almacenes);
                    }
                }
            }

            DB::table('almacenes')->where('id', $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Almacén eliminado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el almacén.']);
            return $ex;
        }
    }

    public function delete_subalmacenes($almacenes)
    {
        foreach ($almacenes as $key => $value) {
            if (count($value->almacenes) > 0) {
                $this->delete_subalmacenes($value->almacenes);
            }

            DB::table('almacenes')->where('id', $value->id)->delete();
        }
    }

    public function getAlmacenes($almacenes)
    {
        foreach ($almacenes as $key => $almacen) {
            $almacenes[$key]->almacenes = DB::table('almacenes')->where('parent_id', $almacen->id)->get();

            if ($almacenes[$key]->almacenes->count() > 0) {
                $almacenes[$key]->almacenes = $almacenes[$key]->almacenes->toArray();
                $almacenes[$key]->almacenes = $this->getAlmacenes($almacenes[$key]->almacenes);
            } else {
                $almacenes[$key]->almacenes = [];
            }
        }

        return $almacenes;
    }
}
