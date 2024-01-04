<?php

namespace App\Http\Controllers\Iso;

use App\Exports\PqrsExport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PqrController extends Controller
{
    public function index()
    {
        $pqrs = DB::table('pqr')
            ->select('pqr.*', 'cliente.razon_social as cliente', 'cliente.nit', 'empleados.nombre as empleado')
            ->join('cliente', 'cliente.id', '=', 'pqr.empresa')
            ->join('empleados', 'empleados.id', '=', 'pqr.created_by')
            ->get();

        $clientes = DB::table('cliente')->where('estado', 1)->get();

        return view('iso.pqr', compact('clientes', 'pqrs'));
    }

    public function generar_codigo()
    {
        $codigo = rand(100000, 999999);
        return "PQ" . $codigo;
    }

    public function data(Request $request)
    {
        $pqr = DB::table('pqr')
            ->where('id', $request->id)
            ->first();

        return response()->json(['info' => 1, 'data' => $pqr]);
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $mes = $request->mes;
            $medio = $request->medio;
            $empresa = $request->empresa;
            $queja = $request->queja;
            $codigo = $this->generar_codigo();

            DB::table("pqr")->insertGetId([
                'codigo' => $codigo,
                'mes' => $mes,
                'medio_comunicacion' => $medio,
                'empresa' => $empresa,
                'queja' => $queja,
                'status' => 0,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr creado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $mes = $request->mes;
            $medio = $request->medio;
            $empresa = $request->empresa;
            $queja = $request->queja;

            DB::table('pqr')
                ->where('id', $id)
                ->update([
                    'mes' => $mes,
                    'medio_comunicacion' => $medio,
                    'empresa' => $empresa,
                    'queja' => $queja,
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr actualizado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function tratamiento_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $tratamiento = $request->tratamiento;

            DB::table('pqr')
                ->where('id', $id)
                ->update([
                    'tratamiento' => $tratamiento,
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr actualizado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function evidencia_update(Request $request)
    {

        try {
            DB::beginTransaction();
            $id = $request->id;
            $evidecia = $request->evidencia;
            $adjunto = null;

            if ($request->hasFile('adjunto')) {
                $file = $request->file('adjunto');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/pqrs/', $name);
                $adjunto = $name;
            }

            DB::table('pqr')
                ->where('id', $id)
                ->update([
                    'evidencia' => $evidecia,
                    'adjunto_evidencia' => $adjunto
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr actualizado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function seguimiento_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $seguimiento = $request->seguimiento;

            DB::table('pqr')
                ->where('id', $id)
                ->update([
                    'seguimiento' => $seguimiento,
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr actualizado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function correcion_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $correcion = $request->correcion;

            DB::table('pqr')
                ->where('id', $id)
                ->update([
                    'correcion' => $correcion,
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr actualizado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function status_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $status = $request->status;

            DB::table('pqr')
                ->where('id', $id)
                ->update([
                    'status' => $status,
                ]);

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr actualizado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;

            DB::table('pqr')
                ->where('id', $id)
                ->delete();

            DB::commit();
            return response()->json(['info' => 1, 'mensaje' => 'Pqr eliminado correctamente']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['info' => 0, 'error' => $ex->getMessage()]);
        }
    }

    public function excel()
    {
        // Generar excel con las reparaciones finalizadas
        $pqrs = DB::table('pqr')
            ->select('pqr.*', 'cliente.razon_social as cliente', 'cliente.nit', 'empleados.nombre as empleado')
            ->join('cliente', 'cliente.id', '=', 'pqr.empresa')
            ->join('empleados', 'empleados.id', '=', 'pqr.created_by')
            ->get();;

        return Excel::download(new PqrsExport($pqrs), 'PQRS.xlsx');
    }
}
