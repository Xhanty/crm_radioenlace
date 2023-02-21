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
            return view('admin.contabilidad.configuracion');
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
}
