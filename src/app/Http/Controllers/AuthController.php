<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function index()
    {
    return view('/');
    }

    public function login()
    {
    return view('/auth/login');
    }

    public function store()
    {
    return view('auth.register');
    }
    public function thanks()
    {
        return view('/auth/thanks');
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->back()->with('error', '会員登録に失敗しました。');
        }

        return view('/auth/thanks');
    }
    
    public function mypage(){
    return view('mypage');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/auth/login');
    }
}