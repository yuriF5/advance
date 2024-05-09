<?php

use App\Http\Controllers\Controller;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;

class QrCodeController extends Controller
{
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
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeImage = $writer->writeString($textData);

        // ビューにQRコード画像を渡す
        return view('qrcode', ['qrCodeImage' => $qrCodeImage]);
    }
}
