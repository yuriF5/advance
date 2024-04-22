<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
    return view('index');
    }

    public function thanks()
    {
        return view('auth.thanks');
    }

    public function register(Request $request)
    {
                // バリデーションを実行
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

        // 登録成功時の処理
        // 今回は単純にthanksページにリダイレクト
        return redirect()->route('thanks');
    }
    
    public function mypage(){
    return view('mypage');
    }

}