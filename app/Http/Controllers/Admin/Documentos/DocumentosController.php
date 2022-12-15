<?php

namespace App\Http\Controllers\Admin\Documentos;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function index()
    {
        try {
            return view('admin.documentos.documentos');
        } catch (Exception $ex) {
            return view('errors.500');
        }
    }
}
