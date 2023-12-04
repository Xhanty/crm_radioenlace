<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GastosFijosController extends Controller
{
    public function index()
    {
        return view('admin.reportes.gastos_fijos');
    }
}
