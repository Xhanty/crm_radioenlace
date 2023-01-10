<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestionar_cotizaciones')) {
                return redirect()->route('home');
            }

            return view('admin.comercial.cotizaciones');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
