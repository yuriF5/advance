<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
    return view('index');
    }

    public function thanks()
    {
        return view('auth.thanks');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // ユーザーを作成し、データベースに保存
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            // エラーメッセージをフラッシュデータに保存してリダイレクト
            return redirect()->back()->with('error', '会員登録に失敗しました。');
        }

        return redirect()->route('thanks');
    }
    
    public function mypage(){
    return view('mypage');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/login');
    }
}