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
}