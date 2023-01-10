<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformeContableController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('informes_contables')) {
                return redirect()->route('home');
            }

            return view('admin.contabilidad.informe_contable');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
