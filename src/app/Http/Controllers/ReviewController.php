<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewStoreRequest;

class ReviewController extends Controller
{
    // レビュー画面表示
    public function create(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);
        $favorites = $this->getFavorites();
        $reviews = $this->getReviews();
        $review=Review::find($request->review_id);
        $reviewsArray = collect($reviews)->toArray();
        return view('review', compact('user', 'shop', 'favorites', 'reviews', 'review', 'reviewsArray'));
    }

    // レビュー処理
    public function store(ReviewStoreRequest $request, $shop_id)
    {
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->shop_id = $shop_id;
        $review->star = $request->input('star');
        $review->comment = $request->input('comment');
        $review->save();
        return redirect()->route('review.create', ['shop_id' => $shop_id]);
    }

    // お気に入り情報
    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }

    // レビュー情報
    private function getReviews(): array
    {
        if (Auth::check()) {
            return Auth::user()->reviews()->pluck('shop_id')->toArray();
        }
        return [];
    }

    // 削除
    public function delete($review_id)
    {
        Review::find($review_id)->delete();
        return redirect()->back()->with('success','口コミを削除しました');
    }
}