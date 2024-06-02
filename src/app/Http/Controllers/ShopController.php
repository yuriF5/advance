<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReseFormRequest;
use App\Http\Requests\ShopUpdateRequest;
use Illuminate\Support\Facades\Storage;

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
// HOME検索機能
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
// HOME検索機能結果
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
// お気に入り有無取得
    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }
// 詳細ページ
    public function detail(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);
        $backRoute = '/';
        
        return view('detail', compact('user', 'shop', 'backRoute'));
    }

    public function store(Request $request)
    {
         // 画像を保存してパスを取得
        $img = $request->file('image_file');
        $path = $img->store('img', 'public');

        // フォームからの入力データを取得
        $genreId = $request->input('genre'); 
        $areaId = $request->input('area'); 
        $name = $request->input('name');
        $description = $request->input('description');

        // 新しい店舗を作成し保存する
        $shop = new Shop;
        $shop->name = $name;
        $shop->description = $description;
        $shop->genre_id = $genreId;
        $shop->area_id = $areaId;
        $shop->image_url = $path;

        $shop->save();

        $message = '店舗を新規登録しました。';
        return redirect('/admin/create')->with('message', $message);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);
        $genres = Genre::all();
        $areas = Area::all();
        $backRoute = '/';
        
        return view('admin.update', compact('user', 'shop','genres', 'areas','backRoute'));
    }

    public function update(ShopUpdateRequest $request)
    {

        //ストレージに画像を登録
        $img = $request->file('image_file');
        $path = $img->store('img', 'public');

        //更新情報を作成
        $update_info = [
            'name' => $request->name,
            'region' => $request->region,
            'genre' => $request->genre,
            'description' => $request->description
        ];
        if(!empty($path)) $update_info['image_url'] = $path;

        //更新
        $shop = Shop::find($request->id);
        $shop->update($update_info);
   
        return redirect('/admin/done');
    }

        public function done()
    {
        return view('admin.done');
    }
}
