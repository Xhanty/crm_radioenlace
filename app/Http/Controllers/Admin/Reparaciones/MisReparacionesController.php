<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MisReparacionesController extends Controller
{
    public function index()
    {
        try {
            return view('admin.reparaciones.mis_reparaciones');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}