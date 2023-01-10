<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NominaController extends Controller
{
    public function nomina()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_nomina_general')) {
                return redirect()->route('home');
            }

            return view('admin.contabilidad.nomina');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function config_nomina()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_config_nomina_general')) {
                return redirect()->route('home');
            }

            $data = DB::table('configuracion_nomina')->first();
            return view('admin.contabilidad.config_nomina', compact('data'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function update_config_nomina(Request $request)
    {
        try {
            DB::table("configuracion_nomina")->where("id", $request->id)->update([
                'porcentaje_salud' => $request->salud,
                'porcentaje_pension' => $request->pension,
                'monto_base_fte' => $request->monto,
            ]);

            return response()->json([
                'info' => 1,
                'message' => 'Configuración actualizada correctamente',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
                'message' => 'Error al actualizar la configuración',
            ], 200);
        }
    }
}
