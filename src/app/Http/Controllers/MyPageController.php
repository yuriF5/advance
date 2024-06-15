<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MyPageController extends Controller
{
    // ログインユーザー、予約、お気に入り表示
    public function mypage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        $favorites = $user->favorites()->pluck('shop_id')->toArray();
        $shops = Shop::whereIn('id', $favorites)->with('genre', 'area')->get();
        return view('mypage', compact('reservations', 'favorites', 'shops'));
    }

    // お気に入り変更
    public function updateFavorite(Request $request, $shopId)
    {
        $user = Auth::user();    
        $favoriteShopIds = $user->favorites()->pluck('shop_id')->toArray();
        $shops = Shop::whereIn('id', $favoriteShopIds)->get();
        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();
        return redirect()->back()->with('status', $message)->with('shops', $shops);
    }

    // 予約削除
    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->back();
    }

    // QR生成
    public function generateQRCode($reservationId)
    {
        // 予約情報が存在するか確認
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            abort(404); // 予約情報が見つからない場合は404エラーを返す
        }

        // QRコードの内容を生成
        $qrCodeContent = 'Reservation ID: ' . $reservationId;

        // PNG形式でQRコードを生成してレスポンスとして返す
        return response(QrCode::format('png')->size(200)->generate($qrCodeContent))->header('Content-Type', 'image/png');
    }

    // QR表示
    public function showQRCode($reservationId)
    {
        return view('qr', compact('reservationId'));
    }
}