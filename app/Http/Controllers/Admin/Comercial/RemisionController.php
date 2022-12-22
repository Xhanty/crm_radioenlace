<?php

namespace App\Http\Controllers\Admin\Comercial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemisionController extends Controller
{
    public function index()
    {
        try {
            return view('admin.comercial.remisiones');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
