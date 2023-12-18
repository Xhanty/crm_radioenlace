<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Exports\Contabilidad\ResultadoIntegral;
use App\Http\Controllers\Controller;
use App\Imports\ComprobantesContables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ComprobantesContablesController extends Controller
{
    public function index()
    {
        $empleados = DB::table('empleados')
            ->select('id', 'nombre')
            ->where('status', 1)
            ->get();

        $comprobantes = DB::table('comprobantes_carga')->get();

        return view('admin.contabilidad.comprobantes_contables', compact('empleados', 'comprobantes'));
    }

    public function add(Request $request)
    {
        try {
            // Importar archivo con laraexcel
            $file = $request->file('file');
            Excel::import(new ComprobantesContables, $file);

            return response()->json(['info' => 1]);
        } catch (Exception $ex) {
            return response()->json(['info' => 0]);
        }
    }

    public function reporte_resultado_integral()
    {
        return Excel::download(new ResultadoIntegral, 'ResultadoIntegral.xlsx');
    }
}
