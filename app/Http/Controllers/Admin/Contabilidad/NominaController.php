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
            return view('admin.contabilidad.nomina');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function config_nomina()
    {
        try {
            return view('admin.contabilidad.config_nomina');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
