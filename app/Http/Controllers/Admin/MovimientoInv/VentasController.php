<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
    {
        try {
            return view('admin.movimientoInv.ventas');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
