<?php

namespace App\Http\Controllers\Admin\SeguimientoCliente;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        try {
            return view('admin.seguimiento_cliente.categorias');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
