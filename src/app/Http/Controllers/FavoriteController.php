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

        public function toggleFavorite(Request $request)
    {
        $user = Auth::user();
        $shopId = $request->input('shop_id');
        
        // ユーザーのお気に入り情報を取得
        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();

        // お気に入りが存在する場合は削除し、存在しない場合は追加する
        if ($favorite) {
            $favorite->delete();
            $status = 0; // お気に入り解除
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shopId,
            ]);
            $status = 1; // お気に入り登録
        }

        // お気に入りステータスを返す
        return response()->json(['status' => $status]);
    }
}