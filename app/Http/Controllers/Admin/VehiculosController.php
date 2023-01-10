<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class VehiculosController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('ver_vehiculos')) {
                return redirect()->route('home');
            }

            return view('admin.vehiculos.vehiculos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function vehiculos_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("vehiculos")->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a data-id="' . $row->id . '" title="Ver" class="edit btn btn-primary btn-sm btn_Show"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $row->id . '" title="Editar" class="edit btn btn-primary btn-sm btn_Edit"><i class="fa fa-pencil-alt"></i></a>
                    <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
                    
                    if (auth()->user()->hasPermissionTo('gestion_checklist_vehiculos')) {
                        $actionBtn .= ' <a data-id="' . $row->id . '" title="Gestionar" class="edit btn btn-success btn-sm btn_Gestionar"><i class="fa fa-file"></i></a>';
                    }

                    if (auth()->user()->hasPermissionTo('gestion_salud_vehiculos')) {
                        $actionBtn .= '<a data-id="' . $row->id . '" title="Encuesta de salud" class="edit btn btn-success btn-sm btn_Encuesta"><i class="fa fa-plus"></i></a>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function vehiculos_create(Request $request)
    {
        try {
            DB::beginTransaction();
            $image = $request->file('foto');
            $new_name = rand() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move('images/vehiculos', $new_name);

            DB::table("vehiculos")->insert([
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'tipo_combustible' => $request->tipo_combustible,
                'year' => $request->year,
                'soat' => $request->soat,
                'placa' => $request->placa,
                'seguro_obligatorio' => $request->tecnomecanica,
                'color' => $request->color,
                'seguro_riesgos' => $request->seguro,
                'tipo' => $request->tipo,
                'observaciones' => $request->observaciones,
                'foto' => $new_name,
                'created_by' => session('user'),
                'estado' => 1,
            ]);
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Vehículo creado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al crear el vehiculo.']);
            return $ex->getMessage();
        }
    }

    public function data_vehiculo(Request $request)
    {
        try {
            $data = DB::table("vehiculos")->where('id', $request->id)->first();
            return response()->json(['success' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['error' => 'Error al obtener los datos del vehiculo.']);
        }
    }

    public function vehiculos_edit(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $new_name = rand() . rand() . '.' . $image->getClientOriginalExtension();
                $image->move('images/vehiculos', $new_name);

                DB::table("vehiculos")->where('id', $request->id)->update([
                    'marca' => $request->marca,
                    'modelo' => $request->modelo,
                    'tipo_combustible' => $request->tipo_combustible,
                    'year' => $request->year,
                    'soat' => $request->soat,
                    'placa' => $request->placa,
                    'seguro_obligatorio' => $request->tecnomecanica,
                    'color' => $request->color,
                    'seguro_riesgos' => $request->seguro,
                    'tipo' => $request->tipo,
                    'observaciones' => $request->observaciones,
                    'foto' => $new_name
                ]);
            } else {
                DB::table("vehiculos")->where('id', $request->id)->update([
                    'marca' => $request->marca,
                    'modelo' => $request->modelo,
                    'tipo_combustible' => $request->tipo_combustible,
                    'year' => $request->year,
                    'soat' => $request->soat,
                    'placa' => $request->placa,
                    'seguro_obligatorio' => $request->tecnomecanica,
                    'color' => $request->color,
                    'seguro_riesgos' => $request->seguro,
                    'tipo' => $request->tipo,
                    'observaciones' => $request->observaciones
                ]);
            }
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Vehículo modificado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al modificar el vehiculo.']);
            return $ex->getMessage();
        }
    }

    public function vehiculos_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::table("vehiculos")->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['info' => 1, 'success' => 'Vehículo eliminado correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar el vehiculo.']);
            return $ex->getMessage();
        }
    }

    public function checklist_email()
    {
        try {
            if (!auth()->user()->hasPermissionTo('enviar_checklist_vehiculos')) {
                return redirect()->route('home');
            }

            $vehiculos = DB::table("vehiculos")->where('estado', 1)->get();
            return view('admin.vehiculos.checklist_email', compact('vehiculos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function data_salud_vehiculos(Request $request)
    {
        try {
            $data = DB::table("salud")
                ->select('salud.*', 'empleados.nombre as creador')
                ->join('empleados', 'salud.id_empleado', '=', 'empleados.id')
                ->orderBy('salud.id', 'desc')
                ->get();
            return response()->json(['success' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['error' => 'Error al obtener los datos del vehiculo.']);
        }
    }

    public function show_encuesta_salud(Request $request)
    {
        try {
            $data = DB::table("salud")->where('id', $request->id)->first();
            return response()->json(['info' => 1, 'data' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['error' => 'Error al obtener los datos del vehiculo.']);
        }
    }

    public function add_encuesta_salud(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::table("salud")->insert([
                'id_empleado' => session('user'),
                'fecha' => date('Y-m-d'),
                'sede' => $request->sede,
                'dolor_garganta' => $request->uno,
                'malestar_general' => $request->dos,
                'fiebre' => $request->tres,
                'tos_seca' => $request->cuatro,
                'perdida_olfato' => $request->cinco,
                'contacto_covid19' => $request->seis,
                'res_diagnostico_covid19' => $request->siete,
                'res_servicio_salud' => $request->ocho,
                'res_65years' => $request->nueve,
                'res_enfermedades_cronicas' => $request->diez,
                'botas' => $request->once,
                'uniforme' => $request->doce,
                'declaracion' => $request->trece
            ]);
            DB::commit();

            $encuestas = DB::table("salud")
                ->select('salud.*', 'empleados.nombre as creador')
                ->join('empleados', 'salud.id_empleado', '=', 'empleados.id')
                ->orderBy('salud.id', 'desc')
                ->get();
            return response()->json(['info' => 1, 'encuestas' => $encuestas, 'success' => 'Encuesta de salud agregada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al agregar la encuesta de salud.']);
            return $ex->getMessage();
        }
    }

    public function delete_encuesta_salud(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::table("salud")->where('id', $request->id)->delete();
            DB::commit();

            $encuestas = DB::table("salud")
                ->select('salud.*', 'empleados.nombre as creador')
                ->join('empleados', 'salud.id_empleado', '=', 'empleados.id')
                ->orderBy('salud.id', 'desc')
                ->get();
            return response()->json(['info' => 1, 'encuestas' => $encuestas, 'success' => 'Encuesta de salud eliminada correctamente.']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => 'Error al eliminar la encuesta de salud.']);
            return $ex->getMessage();
        }
    }

    public function get_gruas(Request $request)
    {
        try {
            $vehiculo = $request->id;

            $data = DB::table("checklist")->where('id_vehiculo', $vehiculo)
                ->select('checklist.*', 'empleados.nombre as creador')
                ->join('empleados', 'checklist.id_usuario', '=', 'empleados.id')
                ->get();
            return response()->json(['gruas' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['error' => 'Error al obtener los datos del vehiculo.']);
        }
    }

    public function get_tecnicos_vehiculos(Request $request)
    {
        try {
            $vehiculo = $request->id;

            $data = DB::table("checklist2")->where('id_vehiculo', $vehiculo)
                ->select('checklist2.*', 'empleados.nombre as creador')
                ->join('empleados', 'checklist2.id_usuario', '=', 'empleados.id')
                ->get();
            return response()->json(['gruas' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['error' => 'Error al obtener los datos del vehiculo.']);
        }
    }

    public function get_inspecciones_vehiculos(Request $request)
    {
        try {
            $vehiculo = $request->id;

            $data = DB::table("inspeccion")->where('id_vehiculo', $vehiculo)
                ->select('inspeccion.*', 'empleados.nombre as creador')
                ->join('empleados', 'inspeccion.id_usuario', '=', 'empleados.id')
                ->get();
            return response()->json(['gruas' => $data]);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['error' => 'Error al obtener los datos del vehiculo.']);
        }
    }

    public function delete_encuesta_grua(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::table("checklist")->where('id', $request->id)->delete();
            DB::commit();

            $data = DB::table("checklist")->where('id_vehiculo', $request->id_vehiculo)
                ->select('checklist.*', 'empleados.nombre as creador')
                ->join('empleados', 'checklist.id_usuario', '=', 'empleados.id')
                ->get();
            return response()->json(['info' => 1, 'gruas' => $data, 'success' => 'Checklist eliminado correctamente.']);
        } catch (Exception $ex) {
        }
    }

    public function delete_encuesta_tecnico(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::table("checklist2")->where('id', $request->id)->delete();
            DB::commit();

            $data = DB::table("checklist2")->where('id_vehiculo', $request->id_vehiculo)
                ->select('checklist2.*', 'empleados.nombre as creador')
                ->join('empleados', 'checklist2.id_usuario', '=', 'empleados.id')
                ->get();
            return response()->json(['info' => 1, 'gruas' => $data, 'success' => 'Checklist eliminado correctamente.']);
        } catch (Exception $ex) {
        }
    }

    public function delete_encuesta_inspeccion(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::table("inspeccion")->where('id', $request->id)->delete();
            DB::commit();

            $data = DB::table("inspeccion")->where('id_vehiculo', $request->id_vehiculo)
                ->select('inspeccion.*', 'empleados.nombre as creador')
                ->join('empleados', 'inspeccion.id_usuario', '=', 'empleados.id')
                ->get();
            return response()->json(['info' => 1, 'gruas' => $data, 'success' => 'Inspeccion eliminada correctamente.']);
        } catch (Exception $ex) {
        }
    }
}
