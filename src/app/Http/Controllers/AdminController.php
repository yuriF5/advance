<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function board()
    {
        return view('admin.board');
    }

    public function create()
    {
        return view('admin.create');
    }
    public function do()
    {
        return view('admin.do');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = intval($request->role); // 入力を整数に変換
        $user->save();

        if (!$user) {
            return redirect()->back()->with('error', '登録に失敗しました。');
        }

        return redirect('/admin/do');

    }

}