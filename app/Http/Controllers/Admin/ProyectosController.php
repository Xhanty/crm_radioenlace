<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public function index()
    {
        try {
            return view('admin.proyectos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
