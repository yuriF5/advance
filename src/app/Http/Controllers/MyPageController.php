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
    $shops = Shop::whereIn('id', $favorites)->with('genre', 'area')->get();

    return view('mypage', compact('reservations', 'favorites', 'shops'));
}


    public function updateFavorite(Request $request, $shopId)
    {
        $user = Auth::user();    
        $favoriteShopIds = $user->favorites()->pluck('shop_id')->toArray();
        $shops = Shop::whereIn('id', $favoriteShopIds)->get();
        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();
        return redirect()->back()->with('status', $message)->with('shops', $shops);
    }

    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->back();
    }
}

