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
    $shops = Shop::query();

    if ($request->filled('area')) {
        $shops->where('area_id', $request->input('area'));
    }

    if ($request->filled('genre')) {
        $shops->where('genre_id', $request->input('genre'));
    }

    if ($request->filled('word')) {
        $shops->where('name', 'like', '%'.$request->input('word').'%');
    }

    $shops = $shops->get();

    $areas = Area::all();
    $genres = Genre::all();

    return view('index', compact('shops', 'areas', 'genres'));
    }

    public function search(Request $request)
    {
        
        $shops = $this->searchShops($request);
        $favorites = $this->getFavorites();
        $LogIn = Auth::check();

        return response()->json([
            'shops' => $shops,
            'favorites' => $favorites,
        ]);
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

    $shops = $query->get();

    return $shops;
}
}
