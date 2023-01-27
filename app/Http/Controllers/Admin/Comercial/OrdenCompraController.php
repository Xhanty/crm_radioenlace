<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenCompraController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_orden_compra')) {
                return redirect()->route('home');
            }

            $ordenes_pendientes = [];

            $ordenes_completadas = [];

            return view('admin.comercial.orden_compra', compact('ordenes_pendientes', 'ordenes_completadas'));
        } catch (Exception $ex) {
            return $ex;
            return view('errors.500');
        }
    }
}
