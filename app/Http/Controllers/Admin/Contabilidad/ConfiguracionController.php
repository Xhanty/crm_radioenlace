<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

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
}
