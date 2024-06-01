<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class MyPageController extends Controller
{
    public function mypage()
{
    $user = Auth::user();
    $reservations = Reservation::where('user_id', $user->id)->get();
    $favorites = $user->favorites()->pluck('shop_id')->toArray();
    $shops = Shop::whereIn('id', $favorites)->with('genre', 'area')->get();

    return view('mypage', compact('reservations', 'favorites', 'shops'));
}


    public function updateFavorite(Request $request, $shopId)
    {
        $user = Auth::user();    
        $favoriteShopIds = $user->favorites()->pluck('shop_id')->toArray();
        $shops = Shop::whereIn('id', $favoriteShopIds)->get();
        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();
        return redirect()->back()->with('status', $message)->with('shops', $shops);
    }

    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->back();
    }

    public function showQrCode(Request $request)
    {
        // リクエストから予約IDを取得
        $reservationId = $request->input('reservation_id');

        // 予約情報を取得
        $reservation = Reservation::find($reservationId);

        // 予約が存在しない場合はリダイレクトなどの処理を行う

        // QRコードを生成します
        $writer = new Writer(new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\Image\ImagickImageBackEnd(),
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
            new \BaconQrCode\Renderer\RendererStyle\Margin(20)
        ));
        $qrCode = $writer->writeString('Reservation ID: ' . $reservationId);
        // 生成したQRコードをビューに渡して表示する
        return view('code', ['qrCode' => $qrCode]);
    }       

}