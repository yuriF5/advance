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

    if (Auth::guard('admin')->attempt($credentials)) { 
        if (Auth::guard('admin')->user()->role > 0) { 
            $request->session()->regenerate(); 
            return redirect()->intended('admin/dashboard');  
            Auth::guard('admin')->logout(); 
            $request->session()->regenerate(); 
            return redirect()->route('reservation.admin.index')->withErrors([
                'error' => '提供された資格情報は、当社の記録と一致しません。',
            ]);
        }
    }

    return back()->withErrors([ 
        'error' => 'ログインに失敗しました。',
    ]);
}
}