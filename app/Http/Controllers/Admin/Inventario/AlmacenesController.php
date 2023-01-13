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

            $clientes_all = DB::table('cliente')
                ->select("cliente.id", "cliente.razon_social")
                ->where("estado", 1)
                ->orderBy("cliente.razon_social")
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
                ->select("almacenes.id", "almacenes.nombre", "almacenes.observaciones")
                ->whereNull("almacenes.cliente")
                ->where("almacen", 1)
                ->orderBy("almacenes.nombre")
                ->groupBy("almacenes.id", "almacenes.nombre", "almacenes.observaciones")
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

            return view('admin.inventario.almacenes', compact('almacenes_sede', 'clientes', 'clientes_all'));
        } catch (Exception $ex) {
            return $ex;
            return view('errors.500');
        }
    }

    public function almacenes_create(Request $request)
    {
        try {
            $ubicacion = $request->ubicacion;
            $nivel = $request->nivel;
            $cliente = $request->cliente;
            $nivel1 = $request->nivel1;
            $nivel2 = $request->nivel2;
            $nombre = $request->nombre;
            $observaciones = $request->observacion;

            if ($ubicacion == 1) {
                $cliente = null;
                if ($nivel == 1) {
                    DB::table('almacenes')->insert([
                        'nombre' => $nombre,
                        'observaciones' => $observaciones,
                        'created_by' => session('user'),
                        'fecha' => date('Y-m-d'),
                        'status' => 1,
                        'almacen' => 1
                    ]);
                } else if ($nivel == 2) {
                    DB::table('almacenes')->insert([
                        'nombre' => $nombre,
                        'observaciones' => $observaciones,
                        'created_by' => session('user'),
                        'fecha' => date('Y-m-d'),
                        'status' => 1,
                        'almacen' => 0,
                        'almacen_id' => $nivel1
                    ]);
                } else if ($nivel == 3) {
                    DB::table('ubicaciones_almacen')->insert([
                        'almacen' => $nivel2,
                        'observaciones' => $observaciones,
                        'nombre' => $nombre,
                        'created_by' => session('user'),
                        'fecha' => date('Y-m-d'),
                    ]);
                }
            } else if ($ubicacion == 2) {
                if ($nivel == 1) {
                    DB::table('almacenes')->insert([
                        'cliente' => $cliente,
                        'nombre' => $nombre,
                        'observaciones' => $observaciones,
                        'created_by' => session('user'),
                        'fecha' => date('Y-m-d'),
                        'status' => 1,
                        'almacen' => 0,
                    ]);
                } else if ($nivel == 2) {
                    DB::table('ubicaciones_almacen')->insert([
                        'almacen' => $nivel1,
                        'nombre' => $nombre,
                        'observaciones' => $observaciones,
                        'created_by' => session('user'),
                        'fecha' => date('Y-m-d'),
                    ]);
                }
            }

            return response()->json(['info' => 1, 'success' => 'Almacén creado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al crear el almacén.']);
            return $ex;
        }
    }

    public function almacenes_delete(Request $request)
    {
        try {
            $cliente = $request->cliente;
            $id = $request->id;
            $nivel = $request->nivel;

            /*$valid_products = DB::table('productos')
                ->where('almacen', $id)
                ->orWhere('sub_almacen', $id)
                ->orWhere('sub_almacen_2', $id)
                ->count();

            if ($valid_products > 0) {
                return response()->json(['info' => 0, 'success' => 'No se puede eliminar el almacén, tiene productos asociados.']);
            }*/

            if ($cliente == 0) {
                if ($nivel == 1) {
                    $almacenes = DB::table('almacenes')
                        ->where('almacen_id', $id)
                        ->get();

                    foreach ($almacenes as $key => $value) {
                        DB::table('ubicaciones_almacen')
                            ->where('almacen', $value->id)
                            ->delete();
                    }

                    DB::table('almacenes')
                        ->where('almacen_id', $id)
                        ->delete();

                    DB::table('almacenes')
                        ->where('id', $id)
                        ->delete();
                } else if ($nivel == 2) {
                    DB::table('ubicaciones_almacen')
                        ->where('almacen', $id)
                        ->delete();

                    DB::table('almacenes')
                        ->where('id', $id)
                        ->delete();
                } else if ($nivel == 3) {
                    DB::table('ubicaciones_almacen')
                        ->where('id', $id)
                        ->delete();
                }
            } else if ($cliente == 1) {
                if ($nivel == 1) {

                    DB::table('ubicaciones_almacen')
                        ->where('almacen', $id)
                        ->delete();

                    DB::table('almacenes')
                        ->where('id', $id)
                        ->delete();
                } else if ($nivel == 2) {
                    DB::table('ubicaciones_almacen')
                        ->where('id', $id)
                        ->delete();
                }
            }

            DB::table('almacenes')->where('id', $id)->delete();
            return response()->json(['info' => 1, 'success' => 'Almacén eliminado correctamente']);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el almacén.']);
            return $ex;
        }
    }

    public function almacenes_cliente(Request $request)
    {
        try {
            $nivel = $request->nivel;
            $cliente = $request->cliente;


            $almacenes = DB::table('almacenes')
                ->where("almacenes.cliente", $cliente)
                ->orderBy("almacenes.nombre")
                ->get();

            if ($nivel == 3) {
                foreach ($almacenes as $key => $value) {
                    $estantes = DB::table('ubicaciones_almacen')
                        ->where("ubicaciones_almacen.almacen", $value->id)
                        ->orderBy("ubicaciones_almacen.nombre")
                        ->get();
                    $almacenes[$key]->estantes = $estantes;
                }
            }

            return response()->json(['info' => 1, 'data' => $almacenes]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al cargar los almacenes.']);
            return $ex;
        }
    }

    public function almacenes_sede(Request $request)
    {
        try {
            $nivel = $request->nivel;

            $almacenes = DB::table('almacenes')
                ->whereNull("almacenes.cliente")
                ->where("almacen", 1)
                ->orderBy("almacenes.nombre")
                ->get();

            if ($nivel == 3 && $almacenes) {
                foreach ($almacenes as $key => $value) {
                    $estantes = DB::table('almacenes')
                        ->whereNull("almacenes.cliente")
                        ->where("almacen_id", $value->id)
                        ->orderBy("almacenes.nombre")
                        ->get();
                    $almacenes[$key]->estantes = $estantes;
                }
            }

            return response()->json(['info' => 1, 'data' => $almacenes]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0, 'error' => 'Error al cargar los almacenes.']);
            return $ex;
        }
    }

    public function almacenes_update(Request $request)
    {
        $cliente = $request->cliente;
        $id = $request->id;
        $nombre = $request->nombre;
        $nivel = $request->nivel;
        $observacion = $request->observacion;

        if ($cliente == 0) {
            if ($nivel == 1 || $nivel == 2) {
                DB::table('almacenes')
                    ->where('id', $id)
                    ->update([
                        'nombre' => $nombre,
                        'observaciones' => $observacion ? $observacion : null,
                    ]);
            } else if ($nivel == 3) {
                DB::table('ubicaciones_almacen')
                    ->where('id', $id)
                    ->update([
                        'nombre' => $nombre,
                        'observaciones' => $observacion ? $observacion : null,
                    ]);
            }
        } else if ($cliente == 1) {
            if ($nivel == 1) {
                DB::table('almacenes')
                    ->where('id', $id)
                    ->update([
                        'nombre' => $nombre,
                        'observaciones' => $observacion ? $observacion : null,
                    ]);
            } else if ($nivel == 2) {
                DB::table('ubicaciones_almacen')
                    ->where('id', $id)
                    ->update([
                        'nombre' => $nombre,
                        'observaciones' => $observacion ? $observacion : null,
                    ]);
            }
        }

        return response()->json(['info' => 1, 'success' => 'Almacén actualizado correctamente']);
    }
}
