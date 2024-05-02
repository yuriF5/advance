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