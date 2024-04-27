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
        // ログインユーザーのIDを取得
        $userId = $request->user()->id;

        // リクエストから店舗IDを取得
        $shopId = $request->input('shop_id');

        // お気に入りを検索
        $favorite = Favorite::where('user_id', $userId)
            ->where('shop_id', $shopId)
            ->first();

        // お気に入りが存在しない場合は新しく作成し、存在する場合は削除する
        if ($favorite) {
            $favorite->delete();
            $message = 'お気に入りから削除しました。';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'shop_id' => $shopId,
            ]);
            $message = 'お気に入りに追加しました。';
        }

        return redirect()->back()->with('status', $message);
    }

    public function updateFavorite(Request $request)
    {
        $userId = $request->input('user_id');
        $shopId = $request->input('shop_id');
        $favoriteStatus = $request->input('favorite_status');

        // お気に入りの状態をデータベースに保存
        Favorite::updateOrCreate(
            ['user_id' => $userId, 'shop_id' => $shopId],
            ['favorite_status' => $favoriteStatus]
        );

        return redirect()->back(); 
}
}