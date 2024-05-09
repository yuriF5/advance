<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Admin;

class AdminController extends Controller
{
public function adminLogin(Request $request)
{
    $credentials = $request->validate([ 
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

if (!Admin::check()) {
    return redirect()->route('admin.login');
}

    return back()->withErrors([ 
        'error' => 'ログインに失敗しました。',
    ]);

}
public function userRegister(Request $request)
    {
        // バリデーションのルールを定義
        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
        'password' => 'required|string|min:8'
        ];

        // バリデーションのメッセージを定義
        $messages = [
            'name.required' => '店舗代表者名を入力してください。',
            'name.max' => '店舗代表者名は255文字以内で入力してください。',
            'email.required' => '店舗用メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレスの形式で入力してください。',
            'email.unique' => 'そのメールアドレスは既に登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは少なくとも8文字以上で入力してください。',
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules, $messages);

        // バリデーションが通った場合は、代表者を作成
        $shopRepresentative = Admin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // 成功メッセージなどの追加処理があればここに追加

        // 何かしらのレスポンスを返す
        return response()->json(['message' => '代表者が登録されました'], 200);
    }
}