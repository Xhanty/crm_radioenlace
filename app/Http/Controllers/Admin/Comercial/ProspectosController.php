<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProspectosController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('gestionar_prospectos')) {
                return redirect()->route('home');
            }*/

            $prospectos = DB::table("prospectos")->select('prospectos.*', 'paises.name as pais')
            ->join('paises', 'paises.id', '=', 'prospectos.pais_id')
            ->limit(100)->orderBy('id', 'desc')->get();

            $paises = DB::table("paises")->get();

            return view('admin.comercial.prospectos', compact('prospectos', 'paises'));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
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

            $prospectos = DB::table("prospectos")->select('prospectos.*', 'paises.name as pais')
            ->join('paises', 'paises.id', '=', 'prospectos.pais_id')
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

            $prospectos = DB::table("prospectos")->select('prospectos.*', 'paises.name as pais')
            ->join('paises', 'paises.id', '=', 'prospectos.pais_id')
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

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $file = DB::table("prospectos")->where('id', $request->id)->first();

            if($file->logo != null) {
                $file_path = 'images/prospectos_personas/' . $file->logo;
                unlink($file_path);
            }
            

            DB::table("prospectos")->where('id', $request->id)->delete();

            DB::commit();

            $prospectos = DB::table("prospectos")->select('prospectos.*', 'paises.name as pais')
            ->join('paises', 'paises.id', '=', 'prospectos.pais_id')
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
}
