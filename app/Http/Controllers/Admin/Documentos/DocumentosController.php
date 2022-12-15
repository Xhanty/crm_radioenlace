<?php

namespace App\Http\Controllers\Admin\Documentos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function index()
    {
        return view('admin.documentos.documentos');
    }
}
