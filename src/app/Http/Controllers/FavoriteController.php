<?php

namespace App\Http\Controllers;
use App\Models\Favorite;


use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->get(); // ユーザーのお気に入りを取得する
        return view('index', compact('favorites'));
    }

    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return back();
}
    public function destroy(Shop $shop)
    {
        Auth::user()->favorites()->where('shop_id',$shop->id)->delete();

        return back();
    }
}