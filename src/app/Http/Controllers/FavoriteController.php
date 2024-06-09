<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // お気に入り登録
    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();
        return back();
    }

    // お気に入り削除
    public function destroy(Shop $shop)
    {
        Auth::user()->favorites()->where('shop_id',$shop->id)->delete();
        return back();
    }
}