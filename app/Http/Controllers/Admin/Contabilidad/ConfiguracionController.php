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
            if (!auth()->user()->hasPermissionTo('contabilidad_config_administrativa') || !auth()->user()->hasPermissionTo('contabilidad_config_general')) {
                return redirect()->route('home');
            }

            $organizacion = DB::table('organizacion')->where('id', 1)->first();

            if (!$organizacion) {
                DB::table('organizacion')->insert([
                    'tipo_empresa' => null,
                ]);

                DB::table('datos_tributarios')->insert([
                    'actividad_economica' => null,
                ]);

                DB::table('representante_legal')->insert([
                    'tipo_documento' => null,
                ]);

                DB::table('contador')->insert([
                    'tipo_documento' => null,
                ]);

                DB::table('revisor_fiscal')->insert([
                    'tipo_documento' => null,
                ]);

                $organizacion = DB::table('organizacion')->where('id', 1)->first();
                $datos_tributarios = DB::table('datos_tributarios')->where('id', 1)->first();
                $representantes = DB::table('representante_legal')->where('id', 1)->first();
                $contador = DB::table('contador')->where('id', 1)->first();
                $revisor_fiscal = DB::table('revisor_fiscal')->where('id', 1)->first();
            } else {
                $datos_tributarios = DB::table('datos_tributarios')->where('id', 1)->first();
                $representantes = DB::table('representante_legal')->where('id', 1)->first();
                $contador = DB::table('contador')->where('id', 1)->first();
                $revisor_fiscal = DB::table('revisor_fiscal')->where('id', 1)->first();
            }

            $documentos_org = DB::table("anexos_organizacion")
                ->select('anexos_organizacion.*', 'empleados.nombre as creador')
                ->join('empleados', 'empleados.id', '=', 'anexos_organizacion.created_by')
                ->get();
            $tributos = DB::table('tributos_dian')->where("status", 1)->get();
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

            $cuentas_contables = DB::table('configuracion_puc')
                ->select('id', 'code', 'nombre')
                ->where('status', 1)
                ->where('forma_pago', 0)
                ->whereRaw('LENGTH(code) = 8')
                ->get();

            return view('admin.contabilidad.configuracion', compact(
                'departamentos',
                'tipos_empresas',
                'tipos_regimenes',
                'tipos_documentos',
                'actividades_economicas',
                'ciudades',
                'organizacion',
                'datos_tributarios',
                'representantes',
                'contador',
                'revisor_fiscal',
                'cuentas_contables',
                'tributos',
                'documentos_org'
            ));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }

    // PUC CATALOGO
    public function pucs()
    {
        $pucs = DB::table('pucs')
            ->where('parent_id', null)
            ->get();

        if (
            $pucs->count() > 0
        ) {
            $pucs = $pucs->toArray();
            $pucs = $this->getGruposPucs($pucs);
        }

        return response()->json([
            'data' => $pucs
        ]);
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

    // PUC CLIENTE
    public function pucs_cliente()
    {
        $pucs = DB::table('configuracion_puc')
            ->where('parent_id', null)
            ->where('status', 1)
            ->get();

        if ($pucs->count() > 0) {
            $pucs = $pucs->toArray();
            $pucs = $this->getGruposClientePucs($pucs);
        }

        return response()->json([
            'data' => $pucs
        ]);
    }

    public function pucs_all_clientes_data()
    {
        $pucs = DB::table('configuracion_puc')
            ->where('parent_id', null)
            ->get();

        if ($pucs->count() > 0) {
            $pucs = $pucs->toArray();
            $pucs = $this->getGruposClienteAllPucs($pucs);
        }

        return response()->json([
            'data' => $pucs
        ]);
    }

    public function getGruposClientePucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->id;
            $data = DB::select('select * from configuracion_puc where parent_id = ? AND status = 1 AND CHARACTER_LENGTH(code) = 2', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getCuentasClientePucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getCuentasClientePucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from configuracion_puc where parent_id = ? AND status = 1 AND CHARACTER_LENGTH(code) = 4 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getSubCuentasClientePucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getSubCuentasClientePucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from configuracion_puc where parent_id = ? AND status = 1 AND CHARACTER_LENGTH(code) = 6 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getAuxiliaresClientePucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getAuxiliaresClientePucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from configuracion_puc where parent_id = ? AND status = 1 AND CHARACTER_LENGTH(code) > 6 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
            }
        }

        return $pucs;
    }

    // TODOS LOS PUC CLIENTE
    public function getGruposClienteAllPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->id;
            $data = DB::select('select * from configuracion_puc where parent_id = ? AND CHARACTER_LENGTH(code) = 2', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getCuentasClienteAllPucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getCuentasClienteAllPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from configuracion_puc where parent_id = ? AND CHARACTER_LENGTH(code) = 4 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getSubCuentasClienteAllPucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getSubCuentasClienteAllPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from configuracion_puc where parent_id = ? AND CHARACTER_LENGTH(code) = 6 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
                $pucs[$key]->children = $this->getAuxiliaresClienteAllPucs($pucs[$key]->children);
            }
        }

        return $pucs;
    }

    public function getAuxiliaresClienteAllPucs($pucs)
    {
        foreach ($pucs as $key => $puc) {
            $id = $puc->parent_id;
            $sub_id = $puc->code;

            $data = DB::select('select * from configuracion_puc where parent_id = ? AND CHARACTER_LENGTH(code) > 6 AND code LIKE "' . $sub_id . '%"', [$id]);

            if ($data) {
                $pucs[$key]->children = $data;
            }
        }

        return $pucs;
    }

    public function deshabilitar_puc_cliente(Request $request)
    {
        $pucs_id = $request->pucs;

        $pucs = DB::table('configuracion_puc')
            ->whereIn('id', $pucs_id)
            ->update(['status' => 0]);

        $children = DB::table('configuracion_puc')
            ->whereIn('parent_id', $pucs_id)
            ->update(['status' => 0]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function habilitar_puc_cliente(Request $request)
    {
        $pucs_id = $request->pucs;

        $pucs = DB::table('configuracion_puc')
            ->whereIn('id', $pucs_id)
            ->update(['status' => 1]);

        $children = DB::table('configuracion_puc')
            ->whereIn('parent_id', $pucs_id)
            ->update(['status' => 1]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function add_child_puc_cliente(Request $request)
    {
        $code = $request->code_parent . $request->code_child;
        $nombre = $request->nombre;
        $id_parent = $request->id_parent;
        $id_child = $request->id_child;

        $valid_code = DB::table('configuracion_puc')->where('code', $code)->first();

        if ($valid_code) {
            return response()->json([
                'info' => 0,
                'mensaje' => 'El código ya existe',
            ]);
        }

        DB::table('configuracion_puc')->insert([
            'code' => $code,
            'code_child' => $request->code_child,
            'nombre' => $nombre,
            'parent_id' => $id_parent,
            'status' => 1,
            'auxiliar' => 1,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function edit_child_puc_cliente(Request $request)
    {
        $id = $request->id;
        $code = $request->code;
        $nombre = $request->nombre;

        $code_old = DB::table('configuracion_puc')->where('id', $id)->first()->code;
        $first_letter = substr($code_old, 0, 6);

        $code = $first_letter . $code;

        DB::table('configuracion_puc')->where('id', $id)->update([
            'code' => $code,
            'code_child' => $request->code,
            'nombre' => $nombre,
        ]);

        return response()->json([
            'info' => 1,
            'code' => $code,
        ]);
    }

    public function delete_child_puc_cliente(Request $request)
    {
        $id = $request->id;

        DB::table('configuracion_puc')->where('id', $id)->delete();

        return response()->json([
            'info' => 1,
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

    public function edit_tipo_regimen(Request $request)
    {

        DB::table('tipos_regimenes')->where('id', $request->id)->update([
            'code' => $request->code,
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_tipo_regimen(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('tipos_regimenes')->where('id', $request->id)->update([
            'status' => $status,
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

    public function edit_tipo_empresa(Request $request)
    {

        DB::table('tipos_empresas')->where('id', $request->id)->update([
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_tipo_empresa(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('tipos_empresas')->where('id', $request->id)->update([
            'status' => $status,
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

    public function edit_tipo_documento(Request $request)
    {

        DB::table('tipos_documentos')->where('id', $request->id)->update([
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_tipo_documento(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('tipos_documentos')->where('id', $request->id)->update([
            'status' => $status,
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

    public function edit_actividad_economica(Request $request)
    {

        DB::table('actividades_economicas')->where('id', $request->id)->update([
            'code' => $request->code,
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_actividad_economica(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('actividades_economicas')->where('id', $request->id)->update([
            'status' => $status,
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
            'codigo_postal' => $request->codigo_postal ? $request->codigo_postal : null,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function edit_ciudad(Request $request)
    {

        DB::table('ciudades')->where('id', $request->id)->update([
            'nombre' => $request->name,
            'departamento_id' => $request->departamento,
            'codigo_postal' => $request->codigo_postal ? $request->codigo_postal : null,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_ciudad(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('ciudades')->where('id', $request->id)->update([
            'status' => $status,
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

    public function edit_forma_pago(Request $request)
    {

        DB::table('formas_pago')->where('id', $request->id)->update([
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_forma_pago(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('formas_pago')->where('id', $request->id)->update([
            'status' => $status,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }


    // CENTROS DE COSTOS
    public function centros_costos_data()
    {
        $tipo_documentos = DB::table('centros_costo')
            ->select('centros_costo.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'centros_costo.created_by')
            ->orderByRaw("CAST(centros_costo.code AS SIGNED) ASC")
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_centros_costos(Request $request)
    {

        DB::table('centros_costo')->insert([
            'code' => $request->code,
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function edit_centros_costos(Request $request)
    {

        DB::table('centros_costo')->where('id', $request->id)->update([
            'code' => $request->code,
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_centros_costos(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('centros_costo')->where('id', $request->id)->update([
            'status' => $status,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    // TRIBUTOS
    public function tributos_dian_data()
    {
        $tipo_documentos = DB::table('tributos_dian')
            ->select('tributos_dian.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'tributos_dian.created_by')
            ->orderByRaw("CAST(tributos_dian.codigo AS SIGNED) ASC")
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $tipo_documentos
        ]);
    }

    public function add_tributos_dian(Request $request)
    {

        DB::table('tributos_dian')->insert([
            'codigo' => $request->code,
            'nombre' => $request->name,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function edit_tributos_dian(Request $request)
    {

        DB::table('tributos_dian')->where('id', $request->id)->update([
            'codigo' => $request->code,
            'nombre' => $request->name,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    public function status_tributos_dian(Request $request)
    {
        $status = $request->status;

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        DB::table('tributos_dian')->where('id', $request->id)->update([
            'status' => $status,
        ]);

        return response()->json([
            'info' => 1,
        ]);
    }

    // ORGANIZACION
    public function edit_organizacion(Request $request)
    {
        $avatar = null;
        $anexo = null;
        if ($request->tipo == 1) {
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/logo_organizacion/', $name);
                $avatar = $name;

                DB::table('organizacion')->where('id', 1)->update([
                    'tipo_empresa' => $request->tipo_empresa ? $request->tipo_empresa : null,
                    'organizacion' => $request->organizacion ? $request->organizacion : null,
                    'tipo_documento' => $request->tipo_documento ? $request->tipo_documento : null,
                    'documento' => $request->documento ? $request->documento : null,
                    'digito' => $request->digito ? $request->digito : null,
                    'ciudad' => $request->ciudad ? $request->ciudad : null,
                    'direccion' => $request->direccion ? $request->direccion : null,
                    'tipo_regimen' => $request->tipo_regimen ? $request->tipo_regimen : null,
                    'telefono' => $request->telefono ? $request->telefono : null,
                    'contacto' => $request->contacto ? $request->contacto : null,
                    'email_contacto' => $request->email_contacto ? $request->email_contacto : null,
                    'pagina_web' => $request->pagina_web ? $request->pagina_web : null,
                    'avatar' => $avatar,
                ]);
            } else {
                DB::table('organizacion')->where('id', 1)->update([
                    'tipo_empresa' => $request->tipo_empresa ? $request->tipo_empresa : null,
                    'organizacion' => $request->organizacion ? $request->organizacion : null,
                    'tipo_documento' => $request->tipo_documento ? $request->tipo_documento : null,
                    'documento' => $request->documento ? $request->documento : null,
                    'digito' => $request->digito ? $request->digito : null,
                    'ciudad' => $request->ciudad ? $request->ciudad : null,
                    'direccion' => $request->direccion ? $request->direccion : null,
                    'tipo_regimen' => $request->tipo_regimen ? $request->tipo_regimen : null,
                    'telefono' => $request->telefono ? $request->telefono : null,
                    'contacto' => $request->contacto ? $request->contacto : null,
                    'email_contacto' => $request->email_contacto ? $request->email_contacto : null,
                    'pagina_web' => $request->pagina_web ? $request->pagina_web : null,
                ]);

                $avatar = DB::table('organizacion')->where('id', 1)->first()->avatar;
            }
        } else if ($request->tipo == 2) {
            if ($request->hasFile('anexo_dian')) {
                $file = $request->file('anexo_dian');
                $name = time() . $file->getClientOriginalName();
                $file->move('images/anexos_organizacion/', $name);
                $anexo = $name;

                DB::table('datos_tributarios')->where('id', 1)->update([
                    'actividad_economica' => $request->actividades ? $request->actividades : null,
                    'ica' => $request->ica ? $request->ica : null,
                    'aiu' => $request->aiu ? $request->aiu : null,
                    'dos_impuestos' => $request->impuestos ? $request->impuestos : null,
                    'iva' => $request->iva ? $request->iva : null,
                    'valorem' => $request->valorem ? $request->valorem : null,
                    'responsabilidad_fiscal' => $request->responsabilidad_fiscal ? $request->responsabilidad_fiscal : null,
                    'tributos' => $request->tributos ? $request->tributos : null,
                    'anexo_dian' => $anexo ? $anexo : null,
                ]);
            } else {
                DB::table('datos_tributarios')->where('id', 1)->update([
                    'actividad_economica' => $request->actividades ? $request->actividades : null,
                    'ica' => $request->ica ? $request->ica : null,
                    'aiu' => $request->aiu ? $request->aiu : null,
                    'dos_impuestos' => $request->impuestos ? $request->impuestos : null,
                    'iva' => $request->iva ? $request->iva : null,
                    'valorem' => $request->valorem ? $request->valorem : null,
                    'responsabilidad_fiscal' => $request->responsabilidad_fiscal ? $request->responsabilidad_fiscal : null,
                    'tributos' => $request->tributos ? $request->tributos : null,
                ]);

                $anexo = DB::table('datos_tributarios')->where('id', 1)->first()->anexo_dian;
            }
        } else if ($request->tipo == 3) {
            DB::table('representante_legal')->where('id', 1)->update([
                'nombres' => $request->nombres ? $request->nombres : null,
                'apellidos' => $request->apellidos ? $request->apellidos : null,
                'tipo_documento' => $request->tipo_documento ? $request->tipo_documento : null,
                'documento' => $request->documento ? $request->documento : null,
            ]);
        } else if ($request->tipo == 4) {
            DB::table('representante_legal')->where('id', 1)->update([
                'nombres_suplente' => $request->nombres_suplente ? $request->nombres_suplente : null,
                'apellidos_suplente' => $request->apellidos_suplente ? $request->apellidos_suplente : null,
                'tipo_documento_suplente' => $request->tipo_documento_suplente ? $request->tipo_documento_suplente : null,
                'documento_suplente' => $request->documento_suplente ? $request->documento_suplente : null,
            ]);
        } else if ($request->tipo == 5) {
            DB::table('contador')->where('id', 1)->update([
                'nombres' => $request->nombres ? $request->nombres : null,
                'apellidos' => $request->apellidos ? $request->apellidos : null,
                'tipo_documento' => $request->tipo_documento ? $request->tipo_documento : null,
                'documento' => $request->documento ? $request->documento : null,
            ]);
        } else if ($request->tipo == 6) {
            DB::table('revisor_fiscal')->where('id', 1)->update([
                'nombres' => $request->nombres ? $request->nombres : null,
                'apellidos' => $request->apellidos ? $request->apellidos : null,
                'tipo_documento' => $request->tipo_documento ? $request->tipo_documento : null,
                'documento' => $request->documento ? $request->documento : null,
            ]);
        }

        return response()->json([
            'info' => 1,
            'avatar' => $avatar,
            'anexo' => $anexo,
        ]);
    }

    // ANEXOS ORGANIZACIÓN
    public function anexos_organizacion(Request $request)
    {
        $data = DB::table('anexos_organizacion')
            ->select('anexos_organizacion.*', 'empleados.nombre as creador')
            ->join('empleados', 'empleados.id', '=', 'anexos_organizacion.created_by')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $data
        ]);
    }

    public function add_anexo_organizacion(Request $request)
    {
        if ($request->hasFile('anexo')) {
            $file = $request->file('anexo');
            $name = time() . $file->getClientOriginalName();
            $file->move('images/anexos_organizacion/', $name);

            DB::table('anexos_organizacion')->insert([
                'documento' => $request->documento,
                'anexo' => $name,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                'info' => 1,
            ]);
        }
    }

    public function delete_anexo_organizacion(Request $request)
    {
        $archivo = DB::table('anexos_organizacion')->where('id', $request->id)->first()->anexo;

        unlink('images/anexos_organizacion/' . $archivo);

        DB::table('anexos_organizacion')->where('id', $request->id)->delete();

        return response()->json([
            'info' => 1,
        ]);
    }

    // PARAMETRIZACION
    public function get_cuentas_parametrizacion(Request $request)
    {
        $regimen = $request->regimen;
        $documento = $request->documento;
        $tipo_parametrizacion = $request->tipo_parametrizacion;

        $cuentas = DB::table('parametrizacion_documentos')
            ->select('parametrizacion_documentos.*', 'configuracion_puc.code', 'configuracion_puc.nombre', 'empleados.nombre as creador')
            ->where('tipo_regimen', $regimen)
            ->where('documento', $documento)
            ->where('tipo_parametrizacion', $tipo_parametrizacion)
            ->join('configuracion_puc', 'parametrizacion_documentos.cuenta', '=', 'configuracion_puc.id')
            ->join('empleados', 'parametrizacion_documentos.created_by', '=', 'empleados.id')
            ->orderBy('parametrizacion_documentos.id', 'desc')
            ->get();

        return response()->json([
            'info' => 1,
            'cuentas' => $cuentas,
        ]);
    }

    public function add_cuenta_parametrizacion(Request $request)
    {
        try {
            $documento = $request->documento;
            $tipo_parametrizacion = $request->tipo_parametrizacion;
            $tipo_regimen = $request->tipo_regimen;
            $cuenta = $request->cuenta;
            $naturaleza = $request->naturaleza;
            $status = 1;
            $created_by = auth()->user()->id;
            $created_at = date('Y-m-d');

            DB::table('parametrizacion_documentos')->insert([
                'documento' => $documento,
                'tipo_parametrizacion' => $tipo_parametrizacion,
                'tipo_regimen' => $tipo_regimen,
                'cuenta' => $cuenta,
                'naturaleza' => $naturaleza,
                'status' => $status,
                'created_by' => $created_by,
                'created_at' => $created_at,
            ]);

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            echo $ex;
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function update_status_cuenta_parametrizacion(Request $request)
    {
        try {
            $id = $request->id;
            $status = $request->status;

            DB::table('parametrizacion_documentos')->where('id', $id)->update([
                'status' => $status,
            ]);

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            echo $ex;
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    // IMPUESTOS
    public function get_impuestos(Request $request)
    {
        $impuestos = DB::table('configuracion_impuestos')
            ->select(
                'configuracion_impuestos.*',
                'compras.code as code_compras',
                'compras.nombre as nombre_compras',
                'ventas.code as code_ventas',
                'ventas.nombre as nombre_ventas',
                'devolucion_ventas.code as code_devolucion_ventas',
                'devolucion_ventas.nombre as nombre_devolucion_ventas',
                'devolucion_compras.code as code_devolucion_compras',
                'devolucion_compras.nombre as nombre_devolucion_compras'
            )
            ->join('configuracion_puc as compras', 'configuracion_impuestos.compras', '=', 'compras.id')
            ->join('configuracion_puc as ventas', 'configuracion_impuestos.ventas', '=', 'ventas.id')
            ->join('configuracion_puc as devolucion_ventas', 'configuracion_impuestos.devolucion_ventas', '=', 'devolucion_ventas.id')
            ->join('configuracion_puc as devolucion_compras', 'configuracion_impuestos.devolucion_compras', '=', 'devolucion_compras.id')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $impuestos,
        ]);
    }

    public function update_uso_impuesto(Request $request)
    {
        try {
            $id = $request->id;
            $uso = $request->uso;

            DB::table('configuracion_impuestos')->where('id', $id)->update([
                'en_uso' => $uso,
            ]);

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function add_impuesto(Request $request)
    {
        try {
            $codigo = $request->codigo;
            $nombre = $request->nombre;
            $tipo = $request->tipo_impuesto;
            $por_valor = $request->por_valor;
            $tarifa = $request->tarifa;
            $ventas = $request->ventas;
            $compras = $request->compras;
            $devolucion_ventas = $request->devolucion_ventas;
            $devolucion_compras = $request->devolucion_compras;

            DB::table('configuracion_impuestos')->insert([
                'codigo' => $codigo,
                'nombre' => $nombre,
                'tipo_impuesto' => $tipo,
                'por_valor' => $por_valor,
                'tarifa' => $tarifa,
                'ventas' => $ventas,
                'compras' => $compras,
                'devolucion_ventas' => $devolucion_ventas,
                'devolucion_compras' => $devolucion_compras,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function delete_impuesto(Request $request)
    {
        try {
            $id = $request->id;

            DB::table('configuracion_impuestos')->where('id', $id)->delete();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    // RETENCIONES
    public function get_retenciones(Request $request)
    {
        $retenciones = DB::table('configuracion_autoretencion')
            ->select('configuracion_autoretencion.*', 'debito.code as code_debito', 'debito.nombre as nombre_debito', 'credito.code as code_credito', 'credito.nombre as nombre_credito')
            ->join('configuracion_puc as debito', 'configuracion_autoretencion.cuenta_debito', '=', 'debito.id')
            ->join('configuracion_puc as credito', 'configuracion_autoretencion.cuenta_credito', '=', 'credito.id')
            ->get();

        return response()->json([
            'info' => 1,
            'data' => $retenciones,
        ]);
    }

    public function update_uso_retencion(Request $request)
    {
        try {
            $id = $request->id;
            $uso = $request->uso;

            DB::table('configuracion_autoretencion')->where('id', $id)->update([
                'en_uso' => $uso,
            ]);

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function add_retencion(Request $request)
    {
        try {
            $codigo = $request->codigo;
            $nombre = $request->nombre;
            $tipo_impuesto = $request->tipo_retencion;
            $tarifa = $request->tarifa;
            $cuenta_debito = $request->debito;
            $cuenta_credito = $request->credito;

            DB::table('configuracion_autoretencion')->insert([
                'codigo' => $codigo,
                'nombre' => $nombre,
                'tipo_impuesto' => $tipo_impuesto,
                'tarifa' => $tarifa,
                'cuenta_debito' => $cuenta_debito,
                'cuenta_credito' => $cuenta_credito,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
            ]);
        }
    }

    public function delete_retencion(Request $request)
    {
        try {
            $id = $request->id;

            DB::table('configuracion_autoretencion')->where('id', $id)->delete();

            return response()->json([
                'info' => 1,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'info' => 0,
            ]);
        }
    }
}
