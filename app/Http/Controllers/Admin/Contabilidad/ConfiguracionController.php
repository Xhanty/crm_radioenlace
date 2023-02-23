<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracionController extends Controller
{
    public function index()
    {
        try {
            $tipos_empresas = DB::table('tipos_empresas')->where("status", 1)->get();
            $tipos_documentos = DB::table('tipos_documentos')->where("status", 1)->get();
            $tipos_regimenes = DB::table('tipos_regimenes')->where("status", 1)->get();
            $actividades_economicas = DB::table('actividades_economicas')->where("status", 1)->get();
            $departamentos = DB::table('departamentos')->where("status", 1)->get();
            $ciudades = DB::table('ciudades')
                ->select('ciudades.*', 'departamentos.nombre as departamento')
                ->join('departamentos', 'departamentos.id', '=', 'ciudades.departamento_id')
                ->where("ciudades.status", 1)
                ->get();
            return view('admin.contabilidad.configuracion', compact(
                'departamentos',
                'tipos_empresas',
                'tipos_regimenes',
                'tipos_documentos',
                'actividades_economicas',
                'ciudades'
            ));
        } catch (Exception $ex) {
            return view('errors.500');
            return $ex->getMessage();
        }
    }

    public function getGruposPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->id;
            $data = DB::select('select * from pucs where parent_id = ? AND CHARACTER_LENGTH(code) = 2', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getCuentasPucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getCuentasPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from pucs where parent_id = ? AND CHARACTER_LENGTH(code) = 4 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getSubCuentasPucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getSubCuentasPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from pucs where parent_id = ? AND CHARACTER_LENGTH(code) = 6 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
            }
        }

        return $pucs;
    }

    public function pucs()
    {
        $pucs = DB::table('pucs')
            ->where('parent_id', null)
            ->get();

        if ($pucs->count() > 0) {
            $pucs = $pucs->toArray();
            $pucs = $this->getGruposPucs($pucs);
        }

        return response()->json([
            'data' => $pucs
        ]);
    }

    // TIPOS DE REGIMENES
    public function tipo_regimen_data()
    {
        $tipo_documentos = DB::table('tipos_regimenes')
            ->select('tipos_regimenes.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'tipos_regimenes.created_by')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_tipo_regimen(Request $request)
    {

        DB::table('tipos_regimenes')->insert([
            'code' => $request->code,
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    // TIPOS DE EMPRESAS
    public function tipo_empresa_data()
    {
        $tipo_documentos = DB::table('tipos_empresas')
            ->select('tipos_empresas.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'tipos_empresas.created_by')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_tipo_empresa(Request $request)
    {

        DB::table('tipos_empresas')->insert([
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    // TIPOS DE DOCUMENTOS
    public function tipo_documento_data()
    {
        $tipo_documentos = DB::table('tipos_documentos')
            ->select('tipos_documentos.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'tipos_documentos.created_by')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_tipo_documento(Request $request)
    {

        DB::table('tipos_documentos')->insert([
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    // ACTIVIDADES ECONOMICAS
    public function actividades_economicas_data()
    {
        $tipo_documentos = DB::table('actividades_economicas')
            ->select('actividades_economicas.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'actividades_economicas.created_by')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_actividad_economica(Request $request)
    {

        DB::table('actividades_economicas')->insert([
            'code' => $request->code,
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    //CIUDADES
    public function ciudades_data()
    {
        $tipo_documentos = DB::table('ciudades')
            ->select('ciudades.*', 'empleados.nombre as creador', 'departamentos.nombre as departamento')
            ->join('empleados', 'empleados.id', '=', 'ciudades.created_by')
            ->join('departamentos', 'departamentos.id', '=', 'ciudades.departamento_id')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_ciudad(Request $request)
    {

        DB::table('ciudades')->insert([
            'nombre' => $request->name,
            'departamento_id' => $request->departamento,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    // FORMAS DE PAGO
    public function formas_pago_data()
    {
        $tipo_documentos = DB::table('formas_pago')
            ->select('formas_pago.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'formas_pago.created_by')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_forma_pago(Request $request)
    {

        DB::table('formas_pago')->insert([
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }
}
