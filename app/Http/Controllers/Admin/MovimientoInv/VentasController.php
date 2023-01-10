<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_ventas')) {
                return redirect()->route('home');
            }

            return view('admin.movimientoInv.ventas');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
