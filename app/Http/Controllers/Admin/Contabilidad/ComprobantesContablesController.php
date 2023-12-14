<?php

namespace App\Http\Controllers\Admin\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprobantesContablesController extends Controller
{
    public function index()
    {
        $empleados = DB::table('empleados')
            ->select('id', 'nombre')
            ->where('status', 1)
            ->get();

        return view('admin.contabilidad.comprobantes_contables', compact('empleados'));
    }
}
