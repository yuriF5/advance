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
        $this->updateShopRatings();
        $shops = $this->searchShops($request);
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = $this->getFavorites();

        return view('index', compact('shops', 'areas', 'genres', 'favorites'));
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
}
