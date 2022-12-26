<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = User::where('id', auth()->user()->id)->first();
                if ($user && $user->id) {
                    session(['user' => $user->id]);
                    session(['user_img' => $user->avatar]);
                    return response()->json(['data' => 'success', 'user' => $user]);
                } else {
                    return response()->json(['data' => 'incorrect']);
                }
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
