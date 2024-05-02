<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($shop_id)
    {
        $userId = Auth::id();

        $review = Review::where('user_id', $userId)->where('shop_id', $shop_id)->first();
        $shop = Shop::where('id', $shop_id)->first();
        $favorites = Auth::user()->favorites()->pluck('shop_id')->toArray();

        return view('review', compact('review', 'shop', 'favorites'));
    }

    public function store(Request $request)
    {
        // バリデーションなどの処理を追加
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // レビューモデルを作成して保存
        $review = new Review();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        // リダイレクトして投稿完了画面へ移動
        return redirect()->route('thanks_review');
    }

    public function thanks()
    {
        
        return view('thanks_review');
    }
}