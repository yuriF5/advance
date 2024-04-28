<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        $favorites = $user->favorites()->pluck('shop_id')->toArray();
        $histories = Reservation::where('user_id', $user->id)->get();
        $shops = $user->favorites()->pluck('shop_id')->toArray();

        return view('mypage', compact('reservations', 'favorites', 'histories', 'shops'));
    }

public function updateFavorite(Request $request, $shopId)
{
    $user = Auth::user();
    
    /// ユーザーのお気に入り店舗IDを取得
    $favoriteShopIds = $user->favorites()->pluck('shop_id')->toArray();

    // お気に入り店舗IDのみを持つ店舗を取得
    $shops = Shop::whereIn('id', $favoriteShopIds)->get();
    $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();

    if ($favorite) {
        $favorite->delete();
        $message = 'お気に入りから削除しました。';
    } else {
        Favorite::create([
            'user_id' => $user->id,
            'shop_id' => $shopId,
        ]);
        $message = 'お気に入りに追加しました。';
    }

    return redirect()->back()->with('status', $message)->with('shops', $shops);
}
    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->back()->with('id', '予約を削除しました。');
    }
}

