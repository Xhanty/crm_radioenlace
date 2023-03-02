<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Exports\ProspectosExcel;
use App\Exports\ProspectosPlantilla;
use App\Http\Controllers\Controller;
use App\Imports\ProspectosImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ProspectosController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_prospectos_personas')) {
                return redirect()->route('home');
            }

            $paises = DB::table("paises")->get();

            return view('admin.comercial.prospectos', compact('paises'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("prospectos")->select('prospectos.*', 'paises.name as pais')
                ->join('paises', 'paises.id', '=', 'prospectos.pais_id')->orderBy('id', 'desc')->get();

            foreach ($data as $key => $value) {
                $data[$key]->created_at = date('d/m/Y H:i A', strtotime($value->created_at));

                if ($data[$key]->tipo_cliente == 0) {
                    $data[$key]->tipo_cliente = 'Posible Cliente';
                } else {
                    $data[$key]->tipo_cliente = 'Cliente Existente';
                }
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $info = '';

                    if ($row->fecha_evento) {
                        $info = "background: rgb(245 60 91 / 30%);";
                    }

                    $actionBtn =

                        '<input type="text" onfocus="(this.type=' . "'date'" . ')" style="' . $info . '" class="form-control date_action text-center" value="' . $row->fecha_evento . '" data-id="' . $row->id . '"><br>' .

                        '<a data-id="' . $row->id . '" title="Ver" class="edit btn btn-primary btn-sm btnView"><i class="fa fa-eye"></i></a>

                    <a data-id="' . $row->id . '" title="Modificar" class="edit btn btn-warning btn-sm btnEdit"><i class="fa fa-pencil-alt"></i></a>

                    <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a>

                    <a data-id="' . $row->id . '" data-celular="' . $row->celular . '" title="WhatsApp" class="btn btn-success btn-sm btnWhatsapp"><i class="fab fa-whatsapp"></i></a>

                    <a target="_BLANK" href="history_prospectos?token=' . $row->id . '&pr=1" title="Historial/Avance" class="btn btn-primary btn-sm btnHistory"><i class="fa fa-book"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->setRowClass(function ($row) {
                    if ($row->estado == 2) {
                        return 'bg-pending';
                    } else if ($row->estado == 1) {
                        return 'bg-approved';
                    } else if ($row->estado == 0) {
                        return 'bg-rejected';
                    }
                })
                ->make(true);
        }
    }

    public function data(Request $request)
    {
        try {
            $prospectos = DB::table("prospectos")->where('id', $request->id)->first();

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $file = $request->file('file');
            $name = null;

            if ($file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images/prospectos_personas/', $name);
            }

            DB::table("prospectos")->insert([
                'tipo_cliente' => $request->tipo_cliente,
                'pais_id' => $request->pais,
                'empresa' => $request->empresa ? $request->empresa : null,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos ? $request->apellidos : null,
                'email' => $request->email ? $request->email : null,
                'cargo' => $request->cargo ? $request->cargo : null,
                'celular' => $request->celular ? $request->celular : null,
                'tel_fijo' => $request->tel_fijo ? $request->tel_fijo : null,
                'fecha_nacimiento' => $request->fecha_nacimiento ? $request->fecha_nacimiento : null,
                'direccion' => $request->direccion ? $request->direccion : null,
                'facebook' => $request->facebook ? $request->facebook : null,
                'whatsapp' => $request->whatsapp ? $request->whatsapp : null,
                'instagram' => $request->instagram ? $request->instagram : null,
                'referido' => $request->referido ? $request->referido : null,
                'logo' => $name,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('file');

            if ($file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images/prospectos_personas/', $name);

                DB::table("prospectos")->where('id', $request->id)->update([
                    'tipo_cliente' => $request->tipo_cliente,
                    'pais_id' => $request->pais,
                    'empresa' => $request->empresa ? $request->empresa : null,
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos ? $request->apellidos : null,
                    'email' => $request->email ? $request->email : null,
                    'cargo' => $request->cargo ? $request->cargo : null,
                    'celular' => $request->celular ? $request->celular : null,
                    'tel_fijo' => $request->tel_fijo ? $request->tel_fijo : null,
                    'fecha_nacimiento' => $request->fecha_nacimiento ? $request->fecha_nacimiento : null,
                    'direccion' => $request->direccion ? $request->direccion : null,
                    'facebook' => $request->facebook ? $request->facebook : null,
                    'whatsapp' => $request->whatsapp ? $request->whatsapp : null,
                    'instagram' => $request->instagram ? $request->instagram : null,
                    'referido' => $request->referido ? $request->referido : null,
                    'logo' => $name,
                ]);
            } else {
                DB::table("prospectos")->where('id', $request->id)->update([
                    'tipo_cliente' => $request->tipo_cliente,
                    'pais_id' => $request->pais,
                    'empresa' => $request->empresa ? $request->empresa : null,
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos ? $request->apellidos : null,
                    'email' => $request->email ? $request->email : null,
                    'cargo' => $request->cargo ? $request->cargo : null,
                    'celular' => $request->celular ? $request->celular : null,
                    'tel_fijo' => $request->tel_fijo ? $request->tel_fijo : null,
                    'fecha_nacimiento' => $request->fecha_nacimiento ? $request->fecha_nacimiento : null,
                    'direccion' => $request->direccion ? $request->direccion : null,
                    'facebook' => $request->facebook ? $request->facebook : null,
                    'whatsapp' => $request->whatsapp ? $request->whatsapp : null,
                    'instagram' => $request->instagram ? $request->instagram : null,
                    'referido' => $request->referido ? $request->referido : null
                ]);
            }

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $file = DB::table("prospectos")->where('id', $request->id)->first();

            if ($file->logo != null) {
                $file_path = 'images/prospectos_personas/' . $file->logo;
                unlink($file_path);
            }


            DB::table("prospectos")->where('id', $request->id)->delete();

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function download_excel()
    {
        return Excel::download(new ProspectosExcel, 'prospectos.xlsx');
    }

    public function download_plantilla()
    {
        return Excel::download(new ProspectosPlantilla, 'prospectos.xlsx');
    }

    public function import_excel(Request $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('file');

            $name = time() . $file->getClientOriginalName();
            $file->move('images/prospectos_personas/', $name);

            Excel::import(new ProspectosImport, 'images/prospectos_personas/' . $name);

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function change_status(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("prospectos")->where('id', $request->id)->update([
                'estado' => $request->estado,
            ]);

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function change_fecha(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("prospectos")->where('id', $request->id)->update([
                'fecha_evento' => $request->fecha,
            ]);

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function history_prospectos(Request $request)
    {
        try {
            $id = $request->get('token');
            $pr = $request->get('pr');

            if (!$id || !$pr) {
                return view('errors.404');
            }

            if ($pr == 1) {
                $prospecto = DB::table("prospectos")->where('id', $id)->first();
            } else {
                $prospecto = DB::table("prospectos_empresas")->where('id', $id)->first();
            }

            $prospecto->observaciones = DB::table("historial_prospectos")
                ->join('empleados', 'empleados.id', '=', 'historial_prospectos.created_by')
                ->select('historial_prospectos.*', 'empleados.nombre as creador')
                ->where('prospecto_id', $id)
                ->orderBy('historial_prospectos.id', 'desc')
                ->get();

            return view('admin.comercial.history_prospectos', compact('prospecto'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function add_observacion(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("historial_prospectos")->insert([
                'prospecto_id' => $request->id,
                'observacion' => $request->observacion,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function edit_observacion(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("historial_prospectos")->where('id', $request->id)->update([
                'observacion' => $request->observacion,
            ]);

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function delete_observacion(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("historial_prospectos")->where('id', $request->id)->delete();

            DB::commit();

            $prospectos = [];

            return response()->json([
                'info' => 1,
                'prospectos' => $prospectos,
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'info' => 0,
                'prospectos' => [],
                'error' => $ex->getMessage(),
            ]);
        }
    }
}
