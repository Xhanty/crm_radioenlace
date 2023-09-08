<?php

namespace App\Http\Controllers\Admin\Viaticos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitasController extends Controller
{
    public function index()
    {
        try {
            /*if (!auth()->user()->hasPermissionTo('visitas_viaticos')) {
                return redirect()->route('home');
            }*/
            $clientes = DB::table('cliente')->where('estado', 1)->get();
            $empleados = DB::table('empleados')->where('status', 1)->orderBy("nombre")->get();
            $vehiculos = DB::table('vehiculos')->where('estado', 1)->orderBy("placa")->get();

            $visitas_pendientes = DB::table('visitas_viaticos')
                ->select('visitas_viaticos.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'visitas_viaticos.empleado_id')
                ->where('visitas_viaticos.status', 0)
                ->get();

            $visitas_completadas = DB::table('visitas_viaticos')
                ->select('visitas_viaticos.*', 'cliente.razon_social', 'cliente.nit', 'empleados.nombre as encargado')
                ->join('cliente', 'cliente.id', '=', 'visitas_viaticos.cliente_id')
                ->join('empleados', 'empleados.id', '=', 'visitas_viaticos.empleado_id')
                ->where('visitas_viaticos.status', 1)
                ->get();

            return view('admin.viaticos.visitas', compact('visitas_pendientes', 'visitas_completadas', 'clientes', 'empleados', 'vehiculos'));
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function generateConsecutive()
    {
        // Traer el ultimo consecutivo de la tabla 'visitas_viaticos' y sumarle 1
        $lastConsecutive = DB::table('visitas_viaticos')->max('consecutivo') + 1;

        // Devolver el consecutivo
        return $lastConsecutive;
    }

    public function data(Request $request)
    {
        $visita = DB::table('visitas_viaticos')
            ->where('id', $request->input('id'))
            ->first();

        $visita->vehiculos = json_decode($visita->vehiculos);
        $visita->tecnicos = json_decode($visita->tecnicos);

        return response()->json(['data' => $visita]);
    }

    public function add(Request $request)
    {
        // Serializar los arrays en cadenas JSON
        $vehiculos = json_encode($request->input('vehiculos'));
        $tecnicos = json_encode($request->input('tecnicos'));

        // Insertar los datos en la tabla 'visitas' utilizando DB
        $visitaId = DB::table('visitas_viaticos')->insertGetId([
            'consecutivo' => $this->generateConsecutive(),
            'cliente_id' => $request->input('cliente'),
            'empleado_id' => $request->input('responsable'),
            'motivo' => $request->input('motivo'),
            'destino' => $request->input('destino'),
            'vehiculos' => $vehiculos, // Almacena la cadena JSON serializada
            'tecnicos' => $tecnicos,   // Almacena la cadena JSON serializada
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_salida' => $request->input('salida'),
            'fecha_llegada' => $request->input('llegada'),
            'observaciones' => $request->input('observaciones'),
            'status' => 0,
            'created_by' => auth()->user()->id
        ]);

        // Devolver una respuesta de éxito
        return response()->json(['info' => 1]);
    }

    public function edit(Request $request)
    {
        // Serializar los arrays en cadenas JSON
        $vehiculos = json_encode($request->input('vehiculos'));
        $tecnicos = json_encode($request->input('tecnicos'));

        // Actualizar los datos en la tabla 'visitas' utilizando DB
        DB::table('visitas_viaticos')
            ->where('id', $request->input('id'))
            ->update([
                'cliente_id' => $request->input('cliente'),
                'empleado_id' => $request->input('responsable'),
                'motivo' => $request->input('motivo'),
                'destino' => $request->input('destino'),
                'vehiculos' => $vehiculos, // Almacena la cadena JSON serializada
                'tecnicos' => $tecnicos,   // Almacena la cadena JSON serializada
                'fecha_salida' => $request->input('salida'),
                'fecha_llegada' => $request->input('llegada'),
                'observaciones' => $request->input('observaciones'),
            ]);

        // Devolver una respuesta de éxito
        return response()->json(['info' => 1]);
    }

    public function completar(Request $request)
    {
        // Actualizar los datos en la tabla 'visitas' utilizando DB
        DB::table('visitas_viaticos')
            ->where('id', $request->input('id'))
            ->update([
                'status' => 1,
            ]);

        // Devolver una respuesta de éxito
        return response()->json(['info' => 1]);
    }

    public function delete(Request $request)
    {
        // Actualizar los datos en la tabla 'visitas' utilizando DB
        DB::table('visitas_viaticos')
            ->where('id', $request->input('id'))
            ->update([
                'status' => 2,
            ]);

        // Devolver una respuesta de éxito
        return response()->json(['info' => 1]);
    }
}
