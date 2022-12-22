<?php

namespace App\Http\Controllers\Admin\Reparaciones;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReparacionesController extends Controller
{
    public function index()
    {
        try {
            return view('admin.reparaciones.reparaciones');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
