<?php

namespace App\Http\Controllers\Admin\Viaticos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracionController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('configuracion_viaticos')) {
                return redirect()->route('home');
            }*/

            $valores = DB::table('configuracion_viaticos')->get();

            return view('admin.viaticos.configuracion', compact('valores'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::table('configuracion_viaticos')->where('id', $request->id)->update([
                'valor' => $request->valor,
            ]);
            return response()->json(['info' => 1, 'success' => 'Valor actualizado correctamente']);
        } catch (Exception $ex) {
            return $ex->getMessage();
            return response()->json(['info' => 0, 'error' => 'Error al actualizar el valor']);
        }
    }
}
