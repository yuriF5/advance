<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use App\Models\Reservation;
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

    public function index(Request $request)
{
    $userSearch = $request->input('user_search');
    $shopSearch = $request->input('shop_search');
    
    // 検索結果を取得
    $query = Reservation::query();
    
    if ($userSearch) {
        $query->whereHas('user', function ($query) use ($userSearch) {
            $query->where('name', 'like', "%$userSearch%");
        });
    }

    if ($shopSearch) {
        $query->whereHas('shop', function ($query) use ($shopSearch) {
            $query->where('name', 'like', "%$shopSearch%");
        });
    }

    $reservations = $query->get();

    // ユーザー名と店舗名を取得
    foreach ($reservations as $reservation) {
        $user = $reservation->user;
        $reservation->user_name = $user ? $user->name : 'Unknown';

        $shop = $reservation->shop;
        $reservation->shop_name = $shop ? $shop->name : 'Unknown';
    }

    return view('admin.reservation', compact('reservations'));
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