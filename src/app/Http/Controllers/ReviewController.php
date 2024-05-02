<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewStoreRequest;

class ReviewController extends Controller
{
    public function thanks()
    {
        return view('rthanks');
    }
public function create(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);
        $favorites = $this->getFavorites();
        return view('review', compact('user', 'shop','favorites'));
    }

    public function store(ReviewStoreRequest $request, $shop_id)
    {
        $userId = Auth::id();
        $review = Review::where('user_id', $userId)->where('shop_id', $shop_id)->first();
        if ($review) {
        $review->update($data);
    } else {
        $data['user_id'] = $userId;
        $data['shop_id'] = $shop_id;
        Review::create($data);
    }
        return redirect()->route('rthanks');
    }

    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }
    public function delete($review_id)
    {
        Review::find($review_id)->delete();
        return redirect()->back()->with('success','口コミを削除しました');
    }
}