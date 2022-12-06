<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ProveedoresController extends Controller
{
    public function index()
    {
        try {
            $proveedores = DB::table('proveedores')->get();
            return view('admin.proveedores', compact('proveedores'));
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
