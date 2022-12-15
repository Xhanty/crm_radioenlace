<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlquileresController extends Controller
{
    public function index()
    {
        return view('admin.movimientoInv.alquileres');
    }
}
