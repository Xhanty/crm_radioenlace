<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionHumanaController extends Controller
{
    public function index()
    {
        return view('admin.gestion_humana.index');
    }
}
