<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
        try {
            $email = $request->email;
            $password = $request->password;

            $user = User::where('email', $email)->where('clave', sha1($password))->first();

            if($user && $user->id) {
                session(['user' => $user->id]);
                return response()->json(['data' => 'success', 'user' => $user]);
            } else {
                return response()->json(['data' => 'incorrect']);
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function logout()
    {
        session()->forget('user');
        return true;
    }
}
