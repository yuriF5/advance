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
public function create(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);
        $favorites = $this->getFavorites();

        
        
        return view('review', compact('user', 'shop','favorites'));
    

}
    public function store(ReviewRequest $request, $shop_id)
    {
        $userId = Auth::id();
        $review = Review::where('user_id', $userId)->where('shop_id', $shop_id)->first();

        

        return view('reviews.thanks', compact('shop_id'));
    }


    public function thanks()
    {
        
        return view('thanks_review');
    }
private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }
    
}