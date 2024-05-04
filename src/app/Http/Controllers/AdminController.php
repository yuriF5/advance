<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;

class AdminController extends Controller
{

    
    public function register(Request $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->back()->with('error', '会員登録に失敗しました。');
        }
    }

}
