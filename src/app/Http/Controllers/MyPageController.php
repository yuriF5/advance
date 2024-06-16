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
    public function showQRCode($reservationId)
    {

        // 予約情報が存在するか確認
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            abort(404); // 予約情報が見つからない場合は404エラーを返す
        }

        // QRコードの内容を生成
        $reservationData = [
            '店舗ID' => $reservation->shop->id,
            '店舗名' => $reservation->shop->name,
            '予約者名' => $reservation->user->name,
            'ご予約ID' => $reservationId,
            '予約日' => $reservation->date,
            '予約時間' => $reservation->time,
            '人数' => $reservation->number_of_people,
        ];

        // 予約情報をJSON形式に変換
        $jsonReservationData = json_encode($reservationData, JSON_UNESCAPED_UNICODE);

        // QRコードを生成 (UTF-8エンコーディングを指定)
        $qrCode = QrCode::encoding('UTF-8')->size(100)->generate($jsonReservationData);

        // QRコードをビューに渡す
        return view('qr', ['qrCode' => $qrCode, 'reservationData' => $reservationData]);
    }
}