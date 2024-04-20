<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentacionContableController extends Controller
{
    public function index()
    {
        /*if (!auth()->user()->hasPermissionTo('contabilidad_factura_venta')) {
            return redirect()->route('home');
        }*/

        $empleados = DB::table('empleados')
            ->select('id', 'nombre')
            ->where('status', 1)
            ->get();

        $documentos = DB::table('documentos_contabilidad')
            ->join('empleados', 'documentos_contabilidad.created_by', '=', 'empleados.id')
            ->select('documentos_contabilidad.*', 'empleados.nombre AS empleado')
            ->get();

        $clientes = DB::table('cliente')
            ->select('id', 'razon_social', 'nit')
            ->where('estado', 1)
            ->get();

        return view('admin.contabilidad.documentacion', compact('empleados', 'documentos', 'clientes'));
    }

    public function add(Request $request)
    {
        $tipo = $request->tipo_add;
        $fecha = $request->fecha_add;
        $observacion = $request->observaciones_add;
        $archivos_name = [];
        $last_numero = DB::table('documentos_contabilidad')->orderBy('id', 'desc')->first();

        if ($last_numero) {
            $last_numero = $last_numero->numero + 1;
        } else {
            $last_numero = 0;
        }

        if ($request->hasFile('archivos_add')) {
            $archivos = $request->file('archivos_add');

            if (!is_array($archivos)) {
                $archivos = [$archivos];
            }

            foreach ($archivos as $archivo) {
                $nombre = time() . '_' . $archivo->getClientOriginalName();
                $archivo->move('images/contabilidad/documentos_contabilidad', $nombre);
                $archivos_name[] = $nombre;
            }
        }

        DB::table('documentos_contabilidad')->insert([
            'numero' => $last_numero,
            'tipo' => $tipo,
            'fecha' => $fecha,
            'descripcion' => $observacion,
            'archivos' => $archivos_name ? json_encode($archivos_name) : null,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('documentacion_contabilidad');
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        DB::table('documentos_contabilidad')->where('id', $id)->delete();

        return response()->json(['info' => 1]);
    }
}
