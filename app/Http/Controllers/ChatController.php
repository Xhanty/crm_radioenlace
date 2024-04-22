<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $usuarios = DB::table('empleados')->where('status', 1)->get();

        return view('chat.chat', compact('usuarios'));
    }
}
