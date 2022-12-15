<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class AlquileresController extends Controller
{
    public function index()
    {
        try {
            return view('admin.movimientoInv.alquileres');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
