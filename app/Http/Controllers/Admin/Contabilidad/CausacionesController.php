<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CausacionesController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_causaciones')) {
                return redirect()->route('home');
            }

            return view('admin.contabilidad.causaciones');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
