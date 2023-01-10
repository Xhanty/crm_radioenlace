<?php

namespace App\Http\Controllers\Admin\SeguimientoCliente;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_seguimientos')) {
                return redirect()->route('home');
            }

            return view('admin.seguimiento_cliente.seguimientos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
