<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViaticosController extends Controller
{
    public function index()
    {
        try {
            if (!auth()->user()->hasPermissionTo('gestion_viaticos')) {
                return redirect()->route('home');
            }

            return view('admin.contabilidad.viaticos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
