<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        try {
            $clientes = DB::table('cliente')->where("estado", 1)->get();
            return view('admin.clientes', compact('clientes'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function clientes_list()
    {
        try {
            $clientes = DB::table('cliente')->where("estado", 1)->get();
            return response()->json(["data" => $clientes]);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
