<?php

namespace App\Http\Controllers\Admin\Gastos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArrendamientosController extends Controller
{
    public function index()
    {
        try {
            return view('admin.gastos.arrendamientos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}