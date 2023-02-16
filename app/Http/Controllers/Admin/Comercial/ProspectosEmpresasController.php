<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Exports\ProspectosEmpresaExcel;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProspectosEmpresasController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('gestionar_prospectos_empresas')) {
                return redirect()->route('home');
            }*/

            $prospectos = DB::table("prospectos_empresas")
                ->select('prospectos_empresas.*', 'paises.name as pais')
                ->join('paises', 'paises.id', '=', 'prospectos_empresas.pais_id')
                ->get();

            $paises = DB::table("paises")->get();

            return view('admin.comercial.prospectos_empresas', compact('prospectos', 'paises'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    public function data(Request $request)
    {
        try {
            $prospectos = DB::table("prospectos_empresas")->where('id', $request->id)->first();

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
                $file->move('images/prospectos_empresas/', $name);
            }


            DB::table("prospectos_empresas")->insert([
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

            $prospectos = DB::table("prospectos_empresas")->select('prospectos_empresas.*', 'paises.name as pais')
                ->join('paises', 'paises.id', '=', 'prospectos_empresas.pais_id')->get();

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
                $file->move('images/prospectos_empresas/', $name);

                DB::table("prospectos_empresas")->where('id', $request->id)->update([
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
                DB::table("prospectos_empresas")->where('id', $request->id)->update([
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

            $prospectos = DB::table("prospectos_empresas")->select('prospectos_empresas.*', 'paises.name as pais')
                ->join('paises', 'paises.id', '=', 'prospectos_empresas.pais_id')->get();

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

            $file = DB::table("prospectos_empresas")->where('id', $request->id)->first();

            if ($file->logo != null) {
                $file_path = 'images/prospectos_empresas/' . $file->logo;
                unlink($file_path);
            }

            DB::table("prospectos_empresas")->where('id', $request->id)->delete();

            DB::commit();

            $prospectos = DB::table("prospectos_empresas")->select('prospectos_empresas.*', 'paises.name as pais')
                ->join('paises', 'paises.id', '=', 'prospectos_empresas.pais_id')
                ->limit(100)->orderBy('id', 'desc')->get();

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
        return Excel::download(new ProspectosEmpresaExcel, 'prospectos_empresas.xlsx');
    }
}
