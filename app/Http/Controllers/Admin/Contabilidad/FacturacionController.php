<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturacionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_facturacion')) {
                return redirect()->route('home');
            }

            return view('admin.contabilidad.facturacion');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
