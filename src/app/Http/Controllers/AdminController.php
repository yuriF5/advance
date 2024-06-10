<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use App\Models\Reservation;
use App\Models\ShopRepresentative;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminRequest;


class AdminController extends Controller
{
    // 店舗代表者登録画面表示
    public function board()
    {
        $shops = Shop::all();
        $users=User::all();
        return view('admin.board', compact('shops','users'));
    }

    // 新店舗表示 登録処理はShopControllerへ
    public function create()
    {
        return view('admin.create');
    }

    // 代表者登録完了画面
    public function do()
    {
        return view('admin.do');
    }

    // 予約一覧と検索画面表示
    public function index(Request $request)
    {
        $shops=Shop::all();
        $users=User::all();
        $userSearch = $request->input('user_search');
        
        // 検索結果を取得
        $query = Reservation::query();
        
        if ($userSearch) {
            $query->whereHas('user', function ($query) use ($userSearch) {
                $query->where('name', 'like', "%$userSearch%");
            });
        }
        $reservations = $query->where('shop_id', 1)->get();

        // ユーザー名と店舗名を取得
        foreach ($reservations as $reservation) {
            $user = $reservation->user;
            $reservation->user_name = $user ? $user->name : 'Unknown';
            $shop = $reservation->shop->id;
        }

        return view('admin.reservation', compact('reservations','shops','users'));

    }

    // 管理者登録処理
    public function register(Request $request)
    {
        $representative = new ShopRepresentative();
        $representative->shop_id = $request->shop_id;
        $representative->user_id = $request->user_id;
        $representative->save();

        $user = User::findOrFail($request->user_id);
        $user->role = $request->role=1;
        $user->save();

        return view('admin.do');
    }
}