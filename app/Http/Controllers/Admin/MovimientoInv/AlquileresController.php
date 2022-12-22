<?php

namespace App\Http\Controllers\Admin\MovimientoInv;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
