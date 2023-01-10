<?php

namespace App\Http\Controllers\Admin\Inventario;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudInventarioController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_solicitudes')) {
                return redirect()->route('home');
            }

            return view('admin.inventario.solicitud_inventario');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
