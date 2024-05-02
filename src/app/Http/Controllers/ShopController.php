<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    public function index(Request $request)
{
        $shopsQuery = Shop::query();
    
    // 条件に従って絞り込む
    if ($request->filled('area')) {
        $shopsQuery->where('area_id', $request->input('area'));
    }
    
    if ($request->filled('genre')) {
        $shopsQuery->where('genre_id', $request->input('genre'));
    }
    
    if ($request->filled('word')) {
        $shopsQuery->where('name', 'like', '%'.$request->input('word').'%');
    }
    
    // $shops を取得
    $shops = $shopsQuery->get(['id', 'name', 'image_url', 'area_id', 'genre_id']);
    
    // 地域とジャンルの名前を取得し、$shops に追加する
    $areaNames = Area::pluck('name', 'id');
    $genreNames = Genre::pluck('name', 'id');
    
    $areas = Area::all();
    $genres = Genre::all();
    $user = Auth::user();
    $favorites = $this->getFavorites();
    
    return view('index', compact('shops', 'areaNames', 'genreNames', 'areas', 'genres','favorites'));

}

public function search(Request $request)
{
    $shops = $this->searchShops($request);
    $favorites = $this->getFavorites();
    $LogIn = Auth::check();
    $message = '';

    if ($shops->isEmpty()) {
        $message = 'No shops found.';
    }

    $areas = Area::all();
    $genres = Genre::all();


    return view('search_result', compact('message', 'shops', 'favorites', 'areas', 'genres'));

}

    private function searchShops(Request $request)
{
    $keyword = $request->input('keyword');
    $areaId = $request->input('area');
    $genreId = $request->input('genre');

    $query = Shop::query();

    if (!empty($keyword)) {
        $query->where('name', 'like', '%'.$keyword.'%');
    }

    if (!empty($areaId)) {
        $query->where('area_id', $areaId);
    }

    if (!empty($genreId)) {
        $query->where('genre_id', $genreId);
    }

    return $query->get();
}
    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }

public function detail(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);

        $backRoute = '/';
        
        return view('detail', compact('user', 'shop', 'backRoute'));
    }
    
}
