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
    // ログインリクエスト
    public function index(LoginRequest $request)
    {   
        $user = Auth::user()->name;
        $email = $request->input('email');
        $password = $request->input('password');
        return view('/');
    }

    // ログイン画面表示
    public function login()
    {
        return view('/auth/login');
    }

    // 登録画面表示
    public function store()
    {
        return view('auth.register');
    }

    // 登録完了表示
    public function thanks()
    {
        return view('/auth/thanks');
    }

    // 登録リクエスト
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
    
    // ログイン後マイページ表示
    public function mypage()
    {
        return view('mypage');
    }

    // ログアウト
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/auth/login');
    }
}