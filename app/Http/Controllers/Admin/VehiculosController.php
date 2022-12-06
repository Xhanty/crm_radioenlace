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
            return view('admin.vehiculos.vehiculos');
        } catch (Exception $ex) {
            return $ex->getMessage();
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
                    <a data-id="' . $row->id . '" title="Gestionar" class="edit btn btn-success btn-sm btn_Gestionar"><i class="fa fa-file"></i></a>
                    <a data-id="' . $row->id . '" title="Encuesta de salud" class="edit btn btn-success btn-sm btn_Encuesta"><i class="fa fa-plus"></i></a>
                    <a data-id="' . $row->id . '" title="Eliminar" class="delete btn btn-danger btn-sm btn_Delete"><i class="fa fa-trash"></i></a>';
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
            $image->move(public_path('images/vehiculos'), $new_name);

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
                $image->move(public_path('images/vehiculos'), $new_name);

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
            $vehiculos = DB::table("vehiculos")->where('estado', 1)->get();
            return view('admin.vehiculos.checklist_email', compact('vehiculos'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
