<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use App\Models\Reservation;
use App\Models\ShopRepresentative;
use Illuminate\Support\Facades\Hash;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminRequest;


class AdminController extends Controller
{

    public function board()
    {
        $shops = Shop::all();
        $users=User::all();
        return view('admin.board', compact('shops','users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function do()
    {
        return view('admin.do');
    }

    public function index(Request $request)
{
    $userSearch = $request->input('user_search');
    $shopSearch = $request->input('shop_search');
    
    // 検索結果を取得
    $query = Reservation::query();
    
    if ($userSearch) {
        $query->whereHas('user', function ($query) use ($userSearch) {
            $query->where('name', 'like', "%$userSearch%");
        });
    }

    if ($shopSearch) {
        $query->whereHas('shop', function ($query) use ($shopSearch) {
            $query->where('name', 'like', "%$shopSearch%");
        });
    }

    $reservations = $query->get();

    // ユーザー名と店舗名を取得
    foreach ($reservations as $reservation) {
        $user = $reservation->user;
        $reservation->user_name = $user ? $user->name : 'Unknown';

        $shop = $reservation->shop;
        $reservation->shop_name = $shop ? $shop->name : 'Unknown';
    }

    return view('admin.reservation', compact('reservations'));
    }

    public function register(AdminRequest $request)
    {
        $validated = $request->validated();

        $representative = new ShopRepresentative;
        $request->input('shop_id');
        $request->input('user_id');

        $representative->save();

        return redirect()->back()->with('success', '店舗代表者を登録しました。');
    
    }

    public function displayQrCode()
    {
        // ログインしているユーザーの予約情報を取得
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();

        // 予約情報をテキストに変換
        $reservationData = [];
        foreach ($reservations as $reservation) {
            $reservationData[] = [
                'date' => $reservation->date,
                'time' => $reservation->time,
                'number_of_people' => $reservation->number_of_people,
                'name' => $reservation->shop->name 
            ];
        }
        $textData = json_encode($reservationData);

        // QRコードの生成
        $renderer = new ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(300),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeImage = $writer->writeString($textData);

        // ビューにQRコード画像を渡す
        return view('admin.qr.code', ['qrCodeImage' => $qrCodeImage]);
    }
}