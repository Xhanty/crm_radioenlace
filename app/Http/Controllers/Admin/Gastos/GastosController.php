<?php

namespace App\Http\Controllers\Admin\Gastos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GastosController extends Controller
{
    public function gastos_varios()
    {
        try {
            return view('admin.gastos.gastos_varios');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gastos_fijos()
    {
        try {
            return view('admin.gastos.gastos_fijos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }

    public function gastos_equivalentes()
    {
        try {
            return view('admin.gastos.gastos_equivalentes');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
